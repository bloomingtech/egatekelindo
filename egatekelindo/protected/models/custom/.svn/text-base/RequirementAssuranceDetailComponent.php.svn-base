<?php

class RequirementAssuranceDetailComponent extends RequirementAssuranceDetailComponentBase
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
    public function getUnitPriceAfterDiscount() {
        $total = $this->unit_price;

        if ($this->requirementAssuranceBrandDiscount->value_1 > 0) {
            if ($this->requirementAssuranceBrandDiscount->value_calculation_type_1 == 1)
                $total = $total * $this->requirementAssuranceBrandDiscount->value_1;
            else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_1 == 2)
                $total = $total / $this->requirementAssuranceBrandDiscount->value_1;
            else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_1 == 3)
                $total = $total - $this->requirementAssuranceBrandDiscount->value_1;
			else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_1 == 4)
                $total = $total + $this->requirementAssuranceBrandDiscount->value_1;
        }

        if ($this->requirementAssuranceBrandDiscount->value_2 > 0) {
            if ($this->requirementAssuranceBrandDiscount->value_calculation_type_2 == 1)
                $total = $total * $this->requirementAssuranceBrandDiscount->value_2;
            else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_2 == 2)
                $total = $total / $this->requirementAssuranceBrandDiscount->value_2;
            else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_2 == 3)
                $total = $total - $this->requirementAssuranceBrandDiscount->value_2;
			else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_2 == 4)
                $total = $total + $this->requirementAssuranceBrandDiscount->value_2;
        }

        if ($this->requirementAssuranceBrandDiscount->value_3 > 0) {
            if ($this->requirementAssuranceBrandDiscount->value_calculation_type_3 == 1)
                $total = $total * $this->requirementAssuranceBrandDiscount->value_3;
            else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_3 == 2)
                $total = $total / $this->requirementAssuranceBrandDiscount->value_3;
            else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_3 == 3)
                $total = $total - $this->requirementAssuranceBrandDiscount->value_3;
			else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_3 == 4)
                $total = $total + $this->requirementAssuranceBrandDiscount->value_3;
        }

        if ($this->requirementAssuranceBrandDiscount->value_4 > 0) {
            if ($this->requirementAssuranceBrandDiscount->value_calculation_type_4 == 1)
                $total = $total * $this->requirementAssuranceBrandDiscount->value_4;
            else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_4 == 2)
                $total = $total / $this->requirementAssuranceBrandDiscount->value_4;
            else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_4 == 3)
                $total = $total - $this->requirementAssuranceBrandDiscount->value_4;
			else if ($this->requirementAssuranceBrandDiscount->value_calculation_type_4 == 4)
                $total = $total + $this->requirementAssuranceBrandDiscount->value_4;
        }

        return $total;
    }

	public function getTotalPriceRequirement()
	{
		return $this->requirementDetailComponent->quantity * $this->getUnitPriceAfterDiscount();
	}
	
	public function getTotalPrice()
	{
		return $this->quantity * $this->getUnitPriceAfterDiscount();
	}
}