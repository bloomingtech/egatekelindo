<?php

/**
 * @property integer $id
 * @property string $value
 * @property integer $estimation_header_id
 * @property integer $currency_id
 * @property integer $is_inactive
 *
 * @property EstimationBrandDiscount[] $estimationBrandDiscounts
 * @property EstimationBrandDiscountHistory[] $estimationBrandDiscountHistories
 * @property EstimationHeader $estimationHeader
 * @property Currency $currency
 */
class EstimationCurrencyBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_estimation_currency';
	}

	public function rules()
	{
		return array(
			array('value, estimation_header_id, currency_id', 'required'),
			array('estimation_header_id, currency_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, value, estimation_header_id, currency_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'estimationBrandDiscounts' => array(self::HAS_MANY, 'EstimationBrandDiscount', 'estimation_currency_id'),
			'estimationBrandDiscountHistories' => array(self::HAS_MANY, 'EstimationBrandDiscountHistory', 'estimation_currency_id'),
			'estimationHeader' => array(self::BELONGS_TO, 'EstimationHeader', 'estimation_header_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'value' => 'Value',
			'estimation_header_id' => 'Estimation Header',
			'currency_id' => 'Currency',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.value', $this->value, true);
		$criteria->compare('t.estimation_header_id', $this->estimation_header_id);
		$criteria->compare('t.currency_id', $this->currency_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
