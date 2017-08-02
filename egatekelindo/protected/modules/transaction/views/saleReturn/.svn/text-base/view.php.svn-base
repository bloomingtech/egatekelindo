<?php
//$purchaseItem as a PurchaseHeader model

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

<h1>Retur Penjualan</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $saleReturn,
    'attributes' => array(
        array(
            'label' => 'Retur  #',
            'value' => $saleReturn->getCodeNumber(SaleInvoiceHeader::CN_CONSTANT),
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($saleReturn, 'date'))),
        ),
        array(
            'label' => 'Project Name',
            'value' => CHtml::encode(CHtml::value($saleReturn->saleOrder, 'project_name')),
        ),
        array(
            'label' => 'Catatan',
            'value' => CHtml::encode(CHtml::value($saleReturn, 'note')),
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
        'item_description: Item Name',
        array(
            'header' => 'Quantiy',
            'value' => 'number_format(CHtml::value($data, "quantity"), 2)',
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
            'header' => 'Total',
            'value' => 'number_format(CHtml::value($data, "total"), 2)',
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
            Sub Total:
        </td>
        <td style="text-align: right; width: 21%;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::encode(CHtml::value($saleReturn, 'subTotal')))); ?>
        </td>

    </tr>
    <tr style="background-color: skyblue">
        <td style="text-align:right; width: 70%;">
            Discount:
        </td>
        <td style="text-align: right; width: 21%;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::encode(CHtml::value($saleReturn, 'discount')))); ?>
        </td>

    </tr>
    <tr style="background-color: skyblue">
        <td style="text-align:right; width: 70%;">
            PPN 10%:
        </td>
        <td style="text-align: right; width: 21%;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::encode(CHtml::value($saleReturn, 'taxTotal')))); ?>
        </td>

    </tr>
    <tr style="background-color: skyblue">
        <td style="text-align:right; width: 70%;">
            Grand Total:
        </td>
        <td style="text-align: right; width: 21%;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::encode(CHtml::value($saleReturn, 'grandTotal')))); ?>
        </td>

    </tr>

</table>

<br />


<br />
<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Print', array('memo', 'id' => $saleReturn->id), array('target' => '_blank')); ?>
</div>