<?php

/**
 * @property integer $id
 * @property string $name
 * @property integer $estimation_panel_id
 * @property integer $is_inactive
 *
 * @property EstimationComponent[] $estimationComponents
 * @property EstimationPanel $estimationPanel
 * @property EstimationComponentHistory[] $estimationComponentHistories
 */
class EstimationComponentGroupBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_estimation_component_group';
	}

	public function rules()
	{
		return array(
			array('name, estimation_panel_id', 'required'),
			array('estimation_panel_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, name, estimation_panel_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'estimationComponents' => array(self::HAS_MANY, 'EstimationComponent', 'estimation_component_group_id'),
			'estimationPanel' => array(self::BELONGS_TO, 'EstimationPanel', 'estimation_panel_id'),
			'estimationComponentHistories' => array(self::HAS_MANY, 'EstimationComponentHistory', 'estimation_component_group_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'estimation_panel_id' => 'Estimation Panel',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.estimation_panel_id', $this->estimation_panel_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
