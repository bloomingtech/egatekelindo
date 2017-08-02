<?php

class MaterialCheckoutHeader extends MaterialCheckoutHeaderBase
{
	const CN_CONSTANT = 'MCO'; 
	
	//custom attribute
	public $packingListHeaderId;	
	public $packingListHeaderCnOrdinal;
	public $packingListHeaderCnMonth;
	public $packingListHeaderCnYear;
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function search() {
		$dataProvider = parent::search();
		
		$dataProvider->criteria->with = array(
			'packingListHeader:resetScope' => array(
			),
		);
		
		$dataProvider->criteria->compare('packingListHeader.cn_ordinal', $this->packingListHeaderCnOrdinal);
		$dataProvider->criteria->compare('packingListHeader.cn_month', $this->packingListHeaderCnMonth);
		$dataProvider->criteria->compare('packingListHeader.cn_year', $this->packingListHeaderCnYear);
		
		return $dataProvider;
	}
}