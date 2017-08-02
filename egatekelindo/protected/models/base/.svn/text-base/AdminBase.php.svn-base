<?php

/**
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property integer $is_inactive
 *
 * @property DeliveryHeader[] $deliveryHeaders
 * @property DepositHeader[] $depositHeaders
 * @property ExpenseHeader[] $expenseHeaders
 * @property JournalAccounting[] $journalAccountings
 * @property JournalVoucherHeader[] $journalVoucherHeaders
 * @property MaterialCheckoutHeader[] $materialCheckoutHeaders
 * @property PackingListHeader[] $packingListHeaders
 * @property PartListHeader[] $partListHeaders
 * @property PurchaseHeader[] $purchaseHeaders
 * @property PurchaseRequestHeader[] $purchaseRequestHeaders
 * @property ReceiveHeader[] $receiveHeaders
 * @property SaleInvoiceHeader[] $saleInvoiceHeaders
 * @property SaleOrderHeader[] $saleOrderHeaders
 */
class AdminBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_admin';
	}

	public function rules()
	{
		return array(
			array('username, password, salt, name, phone, email', 'required'),
			array('email', 'email'),
			array('is_inactive', 'numerical', 'integerOnly'=>true),
			array('username, password, salt, name, phone, email', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, username, password, salt, name, phone, email, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'deliveryHeaders' => array(self::HAS_MANY, 'DeliveryHeader', 'admin_id'),
			'depositHeaders' => array(self::HAS_MANY, 'DepositHeader', 'admin_id'),
			'expenseHeaders' => array(self::HAS_MANY, 'ExpenseHeader', 'admin_id'),
			'journalAccountings' => array(self::HAS_MANY, 'JournalAccounting', 'admin_id'),
			'journalVoucherHeaders' => array(self::HAS_MANY, 'JournalVoucherHeader', 'admin_id'),
			'materialCheckoutHeaders' => array(self::HAS_MANY, 'MaterialCheckoutHeader', 'admin_id'),
			'packingListHeaders' => array(self::HAS_MANY, 'PackingListHeader', 'admin_id'),
			'partListHeaders' => array(self::HAS_MANY, 'PartListHeader', 'admin_id'),
			'purchaseHeaders' => array(self::HAS_MANY, 'PurchaseHeader', 'admin_id'),
			'purchaseRequestHeaders' => array(self::HAS_MANY, 'PurchaseRequestHeader', 'admin_id'),
			'receiveHeaders' => array(self::HAS_MANY, 'ReceiveHeader', 'admin_id'),
			'saleInvoiceHeaders' => array(self::HAS_MANY, 'SaleInvoiceHeader', 'admin_id'),
			'saleOrderHeaders' => array(self::HAS_MANY, 'SaleOrderHeader', 'admin_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
			'name' => 'Name',
			'phone' => 'Phone',
			'email' => 'Email',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.username', $this->username, true);
		$criteria->compare('t.password', $this->password, true);
		$criteria->compare('t.salt', $this->salt, true);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.phone', $this->phone, true);
		$criteria->compare('t.email', $this->email, true);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
