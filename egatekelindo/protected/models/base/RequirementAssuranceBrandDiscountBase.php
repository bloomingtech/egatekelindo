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
 * @property integer $requirement_assurance_header_id
 * @property integer $component_brand_discount_id
 * @property integer $is_inactive
 *
 * @property ComponentBrandDiscount $componentBrandDiscount
 * @property RequirementAssuranceHeader $requirementAssuranceHeader
 * @property RequirementAssuranceDetailComponent[] $requirementAssuranceDetailComponents
 */
class RequirementAssuranceBrandDiscountBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_requirement_assurance_brand_discount';
	}

	public function rules()
	{
		return array(
			array('requirement_assurance_header_id, component_brand_discount_id', 'required'),
			array('value_calculation_type_1, value_calculation_type_2, value_calculation_type_3, value_calculation_type_4, requirement_assurance_header_id, component_brand_discount_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('value_1, value_2, value_3, value_4', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, value_1, value_calculation_type_1, value_2, value_calculation_type_2, value_3, value_calculation_type_3, value_4, value_calculation_type_4, requirement_assurance_header_id, component_brand_discount_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'componentBrandDiscount' => array(self::BELONGS_TO, 'ComponentBrandDiscount', 'component_brand_discount_id'),
			'requirementAssuranceHeader' => array(self::BELONGS_TO, 'RequirementAssuranceHeader', 'requirement_assurance_header_id'),
			'requirementAssuranceDetailComponents' => array(self::HAS_MANY, 'RequirementAssuranceDetailComponent', 'requirement_brand_discount_id'),
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
			'requirement_assurance_header_id' => 'Requirement Assurance Header',
			'component_brand_discount_id' => 'Component Brand Discount',
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
		$criteria->compare('t.requirement_assurance_header_id', $this->requirement_assurance_header_id);
		$criteria->compare('t.component_brand_discount_id', $this->component_brand_discount_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
