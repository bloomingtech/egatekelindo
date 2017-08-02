<?php

/**
 * @property integer $id
 * @property string $panel_name
 * @property integer $sort_number
 * @property integer $quantity
 * @property string $unit_price
 * @property integer $sale_order_header_id
 * @property integer $is_inactive
 *
 * @property BudgetingDetail[] $budgetingDetails
 * @property BudgetingDetailAccesories[] $budgetingDetailAccesories
 * @property EstimationPanel[] $estimationPanels
 * @property RequirementDetail[] $requirementDetails
 * @property SaleOrderHeader $saleOrderHeader
 * @property WorkOrderDrawingDetail[] $workOrderDrawingDetails
 */
class SaleOrderDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_sale_order_detail';
	}

	public function rules()
	{
		return array(
			array('panel_name, sort_number, quantity, sale_order_header_id', 'required'),
			array('sort_number, quantity, sale_order_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('panel_name', 'length', 'max'=>60),
			array('unit_price', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, panel_name, sort_number, quantity, unit_price, sale_order_header_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingDetails' => array(self::HAS_MANY, 'BudgetingDetail', 'sale_order_detail_id'),
			'budgetingDetailAccesories' => array(self::HAS_MANY, 'BudgetingDetailAccesories', 'sale_order_detail_id'),
			'estimationPanels' => array(self::HAS_MANY, 'EstimationPanel', 'sale_order_detail_id'),
			'requirementDetails' => array(self::HAS_MANY, 'RequirementDetail', 'sale_order_detail_id'),
			'saleOrderHeader' => array(self::BELONGS_TO, 'SaleOrderHeader', 'sale_order_header_id'),
			'workOrderDrawingDetails' => array(self::HAS_MANY, 'WorkOrderDrawingDetail', 'sale_order_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'panel_name' => 'Panel Name',
			'sort_number' => 'Sort Number',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'sale_order_header_id' => 'Sale Order Header',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.panel_name', $this->panel_name, true);
		$criteria->compare('t.sort_number', $this->sort_number);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.sale_order_header_id', $this->sale_order_header_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
