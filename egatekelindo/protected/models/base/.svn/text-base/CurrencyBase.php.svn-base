<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $rate
 * @property integer $is_inactive
 *
 * @property BudgetingCurrency[] $budgetingCurrencies
 * @property ComponentBrandDiscount[] $componentBrandDiscounts
 * @property EstimationCurrency[] $estimationCurrencies
 * @property EstimationCurrencyHistory[] $estimationCurrencyHistories
 * @property Supplier[] $suppliers
 */
class CurrencyBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_currency';
	}

	public function rules()
	{
		return array(
			array('name', 'required'),
			array('is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			array('rate', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, name, rate, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingCurrencies' => array(self::HAS_MANY, 'BudgetingCurrency', 'currency_id'),
			'componentBrandDiscounts' => array(self::HAS_MANY, 'ComponentBrandDiscount', 'currency_id'),
			'estimationCurrencies' => array(self::HAS_MANY, 'EstimationCurrency', 'currency_id'),
			'estimationCurrencyHistories' => array(self::HAS_MANY, 'EstimationCurrencyHistory', 'currency_id'),
			'suppliers' => array(self::HAS_MANY, 'Supplier', 'currency_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'rate' => 'Rate',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.rate', $this->rate, true);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
