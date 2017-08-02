<?php

/**
 * @property integer $id
 * @property string $date_created
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $cn_revision
 * @property string $cn_initial
 * @property string $date
 * @property string $project_name
 * @property string $client_name
 * @property string $client_company
 * @property string $mark_up_all
 * @property string $mark_up_wiring_low
 * @property string $mark_up_wiring_high
 * @property string $mark_up_wiring_border
 * @property string $mark_up_accesories
 * @property string $note
 * @property integer $component_brand_id
 * @property integer $estimation_header_id
 * @property integer $is_inactive
 *
 * @property ComponentBrand $componentBrand
 * @property EstimationHeader $estimationHeader
 */
class EstimationHeaderHistoryBase extends ActiveRecord
{
	public function tableName()
	{
		return 'tblet_estimation_header_history';
	}

	public function rules()
	{
		return array(
			array('date_created, cn_ordinal, cn_month, cn_year, cn_initial, date, project_name, client_name, client_company, component_brand_id, estimation_header_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, component_brand_id, estimation_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('cn_revision, cn_initial', 'length', 'max'=>20),
			array('project_name, client_name, client_company, note', 'length', 'max'=>60),
			array('mark_up_all, mark_up_wiring_low, mark_up_wiring_high, mark_up_accesories', 'length', 'max'=>10),
			array('mark_up_wiring_border', 'length', 'max'=>18),
			// The following rule is used by search().
			array('id, date_created, cn_ordinal, cn_month, cn_year, cn_revision, cn_initial, date, project_name, client_name, client_company, mark_up_all, mark_up_wiring_low, mark_up_wiring_high, mark_up_wiring_border, mark_up_accesories, note, component_brand_id, estimation_header_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'componentBrand' => array(self::BELONGS_TO, 'ComponentBrand', 'component_brand_id'),
			'estimationHeader' => array(self::BELONGS_TO, 'EstimationHeader', 'estimation_header_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_created' => 'Date Created',
			'cn_ordinal' => 'Cn Ordinal',
			'cn_month' => 'Cn Month',
			'cn_year' => 'Cn Year',
			'cn_revision' => 'Cn Revision',
			'cn_initial' => 'Cn Initial',
			'date' => 'Date',
			'project_name' => 'Project Name',
			'client_name' => 'Client Name',
			'client_company' => 'Client Company',
			'mark_up_all' => 'Mark Up All',
			'mark_up_wiring_low' => 'Mark Up Wiring Low',
			'mark_up_wiring_high' => 'Mark Up Wiring High',
			'mark_up_wiring_border' => 'Mark Up Wiring Border',
			'mark_up_accesories' => 'Mark Up Accesories',
			'note' => 'Note',
			'component_brand_id' => 'Component Brand',
			'estimation_header_id' => 'Estimation Header',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.date_created', $this->date_created, true);
		$criteria->compare('t.cn_ordinal', $this->cn_ordinal);
		$criteria->compare('t.cn_month', $this->cn_month);
		$criteria->compare('t.cn_year', $this->cn_year);
		$criteria->compare('t.cn_revision', $this->cn_revision, true);
		$criteria->compare('t.cn_initial', $this->cn_initial, true);
		$criteria->compare('t.date', $this->date, true);
		$criteria->compare('t.project_name', $this->project_name, true);
		$criteria->compare('t.client_name', $this->client_name, true);
		$criteria->compare('t.client_company', $this->client_company, true);
		$criteria->compare('t.mark_up_all', $this->mark_up_all, true);
		$criteria->compare('t.mark_up_wiring_low', $this->mark_up_wiring_low, true);
		$criteria->compare('t.mark_up_wiring_high', $this->mark_up_wiring_high, true);
		$criteria->compare('t.mark_up_wiring_border', $this->mark_up_wiring_border, true);
		$criteria->compare('t.mark_up_accesories', $this->mark_up_accesories, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.component_brand_id', $this->component_brand_id);
		$criteria->compare('t.estimation_header_id', $this->estimation_header_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
