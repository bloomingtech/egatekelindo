<?php

/**
 * @property integer $id
 * @property string $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $note
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * @property JournalVoucherDetail[] $journalVoucherDetails
 * @property Admin $admin
 */
class JournalVoucherHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_journal_voucher_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, admin_id', 'required'),
			array('cn_month, cn_year, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly'=>true),
			array('cn_ordinal', 'length', 'max'=>20),
			array('note', 'safe'),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, note, admin_id, is_non_tax, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'journalVoucherDetails' => array(self::HAS_MANY, 'JournalVoucherDetail', 'journal_voucher_header_id'),
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
			'admin_id' => 'Admin',
			'is_non_tax' => 'Is Non Tax',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.cn_ordinal', $this->cn_ordinal, true);
		$criteria->compare('t.cn_month', $this->cn_month);
		$criteria->compare('t.cn_year', $this->cn_year);
		$criteria->compare('t.date', $this->date, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.admin_id', $this->admin_id);
		$criteria->compare('t.is_non_tax', $this->is_non_tax);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
