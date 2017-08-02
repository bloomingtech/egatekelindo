<?php
Yii::app()->clientScript->registerCss('_report', '
	.width1-1 { width: 15% }
	.width1-2 { width: 15% }
	.width1-3 { width: 15% }
	.width1-4 { width: 15% }
	.width1-5 { width: 15% }
        .width1-6 { width: 15% }
        
	.width2-1 { width: 20% }
	.width2-2 { width: 20% }
	.width2-3 { width: 20% }
	.width2-4 { width: 20% }
	.width2-5 { width: 20% }
	
');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger"><?php echo Yii::app()->name; ?></div>
    <div style="font-size: larger">Laporan Retur Penjualan</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <tr id="header1">
        <th class="width1-1" style="text-align: left">Tanggal</th>
        <th class="width1-2" style="text-align: left">Retur #</th>
        <th class="width1-3" style="text-align: left">SO #</th>
        <th class="width1-4" style="text-align: left">Tanggal SO</th>
        <th class="width1-5" style="text-align: left">No PO</th>
        <th class="width1-6" style="text-align: left">Project Name</th>

    </tr>
    <tr id="header2">
        <td colspan="6">
            <table>
                <tr>
                    <th class="width2-1" style="text-align: left">Item Name</th>
                    <th class="width2-2" style="text-align: right">Quantity</th>
                    <th class="width2-3" style="text-align: right">Unit Price</th>
                    <th class="width2-4" style="text-align: right">Total</th>

                </tr>
            </table>
        </td>
    </tr>
    <?php $grantTotalAmount = 0.00; ?>
    <?php foreach ($saleReturnSummary->dataProvider->data as $header): ?>
        <tr class="items1">
            <td class="width1-1"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
            <td class="width1-2" style="text-align: left"><?php echo CHtml::encode($header->getCodeNumber(SaleReturnHeader::CN_CONSTANT)); ?></td>
            <td class="width1-3" style="text-align: left"><?php echo CHtml::encode($header->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?></td>
            <td class="width1-4"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->saleOrder->date))); ?></td>
            <td class="width1-5" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'saleOrder.work_order_number')); ?></td>
            <td class="width1-6" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'saleOrder.project_name')); ?></td>

        </tr>
        <tr class="items2">
            <td colspan="6">
                <table>
                    <?php foreach ($header->saleReturnDetails as $detail): ?>
                        <tr>
                            <td class="width1-1" style="text-align: left"><?php echo CHtml::encode(CHtml::value($detail, 'item_description')); ?></td>
                            <td class="width1-2" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->quantity)); ?></td>
                            <td class="width1-3" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->unit_price)); ?></td>
                            <td class="width1-4" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->total)); ?></td>
                        </tr>
                    <?php endforeach; ?>

                    <tr> 
                        <td class="width1-3" style="text-align: right;font-weight: bold;" colspan="3">Sub Total</td>
                        <td class="width1-4" style="text-align: right; border-top:1px solid; font-weight: bold;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->subTotal)); ?></td>
                    </tr>

                    <tr> 
                        <td class="width1-3" style="text-align: right;font-weight: bold;" colspan="3">Diskon</td>
                        <td class="width1-4" style="text-align: right; border-top:0px solid;font-weight: bold;">-<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->discount)); ?></td>
                    </tr>

                    <tr> 
                        <td class="width1-3" style="text-align: right;font-weight: bold;" colspan="3">PPN 10%</td>
                        <td class="width1-4" style="text-align: right; border-top:0px solid;font-weight: bold;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->taxTotal)); ?></td>
                    </tr>
                    <tr> 
                        <td class="width1-3" style="text-align: right;font-weight: bold;" colspan="3">Grand Total</td>
                        <td class="width1-4" style="text-align: right; border-top:1px solid;font-weight: bold;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->grandTotal)); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php $grantTotalAmount += $header->grandTotal ?>
    <?php endforeach; ?>
    <tr id="header2">
        <td colspan="6" style="border-bottom: 0px solid;">
            <table>
                <tr>
                    <th class="width2-1" style="text-align: left"></th>
                    <th class="width2-2" style="text-align: right"></th>
                    <th class="width2-3" style="text-align: right">GRAND TOTAL</th>
                    <th class="width2-4" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $grantTotalAmount)); ?></th>
                </tr>
            </table>
        </td>
    </tr>
</table>