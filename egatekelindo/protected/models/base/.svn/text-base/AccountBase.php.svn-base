<?php

/**
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $account_category_id
 * @property integer $is_inactive
 *
 * @property AccountCategory $accountCategory
 * @property DepositDetail[] $depositDetails
 * @property DepositHeader[] $depositHeaders
 * @property ExpenseDetail[] $expenseDetails
 * @property ExpenseHeader[] $expenseHeaders
 * @property JournalAccounting[] $journalAccountings
 * @property JournalVoucherDetail[] $journalVoucherDetails
 */
class AccountBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_account';
	}

	public function rules()
	{
		return array(
			array('code, name, account_category_id', 'required'),
			array('account_category_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('code, name', 'length', 'max'=>60),
			array('description', 'safe'),
			// The following rule is used by search().
			array('id, code, name, description, account_category_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'accountCategory' => array(self::BELONGS_TO, 'AccountCategory', 'account_category_id'),
			'depositDetails' => array(self::HAS_MANY, 'DepositDetail', 'account_id'),
			'depositHeaders' => array(self::HAS_MANY, 'DepositHeader', 'account_id'),
			'expenseDetails' => array(self::HAS_MANY, 'ExpenseDetail', 'account_id'),
			'expenseHeaders' => array(self::HAS_MANY, 'ExpenseHeader', 'account_id'),
			'journalAccountings' => array(self::HAS_MANY, 'JournalAccounting', 'account_id'),
			'journalVoucherDetails' => array(self::HAS_MANY, 'JournalVoucherDetail', 'account_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'name' => 'Name',
			'description' => 'Description',
			'account_category_id' => 'Account Category',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.code', $this->code, true);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.description', $this->description, true);
		$criteria->compare('t.account_category_id', $this->account_category_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
