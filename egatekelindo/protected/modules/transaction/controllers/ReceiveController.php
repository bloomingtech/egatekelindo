<?php

class ReceiveController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionPurchaseList() {
        $purchaseHeader = Search::bind(new PurchaseHeader('search'), isset($_GET['PurchaseHeader']) ? $_GET['PurchaseHeader'] : '');
        $purchaseHeaderDataProvider = $purchaseHeader->search(); 
        $purchaseHeaderDataProvider->criteria->with = array(
            'requirementHeader',
            'purchaseRequestHeader',
            'saleOrderHeader',
            'supplier'
        );

        $purchaseHeaderDataProvider->criteria->order = 't.id DESC';

        $this->render('purchaseList', array(
            'purchaseHeader' => $purchaseHeader,
            'purchaseHeaderDataProvider' => $purchaseHeaderDataProvider,
        ));
    }

    public function actionCreate($purchaseId) {
        $purchaseHeader = PurchaseHeader::model()->findByPk($purchaseId);
        
        $receive = $this->instantiate(null);
        $receive->header->admin_id = 1;
        $receive->header->purchase_header_id = $purchaseId;
        $receive->generateCodeNumber(date('m'), date('y'));
        $receive->addDetails($purchaseId);

        if (isset($_POST['Submit'])) {
            $this->loadState($receive);
            
            if ($receive->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $receive->header->id));
            }
        }

        $this->render('create', array(
            'receive' => $receive,
            'purchaseHeader' => $purchaseHeader,
        ));
    }

    public function actionUpdate($id) {
        $receive = $this->instantiate($id);

        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
        $dataProvider = $component->search();

        $supplier = Search::bind(new Supplier('search'), isset($_GET['Supplier']) ? $_GET['Supplier'] : array());
        $supplierDataProvider = $supplier->search();

        if (isset($_POST['Submit'])) {

            $this->loadState($receive);
            if ($receive->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $receive->header->id));
            }
        }

        $this->render('update', array(
            'receive' => $receive,
            'component' => $component,
            'dataProvider' => $dataProvider,
            'supplier' => $supplier,
            'supplierDataProvider' => $supplierDataProvider,
        ));
    }

    public function actionView($id) {
        $receive = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('receive_header_id', $receive->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('ReceiveDetail', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'receive' => $receive,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $receive = $this->loadModel($id);

        $this->render('memo', array(
            'receive' => $receive,
        ));
    }

    public function actionAdmin() {
        $receive = Search::bind(new ReceiveHeader('search'), isset($_GET['ReceiveHeader']) ? $_GET['ReceiveHeader'] : array());

        $dataProvider = $receive->resetScope()->search();
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
            'receive' => $receive,
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

    public function actionAjaxJsonSupplier($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $supplierId = (isset($_POST['ReceiveHeader']['supplier_id'])) ? $_POST['ReceiveHeader']['supplier_id'] : '';

            $supplier = Supplier::model()->findByPk($supplierId);

            $object = array(
                'supplier_id' => CHtml::value($supplier, 'id'),
                'supplier_name' => CHtml::value($supplier, 'name'),
                'supplier_company' => CHtml::value($supplier, 'company'),
                'supplier_address' => CHtml::value($supplier, 'address'),
            );
            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonTotal($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $sale = $this->instantiate($id);
            $this->loadState($sale);

            $discountAmount = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $sale->getDiscountAmount()));
            $unitPrice = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($sale->details[$index], 'unit_price')));
            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($sale->details[$index], 'total')));
            $subTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $sale->subTotal));
            $totalBeforeTax = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $sale->getTotalBeforeTax()));
            $taxValue = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $sale->getCalculatedTax()));
            $grandTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $sale->getGrandTotal()));

            echo CJSON::encode(array(
                'discountAmount' => $discountAmount,
                'unitPrice' => $unitPrice,
                'total' => $total,
                'subTotal' => $subTotal,
                'totalBeforeTax' => $totalBeforeTax,
                'taxValue' => $taxValue,
                'grandTotal' => $grandTotal
            ));
        }
    }

    public function actionAjaxHtmlCheckStock($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $sale = $this->instantiate($id);
            $this->loadState($sale);

            $productColorSize = ProductColorSize::model()->findByPk($_POST['SaleDetail'][$index]['product_color_size_id']);
            if ($_POST['SaleDetail'][$index]['quantity'] > $productColorSize->getInventoryStockOnHand()) {
                echo 'Quantity exceed available stock';
            }
        }
    }

    public function actionAjaxJsonTaxTotal($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $sale = $this->instantiate($id);
            $this->loadState($sale);

            $discountAmount = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $sale->getDiscountAmount()));
            $taxPercentage = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $sale->getTaxPercentage()));
            $taxValue = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $sale->getCalculatedTax()));
            $totalBeforeTax = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $sale->getTotalBeforeTax()));
            $grandTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $sale->getGrandTotal()));

            echo CJSON::encode(array(
                'discountAmount' => $discountAmount,
                'taxPercentage' => $taxPercentage,
                'taxValue' => $taxValue,
                'totalBeforeTax' => $totalBeforeTax,
                'grandTotal' => $grandTotal,
            ));
        }
    }

    public function actionAjaxHtmlAddComponent($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $receive = $this->instantiate($id);

            $this->loadState($receive);

            if (isset($_POST['ComponentId']))
                $receive->addDetail($_POST['ComponentId']);

            $this->renderPartial('_detail', array(
                'receive' => $receive,
            ));
        }
    }

    public function actionAjaxHtmlRemoveProduct($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $sale = $this->instantiate($id);
            $this->loadState($sale);

            $sale->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'sale' => $sale,
            ));
        }
    }

    public function actionAjaxHtmlUpdateProducts($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $sale = $this->instantiate($id);
            $this->loadState($sale);

            $this->renderPartial('_detail', array(
                'sale' => $sale,
            ));
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $receive = new Receive(new ReceiveHeader(), array());
        else {
            $receiveHeader = $this->loadModel($id);
            $receive = new Receive($receiveHeader, $receiveHeader->receiveDetails);
        }

        return $receive;
    }

    public function loadModel($id) {
        $model = ReceiveHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadState($receive) {
        if (isset($_POST['ReceiveHeader'])) {
            $receive->header->attributes = $_POST['ReceiveHeader'];
        }
        if (isset($_POST['ReceiveDetail'])) {
            foreach ($_POST['ReceiveDetail'] as $i => $item) {
                if (isset($receive->details[$i]))
                    $receive->details[$i]->attributes = $item;
                else {
                    $detail = new ReceiveDetail();
                    $detail->attributes = $item;
                    $receive->details[] = $detail;
                }
            }
            if (count($_POST['ReceiveDetail']) < count($receive->details))
                array_splice($receive->details, $i + 1);
        }
        else
            $receive->details = array();
    }

}
