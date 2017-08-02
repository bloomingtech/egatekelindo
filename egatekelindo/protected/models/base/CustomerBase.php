<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $company
 * @property string $address
 * @property string $phone
 * @property string $fax
 * @property string $tax_number
 * @property integer $is_inactive
 *
 * @property SaleOrderHeader[] $saleOrderHeaders
 */
class CustomerBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_customer';
	}

	public function rules()
	{
		return array(
			array('company', 'required'),
			array('is_inactive', 'numerical', 'integerOnly'=>true),
			array('name, company, phone, fax', 'length', 'max'=>60),
			array('tax_number', 'length', 'max'=>20),
			array('address', 'safe'),
			// The following rule is used by search().
			array('id, name, company, address, phone, fax, tax_number, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'saleOrderHeaders' => array(self::HAS_MANY, 'SaleOrderHeader', 'customer_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'company' => 'Company',
			'address' => 'Address',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'tax_number' => 'Tax Number',
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
		$criteria->compare('t.phone', $this->phone, true);
		$criteria->compare('t.fax', $this->fax, true);
		$criteria->compare('t.tax_number', $this->tax_number, true);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
