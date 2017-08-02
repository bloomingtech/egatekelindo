<?php

/**
 * @property integer $id
 * @property string $quantity
 * @property string $unit_price
 * @property string $memo
 * @property integer $requirement_assurance_detail_panel_id
 * @property integer $requirement_detail_component_id
 * @property integer $estimation_component_id
 * @property integer $requirement_assurance_brand_discount_id
 * @property integer $is_inactive
 *
 * @property RequirementAssuranceDetailPanel $requirementAssuranceDetailPanel
 * @property RequirementDetailComponent $requirementDetailComponent
 * @property EstimationComponent $estimationComponent
 * @property RequirementAssuranceBrandDiscount $requirementAssuranceBrandDiscount
 */
class RequirementAssuranceDetailComponentBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_requirement_assurance_detail_component';
	}

	public function rules()
	{
		return array(
			array('requirement_assurance_detail_panel_id, requirement_detail_component_id, requirement_assurance_brand_discount_id', 'required'),
			array('requirement_assurance_detail_panel_id, requirement_detail_component_id, estimation_component_id, requirement_assurance_brand_discount_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('quantity', 'length', 'max'=>10),
			array('unit_price', 'length', 'max'=>18),
			array('memo', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, quantity, unit_price, memo, requirement_assurance_detail_panel_id, requirement_detail_component_id, estimation_component_id, requirement_assurance_brand_discount_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'requirementAssuranceDetailPanel' => array(self::BELONGS_TO, 'RequirementAssuranceDetailPanel', 'requirement_assurance_detail_panel_id'),
			'requirementDetailComponent' => array(self::BELONGS_TO, 'RequirementDetailComponent', 'requirement_detail_component_id'),
			'estimationComponent' => array(self::BELONGS_TO, 'EstimationComponent', 'estimation_component_id'),
			'requirementAssuranceBrandDiscount' => array(self::BELONGS_TO, 'RequirementAssuranceBrandDiscount', 'requirement_assurance_brand_discount_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'memo' => 'Memo',
			'requirement_assurance_detail_panel_id' => 'Requirement Assurance Detail Panel',
			'requirement_detail_component_id' => 'Requirement Detail Component',
			'estimation_component_id' => 'Estimation Component',
			'requirement_assurance_brand_discount_id' => 'Requirement Assurance Brand Discount',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.quantity', $this->quantity, true);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.memo', $this->memo, true);
		$criteria->compare('t.requirement_assurance_detail_panel_id', $this->requirement_assurance_detail_panel_id);
		$criteria->compare('t.requirement_detail_component_id', $this->requirement_detail_component_id);
		$criteria->compare('t.estimation_component_id', $this->estimation_component_id);
		$criteria->compare('t.requirement_assurance_brand_discount_id', $this->requirement_assurance_brand_discount_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
