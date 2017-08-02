<?php

class WorkOrderProductionController extends Controller {

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'view'
                || $filterChain->action->id === 'create'
                || $filterChain->action->id === 'workOrderDrawingList'
                || $filterChain->action->id === 'memo') {
            if (!(Yii::app()->user->checkAccess('workOrderProductionCreate') || Yii::app()->user->checkAccess('workOrderProductionEdit')))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'admin') {
            if (!(Yii::app()->user->checkAccess('workOrderProductionEdit')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionWorkOrderDrawingList() {
        $projectName = isset($_GET['ProjectName']) ? $_GET['ProjectName'] : '';
        $soOrdinal = isset($_GET['SoOrdinal']) ? $_GET['SoOrdinal'] : '';
        $soMonth = isset($_GET['SoMonth']) ? $_GET['SoMonth'] : '';
        $soYear = isset($_GET['SoYear']) ? $_GET['SoYear'] : '';

        $workOrderDrawingHeader = Search::bind(new WorkOrderDrawingHeader('search'), isset($_GET['WorkOrderDrawingHeader']) ? $_GET['WorkOrderDrawingHeader'] : '');
        $workOrderDrawingHeaderDataProvider = $workOrderDrawingHeader->searchByWorkOrderProduction();
        $workOrderDrawingHeaderDataProvider->criteria->with = array(
			'budgetingHeader' => array(
				'with' => array(
					'saleOrderHeader'
				)
			)
		);

        if (!empty($projectName)) {
            $workOrderDrawingHeaderDataProvider->criteria->addCondition('saleOrderHeader.project_name = :project_name');
            $workOrderDrawingHeaderDataProvider->criteria->params[':project_name'] = $projectName;
            $workOrderDrawingHeaderDataProvider->criteria->compare('saleOrderHeader.project_name', $projectName);
        }

        if (!empty($soOrdinal))
            $workOrderDrawingHeaderDataProvider->criteria->compare('saleOrderHeader.cn_ordinal', $soOrdinal);

        if (!empty($soMonth))
            $workOrderDrawingHeaderDataProvider->criteria->compare('saleOrderHeader.cn_month', $soMonth);

        if (!empty($soYear))
            $workOrderDrawingHeaderDataProvider->criteria->compare('saleOrderHeader.cn_year', $soYear);

        $workOrderDrawingHeaderDataProvider->criteria->order = 't.id DESC';

        $this->render('workOrderDrawingList', array(
            'projectName' => $projectName,
            'soOrdinal' => $soOrdinal,
            'soMonth' => $soMonth,
            'soYear' => $soYear,
            'workOrderDrawingHeader' => $workOrderDrawingHeader,
            'workOrderDrawingHeaderDataProvider' => $workOrderDrawingHeaderDataProvider,
        ));
    }

    public function actionCreate($workOrderDrawingId) {
        $workOrderProduction = $this->instantiate(null);
        $workOrderProduction->generateCodeNumber(date('m'), date('y'));
        $workOrderProduction->header->work_order_drawing_header_id = $workOrderDrawingId;
        $workOrderProduction->addDetails($workOrderDrawingId);

//        $workOrderDrawing = Search::bind(new WorkOrderDrawingHeader('search'), isset($_GET['WorkOrderDrawingHeader']) ? $_GET['WorkOrderDrawingHeader'] : array());
//        $workOrderDrawingDataProvider = $workOrderDrawing->searchByWorkOrderProduction();

        if (isset($_POST['Submit'])) {
            $this->loadState($workOrderProduction);
            if ($workOrderProduction->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $workOrderProduction->header->id));
        }

        $this->render('create', array(
            'workOrderProduction' => $workOrderProduction,
//            'workOrderDrawing' => $workOrderDrawing,
//            'workOrderDrawingDataProvider' => $workOrderDrawingDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $workOrderProduction = $this->instantiate($id);

//        $workOrderDrawing = Search::bind(new WorkOrderDrawingHeader('search'), isset($_GET['WorkOrderDrawingHeader']) ? $_GET['WorkOrderDrawingHeader'] : array());
//        $workOrderDrawingDataProvider = $workOrderDrawing->searchByWorkOrderProduction();

        if (isset($_POST['Submit'])) {
            $this->loadState($workOrderProduction);
            if ($workOrderProduction->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $workOrderProduction->header->id));
        }

        $this->render('update', array(
            'workOrderProduction' => $workOrderProduction,
//            'workOrderDrawing' => $workOrderDrawing,
//            'workOrderDrawingDataProvider' => $workOrderDrawingDataProvider,
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
        $workOrderProduction = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('work_order_production_header_id', $workOrderProduction->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('WorkOrderProductionDetail', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'workOrderProduction' => $workOrderProduction,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $workOrderProduction = $this->loadModel($id);

        $this->render('memo', array(
            'workOrderProduction' => $workOrderProduction,
        ));
    }

    public function actionAdmin() {
        $workOrderProduction = Search::bind(new WorkOrderProductionHeader('search'), isset($_GET['WorkOrderProductionHeader']) ? $_GET['WorkOrderProductionHeader'] : array());

        $saleOrderCnOrdinal = isset($_GET['SaleOrderCnOrdinal']) ? $_GET['SaleOrderCnOrdinal'] : '';
        $saleOrderCnMonth = isset($_GET['SaleOrderCnMonth']) ? $_GET['SaleOrderCnMonth'] : '';
        $saleOrderCnYear = isset($_GET['SaleOrderCnYear']) ? $_GET['SaleOrderCnYear'] : '';
		$projectName = isset($_GET['ProjectName']) ? $_GET['ProjectName'] : '';
		$clientCompany = isset($_GET['ClientCompany']) ? $_GET['ClientCompany'] : '';
        
        $dataProvider = $workOrderProduction->resetScope()->search();
        $dataProvider->criteria->with = array(
            'workOrderDrawingHeader:resetScope' => array(
                'with' => array(
                    'budgetingHeader' => array (
                        'with' => array(
                            'saleOrderHeader'
                        )
                    )
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
            'workOrderProduction' => $workOrderProduction,
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
            $workOrderProduction = $this->instantiate($id);

            $this->loadState($workOrderProduction);

            $workOrderProduction->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'workOrderProduction' => $workOrderProduction,
            ), false, true);
        }
    }

    public function actionAjaxJsonWorkOrderDrawing($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $workOrderProduction = $this->instantiate($id);

            $this->loadState($workOrderProduction);

            $workOrderDrawing = WorkOrderDrawingHeader::model()->findByPk($_POST['WorkOrderProductionHeader']['work_order_drawing_header_id']);

            $object = array(
                'work_order_drawing_code_number' => ($workOrderDrawing === null) ? '' : $workOrderDrawing->getCodeNumber(WorkOrderDrawingHeader::CN_CONSTANT),
                'work_order_drawing_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($workOrderDrawing, 'date')))),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlAddDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $workOrderProduction = $this->instantiate($id);

            if (isset($_POST['WorkOrderProductionHeader']['work_order_drawing_header_id']))
                $workOrderProduction->addDetails($_POST['WorkOrderProductionHeader']['work_order_drawing_header_id']);

            $this->renderPartial('_detail', array(
                'workOrderProduction' => $workOrderProduction,
                    ), false, true);
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $workOrderProduction = new WorkOrderProduction(new WorkOrderProductionHeader(), array());
        else {
            $workOrderProductionHeader = $this->loadModel($id);
            $workOrderProduction = new WorkOrderProduction($workOrderProductionHeader, $workOrderProductionHeader->workOrderProductionDetails);
        }

        return $workOrderProduction;
    }

    public function loadModel($id) {
        $model = WorkOrderProductionHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function loadState(&$workOrderProduction) {
        if (isset($_POST['WorkOrderProductionHeader'])) {
            $workOrderProduction->header->attributes = $_POST['WorkOrderProductionHeader'];
        }
        if (isset($_POST['WorkOrderProductionDetail'])) {
            foreach ($_POST['WorkOrderProductionDetail'] as $i => $item) {
                if (isset($workOrderProduction->details[$i]))
                    $workOrderProduction->details[$i]->attributes = $item;
                else {
                    $detail = new WorkOrderProductionDetail();
                    $detail->attributes = $item;
                    $workOrderProduction->details[] = $detail;
                }
            }
            if (count($_POST['WorkOrderProductionDetail']) < count($workOrderProduction->details))
                array_splice($workOrderProduction->details, $i + 1);
        }
        else
            $workOrderProduction->details = array();
    }

}
