<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $note
 * @property string $order_to
 * @property string $order_to_copy
 * @property integer $budgeting_header_id
 * @property integer $employee_id_incharge
 * @property integer $employee_id_related
 * @property integer $is_construction_layout
 * @property integer $is_front_side_view
 * @property integer $is_section
 * @property integer $is_control_layout
 * @property integer $is_component_list
 * @property integer $is_drawing_layout_attached
 * @property integer $is_technical_specification_attached
 * @property integer $is_single_line_diagram_attached
 * @property integer $is_break_down_component_attached
 * @property integer $is_confirmed
 * @property integer $is_inactive
 *
 * @property WorkOrderDrawingDetail[] $workOrderDrawingDetails
 * @property BudgetingHeader $budgetingHeader
 * @property Employee $employeeIdIncharge
 * @property Employee $employeeIdRelated
 * @property WorkOrderProductionHeader[] $workOrderProductionHeaders
 */
class WorkOrderDrawingHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_work_order_drawing_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, order_to, order_to_copy, budgeting_header_id, employee_id_incharge, employee_id_related', 'required'),
			array('cn_ordinal, cn_month, cn_year, budgeting_header_id, employee_id_incharge, employee_id_related, is_construction_layout, is_front_side_view, is_section, is_control_layout, is_component_list, is_drawing_layout_attached, is_technical_specification_attached, is_single_line_diagram_attached, is_break_down_component_attached, is_confirmed, is_inactive', 'numerical', 'integerOnly'=>true),
			array('order_to, order_to_copy', 'length', 'max'=>60),
			array('note', 'safe'),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, note, order_to, order_to_copy, budgeting_header_id, employee_id_incharge, employee_id_related, is_construction_layout, is_front_side_view, is_section, is_control_layout, is_component_list, is_drawing_layout_attached, is_technical_specification_attached, is_single_line_diagram_attached, is_break_down_component_attached, is_confirmed, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'workOrderDrawingDetails' => array(self::HAS_MANY, 'WorkOrderDrawingDetail', 'work_order_drawing_header_id'),
			'budgetingHeader' => array(self::BELONGS_TO, 'BudgetingHeader', 'budgeting_header_id'),
			'employeeIdIncharge' => array(self::BELONGS_TO, 'Employee', 'employee_id_incharge'),
			'employeeIdRelated' => array(self::BELONGS_TO, 'Employee', 'employee_id_related'),
			'workOrderProductionHeaders' => array(self::HAS_MANY, 'WorkOrderProductionHeader', 'work_order_drawing_header_id'),
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
			'note' => 'Note',
			'order_to' => 'Order To',
			'order_to_copy' => 'Order To Copy',
			'budgeting_header_id' => 'Budgeting Header',
			'employee_id_incharge' => 'Employee Id Incharge',
			'employee_id_related' => 'Employee Id Related',
			'is_construction_layout' => 'Is Construction Layout',
			'is_front_side_view' => 'Is Front Side View',
			'is_section' => 'Is Section',
			'is_control_layout' => 'Is Control Layout',
			'is_component_list' => 'Is Component List',
			'is_drawing_layout_attached' => 'Is Drawing Layout Attached',
			'is_technical_specification_attached' => 'Is Technical Specification Attached',
			'is_single_line_diagram_attached' => 'Is Single Line Diagram Attached',
			'is_break_down_component_attached' => 'Is Break Down Component Attached',
			'is_confirmed' => 'Is Confirmed',
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
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.order_to', $this->order_to, true);
		$criteria->compare('t.order_to_copy', $this->order_to_copy, true);
		$criteria->compare('t.budgeting_header_id', $this->budgeting_header_id);
		$criteria->compare('t.employee_id_incharge', $this->employee_id_incharge);
		$criteria->compare('t.employee_id_related', $this->employee_id_related);
		$criteria->compare('t.is_construction_layout', $this->is_construction_layout);
		$criteria->compare('t.is_front_side_view', $this->is_front_side_view);
		$criteria->compare('t.is_section', $this->is_section);
		$criteria->compare('t.is_control_layout', $this->is_control_layout);
		$criteria->compare('t.is_component_list', $this->is_component_list);
		$criteria->compare('t.is_drawing_layout_attached', $this->is_drawing_layout_attached);
		$criteria->compare('t.is_technical_specification_attached', $this->is_technical_specification_attached);
		$criteria->compare('t.is_single_line_diagram_attached', $this->is_single_line_diagram_attached);
		$criteria->compare('t.is_break_down_component_attached', $this->is_break_down_component_attached);
		$criteria->compare('t.is_confirmed', $this->is_confirmed);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
