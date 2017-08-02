<?php

class PurchaseRequestController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionCreate() {
        $purchaseRequest = $this->instantiate(null);
        $purchaseRequest->header->admin_id = 1;
        $purchaseRequest->generateCodeNumber(date('m'), date('y'));

        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
        $componentDataProvider = $component->search();

        $workOrderProduction = Search::bind(new WorkOrderProductionHeader('search'), isset($_GET['WorkOrderProductionHeader']) ? $_GET['WorkOrderProductionHeader'] : array());
        $workOrderProductionDataProvider = $workOrderProduction->search();

        if (isset($_POST['Submit'])) {
            $this->loadState($purchaseRequest);
            
            if ($purchaseRequest->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $purchaseRequest->header->id));
            }
        }

        $this->render('create', array(
            'purchaseRequest' => $purchaseRequest,
            'component' => $component,
            'componentDataProvider' => $componentDataProvider,
            'workOrderProduction' => $workOrderProduction,
            'workOrderProductionDataProvider' => $workOrderProductionDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $purchaseRequest = $this->instantiate($id);

        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
        $componentDataProvider = $component->search();

        if (isset($_POST['Submit'])) {

            $this->loadState($purchaseRequest);
            if ($purchaseRequest->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $purchaseRequest->header->id));
            }
        }

        $this->render('update', array(
            'purchaseRequest' => $purchaseRequest,
            'component' => $component,
            'componentDataProvider' => $componentDataProvider,
        ));
    }

    public function actionView($id) {
        $purchaseRequest = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('purchase_request_header_id', $purchaseRequest->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsProductDataProvider = new CActiveDataProvider('PurchaseRequestDetailComponent', array(
                    'criteria' => $criteria,
                ));

        $criteria = new CDbCriteria;
        $criteria->compare('purchase_request_header_id', $purchaseRequest->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsServiceDataProvider = new CActiveDataProvider('PurchaseRequestDetailService', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'purchaseRequest' => $purchaseRequest,
            'detailsProductDataProvider' => $detailsProductDataProvider,
            'detailsServiceDataProvider' => $detailsServiceDataProvider,
        ));
    }

    public function actionMemo($id) {
        $purchaseRequest = $this->loadModel($id);

        $this->render('memo', array(
            'purchaseRequest' => $purchaseRequest,
        ));
    }

    public function actionAdmin() {
        $purchaseRequest = Search::bind(new PurchaseRequestHeader('search'), isset($_GET['PurchaseRequestHeader']) ? $_GET['PurchaseRequestHeader'] : array());

        $dataProvider = $purchaseRequest->resetScope()->search();
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
            'purchaseRequest' => $purchaseRequest,
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

//            if (!isset($_GET['ajax']))
//                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionAjaxJsonWorkOrderProduction($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $workOrderProductionId = (isset($_POST['PurchaseRequestHeader']['work_order_production_header_id'])) ? $_POST['PurchaseRequestHeader']['work_order_production_header_id'] : '';

            $workOrderProduction = WorkOrderProductionHeader::model()->findByPk($workOrderProductionId);

            $object = array(
                'customer_project' => CHtml::value($workOrderProduction, 'workOrderDrawingHeader.budgetingHeader.saleOrderHeader.project_name'),
                'customer_company' => CHtml::value($workOrderProduction, 'workOrderDrawingHeader.budgetingHeader.saleOrderHeader.client_company'),
                'customer_sale_order' => $workOrderProduction->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT),
                'customer_work_order' => $workOrderProduction->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT),
            );
            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlAddComponentProduct($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchaseRequest = $this->instantiate($id);

            $this->loadState($purchaseRequest);

            if (isset($_POST['ComponentId']))
                $purchaseRequest->addDetailProduct($_POST['ComponentId']);

            $this->renderPartial('_detailProduct', array(
                'purchaseRequest' => $purchaseRequest,
            ));
        }
    }

    public function actionAjaxHtmlRemoveComponentProduct($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchaseRequest = $this->instantiate($id);

            $this->loadState($purchaseRequest);

            $purchaseRequest->removeDetailProductAt($index);

            $this->renderPartial('_detailProduct', array(
                'purchaseRequest' => $purchaseRequest,
            ));
        }
    }

    public function actionAjaxHtmlAddService($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchaseRequest = $this->instantiate($id);

            $this->loadState($purchaseRequest);

            $purchaseRequest->detailServices[] = new PurchaseRequestDetailService();

            $this->renderPartial('_detailService', array(
                'purchaseRequest' => $purchaseRequest,
            ));
        }
    }

    public function actionAjaxHtmlRemoveService($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchaseRequest = $this->instantiate($id);

            $this->loadState($purchaseRequest);

            $purchaseRequest->removeDetailServiceAt($index);

            $this->renderPartial('_detailService', array(
                'purchaseRequest' => $purchaseRequest,
            ));
        }
    }

    public function actionAjaxHtmlResetDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchaseRequest = $this->instantiate($id);

            $this->loadState($purchaseRequest);

            $type = Yii::app()->request->getParam('type');


            if ($type == 1) {
                $purchaseRequest->details = array();
                $purchaseRequest->detailServices = array();

                $this->renderPartial('_detailProduct', array(
                    'purchaseRequest' => $purchaseRequest,
                ));
            } else {
                $purchaseRequest->detailServices = array();
                $purchaseRequest->details = array();

                $this->renderPartial('_detailService', array(
                    'purchaseRequest' => $purchaseRequest,
                ));
            }
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $purchaseRequest = new PurchaseRequest(new PurchaseRequestHeader(), array(), array());
        else {
            $purchaseRequestHeader = $this->loadModel($id);
            $purchaseRequest = new PurchaseRequest($purchaseRequestHeader, $purchaseRequestHeader->purchaseRequestDetailComponents, $purchaseRequestHeader->purchaseRequestDetailServices);
        }

        return $purchaseRequest;
    }

    public function loadModel($id) {
        $model = PurchaseRequestHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadState($purchaseRequest) {
        if (isset($_POST['PurchaseRequestHeader'])) {
            $purchaseRequest->header->attributes = $_POST['PurchaseRequestHeader'];
        }

        if (isset($_POST['PurchaseRequestDetailComponent'])) {
            foreach ($_POST['PurchaseRequestDetailComponent'] as $i => $item) {
                if (isset($purchaseRequest->details[$i]))
                    $purchaseRequest->details[$i]->attributes = $item;
                else {
                    $detail = new PurchaseRequestDetailComponent();
                    $detail->attributes = $item;
                    $purchaseRequest->details[] = $detail;
                }
            }
            if (count($_POST['PurchaseRequestDetailComponent']) < count($purchaseRequest->details))
                array_splice($purchaseRequest->details, $i + 1);
        }
        else
            $purchaseRequest->details = array();

        if (isset($_POST['PurchaseRequestDetailService'])) {
            foreach ($_POST['PurchaseRequestDetailService'] as $i => $item) {
                if (isset($purchaseRequest->detailServices[$i]))
                    $purchaseRequest->detailServices[$i]->attributes = $item;
                else {
                    $detail = new PurchaseRequestDetailService();
                    $detail->attributes = $item;
                    $purchaseRequest->detailServices[] = $detail;
                }
            }
            if (count($_POST['PurchaseRequestDetailService']) < count($purchaseRequest->detailServices))
                array_splice($purchaseRequest->detailServices, $i + 1);
        }
        else
            $purchaseRequest->detailServices = array();
    }

}
