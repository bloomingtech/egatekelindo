<?php

/**
 * @property integer $id
 * @property string $item_description
 * @property integer $quantity
 * @property string $unit_price
 * @property integer $sale_return_header_id
 * @property integer $is_inactive
 *
 * @property SaleReturnHeader $saleReturnHeader
 */
class SaleReturnDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_sale_return_detail';
	}

	public function rules()
	{
		return array(
			array('item_description, quantity, unit_price, sale_return_header_id', 'required'),
			array('quantity, sale_return_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('unit_price', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, item_description, quantity, unit_price, sale_return_header_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'saleReturnHeader' => array(self::BELONGS_TO, 'SaleReturnHeader', 'sale_return_header_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_description' => 'Item Description',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'sale_return_header_id' => 'Sale Return Header',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.item_description', $this->item_description, true);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.sale_return_header_id', $this->sale_return_header_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
