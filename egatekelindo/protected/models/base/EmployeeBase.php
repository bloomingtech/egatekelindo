<?php

/**
 * @property integer $id
 * @property string $name
 * @property integer $is_inactive
 *
 * @property WorkOrderDrawingHeader[] $workOrderDrawingHeaders
 * @property WorkOrderDrawingHeader[] $workOrderDrawingHeaders1
 */
class EmployeeBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_employee';
	}

	public function rules()
	{
		return array(
			array('name', 'required'),
			array('is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, name, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'workOrderDrawingHeaders' => array(self::HAS_MANY, 'WorkOrderDrawingHeader', 'employee_id_incharge'),
			'workOrderDrawingHeaders1' => array(self::HAS_MANY, 'WorkOrderDrawingHeader', 'employee_id_related'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
