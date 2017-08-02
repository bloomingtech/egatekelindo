<?php

/**
 * @property integer $id
 * @property integer $quantity
 * @property integer $packing_list_header_id
 * @property integer $part_list_detail_id
 * @property integer $is_inactive
 *
 * @property MaterialCheckoutDetail[] $materialCheckoutDetails
 * @property PackingListHeader $packingListHeader
 * @property PartListDetail $partListDetail
 */
class PackingListDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_packing_list_detail';
	}

	public function rules()
	{
		return array(
			array('quantity, packing_list_header_id, part_list_detail_id', 'required'),
			array('quantity, packing_list_header_id, part_list_detail_id, is_inactive', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, quantity, packing_list_header_id, part_list_detail_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'materialCheckoutDetails' => array(self::HAS_MANY, 'MaterialCheckoutDetail', 'packing_list_detail_id'),
			'packingListHeader' => array(self::BELONGS_TO, 'PackingListHeader', 'packing_list_header_id'),
			'partListDetail' => array(self::BELONGS_TO, 'PartListDetail', 'part_list_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'packing_list_header_id' => 'Packing List Header',
			'part_list_detail_id' => 'Part List Detail',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.packing_list_header_id', $this->packing_list_header_id);
		$criteria->compare('t.part_list_detail_id', $this->part_list_detail_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
