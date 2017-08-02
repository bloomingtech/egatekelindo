<?php

class SalePaymentHeader extends SalePaymentHeaderBase
{
	const CN_CONSTANT = 'PAY'; 
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function getTotalAmount()
	{
		$total = 0.00;
		
		foreach ($this->salePaymentDetails(array(
			'condition' => 'salePaymentDetails.is_inactive = 0'
		)) as $detail)
			$total += $detail->amount;
		
		return $total;
	}
	
	public function getGrandTotal()
	{
		$returnTotal = $this->sale_return_header_id ? $this->saleReturnHeader->grand_total : 0 ;
		
		return $this->getTotalAmount() - $returnTotal;
	}
}