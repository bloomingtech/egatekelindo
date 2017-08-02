<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $grand_total
 * @property string $discount
 * @property string $tax
 * @property integer $sale_order_header_id
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * @property SalePaymentHeader[] $salePaymentHeaders
 * @property SaleReturnDetail[] $saleReturnDetails
 * @property SaleOrderHeader $saleOrderHeader
 */
class SaleReturnHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_sale_return_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, sale_order_header_id, admin_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, sale_order_header_id, admin_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('grand_total, discount, tax', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, grand_total, discount, tax, sale_order_header_id, admin_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'salePaymentHeaders' => array(self::HAS_MANY, 'SalePaymentHeader', 'sale_return_header_id'),
			'saleReturnDetails' => array(self::HAS_MANY, 'SaleReturnDetail', 'sale_return_header_id'),
			'saleOrderHeader' => array(self::BELONGS_TO, 'SaleOrderHeader', 'sale_order_header_id'),
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
			'grand_total' => 'Grand Total',
			'discount' => 'Discount',
			'tax' => 'Tax',
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
		$criteria->compare('t.grand_total', $this->grand_total, true);
		$criteria->compare('t.discount', $this->discount, true);
		$criteria->compare('t.tax', $this->tax, true);
		$criteria->compare('t.sale_order_header_id', $this->sale_order_header_id);
		$criteria->compare('t.admin_id', $this->admin_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
