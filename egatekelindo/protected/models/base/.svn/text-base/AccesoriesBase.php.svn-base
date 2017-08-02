<?php

/**
 * @property integer $id
 * @property string $type
 * @property string $unit_price
 * @property integer $material_id
 * @property integer $accesories_ampere_id
 * @property integer $accesories_category_id
 * @property integer $is_inactive
 *
 * @property Material $material
 * @property AccesoriesCategory $accesoriesCategory
 * @property AccesoriesAmpere $accesoriesAmpere
 * @property AccesoriesPhase[] $accesoriesPhases
 * @property AccesoriesPhase[] $accesoriesPhases1
 * @property AccesoriesPhase[] $accesoriesPhases2
 */
class AccesoriesBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_accesories';
	}

	public function rules()
	{
		return array(
			array('type, material_id, accesories_category_id', 'required'),
			array('material_id, accesories_ampere_id, accesories_category_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>60),
			array('unit_price', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, type, unit_price, material_id, accesories_ampere_id, accesories_category_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'material' => array(self::BELONGS_TO, 'Material', 'material_id'),
			'accesoriesCategory' => array(self::BELONGS_TO, 'AccesoriesCategory', 'accesories_category_id'),
			'accesoriesAmpere' => array(self::BELONGS_TO, 'AccesoriesAmpere', 'accesories_ampere_id'),
			'accesoriesPhases' => array(self::HAS_MANY, 'AccesoriesPhase', 'accesories_id_1'),
			'accesoriesPhases1' => array(self::HAS_MANY, 'AccesoriesPhase', 'accesories_id_2'),
			'accesoriesPhases2' => array(self::HAS_MANY, 'AccesoriesPhase', 'accesories_id_3'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'unit_price' => 'Unit Price',
			'material_id' => 'Material',
			'accesories_ampere_id' => 'Accesories Ampere',
			'accesories_category_id' => 'Accesories Category',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.type', $this->type, true);
		$criteria->compare('t.unit_price', $this->unit_price, true);
		$criteria->compare('t.material_id', $this->material_id);
		$criteria->compare('t.accesories_ampere_id', $this->accesories_ampere_id);
		$criteria->compare('t.accesories_category_id', $this->accesories_category_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
