<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $note
 * @property integer $sale_order_id
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * @property PackingListHeader[] $packingListHeaders
 * @property ProductionRequestDetail[] $productionRequestDetails
 * @property SaleOrder $saleOrder
 * @property Admin $admin
 */
class ProductionRequestHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_production_request_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, sale_order_id, admin_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, sale_order_id, admin_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('note', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, note, sale_order_id, admin_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'packingListHeaders' => array(self::HAS_MANY, 'PackingListHeader', 'production_request_header_id'),
			'productionRequestDetails' => array(self::HAS_MANY, 'ProductionRequestDetail', 'production_request_header_id'),
			'saleOrder' => array(self::BELONGS_TO, 'SaleOrder', 'sale_order_id'),
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
			'note' => 'Note',
			'sale_order_id' => 'Sale Order',
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
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.sale_order_id', $this->sale_order_id);
		$criteria->compare('t.admin_id', $this->admin_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
