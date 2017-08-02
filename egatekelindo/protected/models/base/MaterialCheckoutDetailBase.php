<?php

/**
 * @property integer $id
 * @property integer $quantity
 * @property integer $packing_list_detail_id
 * @property integer $material_checkout_header_id
 * @property integer $is_inactive
 *
 * @property PackingListDetail $packingListDetail
 * @property MaterialCheckoutHeader $materialCheckoutHeader
 */
class MaterialCheckoutDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_material_checkout_detail';
	}

	public function rules()
	{
		return array(
			array('quantity, packing_list_detail_id, material_checkout_header_id', 'required'),
			array('quantity, packing_list_detail_id, material_checkout_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, quantity, packing_list_detail_id, material_checkout_header_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'packingListDetail' => array(self::BELONGS_TO, 'PackingListDetail', 'packing_list_detail_id'),
			'materialCheckoutHeader' => array(self::BELONGS_TO, 'MaterialCheckoutHeader', 'material_checkout_header_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'packing_list_detail_id' => 'Packing List Detail',
			'material_checkout_header_id' => 'Material Checkout Header',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.packing_list_detail_id', $this->packing_list_detail_id);
		$criteria->compare('t.material_checkout_header_id', $this->material_checkout_header_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
