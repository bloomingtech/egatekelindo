<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $note
 * @property integer $requirement_header_id
 * @property integer $is_inactive
 *
 * @property RequirementAssuranceBrandDiscount[] $requirementAssuranceBrandDiscounts
 * @property RequirementAssuranceDetailPanel[] $requirementAssuranceDetailPanels
 * @property RequirementHeader $requirementHeader
 */
class RequirementAssuranceHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_requirement_assurance_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, requirement_header_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, requirement_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('note', 'safe'),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, note, requirement_header_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'requirementAssuranceBrandDiscounts' => array(self::HAS_MANY, 'RequirementAssuranceBrandDiscount', 'requirement_assurance_header_id'),
			'requirementAssuranceDetailPanels' => array(self::HAS_MANY, 'RequirementAssuranceDetailPanel', 'requirement_assurance_header_id'),
			'requirementHeader' => array(self::BELONGS_TO, 'RequirementHeader', 'requirement_header_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cn_ordinal' => 'Cn Ordinal',
			'cn_month' => 'Cn Month',
			'cn_year' => 'Cn Year',
			'date' => 'Date',
			'note' => 'Note',
			'requirement_header_id' => 'Requirement Header',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.cn_ordinal', $this->cn_ordinal);
		$criteria->compare('t.cn_month', $this->cn_month);
		$criteria->compare('t.cn_year', $this->cn_year);
		$criteria->compare('t.date', $this->date, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.requirement_header_id', $this->requirement_header_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
