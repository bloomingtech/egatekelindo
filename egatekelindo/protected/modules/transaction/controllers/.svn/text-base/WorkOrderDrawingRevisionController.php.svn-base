<?php

class WorkOrderDrawingRevisionController extends Controller {

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'add'
                || $filterChain->action->id === 'view'
        ) {
            if (!(Yii::app()->user->checkAccess('workOrderDrawingCreate') || Yii::app()->user->checkAccess('workOrderDrawingEdit')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionAdd($detailId, $headerId) {
        $workOrderDrawingRevision = $this->instantiate($detailId);

        if (isset($_POST['Submit'])) {
            $this->loadState($workOrderDrawingRevision);
            if ($workOrderDrawingRevision->save(Yii::app()->db))
                $this->redirect(array('workOrderDrawing/view', 'id' => $headerId));
        }

        $this->render('create', array(
            'workOrderDrawingRevision' => $workOrderDrawingRevision,
        ));
    }

    public function actionView($detailId, $headerId) {
        $workOrderDrawingRevision = $this->instantiate($detailId);
        
        $this->render('view', array(
            'workOrderDrawingRevision' => $workOrderDrawingRevision,
        ));
    }

    public function instantiate($id) {

        $workOrderDrawingDetail = $this->loadModel($id);
        if ($workOrderDrawingDetail->workOrderDrawingRevisions != NULL)
            $workOrderDrawingRevision = new WorkOrderDrawingRevisionComponent($workOrderDrawingDetail, $workOrderDrawingDetail->workOrderDrawingRevisions);
        else
            $workOrderDrawingRevision = new WorkOrderDrawingRevisionComponent($workOrderDrawingDetail, array());

        return $workOrderDrawingRevision;
    }

    public function loadModel($id) {
        $model = WorkOrderDrawingDetail::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionAjaxHtmlAddDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $workOrderDrawingRevisionComponent = $this->instantiate($id);
            $this->loadState($workOrderDrawingRevisionComponent);

            $workOrderDrawingRevisionComponent->details[] = new WorkOrderDrawingRevision();

            $this->renderPartial('_detail', array(
                'workOrderDrawingRevisionComponent' => $workOrderDrawingRevisionComponent,
                    ), false, true);
        }
    }

    protected function loadState(&$workOrderDrawingRevision) {

        if (isset($_POST['WorkOrderDrawingRevision'])) {
            foreach ($_POST['WorkOrderDrawingRevision'] as $i => $item) {
                if (isset($workOrderDrawingRevision->details[$i]))
                    $workOrderDrawingRevision->details[$i]->attributes = $item;
                else {
                    $detail = new WorkOrderDrawingRevision();
                    $detail->attributes = $item;
                    $workOrderDrawingRevision->details[] = $detail;
                }
            }
            if (count($_POST['WorkOrderDrawingRevision']) < count($workOrderDrawingRevision->details))
                array_splice($workOrderDrawingRevision->details, $i + 1);
        }
        else
            $workOrderDrawingRevision->details = array();
    }

}

?>