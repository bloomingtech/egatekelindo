<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $project_name
 * @property string $payment_term
 * @property string $delivery_date
 * @property string $delivery_place
 * @property string $note
 * @property integer $requirement_header_id
 * @property integer $purchase_request_header_id
 * @property integer $sale_order_header_id
 * @property integer $supplier_id
 * @property integer $purchasing_type_id
 * @property integer $admin_id
 * @property integer $is_tax
 * @property integer $is_cash
 * @property integer $is_purchase_request
 * @property integer $is_inactive
 *
 * @property PurchaseDetailRequest[] $purchaseDetailRequests
 * @property PurchaseDetailRequirement[] $purchaseDetailRequirements
 * @property SaleOrderHeader $saleOrderHeader
 * @property RequirementHeader $requirementHeader
 * @property PurchaseRequestHeader $purchaseRequestHeader
 * @property Supplier $supplier
 * @property Admin $admin
 * @property PurchasingType $purchasingType
 * @property ReceiveHeader[] $receiveHeaders
 */
class PurchaseHeaderBase extends MonthlyTransactionActiveRecord {

    public function tableName() {
        return 'tblet_purchase_header';
    }

    public function rules() {
        return array(
            array('cn_ordinal, cn_month, cn_year, date, supplier_id, purchasing_type_id, admin_id', 'required'),
            array('cn_ordinal, cn_month, cn_year, requirement_header_id, purchase_request_header_id, sale_order_header_id, supplier_id, purchasing_type_id, admin_id, is_tax, is_cash, is_purchase_request, is_inactive', 'numerical', 'integerOnly' => true),
            array('project_name, payment_term, delivery_place', 'length', 'max' => 255),
            array('delivery_date, note', 'safe'),
            // The following rule is used by search().
            array('id, cn_ordinal, cn_month, cn_year, date, project_name, payment_term, delivery_date, delivery_place, note, requirement_header_id, purchase_request_header_id, sale_order_header_id, supplier_id, purchasing_type_id, admin_id, is_tax, is_cash, is_purchase_request, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'purchaseDetailRequests' => array(self::HAS_MANY, 'PurchaseDetailRequest', 'purchase_header_id'),
            'purchaseDetailRequirements' => array(self::HAS_MANY, 'PurchaseDetailRequirement', 'purchase_header_id'),
            'saleOrderHeader' => array(self::BELONGS_TO, 'SaleOrderHeader', 'sale_order_header_id'),
            'requirementHeader' => array(self::BELONGS_TO, 'RequirementHeader', 'requirement_header_id'),
            'purchaseRequestHeader' => array(self::BELONGS_TO, 'PurchaseRequestHeader', 'purchase_request_header_id'),
            'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplier_id'),
            'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
            'purchasingType' => array(self::BELONGS_TO, 'PurchasingType', 'purchasing_type_id'),
            'receiveHeaders' => array(self::HAS_MANY, 'ReceiveHeader', 'purchase_header_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'cn_ordinal' => 'Cn Ordinal',
            'cn_month' => 'Cn Month',
            'cn_year' => 'Cn Year',
            'date' => 'Date',
            'project_name' => 'Project Name',
            'payment_term' => 'Payment Term',
            'delivery_date' => 'Delivery Date',
            'delivery_place' => 'Delivery Place',
            'note' => 'Note',
            'requirement_header_id' => 'Requirement Header',
            'purchase_request_header_id' => 'Purchase Request Header',
            'sale_order_header_id' => 'Sale Order Header',
            'supplier_id' => 'Supplier',
            'purchasing_type_id' => 'Purchasing Type',
            'admin_id' => 'Admin',
            'is_tax' => 'Is Tax',
            'is_cash' => 'Is Cash',
            'is_purchase_request' => 'Is Purchase Request',
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
        $criteria->compare('t.project_name', $this->project_name, true);
        $criteria->compare('t.payment_term', $this->payment_term, true);
        $criteria->compare('t.delivery_date', $this->delivery_date, true);
        $criteria->compare('t.delivery_place', $this->delivery_place, true);
        $criteria->compare('t.note', $this->note, true);
        $criteria->compare('t.requirement_header_id', $this->requirement_header_id);
        $criteria->compare('t.purchase_request_header_id', $this->purchase_request_header_id);
        $criteria->compare('t.sale_order_header_id', $this->sale_order_header_id);
        $criteria->compare('t.supplier_id', $this->supplier_id);
        $criteria->compare('t.purchasing_type_id', $this->purchasing_type_id);
        $criteria->compare('t.admin_id', $this->admin_id);
        $criteria->compare('t.is_tax', $this->is_tax);
        $criteria->compare('t.is_cash', $this->is_cash);
        $criteria->compare('t.is_purchase_request', $this->is_purchase_request);
        $criteria->compare('t.is_inactive', $this->is_inactive);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}
