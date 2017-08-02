<?php
$this->breadcrumbs = array(
    'Purchase' => array('/transaction/purchase/create'),
    'View',
);
?>

<style>
    table
    {
        margin-bottom: 0px;
    }
</style>

<h1>Purchase Order</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $purchase,
    'attributes' => array(
        array(
            'label' => 'PO #',
            'value' => $purchase->getCodeNumber(PurchaseHeader::CN_CONSTANT),
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($purchase, 'date'))),
        ),
        array(
            'label' => 'Project Name',
            'value' => CHtml::encode(CHtml::value($purchase, 'requirementHeader.saleOrderHeader.project_name')),
        ),
        array(
            'label' => 'Client',
            'value' => CHtml::encode(CHtml::value($purchase, 'requirementHeader.saleOrderHeader.client_company')),
        ),
        array(
            'label' => 'SO #',
            'value' => CHtml::encode($purchase->requirementHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)),
        ),
        array(
            'label' => 'Tanggal Kirim',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($purchase, 'delivery_date'))),
        ),
        array(
            'label' => 'Kirim ke',
            'value' => CHtml::encode(CHtml::value($purchase, 'delivery_place')),
        ),
        array(
            'label' => 'Jenis PO',
            'value' => CHtml::encode(CHtml::value($purchase, 'purchasingType.name')),
        ),
        array(
            'label' => 'Supplier Company',
            'value' => CHtml::encode(CHtml::value($purchase, 'supplier.company')),
        ),
        array(
            'label' => 'Supplier Name',
            'value' => CHtml::encode(CHtml::value($purchase, 'supplier.name')),
        ),
        array(
            'label' => 'Payment Term',
            'value' => CHtml::encode(CHtml::value($purchase, 'payment_term')),
        ),
        array(
            'label' => 'Payment Type',
            'value' => CHtml::encode(CHtml::value($purchase, 'paymentType')),
        ),
        array(
            'label' => 'Catatan',
            'value' => CHtml::encode(CHtml::value($purchase, 'note')),
        ),
    ),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'purchase-detail-grid',
    'dataProvider' => $detailsDataProvider,
    'htmlOptions' => array(
        'margin' => '0px'
    ),
    'columns' => array(
        'requirementDetailComponent.component_name: Komponen',
        array(
            'header' => 'Quantity',
            'value' => 'number_format(CHtml::value($data, "quantity"), 0)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        array(
            'header' => 'Berat',
            'value' => 'number_format(CHtml::value($data, "weight"), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        array(
            'header' => 'Unit Price',
            'value' => 'number_format(CHtml::value($data, "unit_price"), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        array(
            'header' => 'Disc 1(%)',
            'value' => 'number_format(CHtml::value($data, "discount_1"), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        array(
            'header' => 'Disc 2(%)',
            'value' => 'number_format(CHtml::value($data, "discount_2"), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        array(
            'header' => 'Disc 3(%)',
            'value' => 'number_format(CHtml::value($data, "discount_3"), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        array(
            'header' => 'Disc 4(%)',
            'value' => 'number_format(CHtml::value($data, "discount_4"), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        array(
            'header' => 'Total',
            'value' => 'number_format(CHtml::value($data, "totalAfterDiscount"), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        )
    ),
));
?>

<table>
    <tr style="background-color: skyblue">
        <td style="text-align:right; width: 70%;">
            Sub Total :
        </td>
        <td style="text-align: right; width: 21%;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchase, 'subTotalRequirement'))); ?>
        </td>
    </tr>
    <tr style="background-color: skyblue">
        <td style="text-align:right; width: 70%;">
            PPn <?php echo CHtml::encode(CHtml::value($purchase, 'taxPercentage')); ?>% : 
        </td>
        <td style="text-align: right; width: 21%;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::encode(CHtml::value($purchase, 'calculatedTaxRequirement')))); ?>
        </td>
    </tr>
    <tr style="background-color: skyblue">
        <td style="text-align:right; width: 70%;">
            Grand Total :
        </td>
        <td style="text-align: right; width: 21%;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchase, 'grandTotalRequirement'))); ?>
        </td>
    </tr>
</table>

<br />


<br />
<div id="link">
    <?php echo CHtml::link('Create', array('requirementList')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Print', array('memo', 'id' => $purchase->id), array('target' => '_blank')); ?>
</div>