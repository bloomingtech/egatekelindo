<?php

class SalePaymentController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function loadModel($id) {
        $model = SalePaymentHeader::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    protected function loadState(&$salePayment) {
        if (isset($_POST['SalePaymentHeader'])) {
            $salePayment->header->attributes = $_POST['SalePaymentHeader'];
        }
        if (isset($_POST['SalePaymentDetail'])) {
            foreach ($_POST['SalePaymentDetail'] as $i => $item) {
                if (isset($salePayment->details[$i]))
                    $salePayment->details[$i]->attributes = $item;
                else {
                    $detail = new SalePaymentDetail();
                    $detail->attributes = $item;
                    $salePayment->details[] = $detail;
                }
            }
            if (count($_POST['SalePaymentDetail']) < count($salePayment->details))
                array_splice($salePayment->details, $i + 1);
        }
        else
            $salePayment->details = array();
    }

    public function instantiate($id) {
        if (empty($id))
            $salePayment = new SalePayment(new SalePaymentHeader(), array());
        else {
            $salePaymentHeader = $this->loadModel($id);
            $salePayment = new SalePayment($salePaymentHeader, $salePaymentHeader->salePaymentDetails);
        }

        return $salePayment;
    }

    public function actionCreate() {
        $salePayment = $this->instantiate(null);
        $salePayment->generateCodeNumber(date('m'), date('y'));
        $salePayment->header->admin_id = 1; //Yii::app()->user->id;

        $saleInvoice = Search::bind(new SaleInvoiceHeader('search'), isset($_GET['SaleInvoiceHeader']) ? $_GET['SaleInvoiceHeader'] : array());
        $saleInvoiceDataProvider = $saleInvoice->searchBySalePayment();
        $saleReturnHeader = Search::bind(new SaleReturnHeader('search'), isset($_GET['SaleReturnHeader']) ? $_GET['SaleReturnHeader'] : array());

        $saleReturnDataProvider = $saleReturnHeader->search();
        $saleReturnDataProvider->criteria->condition = 't.id NOT IN(
			SELECT sale_return_header_id FROM ' . SalePaymentHeader::model()->tableName() . '
			WHERE sale_return_header_id IS NOT NULL
		) AND t.is_inactive = 0';


        if (isset($_POST['Submit'])) {
            $this->loadState($salePayment);

            if ($salePayment->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $salePayment->header->id));
        }

        $this->render('create', array(
            'salePayment' => $salePayment,
            'saleInvoice' => $saleInvoice,
            'saleInvoiceDataProvider' => $saleInvoiceDataProvider,
            'saleReturnHeader' => $saleReturnHeader,
            'saleReturnDataProvider' => $saleReturnDataProvider
        ));
    }

    public function actionView($id) {
        $salePayment = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('sale_payment_header_id', $salePayment->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('SalePaymentDetail', array(
                    'criteria' => $criteria,
                ));

        $detailsDataProvider->criteria->with = array(
            'saleInvoiceHeader:resetScope',
        );

        $this->render('view', array(
            'salePayment' => $salePayment,
            'detailsDataProvider' => $detailsDataProvider
        ));
    }

    public function actionMemo($id) {
        $salePayment = $this->loadModel($id);

        $this->render('memo', array(
            'salePayment' => $salePayment
        ));
    }

    public function actionAdmin() {
        $salePayment = Search::bind(new SalePaymentHeader('search'), isset($_GET['SalePaymentHeader']) ? $_GET['SalePaymentHeader'] : array());
        $dataProvider = $salePayment->resetScope()->search();

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
            'saleInvoiceCnOrdinal' => 'saleInvoice.id',
            'saleHeaderCnOrdinal' => 'saleHeader.id',
        );


        $this->render('admin', array(
            'salePayment' => $salePayment,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionUpdate($id) {
        $salePayment = $this->instantiate($id);
        $salePayment->header->admin_id = 1; //Yii::app()->user->id;

        $saleInvoice = Search::bind(new SaleInvoiceHeader('search'), isset($_GET['SaleInvoiceHeader']) ? $_GET['SaleInvoiceHeader'] : array());
        $saleInvoiceDataProvider = $saleInvoice->searchBySalePayment();

        $saleReturnHeader = Search::bind(new SaleReturnHeader('search'), isset($_GET['SaleReturnHeader']) ? $_GET['SaleReturnHeader'] : array());
        $saleReturnDataProvider = $saleReturnHeader->search();

        if (isset($_POST['Submit'])) {
            $this->loadState($salePayment);

            if ($salePayment->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $salePayment->header->id));
        }

        $this->render('update', array(
            'salePayment' => $salePayment,
            'saleInvoice' => $saleInvoice,
            'saleInvoiceDataProvider' => $saleInvoiceDataProvider,
            'saleReturnHeader' => $saleReturnHeader,
            'saleReturnDataProvider' => $saleReturnDataProvider
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $salePayment = $this->instantiate($id);

            if ($salePayment->delete(Yii::app()->db))
                Yii::app()->user->setFlash('message', 'Delete successful.');
            else
                Yii::app()->user->setFlash('message', 'Delete failed.');

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionAjaxJsonCustomer($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $customerId = (isset($_POST['SalePaymentHeader']['customer_id'])) ? $_POST['SalePaymentHeader']['customer_id'] : '';

            $customer = Customer::model()->findByPk($customerId);

            $object = array(
                'customer_id' => CHtml::value($customer, 'id'),
                'customer_name' => CHtml::value($customer, 'name'),
                'customer_company' => CHtml::value($customer, 'company'),
                'customer_address' => CHtml::value($customer, 'address'),
            );
            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlAddSaleInvoice($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $salePayment = $this->instantiate($id);

            $this->loadState($salePayment);

            if (isset($_POST['SaleInvoiceId']))
                $salePayment->addDetail($_POST['SaleInvoiceId']);

            $this->renderPartial('_detail', array(
                'salePayment' => $salePayment,
            ));
        }
    }

    public function actionAjaxHtmlResetDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $salePayment = $this->instantiate($id);

            $this->loadState($salePayment);

            if (isset($_POST['SalePaymentHeader']['customer_id']))
                $salePayment->resetDetail($_POST['SalePaymentHeader']['customer_id']);

            $this->renderPartial('_detail', array(
                'salePayment' => $salePayment,
            ));
        }
    }

    public function actionAjaxHtmlResetDetailRetur($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $salePayment = $this->instantiate($id);

            $this->loadState($salePayment);

            $this->renderPartial('_detail', array(
                'salePayment' => $salePayment,
            ));
        }
    }

    public function actionAjaxJsonSaleReturn($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $salePayment = $this->instantiate($id);

            $this->loadState($salePayment);

            $saleReturnHeader = SaleReturnHeader::model()->findByPk(
                    $_POST['SalePaymentHeader']['sale_return_header_id']
            );

            $object = array(
                'sale_return_header_codeNumber' => $saleReturnHeader->getCodeNumber(SaleReturnHeader::CN_CONSTANT),
                'sale_return_header_date' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($saleReturnHeader, 'date')),
                'totalSaleReturn' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleReturnHeader, 'grand_total'))),
                'grandTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salePayment, 'grandTotal'))),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlRemoveDetail($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $salePayment = $this->instantiate($id);

            $this->loadState($salePayment);

            $salePayment->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'salePayment' => $salePayment,
            ));
        }
    }

    public function actionAjaxJsonTotal($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $salePayment = $this->instantiate($id);

            $this->loadState($salePayment);

            $saleReturnHeader = SaleReturnHeader::model()->findByPk(
                    $_POST['SalePaymentHeader']['sale_return_header_id']
            );

            $object = array(
                'amount' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salePayment->details[$index], 'amount'))),
                'totalAmount' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salePayment, 'totalAmount'))),
                'totalSaleReturn' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleReturnHeader, 'grand_total'))),
                'grandTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salePayment, 'grandTotal'))),
            );
            echo CJSON::encode($object);
        }
    }

}