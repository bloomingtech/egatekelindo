<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $wiring_value
 * @property string $accessories_value
 * @property string $overhead_percentage
 * @property string $fee_percentage
 * @property string $budgeting_fee_value
 * @property string $note
 * @property integer $sale_order_header_id
 * @property integer $estimation_header_id
 * @property integer $budgeting_fee_id
 * @property integer $is_inactive
 *
 * @property BudgetingBrandDiscount[] $budgetingBrandDiscounts
 * @property BudgetingCurrency[] $budgetingCurrencies
 * @property BudgetingDetail[] $budgetingDetails
 * @property BudgetingDetailAccesories[] $budgetingDetailAccesories
 * @property BudgetingFee $budgetingFee
 * @property EstimationHeader $estimationHeader
 * @property SaleOrderHeader $saleOrderHeader
 * @property WorkOrderDrawingHeader[] $workOrderDrawingHeaders
 */
class BudgetingHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_budgeting_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, sale_order_header_id, estimation_header_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, sale_order_header_id, estimation_header_id, budgeting_fee_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('wiring_value, accessories_value, budgeting_fee_value', 'length', 'max'=>18),
			array('overhead_percentage, fee_percentage', 'length', 'max'=>10),
			array('note', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, wiring_value, accessories_value, overhead_percentage, fee_percentage, budgeting_fee_value, note, sale_order_header_id, estimation_header_id, budgeting_fee_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'budgetingBrandDiscounts' => array(self::HAS_MANY, 'BudgetingBrandDiscount', 'budgeting_header_id'),
			'budgetingCurrencies' => array(self::HAS_MANY, 'BudgetingCurrency', 'budgeting_header_id'),
			'budgetingDetails' => array(self::HAS_MANY, 'BudgetingDetail', 'budgeting_header_id'),
			'budgetingDetailAccesories' => array(self::HAS_MANY, 'BudgetingDetailAccesories', 'budgeting_header_id'),
			'budgetingFee' => array(self::BELONGS_TO, 'BudgetingFee', 'budgeting_fee_id'),
			'estimationHeader' => array(self::BELONGS_TO, 'EstimationHeader', 'estimation_header_id'),
			'saleOrderHeader' => array(self::BELONGS_TO, 'SaleOrderHeader', 'sale_order_header_id'),
			'workOrderDrawingHeaders' => array(self::HAS_MANY, 'WorkOrderDrawingHeader', 'budgeting_header_id'),
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
			'wiring_value' => 'Wiring Value',
			'accessories_value' => 'Accessories Value',
			'overhead_percentage' => 'Overhead Percentage',
			'fee_percentage' => 'Fee Percentage',
			'budgeting_fee_value' => 'Budgeting Fee Value',
			'note' => 'Note',
			'sale_order_header_id' => 'Sale Order Header',
			'estimation_header_id' => 'Estimation Header',
			'budgeting_fee_id' => 'Budgeting Fee',
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
		$criteria->compare('t.wiring_value', $this->wiring_value, true);
		$criteria->compare('t.accessories_value', $this->accessories_value, true);
		$criteria->compare('t.overhead_percentage', $this->overhead_percentage, true);
		$criteria->compare('t.fee_percentage', $this->fee_percentage, true);
		$criteria->compare('t.budgeting_fee_value', $this->budgeting_fee_value, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.sale_order_header_id', $this->sale_order_header_id);
		$criteria->compare('t.estimation_header_id', $this->estimation_header_id);
		$criteria->compare('t.budgeting_fee_id', $this->budgeting_fee_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
