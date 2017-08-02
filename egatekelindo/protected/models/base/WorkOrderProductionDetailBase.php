<?php

/**
 * @property integer $id
 * @property integer $quantity
 * @property string $panel_dimension
 * @property string $delivery_date
 * @property string $memo
 * @property integer $work_order_production_header_id
 * @property integer $work_order_drawing_detail_id
 * @property integer $is_inactive
 *
 * @property RequirementDetail[] $requirementDetails
 * @property WorkOrderProductionHeader $workOrderProductionHeader
 * @property WorkOrderDrawingDetail $workOrderDrawingDetail
 */
class WorkOrderProductionDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_work_order_production_detail';
	}

	public function rules()
	{
		return array(
			array('quantity, panel_dimension, delivery_date, work_order_production_header_id, work_order_drawing_detail_id, is_inactive', 'required'),
			array('quantity, work_order_production_header_id, work_order_drawing_detail_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('panel_dimension', 'length', 'max'=>20),
			array('memo', 'safe'),
			// The following rule is used by search().
			array('id, quantity, panel_dimension, delivery_date, memo, work_order_production_header_id, work_order_drawing_detail_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'requirementDetails' => array(self::HAS_MANY, 'RequirementDetail', 'work_order_production_detail_id'),
			'workOrderProductionHeader' => array(self::BELONGS_TO, 'WorkOrderProductionHeader', 'work_order_production_header_id'),
			'workOrderDrawingDetail' => array(self::BELONGS_TO, 'WorkOrderDrawingDetail', 'work_order_drawing_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'panel_dimension' => 'Panel Dimension',
			'delivery_date' => 'Delivery Date',
			'memo' => 'Memo',
			'work_order_production_header_id' => 'Work Order Production Header',
			'work_order_drawing_detail_id' => 'Work Order Drawing Detail',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.panel_dimension', $this->panel_dimension, true);
		$criteria->compare('t.delivery_date', $this->delivery_date, true);
		$criteria->compare('t.memo', $this->memo, true);
		$criteria->compare('t.work_order_production_header_id', $this->work_order_production_header_id);
		$criteria->compare('t.work_order_drawing_detail_id', $this->work_order_drawing_detail_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
