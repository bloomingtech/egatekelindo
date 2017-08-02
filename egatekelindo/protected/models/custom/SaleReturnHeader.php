<?php

class SaleReturnHeader extends SaleReturnHeaderBase
{
	const CN_CONSTANT = 'SRE'; 
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function getSubTotal()
	{
		$total = 0.00;

		foreach ($this->saleReturnDetails as $detail)
			$total += $detail->total;

		return $total;
	}
	
	public function getTaxTotal()
	{
		return $this->getSubTotal() * 0.1;
	}
	
	public function getGrandTotal()
	{
		return $this->getSubTotal() + $this->getTaxTotal() - $this->discount;
	}
}