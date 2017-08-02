<?php

/**
 * @property integer $id
 * @property integer $quantity
 * @property string $weight
 * @property string $memo
 * @property integer $purchase_request_header_id
 * @property integer $component_id
 * @property integer $is_inactive
 *
 * @property PurchaseDetailRequest[] $purchaseDetailRequests
 * @property PurchaseRequestHeader $purchaseRequestHeader
 * @property Component $component
 */
class PurchaseRequestDetailComponentBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_purchase_request_detail_component';
	}

	public function rules()
	{
		return array(
			array('purchase_request_header_id, component_id', 'required'),
			array('quantity, purchase_request_header_id, component_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('weight', 'length', 'max'=>10),
			array('memo', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, quantity, weight, memo, purchase_request_header_id, component_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'purchaseDetailRequests' => array(self::HAS_MANY, 'PurchaseDetailRequest', 'purchase_request_detail_component_id'),
			'purchaseRequestHeader' => array(self::BELONGS_TO, 'PurchaseRequestHeader', 'purchase_request_header_id'),
			'component' => array(self::BELONGS_TO, 'Component', 'component_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'weight' => 'Weight',
			'memo' => 'Memo',
			'purchase_request_header_id' => 'Purchase Request Header',
			'component_id' => 'Component',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.weight', $this->weight, true);
		$criteria->compare('t.memo', $this->memo, true);
		$criteria->compare('t.purchase_request_header_id', $this->purchase_request_header_id);
		$criteria->compare('t.component_id', $this->component_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
