<?php

/**
 * @property integer $id
 * @property string $component_name
 * @property string $quantity
 * @property string $unit_price
 * @property string $memo
 * @property integer $component_id
 * @property integer $component_cu_id
 * @property integer $requirement_detail_id
 * @property integer $budgeting_detail_id
 * @property integer $budgeting_detail_accesories_id
 * @property integer $is_stock
 * @property integer $is_inactive
 *
 * @property PurchaseDetailRequirement[] $purchaseDetailRequirements
 * @property RequirementAssuranceDetailComponent[] $requirementAssuranceDetailComponents
 * @property RequirementDetail $requirementDetail
 * @property BudgetingDetail $budgetingDetail
 * @property BudgetingDetailAccesories $budgetingDetailAccesories
 * @property Component $component
 * @property ComponentCu $componentCu
 */
class RequirementDetailComponentBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_requirement_detail_component';
	}

	public function rules()
	{
		return array(
			array('component_name, requirement_detail_id', 'required'),
			array('component_id, component_cu_id, requirement_detail_id, budgeting_detail_id, budgeting_detail_accesories_id, is_stock, is_inactive', 'numerical', 'integerOnly'=>true),
			array('component_name', 'length', 'max'=>60),
			array('quantity', 'length', 'max'=>10),
			array('unit_price', 'length', 'max'=>18),
			array('memo', 'safe'),
			// The following rule is used by search().
			array('id, component_name, quantity, unit_price, memo, component_id, component_cu_id, requirement_detail_id, budgeting_detail_id, budgeting_detail_accesories_id, is_stock, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'purchaseDetailRequirements' => array(self::HAS_MANY, 'PurchaseDetailRequirement', 'requirement_detail_component_id'),
			'requirementAssuranceDetailComponents' => array(self::HAS_MANY, 'RequirementAssuranceDetailComponent', 'requirement_detail_component_id'),
			'requirementDetail' => array(self::BELONGS_TO, 'RequirementDetail', 'requirement_detail_id'),
			'budgetingDetail' => array(self::BELONGS_TO, 'BudgetingDetail', 'budgeting_detail_id'),
			'budgetingDetailAccesories' => array(self::BELONGS_TO, 'BudgetingDetailAccesories', 'budgeting_detail_accesories_id'),
			'component' => array(self::BELONGS_TO, 'Component', 'component_id'),
			'componentCu' => array(self::BELONGS_TO, 'ComponentCu', 'component_cu_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'component_name' => 'Component Name',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'memo' => 'Memo',
			'component_id' => 'Component',
			'component_cu_id' => 'Component Cu',
			'requirement_detail_id' => 'Requirement Detail',
			'budgeting_detail_id' => 'Budgeting Detail',
			'budgeting_detail_accesories_id' => 'Budgeting Detail Accesories',
			'is_stock' => 'Is Stock',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.component_name', $this->component_name, true);
		$criteria->compare('t.quantity', $this->quantity, true);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.memo', $this->memo, true);
		$criteria->compare('t.component_id', $this->component_id);
		$criteria->compare('t.component_cu_id', $this->component_cu_id);
		$criteria->compare('t.requirement_detail_id', $this->requirement_detail_id);
		$criteria->compare('t.budgeting_detail_id', $this->budgeting_detail_id);
		$criteria->compare('t.budgeting_detail_accesories_id', $this->budgeting_detail_accesories_id);
		$criteria->compare('t.is_stock', $this->is_stock);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
