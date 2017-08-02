<?php

/**
 * @property integer $id
 * @property string $panel_name
 * @property string $quantity
 * @property integer $unit_id
 * @property integer $delivery_header_id
 * @property integer $is_inactive
 *
 * @property DeliveryHeader $deliveryHeader
 * @property Unit $unit
 * @property SaleInvoiceDetail[] $saleInvoiceDetails
 */
class DeliveryDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_delivery_detail';
	}

	public function rules()
	{
		return array(
			array('panel_name, unit_id, delivery_header_id', 'required'),
			array('unit_id, delivery_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('panel_name', 'length', 'max'=>60),
			array('quantity', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, panel_name, quantity, unit_id, delivery_header_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'deliveryHeader' => array(self::BELONGS_TO, 'DeliveryHeader', 'delivery_header_id'),
			'unit' => array(self::BELONGS_TO, 'Unit', 'unit_id'),
			'saleInvoiceDetails' => array(self::HAS_MANY, 'SaleInvoiceDetail', 'delivery_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'panel_name' => 'Panel Name',
			'quantity' => 'Quantity',
			'unit_id' => 'Unit',
			'delivery_header_id' => 'Delivery Header',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.panel_name', $this->panel_name, true);
		$criteria->compare('t.quantity', $this->quantity, true);
		$criteria->compare('t.unit_id', $this->unit_id);
		$criteria->compare('t.delivery_header_id', $this->delivery_header_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
