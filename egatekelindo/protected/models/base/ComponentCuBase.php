<?php

/**
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $weight
 * @property integer $component_brand_discount_id
 * @property integer $unit_id
 * @property integer $is_inactive
 *
 * @property BudgetingDetailAccesories[] $budgetingDetailAccesories
 * @property ComponentBrandDiscount $componentBrandDiscount
 * @property Unit $unit
 * @property EstimationComponentAccesories[] $estimationComponentAccesories
 * @property EstimationComponentAccesoriesHistory[] $estimationComponentAccesoriesHistories
 * @property RequirementDetailAdditional[] $requirementDetailAdditionals
 * @property RequirementDetailComponent[] $requirementDetailComponents
 */
class ComponentCuBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_component_cu';
	}

	public function rules()
	{
		return array(
			array('name, weight', 'required'),
			array('component_brand_discount_id, unit_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>30),
			array('name', 'length', 'max'=>60),
			array('weight', 'length', 'max'=>10),
			// The following rule is used by search().
			array('id, code, name, weight, component_brand_discount_id, unit_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingDetailAccesories' => array(self::HAS_MANY, 'BudgetingDetailAccesories', 'component_cu_id'),
			'componentBrandDiscount' => array(self::BELONGS_TO, 'ComponentBrandDiscount', 'component_brand_discount_id'),
			'unit' => array(self::BELONGS_TO, 'Unit', 'unit_id'),
			'estimationComponentAccesories' => array(self::HAS_MANY, 'EstimationComponentAccesories', 'component_cu_id'),
			'estimationComponentAccesoriesHistories' => array(self::HAS_MANY, 'EstimationComponentAccesoriesHistory', 'component_cu_id'),
			'requirementDetailAdditionals' => array(self::HAS_MANY, 'RequirementDetailAdditional', 'component_cu_id'),
			'requirementDetailComponents' => array(self::HAS_MANY, 'RequirementDetailComponent', 'component_cu_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'name' => 'Name',
			'weight' => 'Weight',
			'component_brand_discount_id' => 'Component Brand Discount',
			'unit_id' => 'Unit',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.code', $this->code, true);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.weight', $this->weight, true);
		$criteria->compare('t.component_brand_discount_id', $this->component_brand_discount_id);
		$criteria->compare('t.unit_id', $this->unit_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
