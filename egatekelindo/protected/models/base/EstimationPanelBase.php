<?php

/**
 * @property integer $id
 * @property string $panel_name
 * @property integer $sort_number
 * @property integer $estimation_header_id
 * @property integer $sale_order_detail_id
 * @property integer $is_inactive
 *
 * @property EstimationComponent[] $estimationComponents
 * @property EstimationComponentAccesories[] $estimationComponentAccesories
 * @property EstimationComponentAccesoriesHistory[] $estimationComponentAccesoriesHistories
 * @property EstimationComponentGroup[] $estimationComponentGroups
 * @property EstimationComponentGroupHistory[] $estimationComponentGroupHistories
 * @property EstimationComponentHistory[] $estimationComponentHistories
 * @property EstimationHeader $estimationHeader
 * @property SaleOrderDetail $saleOrderDetail
 */
class EstimationPanelBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_estimation_panel';
	}

	public function rules()
	{
		return array(
			array('panel_name, sort_number, estimation_header_id, sale_order_detail_id', 'required'),
			array('sort_number, estimation_header_id, sale_order_detail_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('panel_name', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, panel_name, sort_number, estimation_header_id, sale_order_detail_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'estimationComponents' => array(self::HAS_MANY, 'EstimationComponent', 'estimation_panel_id'),
			'estimationComponentAccesories' => array(self::HAS_MANY, 'EstimationComponentAccesories', 'estimation_panel_id'),
			'estimationComponentAccesoriesHistories' => array(self::HAS_MANY, 'EstimationComponentAccesoriesHistory', 'estimation_panel_id'),
			'estimationComponentGroups' => array(self::HAS_MANY, 'EstimationComponentGroup', 'estimation_panel_id'),
			'estimationComponentGroupHistories' => array(self::HAS_MANY, 'EstimationComponentGroupHistory', 'estimation_panel_id'),
			'estimationComponentHistories' => array(self::HAS_MANY, 'EstimationComponentHistory', 'estimation_panel_id'),
			'estimationHeader' => array(self::BELONGS_TO, 'EstimationHeader', 'estimation_header_id'),
			'saleOrderDetail' => array(self::BELONGS_TO, 'SaleOrderDetail', 'sale_order_detail_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'panel_name' => 'Panel Name',
			'sort_number' => 'Sort Number',
			'estimation_header_id' => 'Estimation Header',
			'sale_order_detail_id' => 'Sale Order Detail',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.panel_name', $this->panel_name, true);
		$criteria->compare('t.sort_number', $this->sort_number);
		$criteria->compare('t.estimation_header_id', $this->estimation_header_id);
		$criteria->compare('t.sale_order_detail_id', $this->sale_order_detail_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
