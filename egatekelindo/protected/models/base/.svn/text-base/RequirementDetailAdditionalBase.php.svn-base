<?php

/**
 * @property integer $id
 * @property string $quantity
 * @property string $unit_price
 * @property string $memo
 * @property integer $component_id
 * @property integer $component_cu_id
 * @property integer $requirement_detail_id
 * @property integer $budgeting_brand_discount_id
 * @property integer $is_inactive
 *
 * @property Component $component
 * @property ComponentCu $componentCu
 * @property RequirementDetail $requirementDetail
 * @property BudgetingBrandDiscount $budgetingBrandDiscount
 */
class RequirementDetailAdditionalBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_requirement_detail_additional';
	}

	public function rules()
	{
		return array(
			array('memo, requirement_detail_id', 'required'),
			array('component_id, component_cu_id, requirement_detail_id, budgeting_brand_discount_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('quantity', 'length', 'max'=>10),
			array('unit_price', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, quantity, unit_price, memo, component_id, component_cu_id, requirement_detail_id, budgeting_brand_discount_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'component' => array(self::BELONGS_TO, 'Component', 'component_id'),
			'componentCu' => array(self::BELONGS_TO, 'ComponentCu', 'component_cu_id'),
			'requirementDetail' => array(self::BELONGS_TO, 'RequirementDetail', 'requirement_detail_id'),
			'budgetingBrandDiscount' => array(self::BELONGS_TO, 'BudgetingBrandDiscount', 'budgeting_brand_discount_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'memo' => 'Memo',
			'component_id' => 'Component',
			'component_cu_id' => 'Component Cu',
			'requirement_detail_id' => 'Requirement Detail',
			'budgeting_brand_discount_id' => 'Budgeting Brand Discount',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity, true);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.memo', $this->memo, true);
		$criteria->compare('t.component_id', $this->component_id);
		$criteria->compare('t.component_cu_id', $this->component_cu_id);
		$criteria->compare('t.requirement_detail_id', $this->requirement_detail_id);
		$criteria->compare('t.budgeting_brand_discount_id', $this->budgeting_brand_discount_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
