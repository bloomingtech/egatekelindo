<?php

/**
 * @property integer $id
 * @property string $panel_name
 * @property integer $quantity
 * @property string $unit_price
 * @property integer $sale_invoice_header_id
 * @property integer $unit_id
 * @property integer $delivery_detail_id
 * @property integer $is_inactive
 *
 * @property Unit $unit
 * @property SaleInvoiceHeader $saleInvoiceHeader
 * @property DeliveryDetail $deliveryDetail
 */
class SaleInvoiceDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_sale_invoice_detail';
	}

	public function rules()
	{
		return array(
			array('panel_name, sale_invoice_header_id, unit_id, delivery_detail_id', 'required'),
			array('quantity, sale_invoice_header_id, unit_id, delivery_detail_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('panel_name', 'length', 'max'=>60),
			array('unit_price', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, panel_name, quantity, unit_price, sale_invoice_header_id, unit_id, delivery_detail_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'unit' => array(self::BELONGS_TO, 'Unit', 'unit_id'),
			'saleInvoiceHeader' => array(self::BELONGS_TO, 'SaleInvoiceHeader', 'sale_invoice_header_id'),
			'deliveryDetail' => array(self::BELONGS_TO, 'DeliveryDetail', 'delivery_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'panel_name' => 'Panel Name',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'sale_invoice_header_id' => 'Sale Invoice Header',
			'unit_id' => 'Unit',
			'delivery_detail_id' => 'Delivery Detail',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.panel_name', $this->panel_name, true);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.sale_invoice_header_id', $this->sale_invoice_header_id);
		$criteria->compare('t.unit_id', $this->unit_id);
		$criteria->compare('t.delivery_detail_id', $this->delivery_detail_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
