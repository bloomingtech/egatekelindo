<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $tax_number
 * @property string $customer_order_number
 * @property string $discount
 * @property string $value_percentage
 * @property string $tax_percentage
 * @property string $grand_total
 * @property string $total_payment
 * @property string $note
 * @property integer $admin_id
 * @property integer $delivery_header_id
 * @property integer $is_inactive
 *
 * @property SaleInvoiceDetail[] $saleInvoiceDetails
 * @property DeliveryHeader $deliveryHeader
 * @property Admin $admin
 * @property SalePaymentDetail[] $salePaymentDetails
 * @property SubconRequestHeader[] $subconRequestHeaders
 */
class SaleInvoiceHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_sale_invoice_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, tax_number, customer_order_number, admin_id, delivery_header_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, admin_id, delivery_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('tax_number, customer_order_number, note', 'length', 'max'=>60),
			array('discount, grand_total, total_payment', 'length', 'max'=>18),
			array('value_percentage, tax_percentage', 'length', 'max'=>10),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, tax_number, customer_order_number, discount, value_percentage, tax_percentage, grand_total, total_payment, note, admin_id, delivery_header_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'saleInvoiceDetails' => array(self::HAS_MANY, 'SaleInvoiceDetail', 'sale_invoice_header_id'),
			'deliveryHeader' => array(self::BELONGS_TO, 'DeliveryHeader', 'delivery_header_id'),
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
			'salePaymentDetails' => array(self::HAS_MANY, 'SalePaymentDetail', 'sale_invoice_header_id'),
			'subconRequestHeaders' => array(self::HAS_MANY, 'SubconRequestHeader', 'sale_header_id'),
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
			'tax_number' => 'Tax Number',
			'customer_order_number' => 'Customer Order Number',
			'discount' => 'Discount',
			'value_percentage' => 'Value Percentage',
			'tax_percentage' => 'Tax Percentage',
			'grand_total' => 'Grand Total',
			'total_payment' => 'Total Payment',
			'note' => 'Note',
			'admin_id' => 'Admin',
			'delivery_header_id' => 'Delivery Header',
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
		$criteria->compare('t.tax_number', $this->tax_number, true);
		$criteria->compare('t.customer_order_number', $this->customer_order_number, true);
		$criteria->compare('t.discount', $this->discount, true);
		$criteria->compare('t.value_percentage', $this->value_percentage, true);
		$criteria->compare('t.tax_percentage', $this->tax_percentage, true);
		$criteria->compare('t.grand_total', $this->grand_total, true);
		$criteria->compare('t.total_payment', $this->total_payment, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.admin_id', $this->admin_id);
		$criteria->compare('t.delivery_header_id', $this->delivery_header_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
