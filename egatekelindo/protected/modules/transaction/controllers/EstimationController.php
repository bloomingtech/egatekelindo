<?php

class EstimationController extends CrudController {

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'view'
                || $filterChain->action->id === 'create'
                || $filterChain->action->id === 'saleOrderList'
                || $filterChain->action->id === 'memo') {
            if (!(Yii::app()->user->checkAccess('estimationCreate') || Yii::app()->user->checkAccess('estimationEdit')))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'admin') {
            if (!(Yii::app()->user->checkAccess('estimationEdit')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function instantiate($id) {
        if (empty($id))
            $estimation = new Estimation(new EstimationHeader(), array(), array(), array(), array(), array());
        else {
            $estimationHeader = $this->loadModel($id);
            $estimation = new Estimation($estimationHeader, $estimationHeader->estimationBrandDiscounts, $estimationHeader->estimationPanels, $estimationHeader->estimationPanels[0]->estimationComponents, $estimationHeader->estimationPanels[0]->estimationComponentAccesories, $estimationHeader->estimationCurrencies);
        }
        return $estimation;
    }

    public function instantiateModel($id, $index) {
        if (empty($id))
            $estimation = new Estimation(new EstimationHeader(), array(), array(), array(), array(), array());
        else {
            $estimationHeader = $this->loadModel($id);
            $estimation = new Estimation($estimationHeader, $estimationHeader->estimationBrandDiscounts, $estimationHeader->estimationPanels, $estimationHeader->estimationPanels[$index]->estimationComponents, $estimationHeader->estimationPanels[$index]->estimationComponentAccesories, $estimationHeader->estimationCurrencies);
        }
        return $estimation;
    }

    public function instantiatePanel($id) {
        if (empty($id))
            $panel = new Panel(new EstimationPanel(), array(), array(), array());
        else {
            $estimationPanel = $this->loadModelPanel($id);
            $panel = new Panel($estimationPanel, $estimationPanel->estimationComponents(array('order' => 'sort_number ASC')), $estimationPanel->estimationComponentAccesories(array('order' => 'sort_number ASC')), $estimationPanel->estimationComponentGroups);
        }
        return $panel;
    }

    public function loadStateModel($model) {
        //load detail Component
        $model->detailComponents = null;
        if (isset($_POST['EstimationComponent'])) {
            foreach ($_POST['EstimationComponent'] as $i => $item) {
                if (isset($model->detailComponents[$i]))
                    $model->detailComponents[$i]->attributes = $item;
                else {
                    $detail = new EstimationComponent();
                    $detail->attributes = $item;
                    $model->detailComponents[] = $detail;
                }
            }
            if (count($_POST['EstimationComponent']) < count($model->detailComponents))
                array_splice($model->detailComponents, $i + 1);
        }
        else
            $model->detailComponents = array();

        //load detail Component
        $model->detailAccesories = null;
        if (isset($_POST['EstimationComponentAccesories'])) {
            foreach ($_POST['EstimationComponentAccesories'] as $i => $item) {
                if (isset($model->detailAccesories[$i]))
                    $model->detailAccesories[$i]->attributes = $item;
                else {
                    $detail = new EstimationComponentAccesories();
                    $detail->attributes = $item;
                    $model->detailAccesories[] = $detail;
                }
            }
            if (count($_POST['EstimationComponentAccesories']) < count($model->detailAccesories))
                array_splice($model->detailAccesories, $i + 1);
        }
        else
            $model->detailAccesories = array();
    }

    public function loadState($estimation) {
        // Load Header
        if (isset($_POST['EstimationHeader'])) {
            $estimation->header->attributes = $_POST['EstimationHeader'];
        }

        // Load Detail
        if (isset($_POST['EstimationBrandDiscount'])) {
            foreach ($_POST['EstimationBrandDiscount'] as $i => $item) {
                if (isset($estimation->details[$i]))
                    $estimation->details[$i]->attributes = $item;
                else {
                    $detail = new EstimationBrandDiscount();
                    $detail->attributes = $item;
                    $estimation->details[] = $detail;
                }
            }
        }
        else
            $estimation->details = array();

        // Load panel
        if (isset($_POST['EstimationPanel'])) {
            foreach ($_POST['EstimationPanel'] as $i => $item) {
                if (isset($estimation->panels[$i]))
                    $estimation->panels[$i]->attributes = $item;
                else {
                    $panel = new EstimationPanel();
                    $panel->attributes = $item;
                    $estimation->panels[] = $panel;
                }
            }
        }
        else
            $estimation->panels = array();

        //load detail Component
        if (isset($_POST['EstimationComponent'])) {
            foreach ($_POST['EstimationComponent'] as $i => $item) {
                if (isset($estimation->detailComponents[$i]))
                    $estimation->detailComponents[$i]->attributes = $item;
                else {
                    $detail = new EstimationComponent();
                    $detail->attributes = $item;
                    $estimation->detailComponents[] = $detail;
                }
            }
            if (count($_POST['EstimationComponent']) < count($estimation->detailComponents))
                array_splice($estimation->detailComponents, $i + 1);
        }
        else
            $estimation->detailComponents = array();

        //load detail Component Accesories
        if (isset($_POST['EstimationComponentAccesories'])) {
            foreach ($_POST['EstimationComponentAccesories'] as $i => $item) {
                if (isset($estimation->detailAccesories[$i]))
                    $estimation->detailAccesories[$i]->attributes = $item;
                else {
                    $detail = new EstimationComponentAccesories();
                    $detail->attributes = $item;
                    $estimation->detailAccesories[] = $detail;
                }
            }
            if (count($_POST['EstimationComponentAccesories']) < count($estimation->detailAccesories))
                array_splice($estimation->detailAccesories, $i + 1);
        }
        else
            $estimation->detailAccesories = array();


        // Load estimationCurrency
        if (isset($_POST['EstimationCurrency'])) {
            foreach ($_POST['EstimationCurrency'] as $i => $item) {
                if (isset($estimation->estimationCurrencies[$i]))
                    $estimation->estimationCurrencies[$i]->attributes = $item;
                else {
                    $estimationCurrency = new EstimationCurrency();
                    $estimationCurrency->attributes = $item;
                    $estimation->estimationCurrencies[] = $estimationCurrency;
                }
            }
        }
        else
            $estimation->estimationCurrencies = array();
    }

    public function loadStatePanel($panel) {
        // Load Header
        if (isset($_POST['EstimationPanel'])) {
            $panel->header->attributes = $_POST['EstimationPanel'];
        }

        //load detail EstimationComponentGroup
        if (isset($_POST['EstimationComponentGroup'])) {
            foreach ($_POST['EstimationComponentGroup'] as $i => $item) {
                if (isset($panel->componentGroups[$i]))
                    $panel->componentGroups[$i]->attributes = $item;
                else {
                    $detail = new EstimationComponentGroup();
                    $detail->attributes = $item;
                    $panel->componentGroups[] = $detail;
                }
            }
            if (count($_POST['EstimationComponentGroup']) < count($panel->componentGroups))
                array_splice($panel->componentGroups, $i + 1);
        }
        else
            $panel->componentGroups = array();

        //load detail Component
        if (isset($_POST['EstimationComponent'])) {
            foreach ($_POST['EstimationComponent'] as $i => $item) {
                if (isset($panel->detailComponents[$i]))
                    $panel->detailComponents[$i]->attributes = $item;
                else {
                    $detail = new EstimationComponent();
                    $detail->attributes = $item;
                    $panel->detailComponents[] = $detail;
                }
            }
            if (count($_POST['EstimationComponent']) < count($panel->detailComponents))
                array_splice($panel->detailComponents, $i + 1);
        }
        else
            $panel->detailComponents = array();

        //load detail Component Accesories
        if (isset($_POST['EstimationComponentAccesories'])) {
            foreach ($_POST['EstimationComponentAccesories'] as $i => $item) {
                if (isset($panel->detailAccesories[$i]))
                    $panel->detailAccesories[$i]->attributes = $item;
                else {
                    $detail = new EstimationComponentAccesories();
                    $detail->attributes = $item;
                    $panel->detailAccesories[] = $detail;
                }
            }
            if (count($_POST['EstimationComponentAccesories']) < count($panel->detailAccesories))
                array_splice($panel->detailAccesories, $i + 1);
        }
        else
            $panel->detailAccesories = array();
    }

    public function loadModel($id) {
        $model = EstimationHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelPanel($id) {
        $model = EstimationPanel::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionSaleOrderList() {
        $saleOrderHeader = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : '');
        $saleOrderHeaderDataProvider = $saleOrderHeader->search();
        $saleOrderHeaderDataProvider->criteria->addCondition(
                't.id NOT IN (
			SELECT sale_order_header_id
			FROM tblet_estimation_header
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
        $estimation = $this->instantiate(null);
        $estimation->generateCodeNumber();

        $saleOrderHeader = SaleOrderHeader::model()->findByPk($saleOrderId);
        $estimation->header->sale_order_header_id = $saleOrderId;
        $estimation->header->cn_ordinal = $saleOrderHeader->cn_ordinal;
        $estimation->header->project_name = $saleOrderHeader->project_name;
        $estimation->header->client_company = $saleOrderHeader->client_company;
        $estimation->header->client_name = $saleOrderHeader->client_name;

        $estimation->addEstimationCurrencies();
        $estimation->addDetails();

        $brand = Search::bind(new ComponentBrand, isset($_GET['ComponentBrand']) ? $_GET['ComponentBrand'] : '');
        $brandDataProvider = $brand->search();

        if (isset($_POST['Next'])) {
            $this->loadState($estimation);

            $valid = $estimation->validate();

            if ($valid) {
                Yii::app()->session['estimation'] = $estimation;
                unset(Yii::app()->session['SessionList']);
                unset(Yii::app()->session['SessionListAccesories']);

                $index = isset(Yii::app()->session['index']) ? Yii::app()->session['index'] : 0;

                $this->redirect(array('loop', 'index' => 0));
            } else {
                $estimation->header->addError('error', 'Panel cannot be empty');
            }
        }

        if (isset($_POST['Save'])) {
            $this->loadState($estimation);

            foreach ($saleOrderHeader->saleOrderDetails as $saleOrderDetail) {
                if ($saleOrderDetail->is_inactive == 0) {
                    $estimationPanel = new EstimationPanel();
                    $estimationPanel->panel_name = $saleOrderDetail->panel_name;
                    $estimationPanel->sort_number = $saleOrderDetail->sort_number;
                    $estimationPanel->sale_order_detail_id = $saleOrderDetail->id;
                    $estimation->panels[] = $estimationPanel;
                }
            }

            $valid = $estimation->validate();
            if ($estimation->saveHeader(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $estimation->header->id));
            }
        }
		
        $this->render('create', array(
            'estimation' => $estimation,
            'brand' => $brand,
            'brandDataProvider' => $brandDataProvider,
        ));
    }
	
	public function actionUpdate($id) {
        $estimation = $this->instantiate($id);

        $brand = Search::bind(new ComponentBrand, isset($_GET['ComponentBrand']) ? $_GET['ComponentBrand'] : '');
        $brandDataProvider = $brand->search();

        foreach ($estimation->details as $detail) {
            $detail->setPrimary();
        }

        if (isset($_POST['Save'])) {
            // Load Data
            $this->loadState($estimation);
            $valid = $estimation->validate();

            if ($estimation->saveHeader(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $estimation->header->id));
            }

//            // Save it
//            if ($estimation->save(yii::app()->db))
//                $this->redirect(array('view', 'id' => $estimation->header->id));
        }

        $this->render('update', array(
            'estimation' => $estimation,
            'brand' => $brand,
            'brandDataProvider' => $brandDataProvider,
        ));
    }

    public function actionView($id) {
        $estimation = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('estimation_header_id', $id);
        $detailDataProvider = new CActiveDataProvider('EstimationBrandDiscount', array(
			'criteria' => $criteria,
		));

        $panelDataProvider = new CActiveDataProvider('EstimationPanel', array(
			'criteria' => $criteria,
		));

        $criteria = new CDbCriteria;
        $criteria->with = array('estimationPanel');
        $criteria->compare('estimationPanel.estimation_header_id', $id);

        $estimationComponentDataProvider = new CActiveDataProvider('EstimationComponent', array(
			'criteria' => $criteria,
		));

        $estimationComponentAccesoriesDataProvider = new CActiveDataProvider('EstimationComponentAccesories', array(
			'criteria' => $criteria,
		));
		
        $this->render('view', array(
            'estimation' => $estimation,
            'detailDataProvider' => $detailDataProvider,
            'panelDataProvider' => $panelDataProvider,
            'estimationComponentDataProvider' => $estimationComponentDataProvider,
            'estimationComponentAccesoriesDataProvider' => $estimationComponentAccesoriesDataProvider,
        ));
    }

    public function actionUploadDetail($id, $headerId) {

        $estimationPanel = EstimationPanel::model()->findByPk($id);
        $panelName = $estimationPanel->panel_name;
        $estimation = $this->loadModel($headerId);

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
            $code = array();
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
                            $code[$j] = $row[$key];
                        else if ($key == 'C')
                            $quantity[$j] = $row[$key];
                        else if ($key == 'D')
                            $unit_price[$j] = $row[$key];
                    }
                    $j++;
                }
                $count++;
            }
			
            $valid = true;
            $dbTransaction = Yii::app()->db->beginTransaction();
            try {
                for ($i = 0; $i < $j; $i++) {
                    $component = Component::model()->findByAttributes(array('code' => $code[$i]));

                    if ($component) {
                        $estimationComponent = new EstimationComponent();
                        $estimationComponent->estimation_panel_id = $id;
                        $estimationComponent->sort_number = $sort_number[$i];
                        $estimationComponent->name = $component->name;
                        $estimationComponent->quantity = $quantity[$i];
                        $estimationComponent->unit_price = $unit_price[$i];
                        $estimationComponent->type = $component->type;
                        $estimationComponent->brand_id = $component->component_brand_id;
                        $estimationComponent->component_id = $component->id;
                        $valid = $estimationComponent->save() && $valid;
                    }
					else
						$valid = false;
                }
				
                if ($valid) {
					Yii::app()->user->setFlash('message', 'Upload Successful.');
					$dbTransaction->commit();
				}
                else {
                    Yii::app()->user->setFlash('error', "Upload failed! Check component's code...");
                    $dbTransaction->rollback();
                }
            } catch (Exception $e) {
                Yii::app()->user->setFlash('error', $e);
                $dbTransaction->rollback();
            }
            unlink($path);
        }

        $this->render('upload', array(
            'model' => $model,
            'panelName' => $panelName,
            'estimation' => $estimation
        ));
    }

    public function actionUploadDetailAccesories($id, $headerId) {

        $estimationPanel = EstimationPanel::model()->findByPk($id);
        $panelName = $estimationPanel->panel_name;
        $estimation = $this->loadModel($headerId);

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
            $name = array();
            $quantity = array();
            $unit_price = array();
            $weight = array();

            $j = 0;
            $count = 1;

            foreach ($sheet as $row) {
                if ($count > 1) {
                    foreach ($row as $key => $val) {
                        if ($key == 'A')
                            $sort_number[$j] = $row[$key];
                        else if ($key == 'B')
                            $name[$j] = $row[$key];
                        else if ($key == 'C')
                            $quantity[$j] = $row[$key];
                        else if ($key == 'D')
                            $weight[$j] = $row[$key];
                        else if ($key == 'E')
                            $unit_price[$j] = $row[$key];
                    }
                    $j++;
                }
                $count++;
            }
            $valid = true;
            $dbTransaction = Yii::app()->db->beginTransaction();
            try {
                for ($i = 0; $i < $j; $i++) {

                    $component = ComponentCu::model()->findByAttributes(array('name' => $name[$i]));

                    if ($component) {
                        $estimationComponent = new EstimationComponentAccesories();
                        $estimationComponent->estimation_panel_id = $id;
                        $estimationComponent->sort_number = $sort_number[$i];
                        $estimationComponent->name = $component->name;
                        $estimationComponent->weight = $weight[$i];
                        $estimationComponent->quantity = $quantity[$i];
                        $estimationComponent->unit_price = $unit_price[$i];
                        $estimationComponent->component_cu_id = $component->id;
                        $valid = $estimationComponent->save() && $valid;
                    }
					else
						$valid = false;
                }

                if ($valid)
                    $dbTransaction->commit();
                else
                    $dbTransaction->rollback();
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
            'estimation' => $estimation
        ));
    }

    public function actionViewDetail($id, $headerId) {
        $estimation = $this->loadModel($headerId);

        $criteria = new CDbCriteria;
        $criteria->compare('estimation_panel_id', $id);

        $componentDataProvider = new CActiveDataProvider('EstimationComponent', array(
			'criteria' => $criteria,
			'pagination' => false
		));

        $componentAccesoriesDataProvider = new CActiveDataProvider('EstimationComponentAccesories', array(
			'criteria' => $criteria,
			'pagination' => false
		));

        $estimationPanel = EstimationPanel::model()->findByPk($id);

        $this->render('viewDetail', array(
            'estimation' => $estimation,
            'componentDataProvider' => $componentDataProvider,
            'componentAccesoriesDataProvider' => $componentAccesoriesDataProvider,
            'estimationPanel' => $estimationPanel,
        ));
    }

    public function actionMemo($id) {
        $this->render('memo', array(
            'estimation' => $this->instantiate($id),
        ));
    }

    public function actionAdmin() {
        $header = Search::bind(new EstimationHeader, isset($_GET['EstimationHeader']) ? $_GET['EstimationHeader'] : '');
        $dataprovider = $header->search();

        $this->render('admin', array(
            'header' => $header,
            'dataProvider' => $dataprovider
        ));
    }

    public function actionDelete($id) {
		
//        if (Yii::app()->request->isPostRequest) {
		$estimationComponents = EstimationComponent::model()->findAllByAttributes(array('estimation_panel_id' => $id));

			foreach ($estimationComponents as $estimationComponent) {
				if ($estimationComponent->budgetingDetails == null) {
					$estimationComponent->delete();
					Yii::app()->user->setFlash('message', 'SUCCESS this transaction');
				} else {
					Yii::app()->user->setFlash('message', 'Cannot DELETE this transaction');
				}
			}

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//        }
//        else
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

//    public function actionViewPanel($id) {
//        $panel = $this->loadModelPanel($id);
//        $estimation = $this->loadModel($panel->estimation_header_id);
//
//        $criteria = new CDbCriteria;
//        $criteria->compare('estimation_header_id', $panel->estimation_header_id);
//        $detailDataProvider = new CActiveDataProvider('EstimationBrandDiscount', array(
//                    'criteria' => $criteria,
//                ));
//
//        $criteria = new CDbCriteria;
//        $criteria->compare('estimation_panel_id', $id);
//
//        $estimationComponentDataProvider = new CActiveDataProvider('EstimationComponent', array(
//                    'criteria' => $criteria,
//                ));
//
//        $estimationComponentAccesoriesDataProvider = new CActiveDataProvider('EstimationComponentAccesories', array(
//                    'criteria' => $criteria,
//                ));
//
//        $this->render('viewPanel', array(
//            'panel' => $panel,
//            'estimation' => $estimation,
//            'detailDataProvider' => $detailDataProvider,
//            'estimationComponentDataProvider' => $estimationComponentDataProvider,
//            'estimationComponentAccesoriesDataProvider' => $estimationComponentAccesoriesDataProvider,
//        ));
//    }
//
//    public function actionViewPanelGroup($id) {
//        $panel = $this->loadModelPanel($id);
//        $estimation = $this->loadModel($panel->estimation_header_id);
//
//        $this->render('viewPanelGroup', array(
//            'panel' => $panel,
//            'estimation' => $estimation,
//        ));
//    }
//
//    public function actionBackToEstimation($id) {
//        $this->redirect(array('view', 'id' => $id));
//    }
//
//    public function actionPanelUp($id) {
//        $panel = $this->loadModelPanel($id);
//
//        if ($panel->sort_number > 1) {
//            $preSortNumber = $panel->sort_number - 1;
//            $prePanel = EstimationPanel::model()->findByAttributes(array('estimation_header_id' => $panel->estimation_header_id, 'sort_number' => $preSortNumber));
//            $prePanel->sort_number = $panel->sort_number;
//            $prePanel->save();
//            $panel->sort_number = $preSortNumber;
//            $panel->save();
//        }
//
//        $this->redirect(array('view', 'id' => $panel->estimation_header_id));
//    }
//
//    public function actionPanelDown($id) {
//        $panel = $this->loadModelPanel($id);
//        $lastPanel = EstimationPanel::model()->findByAttributes(array('estimation_header_id' => $panel->estimation_header_id), array('order' => 'sort_number DESC'));
//
//        if ($panel->sort_number != $lastPanel->sort_number) {
//            $postSortNumber = $panel->sort_number + 1;
//            $postPanel = EstimationPanel::model()->findByAttributes(array('estimation_header_id' => $panel->estimation_header_id, 'sort_number' => $postSortNumber));
//            $postPanel->sort_number = $panel->sort_number;
//            $postPanel->save();
//            $panel->sort_number = $postSortNumber;
//            $panel->save();
//        }
//
//        $this->redirect(array('view', 'id' => $panel->estimation_header_id));
//    }
//
//    public function actionAddPanel($id) {
//        $estimation = $this->loadModel($id);
//        $panel = $this->instantiatePanel(null);
//        $panel->header->estimation_header_id = $id;
//
//        $criteria = new CDbCriteria;
//        $criteria->compare('estimation_header_id', $id);
//        $detailDataProvider = new CActiveDataProvider('EstimationBrandDiscount', array(
//                    'criteria' => $criteria,
//                ));
//
//        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
//        $dataProvider = $component->search();
//        $componentCu = Search::bind(new ComponentCu('search'), isset($_GET['ComponentCu']) ? $_GET['ComponentCu'] : array());
//        $cuDataProvider = $componentCu->search();
//
//        if (isset($_POST['Save'])) {
//            $this->loadStatePanel($panel);
//            if ($panel->save(Yii::app()->db)) {
//                $this->redirect(array('view', 'id' => $id));
//            }
//        }
//
//        $this->render('addPanel', array(
//            'estimation' => $estimation,
//            'detailDataProvider' => $detailDataProvider,
//            'panel' => $panel,
//            'component' => $component,
//            'componentCu' => $componentCu,
//            'dataProvider' => $dataProvider,
//            'cuDataProvider' => $cuDataProvider
//        ));
//    }
//
//    public function actionUpdatePanel($id) {
//        $panel = $this->instantiatePanel($id);
//        $estimation = $this->loadModel($panel->header->estimation_header_id);
//
//        $criteria = new CDbCriteria;
//        $criteria->compare('estimation_header_id', $id);
//        $detailDataProvider = new CActiveDataProvider('EstimationBrandDiscount', array(
//                    'criteria' => $criteria,
//                ));
//
//        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
//        $dataProvider = $component->search();
//        $componentCu = Search::bind(new ComponentCu('search'), isset($_GET['ComponentCu']) ? $_GET['ComponentCu'] : array());
//        $cuDataProvider = $componentCu->search();
//
//        if (isset($_POST['Save'])) {
//            $this->loadStatePanel($panel);
//            if ($panel->save(Yii::app()->db)) {
//                $this->redirect(array('view', 'id' => $panel->header->estimation_header_id));
//            }
//        }
//
//        $this->render('updatePanel', array(
//            'estimation' => $estimation,
//            'detailDataProvider' => $detailDataProvider,
//            'panel' => $panel,
//            'component' => $component,
//            'componentCu' => $componentCu,
//            'dataProvider' => $dataProvider,
//            'cuDataProvider' => $cuDataProvider
//        ));
//    }
//
//    public function actionAddDetail($id) {
//        $panel = $this->instantiatePanel($id);
//        $estimation = $this->loadModel($panel->header->estimation_header_id);
//
//        $criteria = new CDbCriteria;
//        $criteria->compare('estimation_header_id', $id);
//        $detailDataProvider = new CActiveDataProvider('EstimationBrandDiscount', array(
//                    'criteria' => $criteria,
//                ));
//
//        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
//        $dataProvider = $component->search();
//        $componentCu = Search::bind(new ComponentCu('search'), isset($_GET['ComponentCu']) ? $_GET['ComponentCu'] : array());
//        $cuDataProvider = $componentCu->search();
//
//        if (isset($_POST['Save'])) {
//            $this->loadStatePanel($panel);
//            if ($panel->save(Yii::app()->db)) {
//                $this->redirect(array('view', 'id' => $panel->header->estimation_header_id));
//            }
//        }
//
//        $this->render('addDetail', array(
//            'estimation' => $estimation,
//            'detailDataProvider' => $detailDataProvider,
//            'panel' => $panel,
//            'component' => $component,
//            'componentCu' => $componentCu,
//            'dataProvider' => $dataProvider,
//            'cuDataProvider' => $cuDataProvider
//        ));
//    }

//        if (isset($_POST['save']))
//        {
//            // Load Data
//            $this->loadState($estimation);
//            
//            // Save it
//            if($estimation->save(yii::app()->db))
//                $this->redirect(array('view','id'=>$estimation->header->id));
//        }

//    public function actionLoop($index) {
//        $estimation = isset(Yii::app()->session['estimation']) ? Yii::app()->session['estimation'] : array();
//
//        $count = count($estimation->panels);
//
//        if (count($estimation->panels) === 0 || $estimation->header->id === 0)
//            $this->redirect(array('create'));
//
//        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
//        $dataProvider = $component->search();
//        $componentCu = Search::bind(new ComponentCu('search'), isset($_GET['ComponentCu']) ? $_GET['ComponentCu'] : array());
//        $cuDataProvider = $componentCu->search();
//
//        if (isset($_POST['Next'])) {
//            $sessionList = Yii::app()->session['SessionList'];
//            $sessionListAccesories = Yii::app()->session['SessionListAccesories'];
//
//            $model = $estimation;
//            $this->loadStateModel($model);
//
//            $components = array();
//            $accesories = array();
//            $valid = true;
//
//            foreach ($model->detailComponents as $i => $detailComponent) {
////                $valid = $this->validateDetail($detailComponent);
//                if ($valid)
//                    $components[] = $detailComponent;
//                else {
//                    Yii::app()->user->setFlash('errorDetail', 'All Detail must be filled');
//                    $this->redirect(array('loop', 'index' => $index));
//                }
//
////                if (!empty($_POST['accesories' . $i])) {
////                    foreach ($_POST['accesories' . $i] as $accesory) {
////                        $detailComponent->accesories[] = $accesory;
////                    }
////                }
//            }
//
//            foreach ($components as $component)
//                $sessionList[] = $component;
//
//            foreach ($model->detailAccesories as $i => $detailAccesories) {
////                $valid = $this->validateDetail($detailComponent);
//                if ($valid)
//                    $accesories[] = $detailAccesories;
//                else {
//                    Yii::app()->user->setFlash('errorDetail', 'All Detail must be filled');
//                    $this->redirect(array('loop', 'index' => $index));
//                }
//
////                if (!empty($_POST['accesories' . $i])) {
////                    foreach ($_POST['accesories' . $i] as $accesory) {
////                        $detailComponent->accesories[] = $accesory;
////                    }
////                }
//            }
//
//            foreach ($accesories as $accesory)
//                $sessionListAccesories[] = $accesory;
//
//
//            if (count($model->detailComponents) < 1 || count($model->detailAccesories) < 1) {
//                Yii::app()->user->setFlash('errorDetail', 'Component Or Accesories cannot be empty ');
//                $this->redirect(array('loop', 'index' => $index));
//            }
//
//            Yii::app()->session['SessionList'] = $sessionList;
//            Yii::app()->session['SessionListAccesories'] = $sessionListAccesories;
//            if ($index != $count - 1) {
//                $index++;
//                $this->redirect(array('loop', 'index' => $index));
//            }
//            else
//                $this->redirect(array('finish'));
//        }
//
//        $this->render('loop', array(
//            'estimation' => $estimation,
//            'panelDetail' => $estimation->panels[$index],
//            'index' => $index,
//            'component' => $component,
//            'componentCu' => $componentCu,
//            'dataProvider' => $dataProvider,
//            'cuDataProvider' => $cuDataProvider
//        ));
//    }

//    public function validateDetail($detailComponent) {
//
//        $fields = array('accesories_id_main', 'accesories_id_secondary');
//        $valid = $detailComponent->validate($fields);
//
//        return $valid;
//    }
//
//    public function actionFinish() {
//        $estimation = isset(Yii::app()->session['estimation']) ? Yii::app()->session['estimation'] : $this->instantiate(null);
//        $componentList = Yii::app()->session['SessionList'];
//        $accesoriesList = Yii::app()->session['SessionListAccesories'];
//
//        $estimation->detailComponents = array();
//        $estimation->detailComponents = $componentList;
//
//        $estimation->detailAccesories = array();
//        $estimation->detailAccesories = $accesoriesList;
//
//        unset(Yii::app()->session['SessionList']);
//        unset(Yii::app()->session['SessionListAccesories']);
//        unset(Yii::app()->session['index']);
//        unset(Yii::app()->session['estimation']);
//
//        if ($estimation->save(Yii::app()->db)) {
//
//            $this->redirect(array('view', 'id' => $estimation->header->id));
//        }
//        else
//            $this->redirect(array('create'));
//    }

//    public function actionAjaxHtmlAddComponent($id, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiateModel($id, $index);
//
//            $this->loadState($estimation);
//
//            $estimationTemp = isset(Yii::app()->session['estimation']) ? Yii::app()->session['estimation'] : array();
//
//            if (isset($_POST['ComponentId']))
//                $estimation->addDetailComponent($index, $_POST['ComponentId']);
//
//            $this->renderPartial('_detailComponent', array(
//                'estimation' => $estimation,
//                'index' => $index,
//                'panelDetail' => $estimationTemp->panels[$index],
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlAddComponentPanel($id) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $panel = $this->instantiatePanel($id);
//            $this->loadStatePanel($panel);
//
//            if (isset($_POST['selectedIds'])) {
//                $componentsId = array();
//                $componentsId = $_POST['selectedIds'];
//
//                foreach ($componentsId as $componentId) {
//                    $panel->addDetailComponent($componentId);
//                }
//            } else if (isset($_POST['ComponentId'])) {
//                $panel->addDetailComponent($_POST['ComponentId']);
//            }
//
//            $this->renderPartial('_addPanelComponent', array(
//                'panel' => $panel,
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlAddComponents($id, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiateModel($id, $index);
//
//            $this->loadState($estimation);
//
//            $estimationTemp = isset(Yii::app()->session['estimation']) ? Yii::app()->session['estimation'] : array();
//
//            if (isset($_POST['selectedIds'])) {
//                $componentsId = array();
//                $componentsId = $_POST['selectedIds'];
//
//                foreach ($componentsId as $componentId) {
//                    $estimation->addDetailComponent($index, $componentId);
//                }
//            }
//
//            $this->renderPartial('_detailComponent', array(
//                'estimation' => $estimation,
//                'index' => $index,
//                'panelDetail' => $estimationTemp->panels[$index],
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlAddAccesories($id, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiateModel($id, $index);
//
//            $this->loadState($estimation);
//
//            $estimationCurrent = isset(Yii::app()->session['estimation']) ? Yii::app()->session['estimation'] : array();
//
//            if (isset($_POST['selectedIdsAccesories'])) {
//                $componentsId = array();
//                $componentsId = $_POST['selectedIdsAccesories'];
//
//                foreach ($componentsId as $componentId) {
//                    $estimation->addDetailAccesories($index, $componentId);
//                }
//            } else if (isset($_POST['ComponentAccesoriesId'])) {
//                $estimation->addDetailAccesories($index, $_POST['ComponentAccesoriesId']);
//            }
//
//            $this->renderPartial('_detailAccesories', array(
//                'estimation' => $estimation,
//                'index' => $index,
//                'panelDetail' => $estimationCurrent->panels[$index],
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlAddCu($id, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiateModel($id, $index);
//
//            $this->loadState($estimation);
//
//            $estimationCurrent = isset(Yii::app()->session['estimation']) ? Yii::app()->session['estimation'] : array();
//
//            if (isset($_POST['selectedIdsCu'])) {
//                $componentsId = array();
//                $componentsId = $_POST['selectedIdsCu'];
//
//                foreach ($componentsId as $componentId) {
//                    $estimation->addDetailAccesoriesCu($index, $componentId);
//                }
//            } else if (isset($_POST['ComponentCuId'])) {
//                $estimation->addDetailAccesoriesCu($index, $_POST['ComponentCuId']);
//            }
//
//            $this->renderPartial('_detailAccesories', array(
//                'estimation' => $estimation,
//                'index' => $index,
//                'panelDetail' => $estimationCurrent->panels[$index],
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlAddAccesoriesPanel($id) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $panel = $this->instantiatePanel($id);
//            $this->loadStatePanel($panel);
//
//            if (isset($_POST['selectedIdsAccesories'])) {
//                $componentsId = array();
//                $componentsId = $_POST['selectedIdsAccesories'];
//
//                foreach ($componentsId as $componentId) {
//                    $panel->addDetailAccesories($componentId);
//                }
//            } else if (isset($_POST['ComponentAccesoriesId'])) {
//                $panel->addDetailAccesories($_POST['ComponentAccesoriesId']);
//            }
//
//            $this->renderPartial('_addPanelAccesories', array(
//                'panel' => $panel,
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlAddCuPanel($id) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $panel = $this->instantiatePanel($id);
//            $this->loadStatePanel($panel);
//
//            if (isset($_POST['selectedIdsCu'])) {
//                $componentsId = array();
//                $componentsId = $_POST['selectedIdsCu'];
//
//                foreach ($componentsId as $componentId) {
//                    $panel->addDetailAccesoriesCu($componentId);
//                }
//            } else if (isset($_POST['ComponentCuId'])) {
//                $panel->addDetailAccesoriesCu($_POST['ComponentCuId']);
//            }
//
//            $this->renderPartial('_addPanelAccesories', array(
//                'panel' => $panel,
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlAddDetail($id) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiate($id);
//            $this->loadState($estimation);
//
//            $estimation->addDetail($_POST['brandid']);
//
//            $this->renderPartial('_detail', array(
//                'estimation' => $estimation,
//                    //'error'=> false,
//            ));
//        }
//    }
//
//    public function actionAjaxAddPanel($id) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiate($id);
//            $this->loadState($estimation);
//
//            $estimation->panels[] = new EstimationPanel();
//
//            $this->renderPartial('_detail_panel', array(
//                'estimation' => $estimation,
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlAddComponentGroup($id) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $panel = $this->instantiatePanel($id);
//            $this->loadStatePanel($panel);
//
//            $panel->addComponentGroup();
//
//            $this->renderPartial('_detail_component_group', array(
//                'panel' => $panel,
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlRemoveDetail($id, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiate($id);
//            $this->loadState($estimation);
//
//            $estimation->removeDetailAt($index);
//
//            $this->renderPartial('_detail', array(
//                'estimation' => $estimation,
//                    //'error' => FALSE,
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlRemovePanel($id, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiate($id);
//            $this->loadState($estimation);
//
//            $estimation->removePanelAt($index);
//
//            $this->renderPartial('_detail_panel', array(
//                'estimation' => $estimation,
//                    //'error' => FALSE,
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlRemoveComponent($id, $index, $i) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiateModel($id, $index);
//            $this->loadState($estimation);
//
//            $estimation->removeComponentDetail($i);
//
//            $this->renderPartial('_detailComponent', array(
//                'estimation' => $estimation,
//                'index' => $index
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlRemoveAccesories($id, $index, $i) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiateModel($id, $index);
//            $this->loadState($estimation);
//
//            $estimation->removeAccesoriesDetail($i);
//
//            $this->renderPartial('_detailAccesories', array(
//                'estimation' => $estimation,
//                'index' => $index
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlRemoveComponentPanel($id, $i) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $panel = $this->instantiatePanel($id);
//            $this->loadStatePanel($panel);
//
//            $panel->removeComponentDetail($i);
//
//            $this->renderPartial('_addPanelComponent', array(
//                'panel' => $panel
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlRemoveAccesoriesPanel($id, $i) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $panel = $this->instantiatePanel($id);
//            $this->loadStatePanel($panel);
//
//            $panel->removeAccesoriesDetail($i);
//
//            $this->renderPartial('_addPanelAccesories', array(
//                'panel' => $panel
//            ));
//        }
//    }
//
//    public function actionAjaxHtmlRemoveEstimation($id, $i, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiate($id);
//            $this->loadState($estimation);
//
//            $estimation->removeDetailAt($index);
//
//            $this->renderPartial('_detailComponent', array(
//                'estimation' => $estimation,
//                ''
//                    //'error' => FALSE,
//            ));
//        }
//    }
//
//    public function actionAjaxJsonTotal($id, $i, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiate($id);
//            $this->loadState($estimation);
//
//            $basicPrice = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->detailComponents[$i]->getBasicPrice($estimation->details)));
//
//            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->detailComponents[$i]->getTotal($estimation->details)));
//
//            $subTotal = 0.00;
//            foreach ($estimation->detailComponents as $detailComponent) {
//                $subTotal+=$detailComponent->getTotal($estimation->details);
//            }
//            $subTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $subTotal));
//
//            echo CJSON::encode(array(
//                'total' => $total,
//                'subTotal' => $subTotal,
//                'basicPrice' => $basicPrice
//            ));
//        }
//    }
//
//    public function actionAjaxJsonTotalComponent($id, $i) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $panel = $this->instantiatePanel($id);
//            $this->loadStatePanel($panel);
//
//            $basicPrice = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $panel->detailComponents[$i]->getBasicPrice($panel->header->estimationHeader->estimationBrandDiscounts)));
//
//            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $panel->detailComponents[$i]->getTotal($panel->header->estimationHeader->estimationBrandDiscounts)));
//
//            $subTotal = 0.00;
//            foreach ($panel->detailComponents as $detailComponent) {
//                $subTotal+=$detailComponent->getTotal($panel->header->estimationHeader->estimationBrandDiscounts);
//            }
//            $subTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $subTotal));
//
//            echo CJSON::encode(array(
//                'total' => $total,
//                'subTotal' => $subTotal,
//                'basicPrice' => $basicPrice
//            ));
//        }
//    }
//
//    public function actionAjaxJsonTotalAccesories($id, $i, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiate($id);
//            $this->loadState($estimation);
//
//            $basicPrice = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->detailAccesories[$i]->getBasicPrice($estimation->details)));
//
//            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->detailAccesories[$i]->getTotal($estimation->details)));
//
//            $subTotal = 0.00;
//            foreach ($estimation->detailAccesories as $detailComponent) {
//                $subTotal+=$detailComponent->getTotal($estimation->details);
//            }
//            $subTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $subTotal));
//
//            echo CJSON::encode(array(
//                'total' => $total,
//                'subTotal' => $subTotal,
//                'basicPrice' => $basicPrice
//            ));
//        }
//    }
//
//    public function actionAjaxJsonTotalAccesoriesPanel($id, $i) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $panel = $this->instantiatePanel($id);
//            $this->loadStatePanel($panel);
//
//            $basicPrice = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $panel->detailAccesories[$i]->getBasicPrice($panel->header->estimationHeader->estimationBrandDiscounts)));
//
//            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $panel->detailAccesories[$i]->getTotal($panel->header->estimationHeader->estimationBrandDiscounts)));
//
//            $subTotal = 0.00;
//            foreach ($panel->detailAccesories as $detailAccesories) {
//                $subTotal+=$detailAccesories->getTotal($panel->header->estimationHeader->estimationBrandDiscounts);
//            }
//            $subTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $subTotal));
//
//            echo CJSON::encode(array(
//                'total' => $total,
//                'subTotal' => $subTotal,
//                'basicPrice' => $basicPrice
//            ));
//        }
//    }
//
//    public function actionAjaxJsonAccesoriesValue($id, $i, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiate($id);
//            $this->loadState($estimation);
//
//            if ($estimation->detailComponents[$i]->accesories_phase_id == NULL)
//                $value = 0;
//            else
//                $value = $estimation->detailComponents[$i]->accesoriesPhase->value;
//
//            echo CJSON::encode(array(
//                'value' => $value,
//            ));
//        }
//    }
//
//    public function actionAjaxJsonAccesoriesValueComponent($id, $i) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $panel = $this->instantiatePanel($id);
//            $this->loadStatePanel($panel);
//
//            if ($panel->detailComponents[$i]->accesories_phase_id == NULL)
//                $value = 0;
//            else
//                $value = $panel->detailComponents[$i]->accesoriesPhase->value;
//
//            echo CJSON::encode(array(
//                'value' => $value,
//            ));
//        }
//    }
//
//    public function actionAjaxJsonAccesoriesValueAccesories($id, $i, $index) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $estimation = $this->instantiate($id);
//            $this->loadState($estimation);
//
//            if ($estimation->detailAccesories[$i]->accesories_phase_id == NULL)
//                $value = 0;
//            else
//                $value = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $estimation->detailAccesories[$i]->accesoriesPhase->value));
//
//            echo CJSON::encode(array(
//                'value' => $value,
//            ));
//        }
//    }
//
//    public function actionAjaxJsonAccesoriesValueAccesoriesPanel($id, $i) {
//        if (Yii::app()->request->isAjaxRequest) {
//            $panel = $this->instantiatePanel($id);
//            $this->loadStatePanel($panel);
//
//            if ($panel->detailAccesories[$i]->accesories_phase_id == NULL)
//                $value = 0;
//            else
//                $value = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $panel->detailAccesories[$i]->accesoriesPhase->value));
//
//            echo CJSON::encode(array(
//                'value' => $value,
//            ));
//        }
//    }

}

