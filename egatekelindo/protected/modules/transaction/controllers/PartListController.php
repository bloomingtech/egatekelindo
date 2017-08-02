<?php

class PartListController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionCreate() {
        $partList = $this->instantiate(null);
        $partList->header->admin_id = 1;
        $partList->generateCodeNumber(date('m'), date('y'));

        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
        $dataProvider = $component->search();

        $saleOrder = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : array());
        $saleOrderDataProvider = $saleOrder->searchByPartList();

        if (isset($_POST['Submit'])) {
            $this->loadState($partList);
            if ($partList->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $partList->header->id));
        }

        $this->render('create', array(
            'partList' => $partList,
            'saleOrder' => $saleOrder,
            'saleOrderDataProvider' => $saleOrderDataProvider,
            'component' => $component,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionUpdate($id) {
        $partList = $this->instantiate($id);

        $saleOrder = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : array());
        $saleOrderDataProvider = $saleOrder->searchByPartList();

        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
        $dataProvider = $component->search();

        if (isset($_POST['Submit'])) {
            $this->loadState($partList);
            if ($partList->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $partList->header->id));
        }

        $this->render('update', array(
            'partList' => $partList,
            'saleOrder' => $saleOrder,
            'saleOrderDataProvider' => $saleOrderDataProvider,
            'component' => $component,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $model = $this->instantiate($id);

            if ($model->delete(Yii::app()->db))
                Yii::app()->user->setFlash('message', 'Delete Successful.');
            else
                Yii::app()->user->setFlash('message', 'Delete Failed.');

//			if (!isset($_GET['ajax']))
//				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionView($id) {
        $partList = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('part_list_header_id', $partList->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('PartListDetail', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'partList' => $partList,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $partList = $this->loadModel($id);

        $this->render('memo', array(
            'partList' => $partList,
        ));
    }

    public function actionAdmin() {
        $partList = Search::bind(new PartListHeader('search'), isset($_GET['PartListHeader']) ? $_GET['PartListHeader'] : array());

        $dataProvider = $partList->resetScope()->search();
        $dataProvider->criteria->with = array(
            'saleOrder:resetScope'
        );

        $dataProvider->sort->attributes = array(
            'cn_ordinal' => 't.id',
            'date' => 't.date',
            'saleOrderId' => 'saleOrder.id',
            'note' => 't.note'
        );

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';

        if ($startDate != '' || $endDate != '') {
            $startDate = (empty($startDate)) ? date('Y-m-d') : $startDate;
            $endDate = (empty($endDate)) ? date('Y-m-d') : $endDate;

            $dataProvider->criteria->addBetweenCondition('t.date', $startDate, $endDate);
        }

        $this->render('admin', array(
            'partList' => $partList,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAjaxHtmlRemoveDetail($index, $id) {
        if (Yii::app()->request->isAjaxRequest) {
            $partList = $this->instantiate($id);

            $this->loadState($partList);

            $partList->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'partList' => $partList,
            ));
        }
    }

    public function actionAjaxHtmlAddComponent($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $partList = $this->instantiate($id);

            $this->loadState($partList);

            if (isset($_POST['ComponentId']))
                $partList->addDetail($_POST['ComponentId']);

            $this->renderPartial('_detail', array(
                'partList' => $partList,
            ));
        }
    }

    public function actionAjaxJsonSale($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $partList = $this->instantiate($id);

            $this->loadState($partList);

            $saleOrder = SaleOrderHeader::model()->findByPk($_POST['PartListHeader']['sale_order_header_id']);

            $object = array(
                'sale_order_code_number' => ($saleOrder === null) ? '' : $saleOrder->getNumber(SaleOrder::CN_CONSTANT),
                'sale_order_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($saleOrder, 'date')))),
            );

            echo CJSON::encode($object);
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $partList = new PartList(new PartListHeader(), array());
        else {
            $partListHeader = $this->loadModel($id);
            $partList = new PartList($partListHeader, $partListHeader->partListDetails);
        }

        return $partList;
    }

    public function loadModel($id) {
        $model = PartListHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function loadState(&$partList) {
        if (isset($_POST['PartListHeader'])) {
            $partList->header->attributes = $_POST['PartListHeader'];
        }
        if (isset($_POST['PartListDetail'])) {
            foreach ($_POST['PartListDetail'] as $i => $item) {
                if (isset($partList->details[$i]))
                    $partList->details[$i]->attributes = $item;
                else {
                    $detail = new PartListDetail();
                    $detail->attributes = $item;
                    $partList->details[] = $detail;
                }
            }
            if (count($_POST['PartListDetail']) < count($partList->details))
                array_splice($partList->details, $i + 1);
        }
        else
            $partList->details = array();
    }

}
