<?php

/**
 * @property integer $id
 * @property string $value
 * @property integer $budgeting_header_id
 * @property integer $currency_id
 * @property integer $is_inactive
 *
 * @property BudgetingBrandDiscount[] $budgetingBrandDiscounts
 * @property BudgetingHeader $budgetingHeader
 * @property Currency $currency
 */
class BudgetingCurrencyBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_budgeting_currency';
	}

	public function rules()
	{
		return array(
			array('value, budgeting_header_id, currency_id', 'required'),
			array('budgeting_header_id, currency_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, value, budgeting_header_id, currency_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingBrandDiscounts' => array(self::HAS_MANY, 'BudgetingBrandDiscount', 'budgeting_currency_id'),
			'budgetingHeader' => array(self::BELONGS_TO, 'BudgetingHeader', 'budgeting_header_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'value' => 'Value',
			'budgeting_header_id' => 'Budgeting Header',
			'currency_id' => 'Currency',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.value', $this->value, true);
		$criteria->compare('t.budgeting_header_id', $this->budgeting_header_id);
		$criteria->compare('t.currency_id', $this->currency_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
