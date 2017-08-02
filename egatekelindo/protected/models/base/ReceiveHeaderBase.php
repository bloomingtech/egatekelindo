<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $note
 * @property integer $purchase_header_id
 * @property integer $warehouse_id
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * @property ReceiveDetail[] $receiveDetails
 * @property Admin $admin
 * @property Warehouse $warehouse
 * @property PurchaseHeader $purchaseHeader
 */
class ReceiveHeaderBase extends MonthlyTransactionActiveRecord {

    public function tableName() {
        return 'tblet_receive_header';
    }

    public function rules() {
        return array(
            array('cn_ordinal, cn_month, cn_year, date, purchase_header_id, warehouse_id, admin_id', 'required'),
            array('cn_ordinal, cn_month, cn_year, purchase_header_id, warehouse_id, admin_id, is_inactive', 'numerical', 'integerOnly' => true),
            array('note', 'length', 'max' => 60),
            // The following rule is used by search().
            array('id, cn_ordinal, cn_month, cn_year, date, note, purchase_header_id, warehouse_id, admin_id, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'receiveDetails' => array(self::HAS_MANY, 'ReceiveDetail', 'receive_header_id'),
            'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
            'warehouse' => array(self::BELONGS_TO, 'Warehouse', 'warehouse_id'),
            'purchaseHeader' => array(self::BELONGS_TO, 'PurchaseHeader', 'purchase_header_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'cn_ordinal' => 'Cn Ordinal',
            'cn_month' => 'Cn Month',
            'cn_year' => 'Cn Year',
            'date' => 'Date',
            'note' => 'Note',
            'purchase_header_id' => 'Purchase Header',
            'warehouse_id' => 'Warehouse',
            'admin_id' => 'Admin',
            'is_inactive' => 'Is Inactive',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.cn_ordinal', $this->cn_ordinal);
        $criteria->compare('t.cn_month', $this->cn_month);
        $criteria->compare('t.cn_year', $this->cn_year);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.note', $this->note, true);
        $criteria->compare('t.purchase_header_id', $this->purchase_header_id);
        $criteria->compare('t.warehouse_id', $this->warehouse_id);
        $criteria->compare('t.admin_id', $this->admin_id);
        $criteria->compare('t.is_inactive', $this->is_inactive);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}
