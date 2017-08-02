<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $delivery_date
 * @property string $place
 * @property string $color
 * @property string $note
 * @property integer $work_order_production_header_id
 * @property integer $department_id
 * @property integer $job_id
 * @property integer $admin_id
 * @property integer $is_service
 * @property integer $is_inactive
 *
 * @property PurchaseHeader[] $purchaseHeaders
 * @property PurchaseRequestDetailComponent[] $purchaseRequestDetailComponents
 * @property PurchaseRequestDetailService[] $purchaseRequestDetailServices
 * @property Admin $admin
 * @property WorkOrderProductionHeader $workOrderProductionHeader
 * @property Department $department
 * @property Job $job
 */
class PurchaseRequestHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_purchase_request_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, department_id, job_id, admin_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, work_order_production_header_id, department_id, job_id, admin_id, is_service, is_inactive', 'numerical', 'integerOnly'=>true),
			array('place, color', 'length', 'max'=>255),
			array('delivery_date, note', 'safe'),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, delivery_date, place, color, note, work_order_production_header_id, department_id, job_id, admin_id, is_service, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'purchaseHeaders' => array(self::HAS_MANY, 'PurchaseHeader', 'purchase_request_header_id'),
			'purchaseRequestDetailComponents' => array(self::HAS_MANY, 'PurchaseRequestDetailComponent', 'purchase_request_header_id'),
			'purchaseRequestDetailServices' => array(self::HAS_MANY, 'PurchaseRequestDetailService', 'purchase_request_header_id'),
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
			'workOrderProductionHeader' => array(self::BELONGS_TO, 'WorkOrderProductionHeader', 'work_order_production_header_id'),
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'job' => array(self::BELONGS_TO, 'Job', 'job_id'),
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
			'delivery_date' => 'Delivery Date',
			'place' => 'Place',
			'color' => 'Color',
			'note' => 'Note',
			'work_order_production_header_id' => 'Work Order Production Header',
			'department_id' => 'Department',
			'job_id' => 'Job',
			'admin_id' => 'Admin',
			'is_service' => 'Is Service',
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
		$criteria->compare('t.delivery_date', $this->delivery_date, true);
		$criteria->compare('t.place', $this->place, true);
		$criteria->compare('t.color', $this->color, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.work_order_production_header_id', $this->work_order_production_header_id);
		$criteria->compare('t.department_id', $this->department_id);
		$criteria->compare('t.job_id', $this->job_id);
		$criteria->compare('t.admin_id', $this->admin_id);
		$criteria->compare('t.is_service', $this->is_service);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
