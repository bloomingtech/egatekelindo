<?php

/**
 * @property integer $id
 * @property string $component_name
 * @property string $quantity
 * @property string $weight
 * @property string $unit_price
 * @property string $type
 * @property string $brand_name
 * @property integer $component_cu_id
 * @property integer $budgeting_header_id
 * @property integer $budgeting_brand_discount_id
 * @property integer $sale_order_detail_id
 * @property integer $estimation_component_accesories_id
 * @property integer $sort_number
 * @property integer $is_inactive
 *
 * @property BudgetingHeader $budgetingHeader
 * @property BudgetingBrandDiscount $budgetingBrandDiscount
 * @property ComponentCu $componentCu
 * @property EstimationComponentAccesories $estimationComponentAccesories
 * @property SaleOrderDetail $saleOrderDetail
 * @property RequirementDetailComponent[] $requirementDetailComponents
 */
class BudgetingDetailAccesoriesBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_budgeting_detail_accesories';
	}

	public function rules()
	{
		return array(
			array('component_name, quantity, budgeting_header_id, sort_number', 'required'),
			array('component_cu_id, budgeting_header_id, budgeting_brand_discount_id, sale_order_detail_id, estimation_component_accesories_id, sort_number, is_inactive', 'numerical', 'integerOnly'=>true),
			array('component_name', 'length', 'max'=>100),
			array('quantity, weight', 'length', 'max'=>10),
			array('unit_price', 'length', 'max'=>18),
			array('type, brand_name', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, component_name, quantity, weight, unit_price, type, brand_name, component_cu_id, budgeting_header_id, budgeting_brand_discount_id, sale_order_detail_id, estimation_component_accesories_id, sort_number, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingHeader' => array(self::BELONGS_TO, 'BudgetingHeader', 'budgeting_header_id'),
			'budgetingBrandDiscount' => array(self::BELONGS_TO, 'BudgetingBrandDiscount', 'budgeting_brand_discount_id'),
			'componentCu' => array(self::BELONGS_TO, 'ComponentCu', 'component_cu_id'),
			'estimationComponentAccesories' => array(self::BELONGS_TO, 'EstimationComponentAccesories', 'estimation_component_accesories_id'),
			'saleOrderDetail' => array(self::BELONGS_TO, 'SaleOrderDetail', 'sale_order_detail_id'),
			'requirementDetailComponents' => array(self::HAS_MANY, 'RequirementDetailComponent', 'budgeting_detail_accesories_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'component_name' => 'Component Name',
			'quantity' => 'Quantity',
			'weight' => 'Weight',
			'unit_price' => 'Unit Price',
			'type' => 'Type',
			'brand_name' => 'Brand Name',
			'component_cu_id' => 'Component Cu',
			'budgeting_header_id' => 'Budgeting Header',
			'budgeting_brand_discount_id' => 'Budgeting Brand Discount',
			'sale_order_detail_id' => 'Sale Order Detail',
			'estimation_component_accesories_id' => 'Estimation Component Accesories',
			'sort_number' => 'Sort Number',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.component_name', $this->component_name, true);
		$criteria->compare('t.quantity', $this->quantity, true);
		$criteria->compare('t.weight', $this->weight, true);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.type', $this->type, true);
		$criteria->compare('t.brand_name', $this->brand_name, true);
		$criteria->compare('t.component_cu_id', $this->component_cu_id);
		$criteria->compare('t.budgeting_header_id', $this->budgeting_header_id);
		$criteria->compare('t.budgeting_brand_discount_id', $this->budgeting_brand_discount_id);
		$criteria->compare('t.sale_order_detail_id', $this->sale_order_detail_id);
		$criteria->compare('t.estimation_component_accesories_id', $this->estimation_component_accesories_id);
		$criteria->compare('t.sort_number', $this->sort_number);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
