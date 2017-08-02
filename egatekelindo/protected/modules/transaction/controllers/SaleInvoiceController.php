<?php

class SaleInvoiceController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionCreate() {
        $saleInvoice = $this->instantiate(null);
        $saleInvoice->generateCodeNumber(date('m'), date('y'));
        $saleInvoice->header->admin_id = 1;

        $deliveryHeader = Search::bind(new DeliveryHeader('search'), isset($_GET['DeliveryHeader']) ? $_GET['DeliveryHeader'] : array());
        $deliveryHeaderDataProvider = $deliveryHeader->searchBySaleInvoice();

        if (isset($_POST['Submit'])) {
            $this->loadState($saleInvoice);
            if ($saleInvoice->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $saleInvoice->header->id));
        }

        $this->render('create', array(
            'saleInvoice' => $saleInvoice,
            'deliveryHeader' => $deliveryHeader,
            'deliveryHeaderDataProvider' => $deliveryHeaderDataProvider
        ));
    }

    public function actionUpdate($id) {
        $saleInvoice = $this->instantiate($id);

        if (isset($_POST['Submit'])) {
            $this->loadState($saleInvoice);
            if ($saleInvoice->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $saleInvoice->header->id));
        }

        $this->render('update', array(
            'saleInvoice' => $saleInvoice,
        ));
    }

    public function actionView($id) {
        $saleInvoice = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('sale_invoice_header_id', $saleInvoice->id);
        $criteria->compare('t.is_inactive', 0);

        $detailsDataProvider = new CActiveDataProvider('SaleInvoiceDetail', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'saleInvoice' => $saleInvoice,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $this->render('memo', array(
            'saleInvoice' => $this->loadModel($id)
        ));
    }

    public function actionAdmin() {
        $saleInvoiceHeader = Search::bind(new SaleInvoiceHeader('search'), isset($_GET['SaleInvoiceHeader']) ? $_GET['SaleInvoiceHeader'] : array());

        $dataProvider = $saleInvoiceHeader->resetScope()->search();

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

        $dataProvider->criteria->order = 't.id DESC';

        $this->render('admin', array(
            'saleInvoiceHeader' => $saleInvoiceHeader,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAjaxHtmlAddDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleInvoice = $this->instantiate($id);
            $this->loadState($saleInvoice);

            $saleInvoice->addDetail();

            $this->renderPartial('_detail', array(
                'saleInvoice' => $saleInvoice,
            ));
        }
    }

    public function actionAjaxHtmlRemoveDetail($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleInvoice = $this->instantiate($id);
            $this->loadState($saleInvoice);

            $saleInvoice->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'saleInvoice' => $saleInvoice,
            ));
        }
    }

    public function actionAjaxHtmlShowDelivery($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleInvoice = $this->instantiate($id);

            $this->loadState($saleInvoice);

            if (isset($_POST['SaleInvoiceHeader']['delivery_header_id']))
                $saleInvoice->addDetailByDelivery($_POST['SaleInvoiceHeader']['delivery_header_id']);

            $this->renderPartial('_detail', array(
                'saleInvoice' => $saleInvoice,
            ));
        }
    }

    public function actionAjaxJsonTotal($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleInvoice = $this->instantiate($id);
            $this->loadState($saleInvoice);

            $object = array(
                'total' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleInvoice->details[$index], 'total'))),
                'subTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $saleInvoice->getSubTotal())),
                'taxTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $saleInvoice->getTaxTotal())),
                'grandTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $saleInvoice->getGrandTotal())),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonTotalByDiscount($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleInvoice = $this->instantiate($id);
            $this->loadState($saleInvoice);

            $object = array(
                'grandTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $saleInvoice->getGrandTotal())),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonSupplier($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $supplierId = (isset($_POST['PurchaseHeader']['supplier_id'])) ? $_POST['PurchaseHeader']['supplier_id'] : '';

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

    public function actionAjaxJsonDelivery($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleInvoice = $this->instantiate($id);

            $this->loadState($saleInvoice);

            $deliveryHeader = DeliveryHeader::model()->findByPk($_POST['SaleInvoiceHeader']['delivery_header_id']);

            $object = array(
                'delivery_header_code_number' => ($deliveryHeader === null) ? '' : $deliveryHeader->getCodeNumber(DeliveryHeader::CN_CONSTANT),
                'delivery_header_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($deliveryHeader, 'date')))),
                'sale_order_code_number' => ($deliveryHeader === null) ? '' : $deliveryHeader->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT),
                'sale_order_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($deliveryHeader->saleOrder, 'date')))),
                'sale_order_work_order_number' => CHtml::encode(CHtml::value($deliveryHeader->saleOrder, 'work_order_number')),
                'sale_order_project_name' => CHtml::encode(CHtml::value($deliveryHeader->saleOrder, 'project_name')),
            );

            echo CJSON::encode($object);
        }
    }

    public function instantiate($id) {
        if (empty($id)) {
            $saleInvoice = new SaleInvoiceComponent(new SaleInvoiceHeader, array());
        } else {
            $saleInvoiceHeader = $this->loadModel($id);
            $saleInvoice = new SaleInvoiceComponent($saleInvoiceHeader, $saleInvoiceHeader->saleInvoiceDetails);
        }

        return $saleInvoice;
    }

    public function loadModel($id) {
        $model = SaleInvoiceHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadState($saleInvoice) {
        if (isset($_POST['SaleInvoiceHeader'])) {
            $saleInvoice->header->attributes = $_POST['SaleInvoiceHeader'];
        }
        if (isset($_POST['SaleInvoiceDetail'])) {
            foreach ($_POST['SaleInvoiceDetail'] as $i => $item) {
                if (isset($saleInvoice->details[$i]))
                    $saleInvoice->details[$i]->attributes = $item;
                else {
                    $detail = new SaleInvoiceDetail();
                    $detail->attributes = $item;
                    $saleInvoice->details[] = $detail;
                }
            }
            if (count($_POST['SaleInvoiceDetail']) < count($saleInvoice->details))
                array_splice($saleInvoice->details, $i + 1);
        }
        else
            $saleInvoice->details = array();
    }

}

?>
