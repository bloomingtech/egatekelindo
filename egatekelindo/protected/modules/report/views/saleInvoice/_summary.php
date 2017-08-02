<?php
Yii::app()->clientScript->registerCss('_report', '
	.width1-1 { width: 10% }
	.width1-2 { width: 10% }
	.width1-3 { width: 10% }
	.width1-4 { width: 10% }
	.width1-5 { width: 10% }
        .width1-6 { width: 10% }
	.width1-7 { width: 10% }
	.width1-8 { width: 10% }
	.width1-9 { width: 10% }
	.width1-10 { width: 10% }
        

	.width2-1 { width: 10% }
	.width2-2 { width: 20% }
	.width2-3 { width: 10% }
	.width2-4 { width: 5% }
	.width2-5 { width: 10% }
	.width2-6 { width: 10% }
	.width2-7 { width: 5% }
	.width2-8 { width: 13% }
	.width2-9 { width: 13% }
	.width2-10 { width: 2% }
	.width2-11 { width: 2% }
');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger"><?php echo Yii::app()->name; ?></div>
    <div style="font-size: larger">Laporan Faktur Penjualan</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <tr id="header1">
        <th class="width1-1" style="text-align: left">Tanggal</th>
        <th class="width1-2" style="text-align: left">No Faktur #</th>
        <th class="width1-3" style="text-align: left">Faktur Pajak</th>
        <th class="width1-4" style="text-align: left">Customer Order</th>
        <th class="width1-5" style="text-align: left">Pengiriman #</th>
        <th class="width1-6" style="text-align: left">SO #</th>
        <th class="width1-7" style="text-align: left">Tanggal SO</th>
        <th class="width1-8" style="text-align: left">No PO</th>
        <th class="width1-9" style="text-align: left">Project Name</th>
        <th class="width1-10" style="text-align: left">Catatan</th>
    </tr>
    <tr id="header2">
        <td colspan="10">
            <table>
                <tr>
                    <th class="width2-1" style="text-align: left">Panel Name</th>
                    <th class="width2-2" style="text-align: left">Quantity</th>
                    <th class="width2-3" style="text-align: center">Satuan</th>
                    <th class="width2-4" style="text-align: right">Unit Price</th>
                    <th class="width2-5" style="text-align: right">Total</th>

                </tr>
            </table>
        </td>
    </tr>
    <?php $grantTotalAmount = 0.00; ?>
    <?php foreach ($saleInvoiceSummary->dataProvider->data as $header): ?>
        <tr class="items1">
            <td class="width1-1"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
            <td class="width1-2" style="text-align: left"><?php echo CHtml::encode($header->getCodeNumber(SaleInvoiceHeader::CN_CONSTANT)); ?></td>
            <td class="width1-3" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'tax_number')); ?></td>
            <td class="width1-4" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'customer_order_number')); ?></td>
            <td class="width1-5" style="text-align: left"><?php echo CHtml::encode($header->deliveryHeader->getCodeNumber(DeliveryHeader::CN_CONSTANT)); ?></td>
            <td class="width1-6" style="text-align: left"><?php echo CHtml::encode($header->deliveryHeader->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?></td>
            <td class="width1-7" style="text-align: left"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->deliveryHeader->saleOrder->date))); ?></td>
            <td class="width1-8" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header->deliveryHeader->saleOrder, 'work_order_number')); ?></td>
            <td class="width1-9" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header->deliveryHeader->saleOrder, 'project_name')); ?></td>
            <td class="width1-10" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'catatan')); ?></td>
        </tr>
        <tr class="items2">
            <td colspan="10">
                <table>
                    <?php foreach ($header->saleInvoiceDetails as $detail): ?>
                        <tr>
                            <td class="width2-1" style="text-align: left"><?php echo CHtml::encode(CHtml::value($detail, 'panel_name')); ?></td>
                            <td class="width2-2" style="text-align: left"><?php echo CHtml::encode(CHtml::value($detail, 'quantity')); ?></td>
                            <td class="width2-3" style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'unit.name')); ?></td>
                            <td class="width2-4" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->unit_price)); ?></td>
                            <td class="width2-5" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->total)); ?></td>

                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td class="width2-4" style="text-align: right;  font-weight: bold" colspan="4">Sub Total</td>
                        <td class="width2-5" style="text-align: right; border-top: 1px solid;font-weight: bold"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->subTotal)); ?></td>

                    </tr>
                    <tr>
                        <td class="width2-4" style="text-align: right;  font-weight: bold" colspan="4">Nilai Tagihan</td>
                        <td class="width2-5" style="text-align: right; font-weight: bold"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->value_percentage)); ?></td>
                    </tr>
                    <tr>
                        <td class="width2-4" style="text-align: right;  font-weight: bold" colspan="4">Discount</td>
                        <td class="width2-5" style="text-align: right; font-weight: bold">-<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->discount)); ?></td>
                    </tr>
                    <tr>
                        <td class="width2-4" style="text-align: right;  font-weight: bold" colspan="4">PPN 10%</td>
                        <td class="width2-5" style="text-align: right; font-weight: bold">+<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->taxTotal)); ?></td>
                    </tr>
                    <tr>
                        <td class="width2-4" style="text-align: right;  font-weight: bold" colspan="4">Grand Total</td>
                        <td class="width2-5" style="text-align: right; font-weight: bold; border-top:1px solid"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->grandTotal)); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php $grantTotalAmount += $header->grandTotal ?>
    <?php endforeach; ?>
    <tr id="header2">
        <td colspan="10" style="border-bottom: 0px solid;">
            <table>
                <tr>
                    <th class="width2-1" style="text-align: left"></th>
                    <th class="width2-2" style="text-align: left"></th>
                    <th class="width2-3" style="text-align: center"></th>
                    <th class="width2-4" style="text-align: right">GRAND TOTAL</th>
                    <th class="width2-5" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $grantTotalAmount)); ?></th>

                </tr>
            </table>
        </td>
    </tr>
</table>