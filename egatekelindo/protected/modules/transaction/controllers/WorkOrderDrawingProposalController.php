<?php

class WorkOrderDrawingProposalController extends Controller {

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
        $workOrderDrawingProposal = $this->instantiate($detailId);

        if (isset($_POST['Submit'])) {
            $this->loadState($workOrderDrawingProposal);
            if ($workOrderDrawingProposal->save(Yii::app()->db))
                $this->redirect(array('workOrderDrawing/view', 'id' => $headerId));
        }

        $this->render('create', array(
            'workOrderDrawingProposal' => $workOrderDrawingProposal,
        ));
    }

    public function actionView($detailId, $headerId) {

        $workOrderDrawingProposal = $this->instantiate($detailId);

        $this->render('view', array(
            'workOrderDrawingProposal' => $workOrderDrawingProposal,
        ));
    }

    public function instantiate($id) {

        $workOrderDrawingDetail = $this->loadModel($id);

        if ($workOrderDrawingDetail->workOrderDrawingProposals != NULL)
            $workOrderDrawingProposal = new WorkOrderDrawingProposalComponent($workOrderDrawingDetail, $workOrderDrawingDetail->workOrderDrawingProposals);
        else
            $workOrderDrawingProposal = new WorkOrderDrawingProposalComponent($workOrderDrawingDetail, array());

        return $workOrderDrawingProposal;
    }

    public function loadModel($id) {
        $model = WorkOrderDrawingDetail::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionAjaxHtmlAddDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $workOrderDrawingProposalComponent = $this->instantiate($id);
            $this->loadState($workOrderDrawingProposalComponent);

            $workOrderDrawingProposalComponent->details[] = new WorkOrderDrawingProposal();

            $this->renderPartial('_detail', array(
                'workOrderDrawingProposalComponent' => $workOrderDrawingProposalComponent,
                    ), false, true);
        }
    }

    protected function loadState(&$workOrderDrawingProposal) {

        if (isset($_POST['WorkOrderDrawingProposal'])) {
            foreach ($_POST['WorkOrderDrawingProposal'] as $i => $item) {
                if (isset($workOrderDrawingProposal->details[$i]))
                    $workOrderDrawingProposal->details[$i]->attributes = $item;
                else {
                    $detail = new WorkOrderDrawingProposal();
                    $detail->attributes = $item;
                    $workOrderDrawingProposal->details[] = $detail;
                }
            }
            if (count($_POST['WorkOrderDrawingProposal']) < count($workOrderDrawingProposal->details))
                array_splice($workOrderDrawingProposal->details, $i + 1);
        }
        else
            $workOrderDrawingProposal->details = array();
    }

}

?>