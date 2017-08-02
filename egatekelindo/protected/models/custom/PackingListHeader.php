<?php

class PackingListHeader extends PackingListHeaderBase
{
	const CN_CONSTANT = 'PKG'; 
	
	//custom attribute
	public $partListId;	
	public $partListHeaderCnOrdinal;
	public $partListHeaderCnMonth;
	public $partListHeaderCnYear;
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function search() {
		$dataProvider = parent::search();
		
		$dataProvider->criteria->with = array(
			'partListHeader:resetScope' => array(
			),
		);
		
		$dataProvider->criteria->compare('partListHeader.cn_ordinal', $this->partListHeaderCnOrdinal);
		$dataProvider->criteria->compare('partListHeader.cn_month', $this->partListHeaderCnMonth);
		$dataProvider->criteria->compare('partListHeader.cn_year', $this->partListHeaderCnYear);
		
		return $dataProvider;
	}
	
	public function searchByMaterialCheckout()
	{
		$criteria = new CDbCriteria;

		$criteria->condition = "t.id NOT IN (SELECT packing_list_header_id FROM tblet_material_checkout_header WHERE is_inactive = 0)";

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