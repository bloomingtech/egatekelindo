<?php

class PurchaseByRequestController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionPurchaseRequestList() {
        $purchaseRequestHeader = Search::bind(new PurchaseRequestHeader('search'), isset($_GET['PurchaseRequestHeader']) ? $_GET['PurchaseRequestHeader'] : '');
        $purchaseRequestHeaderDataProvider = $purchaseRequestHeader->searchByPurchaseOrder();
        $purchaseRequestHeaderDataProvider->criteria->with = array(
            'workOrderProductionHeader' => array(
                'with' => array(
                    'workOrderDrawingHeader' => array(
                        'with' => array(
                            'budgetingHeader' => array(
                                'with' => array(
                                    'saleOrderHeader'
                                )
                            )
                        )
                    )
                )
            )
        );

        $purchaseRequestHeaderDataProvider->criteria->order = 't.id DESC';

        $this->render('purchaseRequestList', array(
            'purchaseRequestHeader' => $purchaseRequestHeader,
            'purchaseRequestHeaderDataProvider' => $purchaseRequestHeaderDataProvider,
        ));
    }

    public function actionCreate($purchaseRequestId) {
        $purchaseRequestHeader = PurchaseRequestHeader::model()->findByPk($purchaseRequestId);

        $purchase = $this->instantiate(null);
        $purchase->header->admin_id = 1;
        $purchase->header->is_purchase_request = 1;
        $purchase->header->purchase_request_header_id = $purchaseRequestId;
        $purchase->header->project_name = (empty($purchaseRequestHeader->work_order_production_header_id)) ? null : $purchaseRequestHeader->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->project_name;
        $purchase->header->sale_order_header_id = (empty($purchaseRequestHeader->work_order_production_header_id)) ? null : $purchaseRequestHeader->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->sale_order_header_id;
        $purchase->generateCodeNumber(date('m'), date('y'));
        $purchase->addDetails($purchaseRequestId);

        $supplier = Search::bind(new Supplier('search'), isset($_GET['Supplier']) ? $_GET['Supplier'] : array());
        $supplierDataProvider = $supplier->search();

        if (isset($_POST['Submit'])) {
            $this->loadState($purchase);
            
            if ($purchase->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $purchase->header->id));
        }

        $this->render('create', array(
            'purchase' => $purchase,
            'purchaseRequestHeader' => $purchaseRequestHeader,
            'supplier' => $supplier,
            'supplierDataProvider' => $supplierDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $purchase = $this->instantiate($id);
        $purchaseRequestHeader = $purchase->header->purchaseRequestHeader;

        $supplier = Search::bind(new Supplier('search'), isset($_GET['Supplier']) ? $_GET['Supplier'] : array());
        $supplierDataProvider = $supplier->search();

        if (isset($_POST['Submit'])) {

            $this->loadState($purchase);
            if ($purchase->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $purchase->header->id));
            }
        }

        $this->render('update', array(
            'purchase' => $purchase,
            'purchaseRequestHeader' => $purchaseRequestHeader,
            'supplier' => $supplier,
            'supplierDataProvider' => $supplierDataProvider,
        ));
    }

    public function actionView($id) {
        $purchase = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('purchase_header_id', $purchase->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('PurchaseDetailRequest', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'purchase' => $purchase,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $purchase = $this->loadModel($id);

        $this->render('memo', array(
            'purchase' => $purchase,
        ));
    }

    public function actionAdmin() {
        $purchase = Search::bind(new PurchaseHeader('search'), isset($_GET['PurchaseHeader']) ? $_GET['PurchaseHeader'] : array());

        $dataProvider = $purchase->resetScope()->search();
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

        $dataProvider->criteria->condition = "t.is_purchase_request = 1";

        $this->render('admin', array(
            'purchase' => $purchase,
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

    public function actionAjaxJsonSupplier($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $supplierId = (isset($_POST['PurchaseHeader']['supplier_id'])) ? $_POST['PurchaseHeader']['supplier_id'] : '';
            $supplier = Supplier::model()->findByPk($supplierId);

            $object = array(
                'supplier_name' => CHtml::value($supplier, 'name'),
                'supplier_company' => CHtml::value($supplier, 'company'),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonTotal($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {

            $purchase = $this->instantiate($id);
            $this->loadState($purchase);

            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($purchase->details[$index], 'totalAfterDiscount')));
            $totalQuantity = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->totalQuantity));
            $totalWeight = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->totalWeight));
            $subTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->subTotal));
            $taxValue = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->calculatedTax));
            $grandTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->grandTotal));

            echo CJSON::encode(array(
                'total' => $total,
                'totalQuantity' => $totalQuantity,
                'totalWeight' => $totalWeight,
                'subTotal' => $subTotal,
                'taxValue' => $taxValue,
                'grandTotal' => $grandTotal,
            ));
        }
    }

    public function actionAjaxJsonGrandTotal($id) {
        if (Yii::app()->request->isAjaxRequest) {

            $purchase = $this->instantiate($id);
            $this->loadState($purchase);

            $taxPercentage = CHtml::encode($purchase->taxPercentage);
            $taxValue = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchase->calculatedTax));
            $grandTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->grandTotal));

            echo CJSON::encode(array(
                'taxPercentage' => $taxPercentage,
                'taxValue' => $taxValue,
                'grandTotal' => $grandTotal,
            ));
        }
    }

    public function actionAjaxHtmlRemoveDetail($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchase = $this->instantiate($id);
            $this->loadState($purchase);

            $purchase->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'purchase' => $purchase,
            ));
        }
    }

    public function instantiate($id) {
        if (empty($id)) {
            $purchaseByRequest = new PurchaseByRequest(new PurchaseHeader(), array());
        } else {
            $purchaseHeader = $this->loadModel($id);
            $purchaseByRequest = new PurchaseByRequest($purchaseHeader, $purchaseHeader->purchaseDetailRequests);
        }

        return $purchaseByRequest;
    }

    public function loadModel($id) {
        $model = PurchaseHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadState($purchaseByRequest) {
        if (isset($_POST['PurchaseHeader']))
            $purchaseByRequest->header->attributes = $_POST['PurchaseHeader'];

        if (isset($_POST['PurchaseDetailRequest'])) {
            foreach ($_POST['PurchaseDetailRequest'] as $i => $item) {
                if (isset($purchaseByRequest->details[$i]))
                    $purchaseByRequest->details[$i]->attributes = $item;
                else {
                    $detail = new PurchaseDetailRequest();
                    $detail->attributes = $item;
                    $purchaseByRequest->details[] = $detail;
                }
            }
            if (count($_POST['PurchaseDetailRequest']) < count($purchaseByRequest->details))
                array_splice($purchaseByRequest->details, $i + 1);
        }
        else
            $purchaseByRequest->details = array();
    }

}
