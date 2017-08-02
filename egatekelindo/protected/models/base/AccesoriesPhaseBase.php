<?php

/**
 * @property integer $id
 * @property string $name
 * @property integer $phase_number
 * @property integer $accesories_id_1
 * @property integer $accesories_id_2
 * @property integer $accesories_id_3
 * @property integer $is_inactive
 *
 * @property Accesories $accesoriesId1
 * @property Accesories $accesoriesId2
 * @property Accesories $accesoriesId3
 * @property EstimationComponent[] $estimationComponents
 * @property EstimationComponentAccesoriesHistory[] $estimationComponentAccesoriesHistories
 * @property EstimationComponentHistory[] $estimationComponentHistories
 */
class AccesoriesPhaseBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_accesories_phase';
	}

	public function rules()
	{
		return array(
			array('name, accesories_id_1', 'required'),
			array('phase_number, accesories_id_1, accesories_id_2, accesories_id_3, is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, name, phase_number, accesories_id_1, accesories_id_2, accesories_id_3, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'accesoriesId1' => array(self::BELONGS_TO, 'Accesories', 'accesories_id_1'),
			'accesoriesId2' => array(self::BELONGS_TO, 'Accesories', 'accesories_id_2'),
			'accesoriesId3' => array(self::BELONGS_TO, 'Accesories', 'accesories_id_3'),
			'estimationComponents' => array(self::HAS_MANY, 'EstimationComponent', 'accesories_phase_id'),
			'estimationComponentAccesoriesHistories' => array(self::HAS_MANY, 'EstimationComponentAccesoriesHistory', 'accesories_phase_id'),
			'estimationComponentHistories' => array(self::HAS_MANY, 'EstimationComponentHistory', 'accesories_phase_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'phase_number' => 'Phase Number',
			'accesories_id_1' => 'Accesories Id 1',
			'accesories_id_2' => 'Accesories Id 2',
			'accesories_id_3' => 'Accesories Id 3',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.phase_number', $this->phase_number);
		$criteria->compare('t.accesories_id_1', $this->accesories_id_1);
		$criteria->compare('t.accesories_id_2', $this->accesories_id_2);
		$criteria->compare('t.accesories_id_3', $this->accesories_id_3);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
