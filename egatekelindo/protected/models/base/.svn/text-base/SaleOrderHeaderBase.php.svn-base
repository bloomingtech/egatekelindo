<?php

/**
 * @property integer $id
 * @property integer $cn_ordinal
 * @property integer $cn_month
 * @property integer $cn_year
 * @property string $date
 * @property string $temporary_number
 * @property string $project_name
 * @property string $client_name
 * @property string $client_company
 * @property string $phone
 * @property string $fax
 * @property string $work_order_number
 * @property string $value
 * @property integer $material_on_site
 * @property integer $downpayment
 * @property integer $testing
 * @property integer $maintenance
 * @property string $discount
 * @property string $payment_term
 * @property string $delivery_time
 * @property string $personal_fee
 * @property string $margin
 * @property string $note
 * @property integer $order_status
 * @property integer $customer_id
 * @property integer $admin_id
 * @property integer $is_tax
 * @property integer $is_paid_downpayment
 * @property integer $is_approved
 * @property integer $is_temporary
 * @property integer $is_inactive
 *
 * @property BudgetingHeader[] $budgetingHeaders
 * @property DeliveryHeader[] $deliveryHeaders
 * @property EstimationHeader[] $estimationHeaders
 * @property PartListHeader[] $partListHeaders
 * @property PurchaseHeader[] $purchaseHeaders
 * @property RequirementHeader[] $requirementHeaders
 * @property SaleOrderDetail[] $saleOrderDetails
 * @property Admin $admin
 * @property Customer $customer
 * @property SaleReturnHeader[] $saleReturnHeaders
 * @property SubconRequestHeader[] $subconRequestHeaders
 */
class SaleOrderHeaderBase extends MonthlyTransactionActiveRecord {

    public function tableName() {
        return 'tblet_sale_order_header';
    }

    public function rules() {
        return array(
            array('cn_ordinal, cn_month, cn_year, date, project_name, client_company, work_order_number, customer_id, admin_id', 'required'),
            array('cn_ordinal, cn_month, cn_year, material_on_site, downpayment, testing, maintenance, order_status, customer_id, admin_id, is_tax, is_paid_downpayment, is_approved, is_temporary, is_inactive', 'numerical', 'integerOnly' => true),
            array('temporary_number, project_name, client_name, client_company, phone, fax, work_order_number, delivery_time', 'length', 'max' => 60),
            array('value, personal_fee', 'length', 'max' => 18),
            array('discount, margin', 'length', 'max' => 10),
            array('payment_term, note', 'safe'),
            // The following rule is used by search().
            array('id, cn_ordinal, cn_month, cn_year, date, temporary_number, project_name, client_name, client_company, phone, fax, work_order_number, value, material_on_site, downpayment, testing, maintenance, discount, payment_term, delivery_time, personal_fee, margin, note, order_status, customer_id, admin_id, is_tax, is_paid_downpayment, is_approved, is_temporary, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'budgetingHeaders' => array(self::HAS_MANY, 'BudgetingHeader', 'sale_order_header_id'),
            'deliveryHeaders' => array(self::HAS_MANY, 'DeliveryHeader', 'sale_order_header_id'),
            'estimationHeaders' => array(self::HAS_MANY, 'EstimationHeader', 'sale_order_header_id'),
            'partListHeaders' => array(self::HAS_MANY, 'PartListHeader', 'sale_order_header_id'),
            'purchaseHeaders' => array(self::HAS_MANY, 'PurchaseHeader', 'sale_order_header_id'),
            'requirementHeaders' => array(self::HAS_MANY, 'RequirementHeader', 'sale_order_header_id'),
            'saleOrderDetails' => array(self::HAS_MANY, 'SaleOrderDetail', 'sale_order_header_id'),
            'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'saleReturnHeaders' => array(self::HAS_MANY, 'SaleReturnHeader', 'sale_order_header_id'),
            'subconRequestHeaders' => array(self::HAS_MANY, 'SubconRequestHeader', 'sale_order_header_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'cn_ordinal' => 'Cn Ordinal',
            'cn_month' => 'Cn Month',
            'cn_year' => 'Cn Year',
            'date' => 'Date',
            'temporary_number' => 'Temporary Number',
            'project_name' => 'Project Name',
            'client_name' => 'Client Name',
            'client_company' => 'Client Company',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'work_order_number' => 'Work Order Number',
            'value' => 'Value',
            'material_on_site' => 'Material On Site',
            'downpayment' => 'Downpayment',
            'testing' => 'Testing',
            'maintenance' => 'Maintenance',
            'discount' => 'Discount',
            'payment_term' => 'Payment Term',
            'delivery_time' => 'Delivery Time',
            'personal_fee' => 'Personal Fee',
            'margin' => 'Margin',
            'note' => 'Note',
            'order_status' => 'Order Status',
            'customer_id' => 'Customer',
            'admin_id' => 'Admin',
            'is_tax' => 'Is Tax',
            'is_paid_downpayment' => 'Is Paid Downpayment',
            'is_approved' => 'Is Approved',
            'is_temporary' => 'Is Temporary',
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
        $criteria->compare('t.temporary_number', $this->temporary_number, true);
        $criteria->compare('t.project_name', $this->project_name, true);
        $criteria->compare('t.client_name', $this->client_name, true);
        $criteria->compare('t.client_company', $this->client_company, true);
        $criteria->compare('t.phone', $this->phone, true);
        $criteria->compare('t.fax', $this->fax, true);
        $criteria->compare('t.work_order_number', $this->work_order_number, true);
        $criteria->compare('t.value', $this->value, true);
        $criteria->compare('t.material_on_site', $this->material_on_site);
        $criteria->compare('t.downpayment', $this->downpayment);
        $criteria->compare('t.testing', $this->testing);
        $criteria->compare('t.maintenance', $this->maintenance);
        $criteria->compare('t.discount', $this->discount, true);
        $criteria->compare('t.payment_term', $this->payment_term, true);
        $criteria->compare('t.delivery_time', $this->delivery_time, true);
        $criteria->compare('t.personal_fee', $this->personal_fee, true);
        $criteria->compare('t.margin', $this->margin, true);
        $criteria->compare('t.note', $this->note, true);
        $criteria->compare('t.order_status', $this->order_status);
        $criteria->compare('t.customer_id', $this->customer_id);
        $criteria->compare('t.admin_id', $this->admin_id);
        $criteria->compare('t.is_tax', $this->is_tax);
        $criteria->compare('t.is_paid_downpayment', $this->is_paid_downpayment);
        $criteria->compare('t.is_approved', $this->is_approved);
        $criteria->compare('t.is_temporary', $this->is_temporary);
        $criteria->compare('t.is_inactive', $this->is_inactive);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}
