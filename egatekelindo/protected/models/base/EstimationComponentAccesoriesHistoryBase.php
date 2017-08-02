<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $weight
 * @property integer $quantity
 * @property string $unit_price
 * @property string $accesories_phase_value
 * @property string $type
 * @property string $memo
 * @property integer $brand_id
 * @property integer $estimation_panel_id
 * @property integer $estimation_brand_discount_id
 * @property integer $component_id
 * @property integer $component_cu_id
 * @property integer $accesories_phase_id
 * @property integer $sort_number
 * @property integer $is_lot
 * @property integer $is_inactive
 *
 * @property ComponentBrand $brand
 * @property EstimationPanel $estimationPanel
 * @property EstimationBrandDiscount $estimationBrandDiscount
 * @property Component $component
 * @property ComponentCu $componentCu
 * @property AccesoriesPhase $accesoriesPhase
 */
class EstimationComponentAccesoriesHistoryBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_estimation_component_accesories_history';
	}

	public function rules()
	{
		return array(
			array('name, quantity, brand_id, estimation_panel_id', 'required'),
			array('quantity, brand_id, estimation_panel_id, estimation_brand_discount_id, component_id, component_cu_id, accesories_phase_id, sort_number, is_lot, is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('weight', 'length', 'max'=>10),
			array('unit_price, accesories_phase_value', 'length', 'max'=>18),
			array('type', 'length', 'max'=>20),
			array('memo', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, name, weight, quantity, unit_price, accesories_phase_value, type, memo, brand_id, estimation_panel_id, estimation_brand_discount_id, component_id, component_cu_id, accesories_phase_id, sort_number, is_lot, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'brand' => array(self::BELONGS_TO, 'ComponentBrand', 'brand_id'),
			'estimationPanel' => array(self::BELONGS_TO, 'EstimationPanel', 'estimation_panel_id'),
			'estimationBrandDiscount' => array(self::BELONGS_TO, 'EstimationBrandDiscount', 'estimation_brand_discount_id'),
			'component' => array(self::BELONGS_TO, 'Component', 'component_id'),
			'componentCu' => array(self::BELONGS_TO, 'ComponentCu', 'component_cu_id'),
			'accesoriesPhase' => array(self::BELONGS_TO, 'AccesoriesPhase', 'accesories_phase_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'weight' => 'Weight',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'accesories_phase_value' => 'Accesories Phase Value',
			'type' => 'Type',
			'memo' => 'Memo',
			'brand_id' => 'Brand',
			'estimation_panel_id' => 'Estimation Panel',
			'estimation_brand_discount_id' => 'Estimation Brand Discount',
			'component_id' => 'Component',
			'component_cu_id' => 'Component Cu',
			'accesories_phase_id' => 'Accesories Phase',
			'sort_number' => 'Sort Number',
			'is_lot' => 'Is Lot',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.weight', $this->weight, true);
		$criteria->compare('t.quantity', $this->quantity);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.accesories_phase_value', $this->accesories_phase_value, true);
		$criteria->compare('t.type', $this->type, true);
		$criteria->compare('t.memo', $this->memo, true);
		$criteria->compare('t.brand_id', $this->brand_id);
		$criteria->compare('t.estimation_panel_id', $this->estimation_panel_id);
		$criteria->compare('t.estimation_brand_discount_id', $this->estimation_brand_discount_id);
		$criteria->compare('t.component_id', $this->component_id);
		$criteria->compare('t.component_cu_id', $this->component_cu_id);
		$criteria->compare('t.accesories_phase_id', $this->accesories_phase_id);
		$criteria->compare('t.sort_number', $this->sort_number);
		$criteria->compare('t.is_lot', $this->is_lot);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
