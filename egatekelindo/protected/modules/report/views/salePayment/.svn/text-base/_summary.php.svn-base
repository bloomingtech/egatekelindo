<?php
Yii::app()->clientScript->registerCss('_report', '
	.width1-1 { width: 10% }
	.width1-2 { width: 15% }
	.width1-3 { width: 15% }
	.width1-4 { width: 10% }
	.width1-5 { width: 10% }
        .width1-6 { width: 15% }
	.width1-7 { width: 10% }
	.width1-8 { width: 10% }
        

	.width2-1 { width: 20% }
	.width2-2 { width: 20% }
	.width2-3 { width: 20% }
	.width2-4 { width: 20% }
	.width2-5 { width: 20% }
	
');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger"><?php echo Yii::app()->name; ?></div>
    <div style="font-size: larger">Laporan Pembayaran Penjualan</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <tr id="header1">
        <th class="width1-1" style="text-align: left">Tanggal</th>
        <th class="width1-2" style="text-align: left">Pembayaran #</th>
        <th class="width1-3" style="text-align: left">Bank</th>
        <th class="width1-4" style="text-align: left">Tanggal Cheque</th>
        <th class="width1-5" style="text-align: left">No Cheque</th>
        <th class="width1-6" style="text-align: left">Retur Penjualan #</th>
        <th class="width1-7" style="text-align: left">Tanggal Retur</th>
        <th class="width1-8" style="text-align: left">Catatan</th>
    </tr>
    <tr id="header2">
        <td colspan="8">
            <table>
                <tr>
                    <th class="width2-1" style="text-align: left">Invoice</th>
                    <th class="width2-2" style="text-align: left">Tanggal</th>
                    <th class="width2-3" style="text-align: right">Jumlah Invoice</th>
                    <th class="width2-4" style="text-align: left">No SO</th>
                    <th class="width2-5" style="text-align: right">Jumlah Bayar</th>

                </tr>
            </table>
        </td>
    </tr>
    <?php $grantTotalAmount = 0.00; ?>
    <?php foreach ($salePaymentSummary->dataProvider->data as $header): ?>
        <tr class="items1">
            <td class="width1-1"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
            <td class="width1-2" style="text-align: left"><?php echo CHtml::encode($header->getCodeNumber(SalePaymentHeader::CN_CONSTANT)); ?></td>
            <td class="width1-3" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'bank_name')); ?></td>
            <td class="width1-4"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->cheque_date))); ?></td>
            <td class="width1-5" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'cheque_number')); ?></td>
            <td class="width1-6" style="text-align: left"><?php if ($header->sale_return_header_id)
        echo CHtml::encode($header->saleReturnHeader->getCodeNumber(SaleReturnHeader::CN_CONSTANT)); ?></td>
            <td class="width1-7" style="text-align: left"><?php if ($header->sale_return_header_id)
                echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->saleReturnHeader->date))); ?></td>
            <td class="width1-8" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'note')); ?></td>
        </tr>
        <tr class="items2">
            <td colspan="8">
                <table>
                    <?php foreach ($header->salePaymentDetails as $detail): ?>
                        <tr>
                            <td class="width2-1" style="text-align: left"><?php echo CHtml::encode($detail->saleInvoiceHeader->getCodeNumber(SaleInvoiceHeader::CN_CONSTANT)); ?></td>
                            <td class="width2-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($detail->saleInvoiceHeader->date))); ?></td>
                            <td class="width2-3" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->saleInvoiceHeader->grand_total)); ?></td>
                            <td class="width2-4" style="text-align: left"><?php echo CHtml::encode($detail->saleInvoiceHeader->deliveryHeader->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?></td>
                            <td class="width2-5" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->amount)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr> 
                        <td class="width2-4" style="text-align: right;font-weight: bold;" colspan="4">Pembayaran</td>
                        <td class="width2-5" style="text-align: right; border-top:1px solid; font-weight: bold;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->totalAmount)); ?></td>
                    </tr>

                    <tr> 
                        <td class="width2-4" style="text-align: right;font-weight: bold;" colspan="4">Retur</td>
                        <td class="width2-5" style="text-align: right; border-top:0px solid;font-weight: bold;"><?php if ($header->sale_return_header_id)
                    echo '-' . CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->saleReturnHeader->grand_total)); ?></td>
                    </tr>
                    <tr> 
                        <td class="width2-4" style="text-align: right;font-weight: bold;" colspan="4">Grand Total</td>
                        <td class="width2-5" style="text-align: right; border-top:1px solid;font-weight: bold;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->grandTotal)); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php $grantTotalAmount += $header->grandTotal ?>
    <?php endforeach; ?>
    <tr id="header2">
        <td colspan="8" style="border-bottom: 0px solid;">
            <table>
                <tr>
                    <th class="width2-1" style="text-align: left"></th>
                    <th class="width2-2" style="text-align: left"></th>
                    <th class="width2-3" style="text-align: right"></th>
                    <th class="width2-4" style="text-align: right">GRAND TOTAL</th>
                    <th class="width2-5" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $grantTotalAmount)); ?></th>
                </tr>
            </table>
        </td>
    </tr>
</table>