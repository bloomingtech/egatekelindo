<?php

/**
 * @property integer $id
 * @property integer $quantity
 * @property string $unit_price
 * @property integer $requirement_header_id
 * @property integer $sale_order_detail_id
 * @property integer $work_order_production_detail_id
 * @property integer $is_inactive
 *
 * @property RequirementAssuranceDetailPanel[] $requirementAssuranceDetailPanels
 * @property RequirementHeader $requirementHeader
 * @property SaleOrderDetail $saleOrderDetail
 * @property WorkOrderProductionDetail $workOrderProductionDetail
 * @property RequirementDetailAdditional[] $requirementDetailAdditionals
 * @property RequirementDetailComponent[] $requirementDetailComponents
 */
class RequirementDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_requirement_detail';
	}

	public function rules()
	{
		return array(
			array('quantity, unit_price, requirement_header_id, sale_order_detail_id, work_order_production_detail_id', 'required'),
			array('quantity, requirement_header_id, sale_order_detail_id, work_order_production_detail_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('unit_price', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, quantity, unit_price, requirement_header_id, sale_order_detail_id, work_order_production_detail_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'requirementAssuranceDetailPanels' => array(self::HAS_MANY, 'RequirementAssuranceDetailPanel', 'requirement_detail_id'),
			'requirementHeader' => array(self::BELONGS_TO, 'RequirementHeader', 'requirement_header_id'),
			'saleOrderDetail' => array(self::BELONGS_TO, 'SaleOrderDetail', 'sale_order_detail_id'),
			'workOrderProductionDetail' => array(self::BELONGS_TO, 'WorkOrderProductionDetail', 'work_order_production_detail_id'),
			'requirementDetailAdditionals' => array(self::HAS_MANY, 'RequirementDetailAdditional', 'requirement_detail_id'),
			'requirementDetailComponents' => array(self::HAS_MANY, 'RequirementDetailComponent', 'requirement_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'requirement_header_id' => 'Requirement Header',
			'sale_order_detail_id' => 'Sale Order Detail',
			'work_order_production_detail_id' => 'Work Order Production Detail',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.requirement_header_id', $this->requirement_header_id);
		$criteria->compare('t.sale_order_detail_id', $this->sale_order_detail_id);
		$criteria->compare('t.work_order_production_detail_id', $this->work_order_production_detail_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
