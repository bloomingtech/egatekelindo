<?php

/**
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $is_inactive
 *
 * @property PurchaseHeader[] $purchaseHeaders
 */
class PurchasingTypeBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_purchasing_type';
	}

	public function rules()
	{
		return array(
			array('code, name', 'required'),
			array('is_inactive', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>20),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, code, name, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'purchaseHeaders' => array(self::HAS_MANY, 'PurchaseHeader', 'purchasing_type_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'name' => 'Name',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.code', $this->code, true);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
