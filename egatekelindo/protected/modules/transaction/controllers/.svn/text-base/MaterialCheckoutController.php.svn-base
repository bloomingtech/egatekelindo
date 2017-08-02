<?php

class MaterialCheckoutController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionCreate() {
        $materialCheckout = $this->instantiate(null);
        $materialCheckout->header->admin_id = 1;
        $materialCheckout->generateCodeNumber(date('m'), date('y'));

        $packingListHeader = Search::bind(new PackingListHeader('search'), isset($_GET['PackingListHeader']) ? $_GET['PackingListHeader'] : array());
        $packingListHeaderDataProvider = $packingListHeader->searchByMaterialCheckout();

        if (isset($_POST['Submit'])) {
            $this->loadState($materialCheckout);
            if ($materialCheckout->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $materialCheckout->header->id));
        }

        $this->render('create', array(
            'materialCheckout' => $materialCheckout,
            'packingListHeader' => $packingListHeader,
            'packingListHeaderDataProvider' => $packingListHeaderDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $materialCheckout = $this->instantiate($id);

        $packingListHeader = Search::bind(new PackingListHeader('search'), isset($_GET['PackingListHeader']) ? $_GET['PackingListHeader'] : array());
        $packingListHeaderDataProvider = $packingListHeader->searchByMaterialCheckout();

        if (isset($_POST['Submit'])) {
            $this->loadState($materialCheckout);
            if ($materialCheckout->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $materialCheckout->header->id));
        }

        $this->render('update', array(
            'materialCheckout' => $materialCheckout,
            'packingListHeader' => $packingListHeader,
            'packingListHeaderDataProvider' => $packingListHeaderDataProvider,
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
        $materialCheckout = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('material_checkout_header_id', $materialCheckout->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('MaterialCheckoutDetail', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'materialCheckout' => $materialCheckout,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $materialCheckout = $this->loadModel($id);

        $this->render('memo', array(
            'materialCheckout' => $materialCheckout,
        ));
    }

    public function actionAdmin() {
        $materialCheckout = Search::bind(new MaterialCheckoutHeader('search'), isset($_GET['MaterialCheckoutHeader']) ? $_GET['MaterialCheckoutHeader'] : array());

        $dataProvider = $materialCheckout->resetScope()->search();
        $dataProvider->criteria->with = array(
            'packingListHeader:resetScope'
        );

        $dataProvider->sort->attributes = array(
            'cn_ordinal' => 't.id',
            'date' => 't.date',
            'packingListHeaderId' => 'packingListHeader.id',
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
            'materialCheckout' => $materialCheckout,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAjaxHtmlRemoveDetail($index, $id) {
        if (Yii::app()->request->isAjaxRequest) {
            $materialCheckout = $this->instantiate($id);

            $this->loadState($materialCheckout);

            $materialCheckout->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'materialCheckout' => $materialCheckout,
            ));
        }
    }

    public function actionAjaxJsonPackingList($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $materialCheckout = $this->instantiate($id);

            $this->loadState($materialCheckout);

            $packingListHeader = PackingListHeader::model()->findByPk($_POST['MaterialCheckoutHeader']['packing_list_header_id']);

            $object = array(
                'packing_list_header_code_number' => ($packingListHeader === null) ? '' : $packingListHeader->getCodeNumber(PackingListHeader::CN_CONSTANT),
                'packing_list_header_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($packingListHeader, 'date')))),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlShowPackingList($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $materialCheckout = $this->instantiate($id);

            $this->loadState($materialCheckout);

            if (isset($_POST['MaterialCheckoutHeader']['packing_list_header_id']))
                $materialCheckout->addDetailByPackingList($_POST['MaterialCheckoutHeader']['packing_list_header_id']);

            $this->renderPartial('_detail', array(
                'materialCheckout' => $materialCheckout,
            ));
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $materialCheckout = new MaterialCheckout(new MaterialCheckoutHeader(), array());
        else {
            $materialCheckoutHeader = $this->loadModel($id);
            $materialCheckout = new MaterialCheckout($materialCheckoutHeader, $materialCheckoutHeader->materialCheckoutDetails);
        }

        return $materialCheckout;
    }

    public function loadModel($id) {
        $model = MaterialCheckoutHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function loadState(&$materialCheckout) {
        if (isset($_POST['MaterialCheckoutHeader'])) {
            $materialCheckout->header->attributes = $_POST['MaterialCheckoutHeader'];
        }
        if (isset($_POST['MaterialCheckoutDetail'])) {
            foreach ($_POST['MaterialCheckoutDetail'] as $i => $item) {
                if (isset($materialCheckout->details[$i]))
                    $materialCheckout->details[$i]->attributes = $item;
                else {
                    $detail = new MaterialCheckoutDetail();
                    $detail->attributes = $item;
                    $materialCheckout->details[] = $detail;
                }
            }
            if (count($_POST['MaterialCheckoutDetail']) < count($materialCheckout->details))
                array_splice($materialCheckout->details, $i + 1);
        }
        else
            $materialCheckout->details = array();
    }

}
