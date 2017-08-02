<?php

/**
 * @property integer $id
 * @property string $name
 * @property integer $component_category_id
 * @property integer $is_inactive
 *
 * @property Component[] $components
 */
class ComponentCategoryBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_component_category';
	}

	public function rules()
	{
		return array(
			array('name', 'required'),
			array('component_category_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			// The following rule is used by search().
			array('id, name, component_category_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'components' => array(self::HAS_MANY, 'Component', 'component_category_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'component_category_id' => 'Component Category',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.component_category_id', $this->component_category_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
