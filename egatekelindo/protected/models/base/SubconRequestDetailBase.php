<?php

/**
 * @property integer $id
 * @property integer $quantity
 * @property integer $subcon_request_header_id
 * @property integer $component_id
 * @property integer $is_inactive
 *
 * @property SubconRequestHeader $subconRequestHeader
 * @property Component $component
 */
class SubconRequestDetailBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_subcon_request_detail';
	}

	public function rules()
	{
		return array(
			array('quantity, subcon_request_header_id, component_id', 'required'),
			array('quantity, subcon_request_header_id, component_id, is_inactive', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, quantity, subcon_request_header_id, component_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'subconRequestHeader' => array(self::BELONGS_TO, 'SubconRequestHeader', 'subcon_request_header_id'),
			'component' => array(self::BELONGS_TO, 'Component', 'component_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'subcon_request_header_id' => 'Subcon Request Header',
			'component_id' => 'Component',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.subcon_request_header_id', $this->subcon_request_header_id);
		$criteria->compare('t.component_id', $this->component_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
