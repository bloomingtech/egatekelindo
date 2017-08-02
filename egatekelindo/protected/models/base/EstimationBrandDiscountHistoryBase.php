<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $value_1
 * @property string $value_2
 * @property string $value_3
 * @property string $value_4
 * @property string $value_5
 * @property integer $estimation_header_id
 * @property integer $estimation_currency_id
 * @property integer $component_brand_discount_id
 * @property integer $is_inactive
 *
 * @property EstimationHeader $estimationHeader
 * @property EstimationCurrency $estimationCurrency
 * @property ComponentBrandDiscount $componentBrandDiscount
 */
class EstimationBrandDiscountHistoryBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_estimation_brand_discount_history';
	}

	public function rules()
	{
		return array(
			array('name, estimation_header_id, component_brand_discount_id', 'required'),
			array('estimation_header_id, estimation_currency_id, component_brand_discount_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			array('value_1, value_2, value_3, value_4, value_5', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, name, value_1, value_2, value_3, value_4, value_5, estimation_header_id, estimation_currency_id, component_brand_discount_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'estimationHeader' => array(self::BELONGS_TO, 'EstimationHeader', 'estimation_header_id'),
			'estimationCurrency' => array(self::BELONGS_TO, 'EstimationCurrency', 'estimation_currency_id'),
			'componentBrandDiscount' => array(self::BELONGS_TO, 'ComponentBrandDiscount', 'component_brand_discount_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'value_1' => 'Value 1',
			'value_2' => 'Value 2',
			'value_3' => 'Value 3',
			'value_4' => 'Value 4',
			'value_5' => 'Value 5',
			'estimation_header_id' => 'Estimation Header',
			'estimation_currency_id' => 'Estimation Currency',
			'component_brand_discount_id' => 'Component Brand Discount',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.value_1', $this->value_1, true);
		$criteria->compare('t.value_2', $this->value_2, true);
		$criteria->compare('t.value_3', $this->value_3, true);
		$criteria->compare('t.value_4', $this->value_4, true);
		$criteria->compare('t.value_5', $this->value_5, true);
		$criteria->compare('t.estimation_header_id', $this->estimation_header_id);
		$criteria->compare('t.estimation_currency_id', $this->estimation_currency_id);
		$criteria->compare('t.component_brand_discount_id', $this->component_brand_discount_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
