<?php

/**
 * @property integer $id
 * @property string $name
 * @property integer $quantity
 * @property string $unit_price
 * @property string $accesories_phase_value
 * @property string $type
 * @property string $memo
 * @property integer $brand_id
 * @property integer $estimation_panel_id
 * @property integer $estimation_brand_discount_id
 * @property integer $estimation_component_group_id
 * @property integer $component_id
 * @property integer $accesories_phase_id
 * @property integer $sort_number
 * @property integer $is_lot
 * @property integer $is_inactive
 *
 * @property BudgetingDetail[] $budgetingDetails
 * @property Component $component
 * @property EstimationPanel $estimationPanel
 * @property AccesoriesPhase $accesoriesPhase
 * @property EstimationBrandDiscount $estimationBrandDiscount
 * @property ComponentBrand $brand
 * @property EstimationComponentGroup $estimationComponentGroup
 * @property RequirementAssuranceDetailComponent[] $requirementAssuranceDetailComponents
 */
class EstimationComponentBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_estimation_component';
	}

	public function rules()
	{
		return array(
			array('name, brand_id, estimation_panel_id, component_id', 'required'),
			array('quantity, brand_id, estimation_panel_id, estimation_brand_discount_id, estimation_component_group_id, component_id, accesories_phase_id, sort_number, is_lot, is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('unit_price, accesories_phase_value', 'length', 'max'=>18),
			array('type', 'length', 'max'=>20),
			array('memo', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, name, quantity, unit_price, accesories_phase_value, type, memo, brand_id, estimation_panel_id, estimation_brand_discount_id, estimation_component_group_id, component_id, accesories_phase_id, sort_number, is_lot, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingDetails' => array(self::HAS_MANY, 'BudgetingDetail', 'estimation_component_id'),
			'component' => array(self::BELONGS_TO, 'Component', 'component_id'),
			'estimationPanel' => array(self::BELONGS_TO, 'EstimationPanel', 'estimation_panel_id'),
			'accesoriesPhase' => array(self::BELONGS_TO, 'AccesoriesPhase', 'accesories_phase_id'),
			'estimationBrandDiscount' => array(self::BELONGS_TO, 'EstimationBrandDiscount', 'estimation_brand_discount_id'),
			'brand' => array(self::BELONGS_TO, 'ComponentBrand', 'brand_id'),
			'estimationComponentGroup' => array(self::BELONGS_TO, 'EstimationComponentGroup', 'estimation_component_group_id'),
			'requirementAssuranceDetailComponents' => array(self::HAS_MANY, 'RequirementAssuranceDetailComponent', 'estimation_component_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'accesories_phase_value' => 'Accesories Phase Value',
			'type' => 'Type',
			'memo' => 'Memo',
			'brand_id' => 'Brand',
			'estimation_panel_id' => 'Estimation Panel',
			'estimation_brand_discount_id' => 'Estimation Brand Discount',
			'estimation_component_group_id' => 'Estimation Component Group',
			'component_id' => 'Component',
			'accesories_phase_id' => 'Accesories Phase',
			'sort_number' => 'Sort Number',
			'is_lot' => 'Is Lot',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.accesories_phase_value', $this->accesories_phase_value, true);
		$criteria->compare('t.type', $this->type, true);
		$criteria->compare('t.memo', $this->memo, true);
		$criteria->compare('t.brand_id', $this->brand_id);
		$criteria->compare('t.estimation_panel_id', $this->estimation_panel_id);
		$criteria->compare('t.estimation_brand_discount_id', $this->estimation_brand_discount_id);
		$criteria->compare('t.estimation_component_group_id', $this->estimation_component_group_id);
		$criteria->compare('t.component_id', $this->component_id);
		$criteria->compare('t.accesories_phase_id', $this->accesories_phase_id);
		$criteria->compare('t.sort_number', $this->sort_number);
		$criteria->compare('t.is_lot', $this->is_lot);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
