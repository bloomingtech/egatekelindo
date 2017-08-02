<?php

/**
 * @property integer $id
 * @property string $amount
 * @property integer $sale_invoice_header_id
 * @property integer $sale_payment_header_id
 * @property integer $is_inactive
 *
 * @property SalePaymentHeader $salePaymentHeader
 * @property SaleInvoiceHeader $saleInvoiceHeader
 */
class SalePaymentDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_sale_payment_detail';
	}

	public function rules()
	{
		return array(
			array('amount, sale_invoice_header_id, sale_payment_header_id', 'required'),
			array('sale_invoice_header_id, sale_payment_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, amount, sale_invoice_header_id, sale_payment_header_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'salePaymentHeader' => array(self::BELONGS_TO, 'SalePaymentHeader', 'sale_payment_header_id'),
			'saleInvoiceHeader' => array(self::BELONGS_TO, 'SaleInvoiceHeader', 'sale_invoice_header_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'amount' => 'Amount',
			'sale_invoice_header_id' => 'Sale Invoice Header',
			'sale_payment_header_id' => 'Sale Payment Header',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.amount', $this->amount, true);
		$criteria->compare('t.sale_invoice_header_id', $this->sale_invoice_header_id);
		$criteria->compare('t.sale_payment_header_id', $this->sale_payment_header_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
