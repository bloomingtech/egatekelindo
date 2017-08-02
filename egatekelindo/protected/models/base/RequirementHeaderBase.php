<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $note
 * @property integer $work_order_production_header_id
 * @property integer $sale_order_header_id
 * @property integer $is_component
 * @property integer $is_inactive
 *
 * @property PurchaseHeader[] $purchaseHeaders
 * @property RequirementAssuranceHeader[] $requirementAssuranceHeaders
 * @property RequirementDetail[] $requirementDetails
 * @property WorkOrderProductionHeader $workOrderProductionHeader
 * @property SaleOrderHeader $saleOrderHeader
 */
class RequirementHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_requirement_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, work_order_production_header_id, sale_order_header_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, work_order_production_header_id, sale_order_header_id, is_component, is_inactive', 'numerical', 'integerOnly'=>true),
			array('note', 'safe'),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, note, work_order_production_header_id, sale_order_header_id, is_component, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'purchaseHeaders' => array(self::HAS_MANY, 'PurchaseHeader', 'requirement_header_id'),
			'requirementAssuranceHeaders' => array(self::HAS_MANY, 'RequirementAssuranceHeader', 'requirement_header_id'),
			'requirementDetails' => array(self::HAS_MANY, 'RequirementDetail', 'requirement_header_id'),
			'workOrderProductionHeader' => array(self::BELONGS_TO, 'WorkOrderProductionHeader', 'work_order_production_header_id'),
			'saleOrderHeader' => array(self::BELONGS_TO, 'SaleOrderHeader', 'sale_order_header_id'),
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
			'work_order_production_header_id' => 'Work Order Production Header',
			'sale_order_header_id' => 'Sale Order Header',
			'is_component' => 'Is Component',
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
		$criteria->compare('t.work_order_production_header_id', $this->work_order_production_header_id);
		$criteria->compare('t.sale_order_header_id', $this->sale_order_header_id);
		$criteria->compare('t.is_component', $this->is_component);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
