<?php

/**
 * @property integer $id
 * @property string $date_revised
 * @property string $date_target
 * @property string $date_real
 * @property integer $work_order_drawing_detail_id
 * @property integer $is_inactive
 *
 * @property WorkOrderDrawingDetail $workOrderDrawingDetail
 */
class WorkOrderDrawingRevisionBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_work_order_drawing_revision';
	}

	public function rules()
	{
		return array(
			array('work_order_drawing_detail_id', 'required'),
			array('work_order_drawing_detail_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('date_revised, date_target, date_real', 'safe'),
			// The following rule is used by search().
			array('id, date_revised, date_target, date_real, work_order_drawing_detail_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'workOrderDrawingDetail' => array(self::BELONGS_TO, 'WorkOrderDrawingDetail', 'work_order_drawing_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_revised' => 'Date Revised',
			'date_target' => 'Date Target',
			'date_real' => 'Date Real',
			'work_order_drawing_detail_id' => 'Work Order Drawing Detail',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.date_revised', $this->date_revised, true);
		$criteria->compare('t.date_target', $this->date_target, true);
		$criteria->compare('t.date_real', $this->date_real, true);
		$criteria->compare('t.work_order_drawing_detail_id', $this->work_order_drawing_detail_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
