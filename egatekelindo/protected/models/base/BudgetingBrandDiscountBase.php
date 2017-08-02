<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $value_1
 * @property integer $value_calculation_type_1
 * @property string $value_2
 * @property integer $value_calculation_type_2
 * @property string $value_3
 * @property integer $value_calculation_type_3
 * @property string $value_4
 * @property integer $value_calculation_type_4
 * @property integer $budgeting_header_id
 * @property integer $budgeting_currency_id
 * @property integer $component_brand_discount_id
 * @property integer $is_inactive
 *
 * @property BudgetingHeader $budgetingHeader
 * @property BudgetingCurrency $budgetingCurrency
 * @property ComponentBrandDiscount $componentBrandDiscount
 * @property BudgetingDetail[] $budgetingDetails
 * @property BudgetingDetailAccesories[] $budgetingDetailAccesories
 * @property RequirementDetailAdditional[] $requirementDetailAdditionals
 */
class BudgetingBrandDiscountBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_budgeting_brand_discount';
	}

	public function rules()
	{
		return array(
			array('name, budgeting_header_id, component_brand_discount_id', 'required'),
			array('value_calculation_type_1, value_calculation_type_2, value_calculation_type_3, value_calculation_type_4, budgeting_header_id, budgeting_currency_id, component_brand_discount_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			array('value_1, value_2, value_3, value_4', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, name, value_1, value_calculation_type_1, value_2, value_calculation_type_2, value_3, value_calculation_type_3, value_4, value_calculation_type_4, budgeting_header_id, budgeting_currency_id, component_brand_discount_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingHeader' => array(self::BELONGS_TO, 'BudgetingHeader', 'budgeting_header_id'),
			'budgetingCurrency' => array(self::BELONGS_TO, 'BudgetingCurrency', 'budgeting_currency_id'),
			'componentBrandDiscount' => array(self::BELONGS_TO, 'ComponentBrandDiscount', 'component_brand_discount_id'),
			'budgetingDetails' => array(self::HAS_MANY, 'BudgetingDetail', 'budgeting_brand_discount_id'),
			'budgetingDetailAccesories' => array(self::HAS_MANY, 'BudgetingDetailAccesories', 'budgeting_brand_discount_id'),
			'requirementDetailAdditionals' => array(self::HAS_MANY, 'RequirementDetailAdditional', 'budgeting_brand_discount_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'value_1' => 'Value 1',
			'value_calculation_type_1' => 'Value Calculation Type 1',
			'value_2' => 'Value 2',
			'value_calculation_type_2' => 'Value Calculation Type 2',
			'value_3' => 'Value 3',
			'value_calculation_type_3' => 'Value Calculation Type 3',
			'value_4' => 'Value 4',
			'value_calculation_type_4' => 'Value Calculation Type 4',
			'budgeting_header_id' => 'Budgeting Header',
			'budgeting_currency_id' => 'Budgeting Currency',
			'component_brand_discount_id' => 'Component Brand Discount',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.value_1', $this->value_1, true);
		$criteria->compare('t.value_calculation_type_1', $this->value_calculation_type_1);
		$criteria->compare('t.value_2', $this->value_2, true);
		$criteria->compare('t.value_calculation_type_2', $this->value_calculation_type_2);
		$criteria->compare('t.value_3', $this->value_3, true);
		$criteria->compare('t.value_calculation_type_3', $this->value_calculation_type_3);
		$criteria->compare('t.value_4', $this->value_4, true);
		$criteria->compare('t.value_calculation_type_4', $this->value_calculation_type_4);
		$criteria->compare('t.budgeting_header_id', $this->budgeting_header_id);
		$criteria->compare('t.budgeting_currency_id', $this->budgeting_currency_id);
		$criteria->compare('t.component_brand_discount_id', $this->component_brand_discount_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
