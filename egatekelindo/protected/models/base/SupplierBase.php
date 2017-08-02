<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $company
 * @property string $address
 * @property string $city
 * @property string $phone
 * @property string $email
 * @property string $fax
 * @property integer $currency_id
 * @property integer $is_inactive
 *
 * @property PurchaseHeader[] $purchaseHeaders
 * @property ReceiveHeader[] $receiveHeaders
 * @property Currency $currency
 */
class SupplierBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_supplier';
	}

	public function rules()
	{
		return array(
			array('name, company, currency_id', 'required'),
			array('email', 'email'),
			array('currency_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('name, company, address, city, phone, email, fax', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, name, company, address, city, phone, email, fax, currency_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'purchaseHeaders' => array(self::HAS_MANY, 'PurchaseHeader', 'supplier_id'),
			'receiveHeaders' => array(self::HAS_MANY, 'ReceiveHeader', 'supplier_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'company' => 'Company',
			'address' => 'Address',
			'city' => 'City',
			'phone' => 'Phone',
			'email' => 'Email',
			'fax' => 'Fax',
			'currency_id' => 'Currency',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.company', $this->company, true);
		$criteria->compare('t.address', $this->address, true);
		$criteria->compare('t.city', $this->city, true);
		$criteria->compare('t.phone', $this->phone, true);
		$criteria->compare('t.email', $this->email, true);
		$criteria->compare('t.fax', $this->fax, true);
		$criteria->compare('t.currency_id', $this->currency_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
