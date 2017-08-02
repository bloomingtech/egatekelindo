<?php
$this->breadcrumbs = array(
    'Sale Payment' => array('create'),
    'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $salePayment,
    'attributes' => array(
        array(
            'label' => 'Pembayaran #',
            'value' => $salePayment->getCodeNumber(SalePaymentHeader::CN_CONSTANT),
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($salePayment, 'date'))),
        ),
        array(
            'label' => 'Retur #',
            'type' => 'raw',
            'value' => ($salePayment->saleReturnHeader === null) ? 'N/A' : CHtml::link($salePayment->saleReturnHeader->getCodeNumber(SaleReturnHeader::CN_CONSTANT), array('/transaction/saleReturn/view', 'id' => $salePayment->saleReturnHeader->id), array('target' => '_blank')
                    ),
        ),
        array(
            'label' => 'Jumlah Invoice',
            'value' => count($salePayment->salePaymentDetails)
        ),
        array(
            'label' => 'Catatan',
            'value' => CHtml::encode(CHtml::value($salePayment, 'note')),
        ),
    ),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'sale-payment-detail-grid',
    'dataProvider' => $detailsDataProvider,
    'columns' => array(
        array(
            'name' => 'saleInvoiceHeader.cn_ordinal',
            'header' => 'Faktur Penjualan #',
            'type' => 'raw',
            'value' => 'CHtml::link($data->saleInvoiceHeader->getCodeNumber(SaleInvoiceHeader::CN_CONSTANT), array("saleInvoiceHeader/view", "id" => $data->sale_invoice_header_id), array("target" => "_blank"))',
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'saleInvoiceHeader.date',
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", 
				CHtml::encode(CHtml::value($data, "saleInvoiceHeader.date")))'
        ),
        array(
            'header' => 'Total',
            'value' => 'number_format(CHtml::encode(CHtml::value($data, "saleInvoiceHeader.grand_total")), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        array(
            'header' => 'Jumlah Bayar',
            'value' => 'number_format(CHtml::encode(CHtml::value($data, "amount")), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
    ),
));
?>

<div>
    <table>
        <tr style="background-color: aquamarine">
            <td width="90%" style="text-align: right; font-weight: bold">Pembayaran:</td>
            <td style="text-align: right; font-weight: bold" width="90%">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salePayment, 'totalAmount'))); ?>
            </td>
        </tr>

        <tr style="background-color: aquamarine">
            <td width="90%" style="text-align: right; font-weight: bold">Total Retur:</td>
            <td style="text-align: right; font-weight: bold" width="90%">
                -<span id="totalSaleReturn">
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salePayment, 'saleReturnHeader.grand_total'))); ?>
                </span>
            </td>
        </tr>

        <tr style="background-color: aquamarine">
            <td width="90%" style="text-align: right; font-weight: bold">Grand Total:</td>
            <td style="text-align: right;font-weight: bold"  width="90%">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salePayment, 'grandTotal'))); ?>
            </td>
        </tr>
    </table>
</div>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Print', array('memo', 'id' => $salePayment->id), array('target' => '_blank')); ?>
</div>
