<?php

class RequirementAssuranceController extends Controller {

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

    public function actionRequirementList() {
        $projectName = isset($_GET['ProjectName']) ? $_GET['ProjectName'] : '';
		$clientCompany = isset($_GET['ClientCompany']) ? $_GET['ClientCompany'] : '';
        $soOrdinal = isset($_GET['SoOrdinal']) ? $_GET['SoOrdinal'] : '';
        $soMonth = isset($_GET['SoMonth']) ? $_GET['SoMonth'] : '';
        $soYear = isset($_GET['SoYear']) ? $_GET['SoYear'] : '';

        $requirementHeader = Search::bind(new RequirementHeader('search'), isset($_GET['RequirementHeader']) ? $_GET['RequirementHeader'] : '');
        $requirementHeaderDataProvider = $requirementHeader->searchByRequirementAssurance();
        $requirementHeaderDataProvider->criteria->with = array('saleOrderHeader');
		$requirementHeaderDataProvider->criteria->addCondition('t.is_component = 1');

        if (!empty($projectName)) {
            $requirementHeaderDataProvider->criteria->addCondition('saleOrderHeader.project_name = :project_name');
            $requirementHeaderDataProvider->criteria->params[':project_name'] = $projectName;
            $requirementHeaderDataProvider->criteria->compare('saleOrderHeader.project_name', $projectName);
        }

        if (!empty($clientCompany)) {
            $requirementHeaderDataProvider->criteria->addCondition('saleOrderHeader.client_company = :client_company');
            $requirementHeaderDataProvider->criteria->params[':client_company'] = $clientCompany;
            $requirementHeaderDataProvider->criteria->compare('saleOrderHeader.client_company', $clientCompany);
        }

        if (!empty($soOrdinal))
            $requirementHeaderDataProvider->criteria->compare('saleOrderHeader.cn_ordinal', $soOrdinal);

        if (!empty($soMonth))
            $requirementHeaderDataProvider->criteria->compare('saleOrderHeader.cn_month', $soMonth);

        if (!empty($soYear))
            $requirementHeaderDataProvider->criteria->compare('saleOrderHeader.cn_year', $soYear);

        $requirementHeaderDataProvider->criteria->order = 't.id DESC';

        $this->render('requirementList', array(
            'projectName' => $projectName,
			'clientCompany' => $clientCompany,
            'soOrdinal' => $soOrdinal,
            'soMonth' => $soMonth,
            'soYear' => $soYear,
            'requirementHeader' => $requirementHeader,
            'requirementHeaderDataProvider' => $requirementHeaderDataProvider,
        ));
    }
	
    public function actionCreate($requirementHeaderId) {
        $requirementAssurance = $this->instantiate(null);
        $requirementAssurance->generateCodeNumber(date('m'), date('y'));
        $requirementAssurance->header->requirement_header_id = $requirementHeaderId;
        
		$requirementAssurance->addDetailPanels($requirementHeaderId);
		$requirementAssurance->addRequirementAssuranceBrandDiscounts();
		
        if (isset($_POST['Submit'])) {
            $this->loadState($requirementAssurance);
            if ($requirementAssurance->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $requirementAssurance->header->id));
        }

        $this->render('create', array(
            'requirementAssurance' => $requirementAssurance,
        ));
    }

    public function actionView($id) {
        $requirementAssurance = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('requirement_assurance_header_id', $requirementAssurance->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('RequirementAssuranceDetailPanel', array(
			'criteria' => $criteria,
		));

        $this->render('view', array(
            'requirementAssurance' => $requirementAssurance,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionAdmin() {
        $requirementAssurance = Search::bind(new RequirementAssuranceHeader('search'), isset($_GET['RequirementAssuranceHeader']) ? $_GET['RequirementAssuranceHeader'] : array());
        $projectName = isset($_GET['ProjectName']) ? $_GET['ProjectName'] : '';
        
        $saleOrderCnOrdinal = isset($_GET['SaleOrderCnOrdinal']) ? $_GET['SaleOrderCnOrdinal'] : '';
        $saleOrderCnMonth = isset($_GET['SaleOrderCnMonth']) ? $_GET['SaleOrderCnMonth'] : '';
        $saleOrderCnYear = isset($_GET['SaleOrderCnYear']) ? $_GET['SaleOrderCnYear'] : '';

        $dataProvider = $requirementAssurance->resetScope()->search();
        $dataProvider->criteria->with = array(
			'requirementHeader:resetScope' => array(
				'with' => array(
					'saleOrderHeader'
				)
			)
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
            'requirementAssurance' => $requirementAssurance,
            'dataProvider' => $dataProvider,
            'projectName' => $projectName,
            'saleOrderCnOrdinal' => $saleOrderCnOrdinal,
            'saleOrderCnMonth' => $saleOrderCnMonth,
            'saleOrderCnYear' => $saleOrderCnYear
        ));
    }

    public function actionMemoAll($id) {
		set_time_limit(0);
		ini_set('memory_limit', '1024M');
		
        $requirementAssurance = $this->loadModel($id);
		$estimationHeader = EstimationHeader::model()->findByAttributes(array('sale_order_header_id' => $requirementAssurance->requirementHeader->sale_order_header_id));

        $this->render('memoAll', array(
            'requirementAssurance' => $requirementAssurance,
			'estimationHeader' => $estimationHeader,
        ));
    }

    public function instantiate($id) {
        if (empty($id))
            $requirementAssurance = new RequirementAssurance(new RequirementAssuranceHeader(), array(), array(), array());
        else {
            $requirementAssuranceHeader = $this->loadModel($id);
            $requirementAssurance = new RequirementAssurance($requirementAssuranceHeader, $requirementAssuranceHeader->details, $requirementAssuranceHeader->brandDiscounts, $requirementAssuranceHeader->detailComponents);
        }

        return $requirementAssurance;
    }

    public function loadModel($id) {
        $model = RequirementAssuranceHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function loadState(&$requirementAssurance) {
        if (isset($_POST['RequirementAssuranceHeader'])) {
            $requirementAssurance->header->attributes = $_POST['RequirementAssuranceHeader'];
        }
        if (isset($_POST['RequirementAssuranceDetailPanel'])) {
            foreach ($_POST['RequirementAssuranceDetailPanel'] as $i => $item) {
                if (isset($requirementAssurance->details[$i]))
                    $requirementAssurance->details[$i]->attributes = $item;
                else {
                    $detail = new RequirementAssuranceDetailPanel();
                    $detail->attributes = $item;
                    $requirementAssurance->details[] = $detail;
                }
            }
            if (count($_POST['RequirementAssuranceDetailPanel']) < count($requirementAssurance->details))
                array_splice($requirementAssurance->details, $i + 1);
        }
        else
            $requirementAssurance->details = array();
		
        // Load brandDiscount
        if (isset($_POST['RequirementAssuranceBrandDiscount'])) {
            foreach ($_POST['RequirementAssuranceBrandDiscount'] as $i => $item) {
                if (isset($requirementAssurance->brandDiscounts[$i]))
                    $requirementAssurance->brandDiscounts[$i]->attributes = $item;
                else {
                    $requirementAssuranceBrandDiscount = new RequirementAssuranceBrandDiscount();
                    $requirementAssuranceBrandDiscount->attributes = $item;
                    $requirementAssurance->brandDiscounts[] = $requirementAssuranceBrandDiscount;
                }
            }
        }
        else
            $requirementAssurance->brandDiscounts = array();
    }
	
    protected function loadStateLoop(&$requirementAssuranceCurrent) {
        if (isset($_POST['RequirementAssuranceDetailComponent'])) {
            foreach ($_POST['RequirementAssuranceDetailComponent'] as $i => $item) {
                if (isset($requirementAssuranceCurrent->detailComponents[$i]))
                    $requirementAssuranceCurrent->detailComponents[$i]->attributes = $item;
                else {
                    $detail = new RequirementAssuranceDetailComponent();
                    $detail->attributes = $item;
                    $requirementAssuranceCurrent->detailComponents[] = $detail;
                }
            }
            if (count($_POST['RequirementAssuranceDetailComponent']) < count($requirementAssuranceCurrent->detailComponents))
                array_splice($requirementAssuranceCurrent->detailComponents, $i + 1);
        }
        else
            $requirementAssuranceCurrent->detailComponents = array();
    }
}