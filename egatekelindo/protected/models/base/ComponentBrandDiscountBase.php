<?php

/**
 * @property integer $id
 * @property string $value_1
 * @property integer $value_calculation_type_1
 * @property string $value_2
 * @property integer $value_calculation_type_2
 * @property string $value_3
 * @property integer $value_calculation_type_3
 * @property string $value_4
 * @property integer $value_calculation_type_4
 * @property string $value_5
 * @property integer $value_calculation_type_5
 * @property integer $currency_id
 * @property integer $component_brand_id
 * @property integer $is_primary
 * @property integer $is_inactive
 *
 * @property BudgetingBrandDiscount[] $budgetingBrandDiscounts
 * @property Component[] $components
 * @property ComponentBrand $componentBrand
 * @property Currency $currency
 * @property ComponentCu[] $componentCus
 * @property EstimationBrandDiscount[] $estimationBrandDiscounts
 * @property EstimationBrandDiscountHistory[] $estimationBrandDiscountHistories
 * @property RequirementAssuranceBrandDiscount[] $requirementAssuranceBrandDiscounts
 */
class ComponentBrandDiscountBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_component_brand_discount';
	}

	public function rules()
	{
		return array(
			array('component_brand_id', 'required'),
			array('value_calculation_type_1, value_calculation_type_2, value_calculation_type_3, value_calculation_type_4, value_calculation_type_5, currency_id, component_brand_id, is_primary, is_inactive', 'numerical', 'integerOnly'=>true),
			array('value_1, value_2, value_3, value_4, value_5', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, value_1, value_calculation_type_1, value_2, value_calculation_type_2, value_3, value_calculation_type_3, value_4, value_calculation_type_4, value_5, value_calculation_type_5, currency_id, component_brand_id, is_primary, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingBrandDiscounts' => array(self::HAS_MANY, 'BudgetingBrandDiscount', 'component_brand_discount_id'),
			'components' => array(self::HAS_MANY, 'Component', 'component_brand_discount_id'),
			'componentBrand' => array(self::BELONGS_TO, 'ComponentBrand', 'component_brand_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
			'componentCus' => array(self::HAS_MANY, 'ComponentCu', 'component_brand_discount_id'),
			'estimationBrandDiscounts' => array(self::HAS_MANY, 'EstimationBrandDiscount', 'component_brand_discount_id'),
			'estimationBrandDiscountHistories' => array(self::HAS_MANY, 'EstimationBrandDiscountHistory', 'component_brand_discount_id'),
			'requirementAssuranceBrandDiscounts' => array(self::HAS_MANY, 'RequirementAssuranceBrandDiscount', 'component_brand_discount_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'value_1' => 'Value 1',
			'value_calculation_type_1' => 'Value Calculation Type 1',
			'value_2' => 'Value 2',
			'value_calculation_type_2' => 'Value Calculation Type 2',
			'value_3' => 'Value 3',
			'value_calculation_type_3' => 'Value Calculation Type 3',
			'value_4' => 'Value 4',
			'value_calculation_type_4' => 'Value Calculation Type 4',
			'value_5' => 'Value 5',
			'value_calculation_type_5' => 'Value Calculation Type 5',
			'currency_id' => 'Currency',
			'component_brand_id' => 'Component Brand',
			'is_primary' => 'Is Primary',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.value_1', $this->value_1, true);
		$criteria->compare('t.value_calculation_type_1', $this->value_calculation_type_1);
		$criteria->compare('t.value_2', $this->value_2, true);
		$criteria->compare('t.value_calculation_type_2', $this->value_calculation_type_2);
		$criteria->compare('t.value_3', $this->value_3, true);
		$criteria->compare('t.value_calculation_type_3', $this->value_calculation_type_3);
		$criteria->compare('t.value_4', $this->value_4, true);
		$criteria->compare('t.value_calculation_type_4', $this->value_calculation_type_4);
		$criteria->compare('t.value_5', $this->value_5, true);
		$criteria->compare('t.value_calculation_type_5', $this->value_calculation_type_5);
		$criteria->compare('t.currency_id', $this->currency_id);
		$criteria->compare('t.component_brand_id', $this->component_brand_id);
		$criteria->compare('t.is_primary', $this->is_primary);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
