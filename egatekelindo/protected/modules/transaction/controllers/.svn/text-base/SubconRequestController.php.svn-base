<?php

class SubconRequestController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionCreate() {
        $subconRequest = $this->instantiate(null);
        $subconRequest->header->admin_id = 1;
        $subconRequest->generateCodeNumber(date('m'), date('y'));

        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
        $dataProvider = $component->search();

        $saleOrder = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : array());
        $saleOrderDataProvider = $saleOrder->searchBySubcon();

        if (isset($_POST['Submit'])) {
            $this->loadState($subconRequest);
            if ($subconRequest->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $subconRequest->header->id));
            }
        }

        $this->render('create', array(
            'subconRequest' => $subconRequest,
            'component' => $component,
            'dataProvider' => $dataProvider,
            'saleOrder' => $saleOrder,
            'saleOrderDataProvider' => $saleOrderDataProvider
        ));
    }

    public function actionUpdate($id) {
        $subconRequest = $this->instantiate($id);

        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
        $dataProvider = $component->search();

        $saleOrder = Search::bind(new SaleOrder('search'), isset($_GET['SaleOrder']) ? $_GET['SaleOrder'] : array());
        $saleOrderDataProvider = $saleOrder->searchBySubcon();

        if (isset($_POST['Submit'])) {

            $this->loadState($subconRequest);
            if ($subconRequest->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $subconRequest->header->id));
            }
        }

        $this->render('update', array(
            'subconRequest' => $subconRequest,
            'component' => $component,
            'dataProvider' => $dataProvider,
            'saleOrder' => $saleOrder,
            'saleOrderDataProvider' => $saleOrderDataProvider
        ));
    }

    public function actionView($id) {
        $subconRequest = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('subcon_request_header_id', $subconRequest->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('SubconRequestDetail', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'subconRequest' => $subconRequest,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $subconRequest = $this->loadModel($id);

        $this->render('memo', array(
            'subconRequest' => $subconRequest,
        ));
    }

    public function actionAdmin() {
        $subconRequest = Search::bind(new SubconRequestHeader('search'), isset($_GET['SubconRequestHeader']) ? $_GET['SubconRequestHeader'] : array());

        $dataProvider = $subconRequest->resetScope()->search();
        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';

        if ($startDate != '' || $endDate != '') {
            $startDate = (empty($startDate)) ? date('Y-m-d') : $startDate;
            $endDate = (empty($endDate)) ? date('Y-m-d') : $endDate;

            $dataProvider->criteria->addBetweenCondition('t.date', $startDate, $endDate);
        }


        $dataProvider->sort->attributes = array(
            'cn_ordinal' => 't.id',
            'date' => 't.date',
        );

        $this->render('admin', array(
            'subconRequest' => $subconRequest,
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
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionAjaxJsonSale($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $subconRequest = $this->instantiate($id);

            $this->loadState($subconRequest);

            $saleOrder = SaleOrderHeader::model()->findByPk($_POST['SubconRequestHeader']['sale_order_header_id']);

            $object = array(
                'sale_order_code_number' => ($saleOrder === null) ? '' : $saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT),
                'sale_order_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($saleOrder, 'date')))),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlAddComponent($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $subconRequest = $this->instantiate($id);

            $this->loadState($subconRequest);

            if (isset($_POST['ComponentId']))
                $subconRequest->addDetail($_POST['ComponentId']);

            $this->renderPartial('_detail', array(
                'subconRequest' => $subconRequest,
            ));
        }
    }

    public function actionAjaxHtmlRemoveComponent($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $subconRequest = $this->instantiate($id);

            $this->loadState($subconRequest);

            $sale->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'subconRequest' => $subconRequest,
            ));
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $subconRequest = new SubconRequest(new SubconRequestHeader(), array());
        else {
            $subconRequestHeader = $this->loadModel($id);
            $subconRequest = new SubconRequest($subconRequestHeader, $subconRequestHeader->subconRequestDetails);
        }

        return $subconRequest;
    }

    public function loadModel($id) {
        $model = SubconRequestHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadState($subconRequest) {
        if (isset($_POST['SubconRequestHeader'])) {
            $subconRequest->header->attributes = $_POST['SubconRequestHeader'];
        }
        if (isset($_POST['SubconRequestDetail'])) {
            foreach ($_POST['SubconRequestDetail'] as $i => $item) {
                if (isset($subconRequest->details[$i]))
                    $subconRequest->details[$i]->attributes = $item;
                else {
                    $detail = new SubconRequestDetail();
                    $detail->attributes = $item;
                    $subconRequest->details[] = $detail;
                }
            }
            if (count($_POST['SubconRequestDetail']) < count($subconRequest->details))
                array_splice($subconRequest->details, $i + 1);
        }
        else
            $subconRequest->details = array();
    }

}
