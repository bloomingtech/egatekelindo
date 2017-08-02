<?php

class WorkOrderDrawingController extends Controller {

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'view'
                || $filterChain->action->id === 'create'
                || $filterChain->action->id === 'budgetingList'
                || $filterChain->action->id === 'memo') {
            if (!(Yii::app()->user->checkAccess('workOrderDrawingCreate') || Yii::app()->user->checkAccess('workOrderDrawingEdit')))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'admin') {
            if (!(Yii::app()->user->checkAccess('workOrderDrawingEdit')))
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
        $budgetingHeaderDataProvider = $budgetingHeader->searchByWorkOrderDrawing();
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

    public function actionCreate($budgetingId) {
        $workOrderDrawing = $this->instantiate(null);
        $workOrderDrawing->generateCodeNumber(date('m'), date('y'));

        $workOrderDrawing->header->budgeting_header_id = $budgetingId;
        $workOrderDrawing->addDetails($budgetingId);

//        $budgetingHeader = Search::bind(new BudgetingHeader('search'), isset($_GET['BudgetingHeader']) ? $_GET['BudgetingHeader'] : array());
//        $budgetingHeaderDataProvider = $budgetingHeader->searchByWorkOrderDrawing();

        if (isset($_POST['Submit'])) {
            $this->loadState($workOrderDrawing);
            if ($workOrderDrawing->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $workOrderDrawing->header->id));
        }

        $this->render('create', array(
            'workOrderDrawing' => $workOrderDrawing,
//            'budgetingHeader' => $budgetingHeader,
//            'budgetingHeaderDataProvider' => $budgetingHeaderDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $workOrderDrawing = $this->instantiate($id);

//        $budgetingHeader = Search::bind(new BudgetingHeader('search'), isset($_GET['BudgetingHeader']) ? $_GET['BudgetingHeader'] : array());
//        $budgetingHeaderDataProvider = $budgetingHeader->searchByWorkOrderDrawing();

        if (isset($_POST['Submit'])) {
            $this->loadState($workOrderDrawing);
            if ($workOrderDrawing->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $workOrderDrawing->header->id));
        }

        $this->render('update', array(
            'workOrderDrawing' => $workOrderDrawing,
//            'budgetingHeader' => $budgetingHeader,
//            'budgetingHeaderDataProvider' => $budgetingHeaderDataProvider,
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
        $workOrderDrawing = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('work_order_drawing_header_id', $workOrderDrawing->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('WorkOrderDrawingDetail', array(
                    'criteria' => $criteria,
                ));

        if (isset($_POST['Confirm']) && (int) $workOrderDrawing->is_confirmed !== 1) {
            $workOrderDrawing->is_confirmed = 1;
            if ($workOrderDrawing->save(true, array('is_confirmed')))
                Yii::app()->user->setFlash('confirm', 'Your SPK has been confirmed!!!');
            else
                Yii::app()->user->setFlash('error', 'Your SPK failed to confirmed!!!');
        }

        $this->render('view', array(
            'workOrderDrawing' => $workOrderDrawing,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $workOrderDrawing = $this->loadModel($id);

        $this->render('memo', array(
            'workOrderDrawing' => $workOrderDrawing,
        ));
    }

    public function actionAdmin() {
        $workOrderDrawing = Search::bind(new WorkOrderDrawingHeader('search'), isset($_GET['WorkOrderDrawingHeader']) ? $_GET['WorkOrderDrawingHeader'] : array());

        $saleOrderCnOrdinal = isset($_GET['SaleOrderCnOrdinal']) ? $_GET['SaleOrderCnOrdinal'] : '';
        $saleOrderCnMonth = isset($_GET['SaleOrderCnMonth']) ? $_GET['SaleOrderCnMonth'] : '';
        $saleOrderCnYear = isset($_GET['SaleOrderCnYear']) ? $_GET['SaleOrderCnYear'] : '';
        $projectName = isset($_GET['ProjectName']) ? $_GET['ProjectName'] : '';
		$clientCompany = isset($_GET['ClientCompany']) ? $_GET['ClientCompany'] : '';
		
        $dataProvider = $workOrderDrawing->resetScope()->search();
        $dataProvider->criteria->with = array(
            'budgetingHeader:resetScope' => array(
                'with' => array(
                    'saleOrderHeader'
                )
            )
        );
        
        $dataProvider->criteria->compare('saleOrderHeader.cn_ordinal', $saleOrderCnOrdinal);
        $dataProvider->criteria->compare('saleOrderHeader.cn_month', $saleOrderCnMonth);
        $dataProvider->criteria->compare('saleOrderHeader.cn_year', $saleOrderCnYear);

        $dataProvider->criteria->addCondition("saleOrderHeader.project_name LIKE :projectName OR saleOrderHeader.client_company LIKE :clientCompany");
        $dataProvider->criteria->params[':projectName'] = "%{$projectName}%";
		$dataProvider->criteria->params[':clientCompany'] = "%{$clientCompany}%";

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
            'workOrderDrawing' => $workOrderDrawing,
            'dataProvider' => $dataProvider,
            'projectName' => $projectName,
			'clientCompany' => $clientCompany,
            'saleOrderCnOrdinal' => $saleOrderCnOrdinal,
            'saleOrderCnMonth' => $saleOrderCnMonth,
            'saleOrderCnYear' => $saleOrderCnYear
        ));
    }

    public function actionAjaxHtmlRemoveDetail($index, $id) {
        if (Yii::app()->request->isAjaxRequest) {
            $workOrderDrawing = $this->instantiate($id);

            $this->loadState($workOrderDrawing);

            $workOrderDrawing->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'workOrderDrawing' => $workOrderDrawing,
            ));
        }
    }

    public function actionAjaxJsonBudgeting($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $workOrderDrawing = $this->instantiate($id);

            $this->loadState($workOrderDrawing);

            $budgetingHeader = BudgetingHeader::model()->findByPk($_POST['WorkOrderDrawingHeader']['budgeting_header_id']);

            $object = array(
                'budgeting_header_code_number' => ($budgetingHeader === null) ? '' : $budgetingHeader->getCodeNumber(BudgetingHeader::CN_CONSTANT),
                'budgeting_header_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($budgetingHeader, 'date')))),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlAddDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $workOrderDrawing = $this->instantiate($id);

            if (isset($_POST['WorkOrderDrawingHeader']['budgeting_header_id']))
                $workOrderDrawing->addDetails($_POST['WorkOrderDrawingHeader']['budgeting_header_id']);

            $this->renderPartial('_detail', array(
                'workOrderDrawing' => $workOrderDrawing,
                    ), false, true);
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $workOrderDrawing = new WorkOrderDrawing(new WorkOrderDrawingHeader(), array());
        else {
            $workOrderDrawingHeader = $this->loadModel($id);
            $workOrderDrawing = new WorkOrderDrawing($workOrderDrawingHeader, $workOrderDrawingHeader->workOrderDrawingDetails);
        }

        return $workOrderDrawing;
    }

    public function loadModel($id) {
        $model = WorkOrderDrawingHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function loadState(&$workOrderDrawing) {
        if (isset($_POST['WorkOrderDrawingHeader'])) {
            $workOrderDrawing->header->attributes = $_POST['WorkOrderDrawingHeader'];
        }
        if (isset($_POST['WorkOrderDrawingDetail'])) {
            foreach ($_POST['WorkOrderDrawingDetail'] as $i => $item) {
                if (isset($workOrderDrawing->details[$i]))
                    $workOrderDrawing->details[$i]->attributes = $item;
                else {
                    $detail = new WorkOrderDrawingDetail();
                    $detail->attributes = $item;
                    $workOrderDrawing->details[] = $detail;
                }
            }
            if (count($_POST['WorkOrderDrawingDetail']) < count($workOrderDrawing->details))
                array_splice($workOrderDrawing->details, $i + 1);
        }
        else
            $workOrderDrawing->details = array();
    }

}
