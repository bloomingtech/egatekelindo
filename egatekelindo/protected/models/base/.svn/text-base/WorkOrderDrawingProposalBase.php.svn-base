<?php

/**
 * @property integer $id
 * @property string $date_delivery
 * @property string $date_return
 * @property integer $work_order_drawing_detail_id
 * @property integer $is_inactive
 *
 * @property WorkOrderDrawingDetail $workOrderDrawingDetail
 */
class WorkOrderDrawingProposalBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_work_order_drawing_proposal';
	}

	public function rules()
	{
		return array(
			array('work_order_drawing_detail_id', 'required'),
			array('work_order_drawing_detail_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('date_delivery, date_return', 'safe'),
			// The following rule is used by search().
			array('id, date_delivery, date_return, work_order_drawing_detail_id, is_inactive', 'safe', 'on'=>'search'),
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
			'date_delivery' => 'Date Delivery',
			'date_return' => 'Date Return',
			'work_order_drawing_detail_id' => 'Work Order Drawing Detail',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.date_delivery', $this->date_delivery, true);
		$criteria->compare('t.date_return', $this->date_return, true);
		$criteria->compare('t.work_order_drawing_detail_id', $this->work_order_drawing_detail_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
