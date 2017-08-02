<?php

class RequirementDetailAdditional extends RequirementDetailAdditionalBase
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
        
        public function getTotal() {
		return $this->unit_price * $this->quantity;
	}
}