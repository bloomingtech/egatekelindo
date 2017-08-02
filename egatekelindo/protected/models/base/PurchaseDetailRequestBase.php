<?php

/**
 * @property integer $id
 * @property integer $quantity
 * @property string $weight
 * @property string $unit_price
 * @property string $discount_1
 * @property string $discount_2
 * @property string $discount_3
 * @property string $discount_4
 * @property integer $purchase_header_id
 * @property integer $purchase_request_detail_component_id
 * @property integer $purchase_request_detail_service_id
 * @property integer $is_inactive
 *
 * @property PurchaseHeader $purchaseHeader
 * @property PurchaseRequestDetailComponent $purchaseRequestDetailComponent
 * @property PurchaseRequestDetailService $purchaseRequestDetailService
 * @property ReceiveDetail[] $receiveDetails
 */
class PurchaseDetailRequestBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_purchase_detail_request';
	}

	public function rules()
	{
		return array(
			array('purchase_header_id', 'required'),
			array('quantity, purchase_header_id, purchase_request_detail_component_id, purchase_request_detail_service_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('weight, discount_1, discount_2, discount_3, discount_4', 'length', 'max'=>10),
			array('unit_price', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, quantity, weight, unit_price, discount_1, discount_2, discount_3, discount_4, purchase_header_id, purchase_request_detail_component_id, purchase_request_detail_service_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'purchaseHeader' => array(self::BELONGS_TO, 'PurchaseHeader', 'purchase_header_id'),
			'purchaseRequestDetailComponent' => array(self::BELONGS_TO, 'PurchaseRequestDetailComponent', 'purchase_request_detail_component_id'),
			'purchaseRequestDetailService' => array(self::BELONGS_TO, 'PurchaseRequestDetailService', 'purchase_request_detail_service_id'),
			'receiveDetails' => array(self::HAS_MANY, 'ReceiveDetail', 'purchase_detail_request_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'weight' => 'Weight',
			'unit_price' => 'Unit Price',
			'discount_1' => 'Discount 1',
			'discount_2' => 'Discount 2',
			'discount_3' => 'Discount 3',
			'discount_4' => 'Discount 4',
			'purchase_header_id' => 'Purchase Header',
			'purchase_request_detail_component_id' => 'Purchase Request Detail Component',
			'purchase_request_detail_service_id' => 'Purchase Request Detail Service',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.weight', $this->weight, true);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.discount_1', $this->discount_1, true);
		$criteria->compare('t.discount_2', $this->discount_2, true);
		$criteria->compare('t.discount_3', $this->discount_3, true);
		$criteria->compare('t.discount_4', $this->discount_4, true);
		$criteria->compare('t.purchase_header_id', $this->purchase_header_id);
		$criteria->compare('t.purchase_request_detail_component_id', $this->purchase_request_detail_component_id);
		$criteria->compare('t.purchase_request_detail_service_id', $this->purchase_request_detail_service_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
