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

    .sig1 { width: 25% }
    .sig2 { width: 25% }
    .sig3 { width: 25% }
    .sig4 { width: 25% }
');
?>

<div id="memoheader">
    <div style="font-size: larger">PT. EGATEKELINDO</div>
    <div style="font-size: 2.5em">FAKTUR PENJUALAN</div>
</div>
<div class="div-separator-20">&nbsp;</div>
<table>
    <tr>
        <td class="title-row-border">INVOICE</td>
        <td class="title-row-border">FAKTUR PAJAK</td>
        <td class="title-row-border">PROJECT NAME</td>
        <td class="title-row-border">PURCHASE ORDER NO</td>
        <td class="title-row-border">DELIVERY SLIP NO</td>
        <td class="title-row-border">SALESMAN</td>
    </tr>
    <tr>
        <td class="content-row-border"><?php echo CHtml::encode($saleInvoice->getCodeNumber(SaleHeader::CN_CONSTANT)); ?></td>
        <td class="content-row-border"><?php echo CHtml::encode(CHtml::value($saleInvoice, 'tax_number')); ?></td>
        <td class="content-row-border"><?php echo CHtml::encode(CHtml::value($saleInvoice, 'deliveryHeader.saleOrder.project_name')); ?></td>
        <td class="content-row-border"><?php echo CHtml::encode(CHtml::value($saleInvoice, 'deliveryHeader.saleOrder.work_order_number')); ?></td>
        <td class="content-row-border">&nbsp;</td>
        <td class="content-row-border"><?php echo CHtml::encode(CHtml::value($saleInvoice, 'customer_order_number')); ?></td>
    </tr>
</table>

<br />

<table class="memo">
    <tr id="theader">
        <th>No</th>
        <th>KETERANGAN/DESCRIPTION</th>
        <th>JUMLAH</th>
        <th>UNIT</th>
        <th colspan="2">UNIT PRICE</th>
        <th colspan="2">TOTAL</th>
    </tr>
    <?php $nomor = 1; ?>
    <?php foreach ($saleInvoice->saleInvoiceDetails as $i => $detail): ?>
        <tr class="titems">
            <td style="text-align: center;"><?php echo $nomor; ?></td>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'panel_name')); ?></td>
            <td style="text-align: right; "><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($detail, 'unit.name')); ?></td>
            <td style="text-align: right; border-right: 0px solid;">Rp</td>
            <td style="text-align: right; border-left: 0px solid;">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unit_price'))); ?>
            </td>
            <td style="text-align: right; border-right: 0px solid;">Rp</td>
            <td style="text-align: right; border-left: 0px solid;">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total'))); ?>
            </td>
        </tr>
        <?php $nomor++; ?>
    <?php endforeach; ?>
    <?php for ($j = 12, $i = $i % $j + 1; $j > $i; $j--): ?>
        <tr class="titems">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="border-right: 0px solid;">&nbsp;</td>
            <td style="border-left: 0px solid;">&nbsp;</td>
            <td style="border-right: 0px solid;">&nbsp;</td>
            <td style="border-left: 0px solid;">&nbsp;</td>
        </tr>
    <?php endfor; ?>
    <tr>
        <td style="text-align: left; font-weight: bold; border-left: 1px solid; border-top: 2px solid; border-right: 1px solid;" colspan="3">FAKTUR INI BUKAN MERUPAKAN BUKTI PELUNASAN</td>
        <td style="text-align: right; font-weight: bold; border-left: 1px solid; border-top: 2px solid; border-right: 1px solid;" colspan="3">TOTAL FAKTUR</td>
        <td style="text-align: right; border-right: 0px solid;font-weight: bold; border-left: 1px solid; border-top: 2px solid;">Rp</td>
        <td style="text-align: right; font-weight: bold; border-left: 0px solid; border-top: 2px solid;border-right: 1px solid;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($saleInvoice, 'subTotal')))); ?>
        </td>

    </tr>
    <tr>
        <td style="text-align: left; font-weight: bold; border-left: 1px solid; border-top: 0px solid; border-right: 1px solid;" colspan="3">THIS INVOICE IS NOT CONSIDERED AS PAYMENT SETTLEMENT</td>
        <td style="text-align: right; font-weight: bold; border-left: 1px solid; border-top: 0px solid; border-right: 1px solid;" colspan="3">POTONGAN HARGA</td>
        <td style="text-align: right; border-right: 0px solid;font-weight: bold; border-left: 1px solid; border-top: 0px solid;">Rp</td>
        <td style="text-align: right; font-weight: bold; border-left: 0px solid; border-top: 0px solid;border-right: 1px solid;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($saleInvoice, 'discount')))); ?>
        </td>

    </tr>
    <tr>
        <td style="text-align: left; font-weight: bold; border-left: 1px solid; border-top: 2px solid; border-right: 1px solid;" colspan="3">TERBILANG</td>
        <td style="text-align: right; font-weight: bold; border-left: 1px solid; border-top: 0px solid; border-right: 1px solid;" colspan="3">NILAI TAGIHAN</td>
        <td style="text-align: right; border-right: 0px solid;font-weight: bold; border-left: 1px solid; border-top: 0px solid;"></td>
        <td style="text-align: right; font-weight: bold; border-left: 0px solid; border-top: 0px solid;border-right: 1px solid;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($saleInvoice, 'value_percentage')))); ?> %
        </td>

    </tr>
    <tr>
        <td style="text-align: right; font-weight: bold; border-left: 1px solid; border-top: 0px solid; border-right: 1px solid;" colspan="3"></td>
        <td style="text-align: right; font-weight: bold; border-left: 1px solid; border-top: 0px solid; border-right: 1px solid;" colspan="3">DASAR PENGENAAN PAJAK PPN = 10% X DASAR PENGENAAN PAJAK</td>
        <td style="text-align: right; border-right: 0px solid;font-weight: bold; border-left: 1px solid; border-top: 2px solid;">Rp</td>
        <td style="text-align: right; font-weight: bold; border-left: 0px solid; border-top: 2px solid;border-right: 1px solid;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($saleInvoice, 'taxTotal')))); ?>
        </td>

    </tr>
    <tr>
        <td style="text-align: right; font-weight: bold; border-left: 1px solid; border-top: 0px solid; border-right: 1px solid;" colspan="3"></td>
        <td style="text-align: right; font-weight: bold; border-left: 1px solid; border-top: 0px solid; border-right: 1px solid;" colspan="3">JUMLAH</td>
        <td style="text-align: right; border-right: 0px solid;font-weight: bold; border-left: 1px solid; border-top: 2px solid;">Rp</td>
        <td style="text-align: right; font-weight: bold; border-left: 0px solid; border-top: 2px solid;border-right: 1px solid;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($saleInvoice, 'grandTotal')))); ?>
        </td>

    </tr>

</table>
<br />

<div class="memoCatatan">Catatan: <?php echo CHtml::encode(CHtml::value($saleInvoice, 'note')); ?></div>

<div class="memosig">
    <div style="font-weight:bold; font-style: italic;" class="divtable">
        <div  class="divtablecell sig2">
            <div></div>
            <div style="height: 50px;"></div>
            <div><?php //echo CHtml::encode(CHtml::value($purchaseItem, 'employeeIdAuthorized.name'));     ?></div>
        </div>
        <div  class="divtablecell sig2">
            <div></div>
            <div style="height: 50px;"></div>
            <div><?php //echo CHtml::encode(CHtml::value($purchaseItem, 'employeeIdAuthorized.name'));     ?></div>
        </div>
        <div  class="divtablecell sig3">
            <div></div>
            <div style="height: 50px;"></div>
            <div><?php //echo CHtml::encode(CHtml::value($purchaseItem, 'employeeIdApproved.name'));     ?></div>
        </div>
        <div class="divtablecell sig4">
            <div >Tangerang, <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($saleInvoice, 'date')))); ?></div>
            <div style="height: 50px;"></div>
            <div>( ____________________________ )</div>
        </div>
    </div>
</div>
