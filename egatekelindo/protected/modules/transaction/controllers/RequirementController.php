<?php

class RequirementController extends Controller {

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'view'
                || $filterChain->action->id === 'create'
                || $filterChain->action->id === 'budgetingList'
                || $filterChain->action->id === 'memo'
                || $filterChain->action->id === 'memoCu'
        ) {
            if (!(Yii::app()->user->checkAccess('requirementCreate') || Yii::app()->user->checkAccess('requirementEdit')))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'admin') {
            if (!(Yii::app()->user->checkAccess('requirementEdit')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionBudgetingList() {
        $projectName = isset($_GET['ProjectName']) ? $_GET['ProjectName'] : '';
        $soOrdinal = isset($_GET['SoOrdinal']) ? $_GET['SoOrdinal'] : '';
        $soMonth = isset($_GET['SoMonth']) ? $_GET['SoMonth'] : '';
        $soYear = isset($_GET['SoYear']) ? $_GET['SoYear'] : '';

        $budgetingHeader = Search::bind(new BudgetingHeader('search'), isset($_GET['BudgetingHeader']) ? $_GET['BudgetingHeader'] : '');
        $budgetingHeaderDataProvider = $budgetingHeader->search(); //searchByRequirement();
        $budgetingHeaderDataProvider->criteria->with = array(
            'saleOrderHeader');

        if (!empty($projectName)) {
            $budgetingHeaderDataProvider->criteria->addCondition('saleOrderHeader.project_name = :project_name');
            $budgetingHeaderDataProvider->criteria->params[':project_name'] = $projectName;
            $budgetingHeaderDataProvider->criteria->compare('saleOrderHeader.project_name', $projectName);
        }

        if (!empty($soOrdinal))
            $budgetingHeaderDataProvider->criteria->compare('saleOrderHeader.cn_ordinal', $soOrdinal);

        if (!empty($soMonth))
            $budgetingHeaderDataProvider->criteria->compare('saleOrderHeader.cn_month', $soMonth);

        if (!empty($soYear))
            $budgetingHeaderDataProvider->criteria->compare('saleOrderHeader.cn_year', $soYear);

        $budgetingHeaderDataProvider->criteria->order = 't.id DESC';

        $this->render('budgetingList', array(
            'projectName' => $projectName,
            'soOrdinal' => $soOrdinal,
            'soMonth' => $soMonth,
            'soYear' => $soYear,
            'budgetingHeader' => $budgetingHeader,
            'budgetingHeaderDataProvider' => $budgetingHeaderDataProvider,
        ));
    }

    public function actionWorkOrderProductionList() {
        $projectName = isset($_GET['ProjectName']) ? $_GET['ProjectName'] : '';
        $soOrdinal = isset($_GET['SoOrdinal']) ? $_GET['SoOrdinal'] : '';
        $soMonth = isset($_GET['SoMonth']) ? $_GET['SoMonth'] : '';
        $soYear = isset($_GET['SoYear']) ? $_GET['SoYear'] : '';

        $workOrderProductionHeader = Search::bind(new WorkOrderProductionHeader('search'), isset($_GET['WorkOrderProductionHeader']) ? $_GET['WorkOrderProductionHeader'] : '');
        $workOrderProductionHeaderDataProvider = $workOrderProductionHeader->searchByRequirement();

        $workOrderProductionHeaderDataProvider->criteria->order = 't.id DESC';

        $this->render('workOrderProductionList', array(
            'projectName' => $projectName,
            'workOrderProductionHeader' => $workOrderProductionHeader,
            'workOrderProductionHeaderDataProvider' => $workOrderProductionHeaderDataProvider,
        ));
    }

    public function actionCreate($workOrderProductionHeaderId) {
        $requirement = $this->instantiate(null);
        $requirement->generateCodeNumber(date('m'), date('y'));
        $requirement->header->work_order_production_header_id = $workOrderProductionHeaderId;
		$requirement->header->sale_order_header_id = $requirement->header->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->sale_order_header_id;
        $requirement->addDetails($workOrderProductionHeaderId);

//        $saleOrderHeader = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : array());
//        $saleOrderHeaderDataProvider = $saleOrderHeader->searchByRequirement();

        if (isset($_POST['Submit'])) {
            $this->loadState($requirement);
            if ($requirement->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $requirement->header->id));
        }

//        if (isset($_POST['Next'])) {
//            $this->loadState($requirement);
//
//            foreach ($requirement->details as $i => $detail) {
//                $budgetingDetails = BudgetingDetail::model()->findAllByAttributes(array('sale_order_detail_id' => $detail->sale_order_detail_id));
//                if ($budgetingDetails)
//                    foreach ($budgetingDetails as $budgetingDetail) {
//                        $requirementDetailComponent = new RequirementDetailComponent();
//                        $requirementDetailComponent->budgeting_detail_id = $budgetingDetail->id;
//                        $requirementDetailComponent->quantity = $budgetingDetail->quantity;
//                        $requirementDetailComponent->unit_price = $budgetingDetail->unit_price;
//                        $requirementDetailComponent->requirement_detail_id = $i;
//                        $requirementDetailComponent->component_name = $budgetingDetail->component_name;
//                        $requirement->detailComponents[] = $requirementDetailComponent;
//                    }
//
//                $budgetingDetailAccesories = BudgetingDetailAccesories::model()->findAllByAttributes(array('sale_order_detail_id' => $detail->sale_order_detail_id));
//                if ($budgetingDetailAccesories)
//                    foreach ($budgetingDetailAccesories as $budgetingDetailAccesory) {
//                        $requirementDetailComponent = new RequirementDetailComponent();
//                        $requirementDetailComponent->budgeting_detail_accesories_id = $budgetingDetailAccesory->id;
//                        $requirementDetailComponent->quantity = $budgetingDetailAccesory->quantity;
//                        $requirementDetailComponent->unit_price = $budgetingDetailAccesory->unit_price;
//                        $requirementDetailComponent->requirement_detail_id = $i;
//                        $requirementDetailComponent->component_name = $budgetingDetailAccesory->component_name;
//                        $requirement->detailComponents[] = $requirementDetailComponent;
//                    }
//            }
//
//            Yii::app()->session['index'] = 0;
//            Yii::app()->session['sessionList'] = NULL;
//            Yii::app()->session['requirement'] = $requirement;
//            $this->redirect(array('loop'));
//        }

        $this->render('create', array(
            'requirement' => $requirement,
//            'saleOrderHeader' => $saleOrderHeader,
//            'saleOrderHeaderDataProvider' => $saleOrderHeaderDataProvider,
        ));
    }

//    public function actionLoop() {
//        $index = isset(Yii::app()->session['index']) ? Yii::app()->session['index'] : 0;
//
//        Yii::app()->session['index'] = $index;
//        $requirementCurrent = Yii::app()->session['requirement'];
//
//        if (isset($_POST['Next'])) {
//            $index++;
//            Yii::app()->session['index'] = $index;
//
//            $requirementCurrent->detailComponents = array();
//            $this->loadStateLoop($requirementCurrent);
//
//            $sessionList = isset(Yii::app()->session['sessionList']) ? Yii::app()->session['sessionList'] : array();
//
//            foreach ($requirementCurrent->detailComponents as $detailComponent)
//                $sessionList[] = $detailComponent;
//
//            Yii::app()->session['sessionList'] = $sessionList;
//
//            $this->redirect(array('loop'));
//        }
//
//        if (isset($_POST['Submit'])) {
//            $requirementCurrent->detailComponents = array();
//            $this->loadStateLoop($requirementCurrent);
//
//            $sessionList = Yii::app()->session['sessionList'];
//            foreach ($requirementCurrent->detailComponents as $detailComponent)
//                $sessionList[] = $detailComponent;
//
//            $requirementCurrent->detailComponents = array();
//            $requirementCurrent->detailComponents = $sessionList;
//
//            if ($requirementCurrent->save(Yii::app()->db))
//                $this->redirect(array('view', 'id' => $requirementCurrent->header->id));
//        }
//
//        $this->render('loop', array(
//            'requirement' => $requirementCurrent,
//            'index' => $index,
//        ));
//    }

    public function actionUpdate($id) {
        $requirement = $this->instantiate($id);

        $saleOrderHeader = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : array());
        $saleOrderHeaderDataProvider = $saleOrderHeader->searchByRequirement();

        if (isset($_POST['Submit'])) {
            $this->loadState($requirement);
            if ($requirement->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $requirement->header->id));
        }

        $this->render('update', array(
            'requirement' => $requirement,
            'saleOrderHeader' => $saleOrderHeader,
            'saleOrderHeaderDataProvider' => $saleOrderHeaderDataProvider,
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

    public function actionView($id) {
        $requirement = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('requirement_header_id', $requirement->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('RequirementDetail', array(
			'criteria' => $criteria,
		));

        $this->render('view', array(
            'requirement' => $requirement,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $requirement = $this->loadModel($id);

        $this->render('memo', array(
            'requirement' => $requirement,
        ));
    }
    
    public function actionMemoAll($id) {
        $requirement = $this->loadModel($id);

        $this->render('memoAll', array(
            'requirement' => $requirement,
        ));
    }

    public function actionMemoComponent($id) {
        $requirement = $this->loadModel($id);
        $components = array();

        foreach ($requirement->requirementDetails as $i => $detail)
            foreach ($detail->requirementDetailComponents as $i => $detailComponent) {
                if ($detailComponent->budgeting_detail_id != NULL) {
                    $exists = FALSE;
                    foreach ($components as $component)
                        if ($detailComponent->component_id == $component->component_id)
                            $exists = TRUE;
                    if (!$exists)
                        $components[] = $detailComponent;
                }
				else {
					$exists = FALSE;
                    foreach ($components as $component)
                        if ($detailComponent->component_id == $component->component_id)
                            $exists = TRUE;
                    if (!$exists)
                        $components[] = $detailComponent;
				}
					
            }


        $this->render('memoComponent', array(
            'requirement' => $requirement,
            'components' => $components
        ));
    }

    public function actionMemoCu($id) {
        $requirement = $this->loadModel($id);
        $componentCus = array();

        foreach ($requirement->requirementDetails as $i => $detail)
            foreach ($detail->requirementDetailComponents as $i => $detailComponent) {
                if ($detailComponent->budgeting_detail_accesories_id != NULL) {
                    $exists = FALSE;
                    foreach ($componentCus as $componentCu)
                        if ($detailComponent->budgetingDetailAccesories->component_cu_id == $componentCu->budgetingDetailAccesories->component_cu_id)
                            $exists = TRUE;
                    if (!$exists)
                        $componentCus[] = $detailComponent;
                }
            }


        $this->render('memoCu', array(
            'requirement' => $requirement,
            'componentCus' => $componentCus
        ));
    }

    public function actionAdmin() {
        $requirement = Search::bind(new RequirementHeader('search'), isset($_GET['RequirementHeader']) ? $_GET['RequirementHeader'] : array());
        $projectName = isset($_GET['ProjectName']) ? $_GET['ProjectName'] : '';
        
        $saleOrderCnOrdinal = isset($_GET['SaleOrderCnOrdinal']) ? $_GET['SaleOrderCnOrdinal'] : '';
        $saleOrderCnMonth = isset($_GET['SaleOrderCnMonth']) ? $_GET['SaleOrderCnMonth'] : '';
        $saleOrderCnYear = isset($_GET['SaleOrderCnYear']) ? $_GET['SaleOrderCnYear'] : '';

        $dataProvider = $requirement->resetScope()->search();
        $dataProvider->criteria->with = array(
			'saleOrderHeader'
        );
        
        $dataProvider->criteria->compare('saleOrderHeader.cn_ordinal', $saleOrderCnOrdinal);
        $dataProvider->criteria->compare('saleOrderHeader.cn_month', $saleOrderCnMonth);
        $dataProvider->criteria->compare('saleOrderHeader.cn_year', $saleOrderCnYear);

        $dataProvider->criteria->addCondition("saleOrderHeader.project_name LIKE :projectName");
        $dataProvider->criteria->params[':projectName'] = "%{$projectName}%";

        $dataProvider->sort->attributes = array(
            'cn_ordinal' => 't.id',
            'date' => 't.date',
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
            'requirement' => $requirement,
            'dataProvider' => $dataProvider,
            'projectName' => $projectName,
            'saleOrderCnOrdinal' => $saleOrderCnOrdinal,
            'saleOrderCnMonth' => $saleOrderCnMonth,
            'saleOrderCnYear' => $saleOrderCnYear
        ));
    }

    public function actionAjaxHtmlRemoveDetail($index, $id) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirement = $this->instantiate($id);

            $this->loadState($requirement);

            $requirement->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'requirement' => $requirement,
            ));
        }
    }

    public function actionAjaxHtmlRemoveDetailComponent($i, $id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirement = $this->instantiate($id);
            $this->loadStateLoop($requirement);

            $requirement->removeDetailPanelAt($i);

            $this->renderPartial('_detail_component', array(
                'requirement' => $requirement,
                'index' => $index,
            ));
        }
    }

    public function actionAjaxJsonSaleOrder($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirement = $this->instantiate($id);

            $this->loadState($requirement);

            $saleOrderHeader = SaleOrderHeader::model()->findByPk($_POST['RequirementHeader']['sale_order_header_id']);

            $object = array(
                'sale_order_code_number' => ($saleOrderHeader === null) ? '' : $saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT),
                'sale_order_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($saleOrderHeader, 'date')))),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonTotal($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirement = $this->instantiate($id);
            $this->loadState($requirement);

            $object = array(
                'total' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($requirement->details[$index], 'total'))),
                'subTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $requirement->getSubTotal())),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonTotalPanel($id, $i, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirement = $this->instantiate($id);
            $this->loadStateLoop($requirement);

            $object = array(
                'total' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($requirement->detailComponents[$i], 'total'))),
                'subTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $requirement->getSubTotalPanel($index))),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlAddDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirement = $this->instantiate($id);

            if (isset($_POST['RequirementHeader']['sale_order_header_id']))
                $requirement->addDetails($_POST['RequirementHeader']['sale_order_header_id']);

            $this->renderPartial('_detail', array(
                'requirement' => $requirement,
            ));
        }
    }

    public function actionAjaxHtmlAddDetailComponent($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirement = $this->instantiate($id);
            $this->loadStateLoop($requirement);

            $requirement->addDetail($index);

            $this->renderPartial('_detail_component', array(
                'requirement' => $requirement,
                'index' => $index,
            ));
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $requirement = new Requirement(new RequirementHeader(), array(), array());
        else {
            $requirementHeader = $this->loadModel($id);
            $requirement = new Requirement($requirementHeader, $requirementHeader->requirementDetails, $requirementHeader->requirementDetailComponents);
        }

        return $requirement;
    }

    public function loadModel($id) {
        $model = RequirementHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function loadState(&$requirement) {
        if (isset($_POST['RequirementHeader'])) {
            $requirement->header->attributes = $_POST['RequirementHeader'];
        }
        if (isset($_POST['RequirementDetail'])) {
            foreach ($_POST['RequirementDetail'] as $i => $item) {
                if (isset($requirement->details[$i]))
                    $requirement->details[$i]->attributes = $item;
                else {
                    $detail = new RequirementDetail();
                    $detail->attributes = $item;
                    $requirement->details[] = $detail;
                }
            }
            if (count($_POST['RequirementDetail']) < count($requirement->details))
                array_splice($requirement->details, $i + 1);
        }
        else
            $requirement->details = array();
    }

    protected function loadStateLoop(&$requirementCurrent) {

        if (isset($_POST['RequirementDetailComponent'])) {
            foreach ($_POST['RequirementDetailComponent'] as $i => $item) {
                if (isset($requirementCurrent->detailComponents[$i]))
                    $requirementCurrent->detailComponents[$i]->attributes = $item;
                else {
                    $detail = new RequirementDetailComponent();
                    $detail->attributes = $item;
                    $requirementCurrent->detailComponents[] = $detail;
                }
            }
            if (count($_POST['RequirementDetailComponent']) < count($requirementCurrent->detailComponents))
                array_splice($requirementCurrent->detailComponents, $i + 1);
        }
        else
            $requirementCurrent->detailComponents = array();
    }
}
