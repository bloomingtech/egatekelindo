<?php

/**
 * @property integer $id
 * @property string $finish_date
 * @property string $memo
 * @property integer $work_order_drawing_header_id
 * @property integer $sale_order_detail_id
 * @property integer $is_inactive
 *
 * @property WorkOrderDrawingHeader $workOrderDrawingHeader
 * @property SaleOrderDetail $saleOrderDetail
 * @property WorkOrderDrawingProposal[] $workOrderDrawingProposals
 * @property WorkOrderDrawingRevision[] $workOrderDrawingRevisions
 * @property WorkOrderProductionDetail[] $workOrderProductionDetails
 */
class WorkOrderDrawingDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_work_order_drawing_detail';
	}

	public function rules()
	{
		return array(
			array('finish_date, work_order_drawing_header_id, sale_order_detail_id', 'required'),
			array('work_order_drawing_header_id, sale_order_detail_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('memo', 'safe'),
			// The following rule is used by search().
			array('id, finish_date, memo, work_order_drawing_header_id, sale_order_detail_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'workOrderDrawingHeader' => array(self::BELONGS_TO, 'WorkOrderDrawingHeader', 'work_order_drawing_header_id'),
			'saleOrderDetail' => array(self::BELONGS_TO, 'SaleOrderDetail', 'sale_order_detail_id'),
			'workOrderDrawingProposals' => array(self::HAS_MANY, 'WorkOrderDrawingProposal', 'work_order_drawing_detail_id'),
			'workOrderDrawingRevisions' => array(self::HAS_MANY, 'WorkOrderDrawingRevision', 'work_order_drawing_detail_id'),
			'workOrderProductionDetails' => array(self::HAS_MANY, 'WorkOrderProductionDetail', 'work_order_drawing_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'finish_date' => 'Finish Date',
			'memo' => 'Memo',
			'work_order_drawing_header_id' => 'Work Order Drawing Header',
			'sale_order_detail_id' => 'Sale Order Detail',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.finish_date', $this->finish_date, true);
		$criteria->compare('t.memo', $this->memo, true);
		$criteria->compare('t.work_order_drawing_header_id', $this->work_order_drawing_header_id);
		$criteria->compare('t.sale_order_detail_id', $this->sale_order_detail_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
