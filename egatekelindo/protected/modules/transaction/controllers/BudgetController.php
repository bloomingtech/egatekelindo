<?php

class BudgetController extends CrudController {

    public function instantiate($id) {
        if (empty($id))
            $budget = new Budget(new BudgetingHeader(), array(), array(), array(), array(), array());
        else {
            $budgetHeader = $this->loadModel($id);
            $budget = new Budget($budgetHeader, $budgetHeader->budgetingDetails,
                            $budgetHeader->saleOrderHeader->saleOrderDetails, $budgetHeader->budgetingBrandDiscounts, $budgetHeader->budgetingCurrencies, $budgetHeader->budgetingBrandDiscounts);
        }
        return $budget;
    }

    public function instantiateDetail($id) {

        $budgetHeader = $this->loadModel($id);
        $budget = new BudgetDetail($budgetHeader->budgetingDetails, $budgetHeader->budgetingDetailAccesories);

        return $budget;
    }

    public function loadModel($id) {
        $model = BudgetingHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadState($budget) {
        // Load Header
        if (isset($_POST['BudgetingHeader'])) {
            $budget->header->attributes = $_POST['BudgetingHeader'];
        }

        // Load Detail
        if (isset($_POST['BudgetingDetail'])) {
            foreach ($_POST['BudgetingDetail'] as $i => $item) {
                if (isset($budget->details[$i]))
                    $budget->details[$i]->attributes = $item;
                else {
                    $detail = new BudgetingDetail();
                    $detail->attributes = $item;
                    $budget->details[] = $detail;
                }
            }
        }
        else
            $budget->details = array();

        // Load panel
        if (isset($_POST['EstimationPanel'])) {
            foreach ($_POST['EstimationPanels'] as $i => $item) {
                if (isset($budget->panels[$i]))
                    $budget->panels[$i]->attributes = $item;
                else {
                    $panel = new EstimationPanel();
                    $panel->attributes = $item;
                    $budget->panels[] = $panel;
                }
            }
        }
        else
            $budget->panels = array();

        // Load Discount
        if (isset($_POST['EstimationBrandDiscount'])) {
            foreach ($_POST['EstimationBrandDiscount'] as $i => $item) {
                if (isset($budget->discounts[$i]))
                    $budget->discounts[$i]->attributes = $item;
                else {
                    $discount = new EstimationBrandDiscount();
                    $discount->attributes = $item;
                    $budget->discounts[] = $discount;
                }
            }
        }
        else
            $budget->discounts = array();

        // Load budgetingCurrency
        if (isset($_POST['BudgetingCurrency'])) {
            foreach ($_POST['BudgetingCurrency'] as $i => $item) {
                if (isset($budget->budgetingCurrencies[$i]))
                    $budget->budgetingCurrencies[$i]->attributes = $item;
                else {
                    $budgetingCurrency = new BudgetingCurrency();
                    $budgetingCurrency->attributes = $item;
                    $budget->budgetingCurrencies[] = $budgetingCurrency;
                }
            }
        }
        else
            $budget->budgetingCurrencies = array();


        // Load budgetingBrandDiscount
        if (isset($_POST['BudgetingBrandDiscount'])) {
            foreach ($_POST['BudgetingBrandDiscount'] as $i => $item) {
                if (isset($budget->budgetingBrandDiscounts[$i]))
                    $budget->budgetingBrandDiscounts[$i]->attributes = $item;
                else {
                    $budgetingBrandDiscount = new BudgetingBrandDiscount();
                    $budgetingBrandDiscount->attributes = $item;
                    $budget->budgetingBrandDiscounts[] = $budgetingBrandDiscount;
                }
            }
        }
        else
            $budget->budgetingBrandDiscounts = array();
    }

    public function loadStateDetail($budgetDetail) {

        if (isset($_POST['BudgetingDetail'])) {
            foreach ($_POST['BudgetingDetail'] as $i => $item) {
                if (isset($budgetDetail->details[$i]))
                    $budgetDetail->details[$i]->attributes = $item;
                else {
                    $budgetingDetail = new BudgetingDetail();
                    $budgetingDetail->attributes = $item;
                    $budgetDetail->details[] = $budgetingDetail;
                }
            }
        }
        else
            $budgetDetail->details = array();


        if (isset($_POST['BudgetingDetailAccesories'])) {
            foreach ($_POST['BudgetingDetailAccesories'] as $i => $item) {
                if (isset($budgetDetail->detailAccesories[$i]))
                    $budgetDetail->detailAccesories[$i]->attributes = $item;
                else {
                    $budgetingDetailAccesories = new BudgetingDetailAccesories();
                    $budgetingDetailAccesories->attributes = $item;
                    $budgetDetail->detailAccesories[] = $budgetingDetailAccesories;
                }
            }
        }
        else
            $budgetDetail->detailAccesories = array();
    }

    public function actionSaleOrderList() {
        $saleOrderHeader = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : '');
        $saleOrderHeaderDataProvider = $saleOrderHeader->search();
        $saleOrderHeaderDataProvider->criteria->addCondition(
                't.id IN (
			SELECT sale_order_header_id
			FROM tblet_estimation_header
			)
                    AND
                    t.id NOT IN (
			SELECT sale_order_header_id
			FROM tblet_budgeting_header
			)
                    AND t.is_inactive = 0'
        );

        $saleOrderHeaderDataProvider->criteria->order = 't.id DESC';

        $this->render('saleOrderList', array(
            'saleOrderHeader' => $saleOrderHeader,
            'saleOrderHeaderDataProvider' => $saleOrderHeaderDataProvider,
        ));
    }

    public function actionCreate($saleOrderId) {
        $budget = $this->instantiate(null);

        $saleOrder = SaleOrderHeader::model()->findByPk($saleOrderId);
		$estimationHeader = EstimationHeader::model()->findByAttributes(array('sale_order_header_id' => $saleOrderId));

        $budget->header->sale_order_header_id = $saleOrderId;
		$budget->header->estimation_header_id = $estimationHeader->id;
        $budget->header->cn_ordinal = $saleOrder->cn_ordinal;

        $budget->addBudgetingCurrencies();
        $budget->addBudgetingBrandDiscounts();

        if (isset($_POST['save'])) {
            // Load Data
            $this->loadState($budget);
            $budget->header->cn_month = date('n', strtotime($budget->header->date));
            $budget->header->cn_year = date('y', strtotime($budget->header->date));


            // Save it
            if ($budget->save(yii::app()->db))
                $this->redirect(array('view', 'id' => $budget->header->id));
        }

        $saleOrderHeader = Search::bind(new SaleOrderHeader, isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : '');
        $saleOrderHeaderDataProvider = $saleOrderHeader->search();

        $this->render('create', array(
            'budget' => $budget,
            'saleOrderHeader' => $saleOrderHeader,
            'saleOrderHeaderDataProvider' => $saleOrderHeaderDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $budget = $this->instantiate($id);

        if (isset($_POST['save'])) {
            // Load Data
            $this->loadState($budget);

            // Save it
            if ($budget->saveHeader(yii::app()->db))
                $this->redirect(array('view', 'id' => $budget->header->id));
        }

        $saleOrderHeader = Search::bind(new SaleOrderHeader, isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : '');
        $saleOrderHeaderDataProvider = $saleOrderHeader->search();

        $this->render('update', array(
            'budget' => $budget,
            'saleOrderHeader' => $saleOrderHeader,
            'saleOrderHeaderDataProvider' => $saleOrderHeaderDataProvider,
        ));
    }

    public function actionView($id) {
        $budget = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('sale_order_header_id', $budget->sale_order_header_id);
        $criteria->compare('is_inactive', 0);

        $detailDataProvider = new CActiveDataProvider('SaleOrderDetail', array(
                    'criteria' => $criteria,
                    'pagination' => false
                ));
        $this->render('view', array(
            'budget' => $budget,
            'detailDataProvider' => $detailDataProvider,
        ));
    }

    public function actionViewDetail($id, $headerId) {
        $budget = $this->loadModel($headerId);

        $criteria = new CDbCriteria;
        $criteria->compare('sale_order_detail_id', $id);
        $criteria->compare('budgeting_header_id', $headerId);
        $criteria->compare('is_inactive', 0);

        $detailDataProvider = new CActiveDataProvider('BudgetingDetail', array(
                    'criteria' => $criteria,
                    'pagination' => false
                ));

        $budgetingDetailAccesories = new CActiveDataProvider('BudgetingDetailAccesories', array(
                    'criteria' => $criteria,
                    'pagination' => false
                ));

        $saleOrderDetail = SaleOrderDetail::model()->findByPk($id);

        $this->render('viewDetail', array(
            'budget' => $budget,
            'detailDataProvider' => $detailDataProvider,
            'budgetingDetailAccesories' => $budgetingDetailAccesories,
            'saleOrderDetail' => $saleOrderDetail,
        ));
    }

    public function actionEditDetail($id, $headerId) {
        $budgetDetail = $this->instantiateDetail($headerId);
        $budgetHeader = $this->loadModel($headerId);

        $criteria = new CDbCriteria;
        $criteria->compare('sale_order_detail_id', $id);
        $criteria->compare('budgeting_header_id', $headerId);

        $detailDataProvider = new CActiveDataProvider('BudgetingDetail', array(
                    'criteria' => $criteria,
                    'pagination' => false
                ));

        $budgetingDetailAccesories = new CActiveDataProvider('BudgetingDetailAccesories', array(
                    'criteria' => $criteria,
                    'pagination' => false
                ));

        $saleOrderDetail = SaleOrderDetail::model()->findByPk($id);

        if (isset($_POST['save'])) {
            $this->loadStateDetail($budgetDetail);
            if ($budgetDetail->save(yii::app()->db))
                $this->redirect(array('viewDetail', 'id' => $id, 'headerId' => $headerId));
        }

        $this->render('editDetail', array(
            'budget' => $budgetHeader,
            'detailDataProvider' => $detailDataProvider,
            'budgetingDetailAccesories' => $budgetingDetailAccesories,
            'saleOrderDetail' => $saleOrderDetail,
        ));
    }

    public function actionUploadDetail($id, $headerId) {

        $saleOrderDetail = SaleOrderDetail::model()->findByPk($id);
        $panelName = $saleOrderDetail->panel_name;
        $budget = $this->loadModel($headerId);

        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes.PHPExcel') . DIRECTORY_SEPARATOR . 'IOFactory.php';
        spl_autoload_register(array('YiiBase', 'autoload'));

        $model = new ImportForm;

        if (isset($_POST['ImportForm'])) {
            $model->attributes = $_POST['ImportForm'];

            $fileUpload = CUploadedFile::getInstance($model, 'file_excel');
            $path = Yii::getPathOfAlias('webroot') . '/FileExcel/' . $fileUpload;
            $fileUpload->saveAs($path);

            if (!file_exists($path))
                die('File could not be found at: ' . $path);

            $objPHPExcel = PHPExcel_IOFactory::load($path);
            $sheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $sort_number = array();
            $component_name = array();
            $quantity = array();
            $unit_price = array();
            $type = array();
            $brand_name = array();
            $accesories_phase_value = array();
            $budgeting_brand_discount_id = array();

            $j = 0;
            $count = 1;

            foreach ($sheet as $row) {
                if ($count > 1) {
                    foreach ($row as $key => $val) {
                        if ($key == 'A')
                            $sort_number[$j] = $row[$key];
                        else if ($key == 'B')
                            $component_name[$j] = $row[$key];
                        else if ($key == 'C')
                            $quantity[$j] = $row[$key];
                        else if ($key == 'D')
                            $unit_price[$j] = $row[$key];
                        else if ($key == 'E')
                            $type[$j] = $row[$key];
                        else if ($key == 'F')
                            $brand_name[$j] = $row[$key];
                        else if ($key == 'G')
                            $accesories_phase_value[$j] = $row[$key];
                        else if ($key == 'H')
                            $budgeting_brand_discount_id[$j] = $row[$key];
                    }
                    $j++;
                }
                $count++;
            }

            for ($i = 0; $i < $j; $i++) {

                $budgetingDetail = new BudgetingDetail();
                $budgetingDetail->component_name = $component_name[$i];
                $budgetingDetail->quantity = $quantity[$i];
                $budgetingDetail->unit_price = $unit_price[$i];
                $budgetingDetail->accessories_phase_value = $accesories_phase_value[$i];
                $budgetingDetail->budgeting_brand_discount_id = $budgeting_brand_discount_id[$i];
                $budgetingDetail->type = $type[$i];
                $budgetingDetail->brand_name = $brand_name[$i];
                $budgetingDetail->sort_number = $sort_number[$i];
                $budgetingDetail->sale_order_detail_id = $id;
                $budgetingDetail->budgeting_header_id = $headerId;

                $dbTransaction = Yii::app()->db->beginTransaction();
                try {
                    $valid = $budgetingDetail->save();

                    if ($valid)
                        $dbTransaction->commit();
                    else {
                        Yii::app()->user->setFlash('message', 'Upload failed');
                        $dbTransaction->rollback();
                    }
                } catch (Exception $e) {
                    Yii::app()->user->setFlash('error', $e);
                    $dbTransaction->rollback();
                }
            }

            unlink($path);
            Yii::app()->user->setFlash('message', 'Upload Successful.');
        }

        $this->render('upload', array(
            'model' => $model,
            'panelName' => $panelName,
            'budget' => $budget
        ));
    }

    public function actionUploadDetailAccesories($id, $headerId) {

        $saleOrderDetail = SaleOrderDetail::model()->findByPk($id);
        $panelName = $saleOrderDetail->panel_name;
        $budget = $this->loadModel($headerId);

        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes.PHPExcel') . DIRECTORY_SEPARATOR . 'IOFactory.php';
        spl_autoload_register(array('YiiBase', 'autoload'));

        $model = new ImportForm;

        if (isset($_POST['ImportForm'])) {
            $model->attributes = $_POST['ImportForm'];

            $fileUpload = CUploadedFile::getInstance($model, 'file_excel');
            $path = Yii::getPathOfAlias('webroot') . '/FileExcel/' . $fileUpload;
            $fileUpload->saveAs($path);

            if (!file_exists($path))
                die('File could not be found at: ' . $path);

            $objPHPExcel = PHPExcel_IOFactory::load($path);
            $sheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $sort_number = array();
            $component_name = array();
            $quantity = array();
            $weight = array();
            $unit_price = array();
            $type = array();
            $brand_name = array();

            $j = 0;
            $count = 1;

            foreach ($sheet as $row) {
                if ($count > 1) {
                    foreach ($row as $key => $val) {
                        if ($key == 'A')
                            $sort_number[$j] = $row[$key];
                        else if ($key == 'B')
                            $component_name[$j] = $row[$key];
                        else if ($key == 'C')
                            $brand_name[$j] = $row[$key];
                        else if ($key == 'D')
                            $type[$j] = $row[$key];
                        else if ($key == 'E')
                            $quantity[$j] = $row[$key];
                        else if ($key == 'F')
                            $weight[$j] = $row[$key];
                        else if ($key == 'G')
                            $unit_price[$j] = $row[$key];
                    }
                    $j++;
                }
                $count++;
            }
            $valid = FALSE;
            for ($i = 0; $i < $j; $i++) {

                $budgetingDetailAccesories = new BudgetingDetailAccesories();
                $budgetingDetailAccesories->component_name = $component_name[$i];
                $budgetingDetailAccesories->quantity = $quantity[$i];
                $budgetingDetailAccesories->weight = $weight[$i];
                $budgetingDetailAccesories->unit_price = $unit_price[$i];
                ;
                $budgetingDetailAccesories->type = $type[$i];
                $budgetingDetailAccesories->brand_name = $brand_name[$i];
                $budgetingDetailAccesories->sort_number = $sort_number[$i];
                $budgetingDetailAccesories->sale_order_detail_id = $id;
                $budgetingDetailAccesories->budgeting_header_id = $headerId;

                $valid = $budgetingDetailAccesories->save() && $valid;
            }

            $budgetingHeader = BudgetingHeader::model()->findByPk($headerId);
            if ($budgetingHeader) {
                $budgetingHeader->wiring_value = $budgetingHeader->getTotalWiring($id);
                $valid = $budgetingHeader->save() && $valid;
            }

            $dbTransaction = Yii::app()->db->beginTransaction();
            try {
                if ($valid)
                    $dbTransaction->commit();
                else {
                    Yii::app()->user->setFlash('message', 'Upload failed.');
                    $dbTransaction->rollback();
                }
            } catch (Exception $e) {
                Yii::app()->user->setFlash('error', 'Upload failed.');
                $dbTransaction->rollback();
            }

            unlink($path);
            Yii::app()->user->setFlash('message', 'Upload Successful.');
        }

        $this->render('upload_accesories', array(
            'model' => $model,
            'panelName' => $panelName,
            'budget' => $budget
        ));
    }

    public function actionAdmin() {
        $header = Search::bind(new BudgetingHeader, isset($_GET['BudgetingHeader']) ? $_GET['BudgetingHeader'] : '');
        //$header = Search::bind(new BudgetingHeader('search'), isset($_GET['BudgetingHeader']) ? $_GET['BudgetingHeader'] : array());
        $projectName = isset($_GET['ProjectName']) ? $_GET['ProjectName'] : '';

        $dataProvider = $header->search();

        $saleOrderCnOrdinal = isset($_GET['SaleOrderCnOrdinal']) ? $_GET['SaleOrderCnOrdinal'] : '';
        $saleOrderCnMonth = isset($_GET['SaleOrderCnMonth']) ? $_GET['SaleOrderCnMonth'] : '';
        $saleOrderCnYear = isset($_GET['SaleOrderCnYear']) ? $_GET['SaleOrderCnYear'] : '';

        $dataProvider->criteria->with = array(
            'saleOrderHeader:resetScope'
        );

        $dataProvider->criteria->compare('saleOrderHeader.cn_ordinal', $saleOrderCnOrdinal);
        $dataProvider->criteria->compare('saleOrderHeader.cn_month', $saleOrderCnMonth);
        $dataProvider->criteria->compare('saleOrderHeader.cn_year', $saleOrderCnYear);

        $dataProvider->criteria->addCondition("saleOrderHeader.project_name LIKE :projectName");
        $dataProvider->criteria->params[':projectName'] = "%{$projectName}%";

        $this->render('admin', array(
            'header' => $header,
            'dataProvider' => $dataProvider,
            'projectName' => $projectName,
            'saleOrderCnOrdinal' => $saleOrderCnOrdinal,
            'saleOrderCnMonth' => $saleOrderCnMonth,
            'saleOrderCnYear' => $saleOrderCnYear
        ));
    }

    public function actionAjaxHtmlResetDiscount($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $budget = $this->instantiate($id);
            $this->loadState($budget);

            $budget->resetDiscount();

            $this->renderPartial('_detail', array(
                'budget' => $budget,
            ));
        }
    }

    public function actionAjaxHtmlResetPanel($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $budget = $this->instantiate($id);
            $this->loadState($budget);

            $budget->resetPanel();

            $this->renderPartial('_detail_panel', array(
                'budget' => $budget,
            ));
        }
    }

    public function actionAjaxHtmlAddDiscount($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $budget = $this->instantiate($id);
            $this->loadState($budget);

            $budget->resetDiscount();
            $budget->addDiscount($_POST['BudgetingHeader']['estimation_header_id']);

            $this->renderPartial('_detail', array(
                'budget' => $budget,
            ));
        }
    }

    public function actionAjaxHtmlAddPanel($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $budget = $this->instantiate($id);
            $this->loadState($budget);

            $budget->resetPanel();
            $budget->addPanel($_POST['BudgetingHeader']['sale_order_header_id']);

            $this->renderPartial('_detail_panel', array(
                'budget' => $budget,
            ));
        }
    }

    public function actionAjaxJsonBudget($id) {
        if (yii::app()->request->isAjaxRequest) {
            $budget = $this->instantiate($id);
            $this->loadState($budget);

            if (isset($_POST['BudgetingHeader']['sale_order_header_id']))
                $saleOrderHeader = SaleOrderHeader::model()->findByPk($_POST['BudgetingHeader']['sale_order_header_id']);

            $object = array(
                'saleOrderNumber' => CHtml::encode($saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)),
                'saleOrderCompany' => CHtml::encode(CHtml::value($saleOrderHeader, 'client_company')),
                'saleOrderProject' => CHtml::encode(CHtml::value($saleOrderHeader, 'project_name')),
                'saleOrderClient' => CHtml::encode(CHtml::value($saleOrderHeader, 'client_name')),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionMemo($id) {
		set_time_limit(0);
		ini_set('memory_limit', '1024M');
		
        $budget = $this->instantiate($id);
        $componentGroups = array();

        $supportingComponents = array();

        $estimationHeader = EstimationHeader::model()->findByAttributes(array('sale_order_header_id' => $budget->header->sale_order_header_id));
        if ($estimationHeader){
            foreach ($estimationHeader->estimationPanels as $estimationPanel) {
                foreach ($estimationPanel->estimationComponents as $estimationComponent) {
                    $exist = FALSE;
                    foreach ($componentGroups as $componentGroup) {
                        if ($estimationComponent->component->component_group_id == $componentGroup->id)
                            $exist = TRUE;
                    }

                    if (!$exist)
                        $componentGroups[] = $estimationComponent->component->componentGroup;
                }
            }
		}

        foreach ($budget->header->budgetingDetails as $budgetingDetail) {
            if ($budgetingDetail->component->component_group_id == 2) {
                $exist = FALSE;
                foreach ($supportingComponents as $supportingComponent) {
                    if ($budgetingDetail->component->component_category_id == $supportingComponent->id)
                        $exist = TRUE;
				}
				
                if (!$exist)
                    $supportingComponents[] = $budgetingDetail->component->componentCategory;
            }
        }

        $this->render('memo', array(
            'budget' => $budget,
            'componentGroups' => $componentGroups,
            'supportingComponents' => $supportingComponents
        ));
    }

}
