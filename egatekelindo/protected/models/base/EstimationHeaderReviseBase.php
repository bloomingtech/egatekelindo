<?php

/**
 * @property integer $id
 * @property string $date
 * @property integer $estimation_header_id
 * @property integer $is_inactive
 *
 * @property EstimationHeader $estimationHeader
 */
class EstimationHeaderReviseBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_estimation_header_revise';
	}

	public function rules()
	{
		return array(
			array('date, estimation_header_id', 'required'),
			array('estimation_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, date, estimation_header_id, is_inactive', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
			'estimation_header_id' => 'Estimation Header',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.date', $this->date, true);
		$criteria->compare('t.estimation_header_id', $this->estimation_header_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
