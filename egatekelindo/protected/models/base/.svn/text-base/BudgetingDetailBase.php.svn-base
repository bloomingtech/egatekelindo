<?php

/**
 * @property integer $id
 * @property string $component_name
 * @property integer $quantity
 * @property string $unit_price
 * @property string $accessories_phase_value
 * @property string $type
 * @property string $brand_name
 * @property integer $component_id
 * @property integer $budgeting_header_id
 * @property integer $budgeting_brand_discount_id
 * @property integer $sale_order_detail_id
 * @property integer $estimation_component_id
 * @property integer $sort_number
 * @property integer $is_inactive
 *
 * @property BudgetingHeader $budgetingHeader
 * @property BudgetingBrandDiscount $budgetingBrandDiscount
 * @property Component $component
 * @property EstimationComponent $estimationComponent
 * @property SaleOrderDetail $saleOrderDetail
 * @property RequirementDetailComponent[] $requirementDetailComponents
 */
class BudgetingDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_budgeting_detail';
	}

	public function rules()
	{
		return array(
			array('component_name, quantity, brand_name, budgeting_header_id, sort_number', 'required'),
			array('quantity, component_id, budgeting_header_id, budgeting_brand_discount_id, sale_order_detail_id, estimation_component_id, sort_number, is_inactive', 'numerical', 'integerOnly'=>true),
			array('component_name', 'length', 'max'=>100),
			array('unit_price, accessories_phase_value', 'length', 'max'=>18),
			array('type, brand_name', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, component_name, quantity, unit_price, accessories_phase_value, type, brand_name, component_id, budgeting_header_id, budgeting_brand_discount_id, sale_order_detail_id, estimation_component_id, sort_number, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingHeader' => array(self::BELONGS_TO, 'BudgetingHeader', 'budgeting_header_id'),
			'budgetingBrandDiscount' => array(self::BELONGS_TO, 'BudgetingBrandDiscount', 'budgeting_brand_discount_id'),
			'component' => array(self::BELONGS_TO, 'Component', 'component_id'),
			'estimationComponent' => array(self::BELONGS_TO, 'EstimationComponent', 'estimation_component_id'),
			'saleOrderDetail' => array(self::BELONGS_TO, 'SaleOrderDetail', 'sale_order_detail_id'),
			'requirementDetailComponents' => array(self::HAS_MANY, 'RequirementDetailComponent', 'budgeting_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'component_name' => 'Component Name',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'accessories_phase_value' => 'Accessories Phase Value',
			'type' => 'Type',
			'brand_name' => 'Brand Name',
			'component_id' => 'Component',
			'budgeting_header_id' => 'Budgeting Header',
			'budgeting_brand_discount_id' => 'Budgeting Brand Discount',
			'sale_order_detail_id' => 'Sale Order Detail',
			'estimation_component_id' => 'Estimation Component',
			'sort_number' => 'Sort Number',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.component_name', $this->component_name, true);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.accessories_phase_value', $this->accessories_phase_value, true);
		$criteria->compare('t.type', $this->type, true);
		$criteria->compare('t.brand_name', $this->brand_name, true);
		$criteria->compare('t.component_id', $this->component_id);
		$criteria->compare('t.budgeting_header_id', $this->budgeting_header_id);
		$criteria->compare('t.budgeting_brand_discount_id', $this->budgeting_brand_discount_id);
		$criteria->compare('t.sale_order_detail_id', $this->sale_order_detail_id);
		$criteria->compare('t.estimation_component_id', $this->estimation_component_id);
		$criteria->compare('t.sort_number', $this->sort_number);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
