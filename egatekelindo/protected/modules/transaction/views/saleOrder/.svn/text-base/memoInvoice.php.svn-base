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
    
    table, th, td {
        border: 1px solid black;
    }
    
    table .invoice{
      border-collapse: collapse;
    }
');
?>

<div>
    <span style="font-weight: bold;font-size: 22px;">PT.EGA TEKELINDO PRIMA</span><br/>
    <span style="font-weight: bold;">Office:</span><br/>
    <span style="font-style: italic;">Jl. P.Jayakarta 141 Blok E No.4 Jakarta 10730</span><br/>
    <span style="font-style: italic;">Phone : (021) 6008081-82-83, 6008742-43-45</span> <br/>
    <span style="font-style: italic;">Fax   : (021) 6293054 </span> <br/>
    <span style="font-style: italic;">Telex : (021) 414484 EGA IA</span>
</div>
<div class="div-separator-20">&nbsp;</div>

<table style="border: 0px solid !important;">
    <tr>
        <td colspan="5" style="text-align: center;border-bottom: 0px solid;">DIJUAL KEPADA / TO</td>
        <td colspan="3" style="text-align: center;border: 0px solid; font-weight: bold; font-size: larger;text-decoration: underline"> FAKTUR PENJUALAN</td>
    </tr>
    <tr>
        <td colspan="5" style="border-bottom: 0px solid; border-top: 0px solid"><?php echo CHtml::encode(CHtml::value($saleOrder, 'customer.company')); ?></td>
        <td colspan="3" style="text-align: center;border: 0px solid;font-weight: bold; font-size: larger;">INVOICE</td>
    </tr>
    <tr>
        <td colspan="5" style="border-bottom: 0px solid; border-top: 0px solid"><?php echo CHtml::encode(CHtml::value($saleOrder, 'customer.address')); ?></td>
        <td colspan="3" style="border: 0px solid">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" style="border-bottom: 0px solid; border-top: 0px solid">NPWP : <?php echo CHtml::encode(CHtml::value($saleOrder, 'customer.tax_number')); ?></td>
        <td colspan="3" style="border: 0px solid">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" style=" border-top: 0px solid">&nbsp;</td>
        <td colspan="3" style="border: 0px solid">&nbsp;</td>
    </tr>

</table>
<table class="invoice">
    <tr>
        <td colspan="2" style="text-align: center;">INVOICE</td>
        <td style="text-align: center;">FAKTUR PAJAK</td>
        <td style="text-align: center;">PROJECT NO / NAME PROJECT</td>
        <td style="text-align: center;" colspan="2">PURCHASE ORDER NO</td>
        <td style="text-align: center;">DELIVERY SLIP NO / NO BON PENYERAHAN</td>
        <td style="text-align: center;">SALESMAN</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td>&nbsp;</td>
        <td><?php echo CHtml::encode($saleOrder->getNumber(SaleOrder::CN_CONSTANT)); ?> / <?php echo CHtml::encode(CHtml::value($saleOrder, 'project_name')); ?></td>
        <td colspan="2"><?php echo CHtml::encode(CHtml::value($saleOrder, 'work_order_number')); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
        <td style="text-align: center;" width="5%">No.</td>
        <td style="text-align: center;" colspan="4">KETERANGAN / DESCRIPTION</td>
        <td style="text-align: center;">UNIT</td>
        <td style="text-align: center;">UNIT PRICE (Rp.)</td>
        <td style="text-align: center;">TOTAL (Rp.)</td>
    </tr>
    <tr>
        <td style="border-bottom: 0px solid; text-align: center;">1</td>
        <td style="border-bottom: 0px solid;" colspan="4">DP (<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'downpayment'))); ?> %)</td>
        <td style="border-bottom: 0px solid;text-align: right;">1</td>
        <td style="border-bottom: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'value'))); ?></td>
        <td style="border-bottom: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'total'))); ?></td>
    </tr>
    <?php for ($i = 0; $i < 10; $i++): ?>
        <tr>
            <td style="border-bottom: 0px solid; border-top: 0px solid">&nbsp;</td>
            <td style="border-bottom: 0px solid; border-top: 0px solid" colspan="4">&nbsp;</td>
            <td style="border-bottom: 0px solid; border-top: 0px solid">&nbsp;</td>
            <td style="border-bottom: 0px solid; border-top: 0px solid">&nbsp;</td>
            <td style="border-bottom: 0px solid; border-top: 0px solid">&nbsp;</td>
        </tr>
    <?php endfor; ?>
    <tr>
        <td style="border-top: 0px solid">&nbsp;</td>
        <td style="border-top: 0px solid" colspan="4">&nbsp;</td>
        <td style="border-top: 0px solid">&nbsp;</td>
        <td style="border-top: 0px solid">&nbsp;</td>
        <td style="border-top: 0px solid">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="6" style="border-bottom: 0px solid; text-align: center;">FAKTUR INI BUKAN MERUPAKAN BUKTI PELUNASAN</td>
        <td  style="text-align: right; border-bottom: 0px solid;">TOTAL FAKTUR</td>
        <td  style="text-align: right; border-bottom: 0px solid;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'total'))); ?></td>
    </tr>
    <tr>
        <td colspan="6" style="border-top: 0px solid; text-align: center;">THIS INVOICE IS NOT CONSIDERED AS PAYMENT SETTLEMENT</td>
        <td style="text-align: right; border-bottom: 0px solid;border-top: 0px solid;"</td>
        <td style="text-align: right; border-bottom: 0px solid;border-top: 0px solid;"></td>
    </tr>
    <tr>
        <td colspan="6" style="border-bottom: 0px solid;text-decoration: underline;">TERBILANG</td>
        <td style=" border-bottom: 0px solid;border-top: 0px solid;">POTONGAN HARGA</td>
        <td style="text-align: right; border-bottom: 0px solid;border-top: 0px solid;"></td>
    </tr>
    <tr>
        <td colspan="6" style="border-bottom: 0px solid;border-top: 0px solid; vertical-align: top;" rowspan="4">
            <?php echo CHtml::encode(NumberWord::numberName(floor(CHtml::value($saleOrder, 'total')))); ?>
            rupiah</td>
        <td style="border-bottom: 0px solid;border-top: 0px solid;">NILAI TAGIHAN ...... %</td>
        <td style="text-align: right; border-bottom: 0px solid;border-top: 0px solid;"></td>
    </tr>
    <tr>
        <td style="border-bottom: 0px solid;border-top: 0px solid;">&nbsp;</td>
        <td style="text-align: right; border-bottom: 0px solid;border-top: 0px solid;">&nbsp;</td>
    </tr>
    <tr>
        <td style="border-bottom: 0px solid;border-top: 0px solid;">DASAR PENGENAAN PAJAK</td>
        <td style="text-align: right; border-bottom: 0px solid;border-top: 0px solid;">&nbsp;</td>
    </tr
    <tr>
        <td style="border-bottom: 0px solid;border-top: 0px solid;">PPN = 10% X DASAR PENGENAAN PAJAK</td>
        <td style="text-align: right; border-bottom: 0px solid;border-top: 0px solid;">
            <?php if ($saleOrder->is_tax) : ?>
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'calculatedTax'))); ?>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td colspan="6" style="border-top: 0px solid;"></td>
        <td style="border-top: 0px solid;text-align: right;">JUMLAH</td>
        <td style="text-align: right; border-top: 0px solid;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'grandTotalDownPayment'))); ?></td>
    </tr>
</table>

<div class="div-separator-20">&nbsp;</div>
<div class="div-separator-20">&nbsp;</div>

<div class="memosig">
    <div style="font-weight:bold; font-style: italic;" class="divtable">
        <div  class="divtablecell sig2">
            <div>
                Pembarayan : <br/>
                PT EGA TEKELINDO PRIMA <br/>
                Bank Bumi Arta Cab.Kopi-Jakarta <br/>
                A/C : 101.12.21679
            </div>
        </div>
        <div  class="divtablecell sig3">
            <div></div>
            <div style="height: 50px;"></div>
        </div>
        <div class="divtablecell sig4">
            <div ></div>
        </div>
        <div  class="divtablecell sig1">
            <div>Tangerang, <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($saleOrder, 'date')))); ?></div>
            <div style="height: 50px;"></div>
            <div>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )</div>
        </div>
    </div>
</div>
