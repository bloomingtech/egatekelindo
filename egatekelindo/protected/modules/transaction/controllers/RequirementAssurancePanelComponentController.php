<?php

class RequirementAssurancePanelComponentController extends Controller
{
	public function actionCreate($requirementAssuranceDetailPanelId)
	{
		$requirementAssurancePanelComponent = $this->instantiate($requirementAssuranceDetailPanelId);

		$requirementDetailId = $requirementAssurancePanelComponent->header->requirement_detail_id;
        $requirementAssurancePanelComponent->addDetailComponents($requirementDetailId);

		if (isset($_POST['Save']))
		{
			$this->loadState($requirementAssurancePanelComponent);
			if ($requirementAssurancePanelComponent->save(Yii::app()->db))
				$this->redirect(array('requirementAssurance/view', 'id' => $requirementAssurancePanelComponent->header->requirement_assurance_header_id));
		}

		$this->render('create', array(
			'requirementAssurancePanelComponent' => $requirementAssurancePanelComponent,
		));
	}

    public function actionView($id) {
        $requirementAssurancePanelComponent = $this->loadModel($id);
		$estimationPanel = EstimationPanel::model()->findByAttributes(array('sale_order_detail_id' => $requirementAssurancePanelComponent->requirementDetail->sale_order_detail_id));

        $criteria = new CDbCriteria;
        $criteria->compare('requirement_assurance_detail_panel_id', $requirementAssurancePanelComponent->id);
        $detailsDataProvider = new CActiveDataProvider('RequirementAssuranceDetailComponent', array(
			'criteria' => $criteria,
		));

        $this->render('view', array(
            'requirementAssurancePanelComponent' => $requirementAssurancePanelComponent,
            'detailsDataProvider' => $detailsDataProvider,
			'estimationPanel' => $estimationPanel
        ));
    }

	public function instantiate($id)
	{
		if (empty($id))
			$requirementDetail = new RequirementAssurancePanelComponent(new RequirementAssuranceDetailPanel(), array());
		else
		{
			$requirementPanel = $this->loadModel($id);
			$requirementDetail = new RequirementAssurancePanelComponent($requirementPanel, $requirementPanel->requirementAssuranceDetailComponents);
		}
		return $requirementDetail;
	}

	public function loadModel($id)
	{
		$model = RequirementAssuranceDetailPanel::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	public function loadState($requirementAssurancePanelComponent)
	{
		//load detail RequirementDetailComponent
		if (isset($_POST['RequirementAssuranceDetailComponent']))
		{
			foreach ($_POST['RequirementAssuranceDetailComponent'] as $i => $item)
			{
				if (isset($requirementAssurancePanelComponent->detailComponents[$i]))
					$requirementAssurancePanelComponent->detailComponents[$i]->attributes = $item;
				else
				{
					$detail = new RequirementAssuranceDetailComponent();
					$detail->attributes = $item;
					$requirementAssurancePanelComponent->detailComponents[] = $detail;
				}
			}
			if (count($_POST['RequirementAssuranceDetailComponent']) < count($requirementAssurancePanelComponent->detailComponents))
				array_splice($requirementAssurancePanelComponent->detailComponents, $i + 1);
		}
		else
			$requirementAssurancePanelComponent->detailComponents = array();
	}
}