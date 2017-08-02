<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $bank_name
 * @property string $cheque_number
 * @property string $cheque_date
 * @property string $note
 * @property string $grand_total
 * @property integer $sale_return_header_id
 * @property integer $admin_id
 * @property integer $is_incative
 *
 * @property SalePaymentDetail[] $salePaymentDetails
 * @property SaleReturnHeader $saleReturnHeader
 */
class SalePaymentHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_sale_payment_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, bank_name, cheque_number, cheque_date, note, admin_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, sale_return_header_id, admin_id, is_incative', 'numerical', 'integerOnly'=>true),
			array('bank_name, cheque_number', 'length', 'max'=>60),
			array('grand_total', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, bank_name, cheque_number, cheque_date, note, grand_total, sale_return_header_id, admin_id, is_incative', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'salePaymentDetails' => array(self::HAS_MANY, 'SalePaymentDetail', 'sale_payment_header_id'),
			'saleReturnHeader' => array(self::BELONGS_TO, 'SaleReturnHeader', 'sale_return_header_id'),
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
			'bank_name' => 'Bank Name',
			'cheque_number' => 'Cheque Number',
			'cheque_date' => 'Cheque Date',
			'note' => 'Note',
			'grand_total' => 'Grand Total',
			'sale_return_header_id' => 'Sale Return Header',
			'admin_id' => 'Admin',
			'is_incative' => 'Is Incative',
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
		$criteria->compare('t.bank_name', $this->bank_name, true);
		$criteria->compare('t.cheque_number', $this->cheque_number, true);
		$criteria->compare('t.cheque_date', $this->cheque_date, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.grand_total', $this->grand_total, true);
		$criteria->compare('t.sale_return_header_id', $this->sale_return_header_id);
		$criteria->compare('t.admin_id', $this->admin_id);
		$criteria->compare('t.is_incative', $this->is_incative);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
