<?php

/**
 * @property integer $id
 * @property string $name
 * @property integer $is_inactive
 *
 * @property Component[] $components
 * @property ComponentBrandDiscount[] $componentBrandDiscounts
 * @property EstimationComponent[] $estimationComponents
 * @property EstimationComponentAccesories[] $estimationComponentAccesories
 * @property EstimationComponentAccesoriesHistory[] $estimationComponentAccesoriesHistories
 * @property EstimationComponentHistory[] $estimationComponentHistories
 * @property EstimationHeader[] $estimationHeaders
 * @property EstimationHeaderHistory[] $estimationHeaderHistories
 */
class ComponentBrandBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_component_brand';
	}

	public function rules()
	{
		return array(
			array('name', 'required'),
			array('is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, name, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'components' => array(self::HAS_MANY, 'Component', 'component_brand_id'),
			'componentBrandDiscounts' => array(self::HAS_MANY, 'ComponentBrandDiscount', 'component_brand_id'),
			'estimationComponents' => array(self::HAS_MANY, 'EstimationComponent', 'brand_id'),
			'estimationComponentAccesories' => array(self::HAS_MANY, 'EstimationComponentAccesories', 'brand_id'),
			'estimationComponentAccesoriesHistories' => array(self::HAS_MANY, 'EstimationComponentAccesoriesHistory', 'brand_id'),
			'estimationComponentHistories' => array(self::HAS_MANY, 'EstimationComponentHistory', 'brand_id'),
			'estimationHeaders' => array(self::HAS_MANY, 'EstimationHeader', 'component_brand_id'),
			'estimationHeaderHistories' => array(self::HAS_MANY, 'EstimationHeaderHistory', 'component_brand_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
