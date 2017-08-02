<?php

class PackingListDetail extends PackingListDetailBase
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function getPartListQuantityRemaining()
	{
		$sql = SqlViewGenerator::partListQuantityRemaining() . "
				WHERE p.id = :part_list_detail_id";
		
		$value = Yii::app()->db->createCommand($sql)->queryScalar(array(
			':part_list_detail_id' => $this->part_list_detail_id, 
		));
		
		return ($value === false) ? 0 : $value;
	}
}