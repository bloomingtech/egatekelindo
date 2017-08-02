<?php

class PartListHeader extends PartListHeaderBase
{
	const CN_CONSTANT = 'PRO'; 
	//custom attribute
	public $saleOrderId;	
	public $saleOrderCnOrdinal;
	public $saleOrderCnMonth;
	public $saleOrderCnYear;
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function search() {
		$dataProvider = parent::search();
		
		$dataProvider->criteria->with = array(
			'saleOrder:resetScope' => array(
			),
		);
		
		$dataProvider->criteria->compare('saleOrder.cn_ordinal', $this->saleOrderCnOrdinal);
		$dataProvider->criteria->compare('saleOrder.cn_month', $this->saleOrderCnMonth);
		$dataProvider->criteria->compare('saleOrder.cn_year', $this->saleOrderCnYear);
		
		return $dataProvider;
	}
	
//	public function searchByPackingList()
//	{
//		$criteria = new CDbCriteria;
//
//		$criteria->condition = "t.id NOT IN (SELECT part_list_header_id FROM tblet_packing_list_header WHERE is_inactive = 0)";
//
//		$criteria->compare('t.cn_ordinal', $this->cn_ordinal);
//		$criteria->compare('t.cn_month', $this->cn_month);
//		$criteria->compare('t.cn_year', $this->cn_year);
//		$criteria->compare('t.date', $this->date, true);
//		$criteria->compare('t.is_inactive', 0);
//
//		return new CActiveDataProvider($this, array(
//			'criteria' => $criteria,
//		));
//	}
	
	
	public function searchByPackingList()
	{
		$criteria = new CDbCriteria;

		$criteria->condition = 'EXISTS (
			'. SqlViewGenerator::partListQuantityRemaining() .'
			WHERE t.id = p.part_list_header_id 
			HAVING quantity_partListed > 0
		)';

		$criteria->compare('cn_ordinal', $this->cn_ordinal);
		$criteria->compare('cn_month', $this->cn_month);
		$criteria->compare('cn_year', $this->cn_year);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('t.is_inactive', 0);	//select active purchase header
		
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}