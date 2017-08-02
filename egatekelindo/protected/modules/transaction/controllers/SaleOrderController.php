<?php

class SaleOrderController extends Controller {

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'view'
                || $filterChain->action->id === 'create'
                || $filterChain->action->id === 'memoAll'
                || $filterChain->action->id === 'memo') {
            if (!(Yii::app()->user->checkAccess('saleOrderCreate') || Yii::app()->user->checkAccess('saleOrderEdit')))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'admin') {
            if (!(Yii::app()->user->checkAccess('saleOrderEdit')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionCreate() {
        $saleOrder = $this->instantiate(null);
        $saleOrder->generateCodeNumber($saleOrder->header->is_tax, date('m'), date('y'));
        $saleOrder->header->admin_id = 1;

        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes.PHPExcel') . DIRECTORY_SEPARATOR . 'IOFactory.php';
        spl_autoload_register(array('YiiBase', 'autoload'));
        $model = new ImportForm;

        $customer = Search::bind(new Customer('search'), isset($_GET['Customer']) ? $_GET['Customer'] : '');
        $customerDataProvider = $customer->search();

        if (isset($_POST['ImportForm'])) {
            $model->attributes = $_POST['ImportForm'];
            $fileUpload = CUploadedFile::getInstance($model, 'file_excel');

            if ($fileUpload) {
                $path = Yii::getPathOfAlias('webroot') . '/FileExcel/' . $fileUpload;
                $fileUpload->saveAs($path);

                if (!file_exists($path))
                    die('File could not be found at: ' . $path);

                $objPHPExcel = PHPExcel_IOFactory::load($path);
                $sheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                $panel_name = array();
                $sort_number = array();
                $quantity = array();
                $unit_price = array();

                $j = 0;
                $count = 1;

                foreach ($sheet as $row) {
                    if ($count > 1) {
                        foreach ($row as $key => $val) {
                            if ($key == 'A')
                                $sort_number[$j] = $row[$key];
                            else if ($key == 'B')
                                $panel_name[$j] = $row[$key];
                            else if ($key == 'C')
                                $quantity[$j] = $row[$key];
                            else if ($key == 'D')
                                $unit_price[$j] = $row[$key];
                        }
                        $j++;
                    }
                    $count++;
                }

                for ($i = 0; $i < $j; $i++) {

                    $saleOrderDetail = new SaleOrderDetail();
                    $saleOrderDetail->panel_name = $panel_name[$i];
                    $saleOrderDetail->sort_number = $sort_number[$i];
                    $saleOrderDetail->quantity = $quantity[$i];
                    $saleOrderDetail->unit_price = $unit_price[$i];
                    $saleOrder->details[] = $saleOrderDetail;
                }

                unlink($path);
            }
        }

        if (isset($_POST['Submit'])) {
            $this->loadState($saleOrder);
            if ($saleOrder->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $saleOrder->header->id));
        }

        $this->render('create', array(
            'saleOrder' => $saleOrder,
            'customer' => $customer,
            'customerDataProvider' => $customerDataProvider,
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $saleOrder = $this->instantiate($id);
        $customer = Search::bind(new Customer('search'), isset($_GET['Customer']) ? $_GET['Customer'] : '');
        $customerDataProvider = $customer->search();

        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes.PHPExcel') . DIRECTORY_SEPARATOR . 'IOFactory.php';
        spl_autoload_register(array('YiiBase', 'autoload'));
        $model = new ImportForm;

        if (isset($_POST['ImportForm'])) {
            $model->attributes = $_POST['ImportForm'];
            $fileUpload = CUploadedFile::getInstance($model, 'file_excel');

            if ($fileUpload) {
                $path = Yii::getPathOfAlias('webroot') . '/FileExcel/' . $fileUpload;
                $fileUpload->saveAs($path);

                if (!file_exists($path))
                    die('File could not be found at: ' . $path);

                $objPHPExcel = PHPExcel_IOFactory::load($path);
                $sheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                $panel_name = array();
                $sort_number = array();
                $quantity = array();
                $unit_price = array();

                $j = 0;
                $count = 1;

                foreach ($sheet as $row) {
                    if ($count > 1) {
                        foreach ($row as $key => $val) {
                            if ($key == 'A')
                                $sort_number[$j] = $row[$key];
                            else if ($key == 'B')
                                $panel_name[$j] = $row[$key];
                            else if ($key == 'C')
                                $quantity[$j] = $row[$key];
                            else if ($key == 'D')
                                $unit_price[$j] = $row[$key];
                        }
                        $j++;
                    }
                    $count++;
                }

                for ($i = 0; $i < $j; $i++) {

                    $saleOrderDetail = new SaleOrderDetail();
                    $saleOrderDetail->panel_name = $panel_name[$i];
                    $saleOrderDetail->sort_number = $sort_number[$i];
                    $saleOrderDetail->quantity = $quantity[$i];
                    $saleOrderDetail->unit_price = $unit_price[$i];
                    $saleOrder->details[] = $saleOrderDetail;
                }

                unlink($path);
            }
        }

        if (isset($_POST['Submit'])) {
            $this->loadState($saleOrder);
            if ($saleOrder->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $saleOrder->header->id));
        }

        $this->render('update', array(
            'saleOrder' => $saleOrder,
            'customer' => $customer,
            'customerDataProvider' => $customerDataProvider,
            'model' => $model,
        ));
    }

    public function actionUpdatePanel($id) {
        $saleOrder = $this->instantiate($id);

        if (isset($_POST['Submit'])) {
            $this->loadStateDetail($saleOrder);
            if ($saleOrder->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $saleOrder->header->id));
        }

        $this->render('update_panel', array(
            'saleOrder' => $saleOrder,
        ));
    }

    public function actionView($id) {
        $saleOrder = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('sale_order_header_id', $saleOrder->id);
        $criteria->compare('t.is_inactive', 0);

        $detailsDataProvider = new CActiveDataProvider('SaleOrderDetail', array(
                    'criteria' => $criteria,
                    'pagination' => false
                ));

        if (isset($_POST['Submit']) && (int) $saleOrder->is_paid_downpayment !== 1) {
            $saleOrder->is_paid_downpayment = 1;
            if ($saleOrder->save(true, array('is_paid_downpayment')))
                $this->redirect(array('memoInvoice', 'id' => $id));
        }

        if (isset($_POST['Approve']) && (int) $saleOrder->is_approved !== 1) {
            $saleOrder->is_approved = 1;
            if ($saleOrder->save(true, array('is_approved')))
                Yii::app()->user->setFlash('confirm', 'Your Order has been approved!!!');
            else
                Yii::app()->user->setFlash('error', 'Your Order failed to approved!!!');
        }

        $this->render('view', array(
            'saleOrder' => $saleOrder,
            'detailsDataProvider' => $detailsDataProvider
        ));
    }

    public function actionMemo($id) {
        $this->render('memo', array(
            'saleOrder' => $this->loadModel($id)
        ));
    }

    public function actionMemoInvoice($id) {
        $this->render('memoInvoice', array(
            'saleOrder' => $this->loadModel($id)
        ));
    }

    public function actionMemoAll($id) {
        $saleOrder = $this->loadModel($id);
        $counterProposals = array();
        $maxCounterProposal = 0;
        foreach ($saleOrder->saleOrderDetails as $i => $saleOrderDetail) :
            $workOrderDrawingDetail = WorkOrderDrawingDetail::model()->findByAttributes(array('sale_order_detail_id' => $saleOrderDetail->id));
            if ($workOrderDrawingDetail) {
                $workOrderDrawingProposals = WorkOrderDrawingProposal::model()->findAllByAttributes(array('work_order_drawing_detail_id' => $workOrderDrawingDetail->id));
                $counterProposals[] = count($workOrderDrawingProposals);
            }
        endforeach;
        if (count($counterProposals) > 0)
            $maxCounterProposal = max($counterProposals);

        $counterRevisions = array();
        $maxCounterRevision = 0;
        foreach ($saleOrder->saleOrderDetails as $i => $saleOrderDetail) :
            $workOrderDrawingDetail = WorkOrderDrawingDetail::model()->findByAttributes(array('sale_order_detail_id' => $saleOrderDetail->id));
            if ($workOrderDrawingDetail) {
                $workOrderDrawingRevisions = WorkOrderDrawingRevision::model()->findAllByAttributes(array('work_order_drawing_detail_id' => $workOrderDrawingDetail->id));
                $counterRevisions[] = count($workOrderDrawingRevisions);
            }
        endforeach;
        if (count($counterRevisions) > 0)
            $maxCounterRevision = max($counterRevisions);

        $this->render('memoAll', array(
            'saleOrder' => $saleOrder,
            'maxCounterProposal' => $maxCounterProposal,
            'maxCounterRevision' => $maxCounterRevision
        ));
    }

    public function actionAdmin() {
        $saleOrder = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : array());

        $dataProvider = $saleOrder->resetScope()->search();

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
            'saleOrder' => $saleOrder,
            'dataProvider' => $dataProvider,
        ));
    }

    public function instantiate($id) {
        if (empty($id)) {
            $saleOrderComponent = new SaleOrderComponent(new SaleOrderHeader, array());
        } else {
            $saleOrder = $this->loadModel($id);
            $saleOrderComponent = new SaleOrderComponent($saleOrder, $saleOrder->saleOrderDetails);
        }

        return $saleOrderComponent;
    }

    public function loadModel($id) {
        $model = SaleOrderHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadState($saleOrder) {
        if (isset($_POST['SaleOrderHeader'])) {
            $saleOrder->header->attributes = $_POST['SaleOrderHeader'];
        }
    }

    public function loadStateDetail($saleOrder) {
        if (isset($_POST['SaleOrderDetail'])) {
            foreach ($_POST['SaleOrderDetail'] as $i => $item) {
                if (isset($saleOrder->details[$i]))
                    $saleOrder->details[$i]->attributes = $item;
                else {
                    $detail = new SaleOrderDetailDetail();
                    $detail->attributes = $item;
                    $saleOrder->details[] = $detail;
                }
            }
            if (count($_POST['SaleOrderDetail']) < count($saleOrder->details))
                array_splice($saleOrder->details, $i + 1);
        }
        else
            $saleOrder->details = array();
    }

    public function actionAjaxJsonCustomer() {
        if (Yii::app()->request->isAjaxRequest) {

            $customerId = isset($_POST['SaleOrderHeader']['customer_id']) ? $_POST['SaleOrderHeader']['customer_id'] : '';

            $customer = Customer::model()->findByPk($customerId);

            $object = array(
                'customerName' => CHtml::encode(CHtml::value($customer, 'name')),
                'customerCompany' => CHtml::encode(CHtml::value($customer, 'company')),
                'customerPhone' => CHtml::encode(CHtml::value($customer, 'phone')),
                'customerAddress' => CHtml::encode(CHtml::value($customer, 'address')),
                'customerTaxNumber' => CHtml::encode(CHtml::value($customer, 'tax_number')),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonCodeNumber($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleOrder = $this->instantiate($id);

            $this->loadState($saleOrder);

            $saleOrder->generateCodeNumber($saleOrder->header->is_tax, date('m'), date('y'));
            $codeNumber = CHtml::encode($saleOrder->header->getNumber(SaleOrder::CN_CONSTANT));

            echo CJSON::encode(array(
                'codeNumber' => $codeNumber,
            ));
        }
    }

}

?>
