<?php

class RequirementDetailComponent extends RequirementDetailComponentBase {

	const NOT_STOCK = 0;
	const STOCK = 1;
	const NOT_STOCK_LITERAL = 'NO';
	const STOCK_LITERAL = 'YES';
	
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

	public function getStockStatus()
	{
		return ($this->is_stock) ? self::STOCK_LITERAL : self::NOT_STOCK_LITERAL;
	}

    public function getTotal() {
        return $this->unit_price * $this->quantity;
    }

    public function getTypeString() {

        if ($this->budgeting_detail_id != NULL)
            return $this->budgetingDetail->type;
        else if ($this->budgeting_detail_accesories_id != NULL)
            return $this->budgetingDetailAccesories->type;
        else if ($this->component_id != NULL)
            return $this->component->type;
    }
    
    public function getBrandString() {

        if ($this->budgeting_detail_id != NULL)
            return $this->budgetingDetail->brand_name;
        else if ($this->budgeting_detail_accesories_id != NULL)
            return $this->budgetingDetailAccesories->brand_name;
        else if ($this->component_id != NULL)
            return $this->component->componentBrand->name;
    }
}