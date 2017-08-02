<?php

/**
 * @property integer $id
 * @property string $quantity
 * @property integer $production_request_header_id
 * @property integer $component_id
 * @property integer $is_inactive
 *
 * @property PackingListDetail[] $packingListDetails
 * @property Component $component
 * @property ProductionRequestHeader $productionRequestHeader
 */
class ProductionRequestDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_production_request_detail';
	}

	public function rules()
	{
		return array(
			array('quantity, production_request_header_id, component_id', 'required'),
			array('production_request_header_id, component_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('quantity', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, quantity, production_request_header_id, component_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'packingListDetails' => array(self::HAS_MANY, 'PackingListDetail', 'production_request_detail_id'),
			'component' => array(self::BELONGS_TO, 'Component', 'component_id'),
			'productionRequestHeader' => array(self::BELONGS_TO, 'ProductionRequestHeader', 'production_request_header_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'production_request_header_id' => 'Production Request Header',
			'component_id' => 'Component',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity, true);
		$criteria->compare('t.production_request_header_id', $this->production_request_header_id);
		$criteria->compare('t.component_id', $this->component_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
