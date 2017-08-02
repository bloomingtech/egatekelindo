<?php

/**
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $selling_price
 * @property string $budget_price
 * @property integer $component_brand_id
 * @property string $type
 * @property integer $component_brand_discount_id
 * @property integer $component_category_id
 * @property integer $component_group_id
 * @property string $note
 * @property integer $is_fiction
 * @property integer $is_accesories
 * @property integer $is_inactive
 *
 * @property BudgetingDetail[] $budgetingDetails
 * @property ComponentBrand $componentBrand
 * @property ComponentBrandDiscount $componentBrandDiscount
 * @property ComponentCategory $componentCategory
 * @property ComponentGroup $componentGroup
 * @property EstimationComponent[] $estimationComponents
 * @property EstimationComponentAccesories[] $estimationComponentAccesories
 * @property EstimationComponentAccesoriesHistory[] $estimationComponentAccesoriesHistories
 * @property EstimationComponentHistory[] $estimationComponentHistories
 * @property PartListDetail[] $partListDetails
 * @property PurchaseRequestDetailComponent[] $purchaseRequestDetailComponents
 * @property ReceiveDetail[] $receiveDetails
 * @property RequirementDetailAdditional[] $requirementDetailAdditionals
 * @property RequirementDetailComponent[] $requirementDetailComponents
 * @property SubconRequestDetail[] $subconRequestDetails
 */
class ComponentBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_component';
	}

	public function rules()
	{
		return array(
			array('name, component_brand_id, component_category_id, component_group_id', 'required'),
			array('component_brand_id, component_brand_discount_id, component_category_id, component_group_id, is_fiction, is_accesories, is_inactive', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>30),
			array('name, type', 'length', 'max'=>60),
			array('selling_price, budget_price', 'length', 'max'=>18),
			array('note', 'safe'),
			// The following rule is used by search().
			array('id, code, name, selling_price, budget_price, component_brand_id, type, component_brand_discount_id, component_category_id, component_group_id, note, is_fiction, is_accesories, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingDetails' => array(self::HAS_MANY, 'BudgetingDetail', 'component_id'),
			'componentBrand' => array(self::BELONGS_TO, 'ComponentBrand', 'component_brand_id'),
			'componentBrandDiscount' => array(self::BELONGS_TO, 'ComponentBrandDiscount', 'component_brand_discount_id'),
			'componentCategory' => array(self::BELONGS_TO, 'ComponentCategory', 'component_category_id'),
			'componentGroup' => array(self::BELONGS_TO, 'ComponentGroup', 'component_group_id'),
			'estimationComponents' => array(self::HAS_MANY, 'EstimationComponent', 'component_id'),
			'estimationComponentAccesories' => array(self::HAS_MANY, 'EstimationComponentAccesories', 'component_id'),
			'estimationComponentAccesoriesHistories' => array(self::HAS_MANY, 'EstimationComponentAccesoriesHistory', 'component_id'),
			'estimationComponentHistories' => array(self::HAS_MANY, 'EstimationComponentHistory', 'component_id'),
			'partListDetails' => array(self::HAS_MANY, 'PartListDetail', 'component_id'),
			'purchaseRequestDetailComponents' => array(self::HAS_MANY, 'PurchaseRequestDetailComponent', 'component_id'),
			'receiveDetails' => array(self::HAS_MANY, 'ReceiveDetail', 'component_id'),
			'requirementDetailAdditionals' => array(self::HAS_MANY, 'RequirementDetailAdditional', 'component_id'),
			'requirementDetailComponents' => array(self::HAS_MANY, 'RequirementDetailComponent', 'component_id'),
			'subconRequestDetails' => array(self::HAS_MANY, 'SubconRequestDetail', 'component_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'name' => 'Name',
			'selling_price' => 'Selling Price',
			'budget_price' => 'Budget Price',
			'component_brand_id' => 'Component Brand',
			'type' => 'Type',
			'component_brand_discount_id' => 'Component Brand Discount',
			'component_category_id' => 'Component Category',
			'component_group_id' => 'Component Group',
			'note' => 'Note',
			'is_fiction' => 'Is Fiction',
			'is_accesories' => 'Is Accesories',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.code', $this->code, true);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.selling_price', $this->selling_price, true);
		$criteria->compare('t.budget_price', $this->budget_price, true);
		$criteria->compare('t.component_brand_id', $this->component_brand_id);
		$criteria->compare('t.type', $this->type, true);
		$criteria->compare('t.component_brand_discount_id', $this->component_brand_discount_id);
		$criteria->compare('t.component_category_id', $this->component_category_id);
		$criteria->compare('t.component_group_id', $this->component_group_id);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.is_fiction', $this->is_fiction);
		$criteria->compare('t.is_accesories', $this->is_accesories);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
