<?php

/**
 * @property integer $id
 * @property integer $quantity
 * @property string $unit_price
 * @property string $wiring_value
 * @property string $wiring_name
 * @property string $memo
 * @property integer $requirement_assurance_header_id
 * @property integer $requirement_detail_id
 * @property integer $is_inactive
 *
 * @property RequirementAssuranceDetailComponent[] $requirementAssuranceDetailComponents
 * @property RequirementAssuranceHeader $requirementAssuranceHeader
 * @property RequirementDetail $requirementDetail
 */
class RequirementAssuranceDetailPanelBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_requirement_assurance_detail_panel';
	}

	public function rules()
	{
		return array(
			array('wiring_name, requirement_assurance_header_id, requirement_detail_id', 'required'),
			array('quantity, requirement_assurance_header_id, requirement_detail_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('unit_price, wiring_value', 'length', 'max'=>18),
			array('wiring_name, memo', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, quantity, unit_price, wiring_value, wiring_name, memo, requirement_assurance_header_id, requirement_detail_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'requirementAssuranceDetailComponents' => array(self::HAS_MANY, 'RequirementAssuranceDetailComponent', 'requirement_assurance_detail_panel_id'),
			'requirementAssuranceHeader' => array(self::BELONGS_TO, 'RequirementAssuranceHeader', 'requirement_assurance_header_id'),
			'requirementDetail' => array(self::BELONGS_TO, 'RequirementDetail', 'requirement_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'wiring_value' => 'Wiring Value',
			'wiring_name' => 'Wiring Name',
			'memo' => 'Memo',
			'requirement_assurance_header_id' => 'Requirement Assurance Header',
			'requirement_detail_id' => 'Requirement Detail',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.wiring_value', $this->wiring_value, true);
		$criteria->compare('t.wiring_name', $this->wiring_name, true);
		$criteria->compare('t.memo', $this->memo, true);
		$criteria->compare('t.requirement_assurance_header_id', $this->requirement_assurance_header_id);
		$criteria->compare('t.requirement_detail_id', $this->requirement_detail_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
