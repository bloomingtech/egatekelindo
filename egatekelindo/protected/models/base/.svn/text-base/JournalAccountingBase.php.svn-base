<?php

/**
 * @property integer $id
 * @property string $transaction_number
 * @property string $date
 * @property string $memo
 * @property integer $type
 * @property string $debit
 * @property string $credit
 * @property integer $account_id
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * @property Account $account
 * @property Admin $admin
 */
class JournalAccountingBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_journal_accounting';
	}

	public function rules()
	{
		return array(
			array('transaction_number, date, admin_id', 'required'),
			array('type, account_id, admin_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('transaction_number', 'length', 'max'=>60),
			array('debit, credit', 'length', 'max'=>18),
			array('memo', 'safe'),
			// The following rule is used by search().
			array('id, transaction_number, date, memo, type, debit, credit, account_id, admin_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'transaction_number' => 'Transaction Number',
			'date' => 'Date',
			'memo' => 'Memo',
			'type' => 'Type',
			'debit' => 'Debit',
			'credit' => 'Credit',
			'account_id' => 'Account',
			'admin_id' => 'Admin',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.transaction_number', $this->transaction_number, true);
		$criteria->compare('t.date', $this->date, true);
		$criteria->compare('t.memo', $this->memo, true);
		$criteria->compare('t.type', $this->type);
		$criteria->compare('t.debit', $this->debit, true);
		$criteria->compare('t.credit', $this->credit, true);
		$criteria->compare('t.account_id', $this->account_id);
		$criteria->compare('t.admin_id', $this->admin_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
