<?php

class RequirementAssurancePanelComponent extends CComponent {

    public $header;
    public $detailComponents;

    public function __construct($header, array $detailComponents) {
        $this->header = $header;
        $this->detailComponents = $detailComponents;
    }

    public function addDetailComponents($requirementDetailId) {
        $this->detailComponents = array();
        $requirementDetail = RequirementDetail::model()->findByPk($requirementDetailId);

        if ($requirementDetail) {
            foreach ($requirementDetail->requirementDetailComponents as $requirementDetailComponent) {
                $detail = new RequirementAssuranceDetailComponent();
                $detail->requirement_detail_component_id = $requirementDetailComponent->id;
                $detail->quantity = $requirementDetailComponent->quantity;
                $detail->unit_price = $requirementDetailComponent->unit_price;
				$detail->estimation_component_id = ($requirementDetailComponent->budgetingDetail === null) ? null : $requirementDetailComponent->budgetingDetail->estimation_component_id;
                $this->detailComponents[] = $detail;
            }
        }
    }
    
    public function removeDetailAt($index) {
        array_splice($this->detailComponents, $index, 1);
    }
    
    public function flush() {
        $valid = TRUE;
        foreach ($this->detailComponents as $detail) {

            if ($detail->isNewRecord) {
                $detail->requirement_assurance_detail_panel_id = $this->header->id;
            }
            $valid = $valid && $detail->save(false);
        }
     
        return $valid;
    }

    public function save($dbConnection) {
        $dbTransaction = $dbConnection->beginTransaction();
        try {
            $valid = $this->validate() && $this->flush();
            if ($valid)
                $dbTransaction->commit();
            else
                $dbTransaction->rollback();
        } catch (Exception $e) {
            $dbTransaction->rollback();
            $this->header->addError('error', $e->getMessage());
            $valid = false;
        }
        return $valid;
    }

    public function validate() {

        $valid = TRUE;
        if (count($this->detailComponents) > 0) {
            foreach ($this->detailComponents as $detail) {
                $fields = array('quantity, unit_price, requirement_detail_component_id, requirement_assurance_brand_discount_id');
                $valid = $valid && $detail->validate($fields);
            }
        }
        else
            $valid = false;

        return $valid;
    }
}
