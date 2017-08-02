<?php

class RequirementAssuranceHeader extends RequirementAssuranceHeaderBase
{
	const CN_CONSTANT = 'KT'; 
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
    public function getSubTotalComponentRequirement() {
        $total = 0.00;

        foreach ($this->requirementAssuranceDetailPanels as $detail)
            foreach ($detail->requirementAssuranceDetailComponents as $component)
                $total += $component->totalPriceRequirement;

        return $total;
    }

    public function getSubTotalComponentRequirementAssurance() {
        $total = 0.00;

        foreach ($this->requirementAssuranceDetailPanels as $detail)
            foreach ($detail->requirementAssuranceDetailComponents as $additional)
                $total += $additional->totalPrice;

        return $total;
    }
    
    public function getSubTotalDifference() {
        return $this->getSubTotalComponentRequirement() - $this->getSubTotalComponentRequirementAssurance();
    }

}