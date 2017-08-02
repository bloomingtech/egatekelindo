<?php

class SaleInvoiceHeader extends SaleInvoiceHeaderBase
{
	const CN_CONSTANT = 'INV'; 
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function getSubTotal()
	{
		$total = 0.00;

		foreach ($this->saleInvoiceDetails as $detail)
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
	
	public function searchBySalePayment()
	{	
		$criteria = new CDbCriteria;

		$criteria->order = 't.id DESC';
		$criteria->condition = "EXISTS (
			SELECT grand_total - total_payment  AS remaining 
			FROM " . SaleInvoiceHeader::model()->tableName() . " 
			WHERE t.id = id
			HAVING remaining > 0
		)";
		
		$criteria->compare('t.cn_ordinal', $this->cn_ordinal);
		$criteria->compare('t.cn_month', $this->cn_month);
		$criteria->compare('t.cn_year', $this->cn_year);
		$criteria->compare('t.date', $this->date, true);
		$criteria->compare('t.is_inactive', 0);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}