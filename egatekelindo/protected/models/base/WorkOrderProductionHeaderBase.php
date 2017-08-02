<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $order_to
 * @property string $order_to_copy
 * @property string $paint_color
 * @property string $note
 * @property integer $work_order_drawing_header_id
 * @property integer $is_urgent
 * @property integer $is_grey_painted
 * @property integer $is_light_grey_painted
 * @property integer $is_cream_painted
 * @property integer $is_construction_drawing
 * @property integer $is_section_drawing
 * @property integer $is_single_line_drawing
 * @property integer $is_control_drawing
 * @property integer $is_component_listed
 * @property integer $is_inactive
 *
 * @property RequirementHeader[] $requirementHeaders
 * @property WorkOrderProductionDetail[] $workOrderProductionDetails
 * @property WorkOrderDrawingHeader $workOrderDrawingHeader
 */
class WorkOrderProductionHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_work_order_production_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, order_to, order_to_copy, paint_color, work_order_drawing_header_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, work_order_drawing_header_id, is_urgent, is_grey_painted, is_light_grey_painted, is_cream_painted, is_construction_drawing, is_section_drawing, is_single_line_drawing, is_control_drawing, is_component_listed, is_inactive', 'numerical', 'integerOnly'=>true),
			array('order_to, order_to_copy, paint_color', 'length', 'max'=>60),
			array('note', 'safe'),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, order_to, order_to_copy, paint_color, note, work_order_drawing_header_id, is_urgent, is_grey_painted, is_light_grey_painted, is_cream_painted, is_construction_drawing, is_section_drawing, is_single_line_drawing, is_control_drawing, is_component_listed, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'requirementHeaders' => array(self::HAS_MANY, 'RequirementHeader', 'work_order_production_header_id'),
			'workOrderProductionDetails' => array(self::HAS_MANY, 'WorkOrderProductionDetail', 'work_order_production_header_id'),
			'workOrderDrawingHeader' => array(self::BELONGS_TO, 'WorkOrderDrawingHeader', 'work_order_drawing_header_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cn_ordinal' => 'Cn Ordinal',
			'cn_month' => 'Cn Month',
			'cn_year' => 'Cn Year',
			'date' => 'Date',
			'order_to' => 'Order To',
			'order_to_copy' => 'Order To Copy',
			'paint_color' => 'Paint Color',
			'note' => 'Note',
			'work_order_drawing_header_id' => 'Work Order Drawing Header',
			'is_urgent' => 'Is Urgent',
			'is_grey_painted' => 'Is Grey Painted',
			'is_light_grey_painted' => 'Is Light Grey Painted',
			'is_cream_painted' => 'Is Cream Painted',
			'is_construction_drawing' => 'Is Construction Drawing',
			'is_section_drawing' => 'Is Section Drawing',
			'is_single_line_drawing' => 'Is Single Line Drawing',
			'is_control_drawing' => 'Is Control Drawing',
			'is_component_listed' => 'Is Component Listed',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.cn_ordinal', $this->cn_ordinal);
		$criteria->compare('t.cn_month', $this->cn_month);
		$criteria->compare('t.cn_year', $this->cn_year);
		$criteria->compare('t.date', $this->date, true);
		$criteria->compare('t.order_to', $this->order_to, true);
		$criteria->compare('t.order_to_copy', $this->order_to_copy, true);
		$criteria->compare('t.paint_color', $this->paint_color, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.work_order_drawing_header_id', $this->work_order_drawing_header_id);
		$criteria->compare('t.is_urgent', $this->is_urgent);
		$criteria->compare('t.is_grey_painted', $this->is_grey_painted);
		$criteria->compare('t.is_light_grey_painted', $this->is_light_grey_painted);
		$criteria->compare('t.is_cream_painted', $this->is_cream_painted);
		$criteria->compare('t.is_construction_drawing', $this->is_construction_drawing);
		$criteria->compare('t.is_section_drawing', $this->is_section_drawing);
		$criteria->compare('t.is_single_line_drawing', $this->is_single_line_drawing);
		$criteria->compare('t.is_control_drawing', $this->is_control_drawing);
		$criteria->compare('t.is_component_listed', $this->is_component_listed);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
