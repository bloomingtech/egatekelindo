<?php

/**
 * @property integer $id
 * @property string $panel_name
 * @property integer $sort_number
 * @property integer $estimation_header_id
 * @property integer $is_inactive
 *
 * @property EstimationHeader $estimationHeader
 */
class EstimationPanelHistoryBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_estimation_panel_history';
	}

	public function rules()
	{
		return array(
			array('panel_name, sort_number, estimation_header_id', 'required'),
			array('sort_number, estimation_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('panel_name', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, panel_name, sort_number, estimation_header_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'estimationHeader' => array(self::BELONGS_TO, 'EstimationHeader', 'estimation_header_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'panel_name' => 'Panel Name',
			'sort_number' => 'Sort Number',
			'estimation_header_id' => 'Estimation Header',
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
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
