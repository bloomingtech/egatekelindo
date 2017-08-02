<?php

/**
 * @property integer $id
 * @property integer $quantity
 * @property integer $part_list_header_id
 * @property integer $component_id
 * @property integer $is_inactive
 *
 * @property PackingListDetail[] $packingListDetails
 * @property Component $component
 * @property PartListHeader $partListHeader
 */
class PartListDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_part_list_detail';
	}

	public function rules()
	{
		return array(
			array('quantity, part_list_header_id, component_id', 'required'),
			array('quantity, part_list_header_id, component_id, is_inactive', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, quantity, part_list_header_id, component_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'packingListDetails' => array(self::HAS_MANY, 'PackingListDetail', 'part_list_detail_id'),
			'component' => array(self::BELONGS_TO, 'Component', 'component_id'),
			'partListHeader' => array(self::BELONGS_TO, 'PartListHeader', 'part_list_header_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'part_list_header_id' => 'Part List Header',
			'component_id' => 'Component',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.part_list_header_id', $this->part_list_header_id);
		$criteria->compare('t.component_id', $this->component_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
