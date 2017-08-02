<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $work_order_number
 * @property string $note
 * @property integer $sale_order_header_id
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * @property PackingListHeader[] $packingListHeaders
 * @property PartListDetail[] $partListDetails
 * @property SaleOrderHeader $saleOrderHeader
 * @property Admin $admin
 */
class PartListHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_part_list_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, work_order_number, sale_order_header_id, admin_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, sale_order_header_id, admin_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('work_order_number, note', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, work_order_number, note, sale_order_header_id, admin_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'packingListHeaders' => array(self::HAS_MANY, 'PackingListHeader', 'part_list_header_id'),
			'partListDetails' => array(self::HAS_MANY, 'PartListDetail', 'part_list_header_id'),
			'saleOrderHeader' => array(self::BELONGS_TO, 'SaleOrderHeader', 'sale_order_header_id'),
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
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
			'work_order_number' => 'Work Order Number',
			'note' => 'Note',
			'sale_order_header_id' => 'Sale Order Header',
			'admin_id' => 'Admin',
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
		$criteria->compare('t.work_order_number', $this->work_order_number, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.sale_order_header_id', $this->sale_order_header_id);
		$criteria->compare('t.admin_id', $this->admin_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
