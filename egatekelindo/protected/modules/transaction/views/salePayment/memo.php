<?php
Yii::app()->clientScript->registerScript('memo', '
	$("#header").addClass("hide");
	$("#mainmenu").addClass("hide");
	$(".breadcrumbs").addClass("hide");
	$("#footer").addClass("hide");
');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/transaction/memo.css');
Yii::app()->clientScript->registerCss('memo', '
	.hcolumn1 { width: 50% }
	.hcolumn2 { width: 50% }

	.hcolumn1header { width: 35% }
	.hcolumn1value { width: 65% }
	.hcolumn2header { width: 35% }
	.hcolumn2value { width: 65% }

	.sig1 { width: 50% }
	.sig2 { width: 50% }
');
?>


<div class="width-33 float-left">
    <div style="font-size: larger" class="font-bold">PT. EGA TEKELINDO PRIMA</div>
</div>

<div class="width-33 float-left">
    <center>
        <div class="div-separator-20">&nbsp;</div>
        <div style="font-size: larger" class="font-underline font-bold">BUKTI TANDA TERIMA</div>
        <div style="font-size: larger"> Tgl. <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($salePayment, 'date')))); ?></div>
    </center>
</div>

<div class="width-33 float-left">
    <div>No : <?php echo CHtml::encode($salePayment->getCodeNumber(SalePaymentHeader::CN_CONSTANT)); ?></div>
    <div>Bank : <?php echo CHtml::encode(CHtml::value($salePayment, 'bank_name')); ?></div>
    <div>Tgl. Cheque : <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($salePayment, 'cheque_date')))); ?></div>
    <div>No. Cheque : <?php echo CHtml::encode(CHtml::value($salePayment, 'cheque_number')); ?> </div>
</div>
<div class="clear"></div>
<div class="div-separator-20">&nbsp;</div>

<br />

<table class="memo">
    <tr id="theader">
        <th style="width: 15%">No Kwitansi</th>
        <th style="width: 15%">Tanggal</th>
        <th style="width: 15%">Uraian</th>
        <th style="width: 15%">Total Kwitansi</th>
        <th style="width: 15%">Jumlah Bayar</th>
    </tr>
    <?php
    foreach ($salePayment->salePaymentDetails(array(
        'condition' => 'salePaymentDetails.is_inactive = 0'
    )) as $i => $detail):
        ?>
        <tr class="titems">
            <td style=""><?php echo CHtml::encode($detail->saleInvoiceHeader->getCodeNumber(SaleInvoiceHeader::CN_CONSTANT)); ?></td>
            <td style=""><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($detail, 'saleInvoiceHeader.date')))); ?></td>
            <td style=""><?php echo CHtml::encode($detail->saleInvoiceHeader->deliveryHeader->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?></td>
            <td style="text-align: right; "><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'saleInvoiceHeader.grand_total'))); ?></td>
            <td style="text-align: right; "><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'amount'))); ?></td>
        </tr>

    <?php endforeach; ?>
    <?php for ($j = 5, $i = $i % $j + 1; $j > $i; $j--): ?>
        <tr class="titems">
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>


        </tr>
    <?php endfor; ?>
    <tr>
        <td style="text-align: right;font-weight: bold; border-left: 1px solid;border-top: 2px solid;"  colspan="4">
            Sub Total
        </td>
        <td style="text-align: right; border-right: 1px solid;border-top: 2px solid;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($salePayment, 'totalAmount')))); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align: right;font-weight: bold; border-left: 1px solid;"  colspan="4">
            Retur
        </td>
        <td style="text-align: right; border-right: 1px solid">
            - <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($salePayment, 'saleReturnHeader.grand_total')))); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align: right;font-weight: bold; border-left: 1px solid;"  colspan="4">
            Grand Total
        </td>
        <td style="text-align: right; border-right: 1px solid;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($salePayment, 'grand_total')))); ?>
        </td>
    </tr>

</table>

<br />
<div style="text-transform: capitalize">
    Terbilang:
    <?php echo CHtml::encode(NumberWord::numberName(CHtml::value($salePayment, 'totalAmount'))); ?>
    rupiah
</div>
<br />
<div>
    CATATAN: <?php echo CHtml::encode(CHtml::value($salePayment, 'note')); ?>
</div>

<br />
<table class="table-sig">
    <tr>
        <td class="width-20 align-center">Dibukukan</td>
        <td class="width-20 align-center">Disetujui</td>
        <td class="width-20 align-center" colspan="2">Diperiksa</td>
        <td class="width-20 align-center">Dibuat</td>
    </tr>
    <tr class="height-70">
        <td class="width-20">&nbsp;</td>
        <td class="width-20">&nbsp;</td>
        <td class="width-20">&nbsp;</td>
        <td class="width-20">&nbsp;</td>
        <td class="width-20">&nbsp;</td>
    </tr>
</table>