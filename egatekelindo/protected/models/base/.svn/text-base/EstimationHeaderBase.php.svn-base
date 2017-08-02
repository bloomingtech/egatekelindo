<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $cn_revision
 * @property string $cn_initial
 * @property string $date
 * @property string $project_name
 * @property string $client_name
 * @property string $client_company
 * @property string $mark_up_all
 * @property string $mark_up_wiring_low
 * @property string $mark_up_wiring_high
 * @property string $mark_up_wiring_border
 * @property string $mark_up_accesories
 * @property string $note
 * @property integer $sale_order_header_id
 * @property integer $component_brand_id
 * @property integer $is_inactive
 *
 * @property BudgetingHeader[] $budgetingHeaders
 * @property EstimationBrandDiscount[] $estimationBrandDiscounts
 * @property EstimationBrandDiscountHistory[] $estimationBrandDiscountHistories
 * @property EstimationCurrency[] $estimationCurrencies
 * @property EstimationCurrencyHistory[] $estimationCurrencyHistories
 * @property ComponentBrand $componentBrand
 * @property SaleOrderHeader $saleOrderHeader
 * @property EstimationHeaderHistory[] $estimationHeaderHistories
 * @property EstimationHeaderRevise[] $estimationHeaderRevises
 * @property EstimationPanel[] $estimationPanels
 * @property EstimationPanelHistory[] $estimationPanelHistories
 */
class EstimationHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_estimation_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, project_name, client_name, client_company, sale_order_header_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, sale_order_header_id, component_brand_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('cn_revision, cn_initial', 'length', 'max'=>20),
			array('project_name, client_name, client_company, note', 'length', 'max'=>60),
			array('mark_up_all, mark_up_wiring_low, mark_up_wiring_high, mark_up_accesories', 'length', 'max'=>10),
			array('mark_up_wiring_border', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, cn_revision, cn_initial, date, project_name, client_name, client_company, mark_up_all, mark_up_wiring_low, mark_up_wiring_high, mark_up_wiring_border, mark_up_accesories, note, sale_order_header_id, component_brand_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingHeaders' => array(self::HAS_MANY, 'BudgetingHeader', 'estimation_header_id'),
			'estimationBrandDiscounts' => array(self::HAS_MANY, 'EstimationBrandDiscount', 'estimation_header_id'),
			'estimationBrandDiscountHistories' => array(self::HAS_MANY, 'EstimationBrandDiscountHistory', 'estimation_header_id'),
			'estimationCurrencies' => array(self::HAS_MANY, 'EstimationCurrency', 'estimation_header_id'),
			'estimationCurrencyHistories' => array(self::HAS_MANY, 'EstimationCurrencyHistory', 'estimation_header_id'),
			'componentBrand' => array(self::BELONGS_TO, 'ComponentBrand', 'component_brand_id'),
			'saleOrderHeader' => array(self::BELONGS_TO, 'SaleOrderHeader', 'sale_order_header_id'),
			'estimationHeaderHistories' => array(self::HAS_MANY, 'EstimationHeaderHistory', 'estimation_header_id'),
			'estimationHeaderRevises' => array(self::HAS_MANY, 'EstimationHeaderRevise', 'estimation_header_id'),
			'estimationPanels' => array(self::HAS_MANY, 'EstimationPanel', 'estimation_header_id'),
			'estimationPanelHistories' => array(self::HAS_MANY, 'EstimationPanelHistory', 'estimation_header_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cn_ordinal' => 'Cn Ordinal',
			'cn_month' => 'Cn Month',
			'cn_year' => 'Cn Year',
			'cn_revision' => 'Cn Revision',
			'cn_initial' => 'Cn Initial',
			'date' => 'Date',
			'project_name' => 'Project Name',
			'client_name' => 'Client Name',
			'client_company' => 'Client Company',
			'mark_up_all' => 'Mark Up All',
			'mark_up_wiring_low' => 'Mark Up Wiring Low',
			'mark_up_wiring_high' => 'Mark Up Wiring High',
			'mark_up_wiring_border' => 'Mark Up Wiring Border',
			'mark_up_accesories' => 'Mark Up Accesories',
			'note' => 'Note',
			'sale_order_header_id' => 'Sale Order Header',
			'component_brand_id' => 'Component Brand',
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
		$criteria->compare('t.cn_revision', $this->cn_revision, true);
		$criteria->compare('t.cn_initial', $this->cn_initial, true);
		$criteria->compare('t.date', $this->date, true);
		$criteria->compare('t.project_name', $this->project_name, true);
		$criteria->compare('t.client_name', $this->client_name, true);
		$criteria->compare('t.client_company', $this->client_company, true);
		$criteria->compare('t.mark_up_all', $this->mark_up_all, true);
		$criteria->compare('t.mark_up_wiring_low', $this->mark_up_wiring_low, true);
		$criteria->compare('t.mark_up_wiring_high', $this->mark_up_wiring_high, true);
		$criteria->compare('t.mark_up_wiring_border', $this->mark_up_wiring_border, true);
		$criteria->compare('t.mark_up_accesories', $this->mark_up_accesories, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.sale_order_header_id', $this->sale_order_header_id);
		$criteria->compare('t.component_brand_id', $this->component_brand_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
