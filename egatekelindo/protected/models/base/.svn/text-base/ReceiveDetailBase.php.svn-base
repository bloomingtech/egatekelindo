<?php

/**
 * @property integer $id
 * @property integer $quantity
 * @property integer $receive_header_id
 * @property integer $purchase_detail_requirement_id
 * @property integer $purchase_detail_request_id
 * @property integer $component_id
 * @property integer $is_inactive
 *
 * @property Component $component
 * @property ReceiveHeader $receiveHeader
 * @property PurchaseDetailRequirement $purchaseDetailRequirement
 * @property PurchaseDetailRequest $purchaseDetailRequest
 */
class ReceiveDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_receive_detail';
	}

	public function rules()
	{
		return array(
			array('receive_header_id, component_id', 'required'),
			array('quantity, receive_header_id, purchase_detail_requirement_id, purchase_detail_request_id, component_id, is_inactive', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, quantity, receive_header_id, purchase_detail_requirement_id, purchase_detail_request_id, component_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'component' => array(self::BELONGS_TO, 'Component', 'component_id'),
			'receiveHeader' => array(self::BELONGS_TO, 'ReceiveHeader', 'receive_header_id'),
			'purchaseDetailRequirement' => array(self::BELONGS_TO, 'PurchaseDetailRequirement', 'purchase_detail_requirement_id'),
			'purchaseDetailRequest' => array(self::BELONGS_TO, 'PurchaseDetailRequest', 'purchase_detail_request_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'receive_header_id' => 'Receive Header',
			'purchase_detail_requirement_id' => 'Purchase Detail Requirement',
			'purchase_detail_request_id' => 'Purchase Detail Request',
			'component_id' => 'Component',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.receive_header_id', $this->receive_header_id);
		$criteria->compare('t.purchase_detail_requirement_id', $this->purchase_detail_requirement_id);
		$criteria->compare('t.purchase_detail_request_id', $this->purchase_detail_request_id);
		$criteria->compare('t.component_id', $this->component_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
