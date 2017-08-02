<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $note
 * @property integer $part_list_header_id
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * @property MaterialCheckoutHeader[] $materialCheckoutHeaders
 * @property PackingListDetail[] $packingListDetails
 * @property PartListHeader $partListHeader
 * @property Admin $admin
 */
class PackingListHeaderBase extends MonthlyTransactionActiveRecord
{
	public function tableName()
	{
		return 'tblet_packing_list_header';
	}

	public function rules()
	{
		return array(
			array('cn_ordinal, cn_month, cn_year, date, part_list_header_id, admin_id', 'required'),
			array('cn_ordinal, cn_month, cn_year, part_list_header_id, admin_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('note', 'safe'),
			// The following rule is used by search().
			array('id, cn_ordinal, cn_month, cn_year, date, note, part_list_header_id, admin_id, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'materialCheckoutHeaders' => array(self::HAS_MANY, 'MaterialCheckoutHeader', 'packing_list_header_id'),
			'packingListDetails' => array(self::HAS_MANY, 'PackingListDetail', 'packing_list_header_id'),
			'partListHeader' => array(self::BELONGS_TO, 'PartListHeader', 'part_list_header_id'),
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cn_ordinal' => 'Cn Ordinal',
			'cn_month' => 'Cn Month',
			'cn_year' => 'Cn Year',
			'date' => 'Date',
			'note' => 'Note',
			'part_list_header_id' => 'Part List Header',
			'admin_id' => 'Admin',
			'is_inactive' => 'Is Inactive',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.cn_ordinal', $this->cn_ordinal);
		$criteria->compare('t.cn_month', $this->cn_month);
		$criteria->compare('t.cn_year', $this->cn_year);
		$criteria->compare('t.date', $this->date, true);
		$criteria->compare('t.note', $this->note, true);
		$criteria->compare('t.part_list_header_id', $this->part_list_header_id);
		$criteria->compare('t.admin_id', $this->admin_id);
		$criteria->compare('t.is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
