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
    <div style="font-size: 2.5em">RETUR PENJUALAN</div>
</div>
<div class="div-separator-20">&nbsp;</div>

<table>
    <tr>
        <td class="title-row-border left-border right-border top-border" colspan="5" >
            <div class="float-left width-12 font-bold">Nama</div>
            <div class="float-left width-1">:</div>
            <div class="float-left ">PT. EGA TEKELINDO PRIMA</div>
            <div class="clear"></div>

            <div class="div-separator-20">&nbsp;</div>
            <div class="float-left width-12 font-bold">Alamat</div>
            <div class="float-left width-1">:</div>
            <div class="float-left ">Jl. Industri Raya IV Blok AE No.7 - Bunder Cikupa Tangerang Banten - 15710</div>
            <div class="clear"></div>

            <div class="div-separator-20">&nbsp;</div>
            <div class="float-left width-12 font-bold">NPWP</div>
            <div class="float-left width-1">:</div>
            <div class="float-left ">01 320 025 8 451 001</div>
            <div class="clear"></div>
        </td>
    </tr>
    <tr>
        <td class="title-row-border left-border right-border" colspan="5">
            <div class="font-underline">CREDIT NOTE NO</div>
            <div><?php echo CHtml::encode($saleReturn->getCodeNumber(SaleReturnHeader::CN_CONSTANT)); ?></div>
        </td>
    </tr>
    <tr>
        <td class="title-row-border left-border right-border" colspan="5" >
            <div style="text-align: left;">CUSTOMER CODE : </div>
            <div class="div-separator-20">&nbsp;</div>
            <div class="float-left width-12 font-bold">Nama</div>
            <div class="float-left width-1">:</div>
            <div class="float-left "><?php echo CHtml::encode(CHtml::value($saleReturn, 'saleOrder.client_name')); ?></div>
            <div class="clear"></div>

            <div class="div-separator-20">&nbsp;</div>
            <div class="float-left width-12 font-bold">Company</div>
            <div class="float-left width-1">:</div>
            <div class="float-left "><?php echo CHtml::encode(CHtml::value($saleReturn, 'saleOrder.client_company')); ?></div>
            <div class="clear"></div>
            <div class="div-separator-20">&nbsp;</div>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="title-row-border left-border">Purchase Order No.</td>
        <td class="title-row-border"><?php echo CHtml::encode(CHtml::value($saleReturn, 'saleOrder.work_order_number')); ?></td>
        <td class="title-row-border right-border" colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" class="title-row-border left-border">So Ref No.</td>
        <td class="title-row-border"><?php echo CHtml::encode($saleReturn->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?></td>
        <td class="title-row-border right-border" colspan="2">Syarat Pembayaran : </td>
    </tr>
    <tr>
        <td class="title-row-border left-border" style="text-align: center;">No</td>
        <td class="title-row-border" style="text-align: center;">Jumlah Barang</td>
        <td class="title-row-border" style="text-align: center;">Uraian Barang</td>
        <td class="title-row-border" style="text-align: center;">Harga Satuan</td>
        <td class="title-row-border right-border" style="text-align: center;">Jumlah Harga</td>
    </tr>
    <?php $nomor = 1; ?>
    <?php foreach ($saleReturn->saleReturnDetails as $i => $detail): ?>
        <tr>
            <td style="text-align: center;border-left: 2px solid; border-right: 1px solid;"><?php echo $nomor; ?></td>
            <td style="text-align: right; border-left: 1px solid; border-right: 1px solid;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
            <td style="text-align: left; border-left: 1px solid; border-right: 1px solid;"><?php echo CHtml::encode(CHtml::value($detail, 'item_description')); ?></td>
            <td style="text-align: right; border-left: 1px solid; border-right: 1px solid;">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unit_price'))); ?>
            </td>
            <td style="text-align: right; border-left: 1px solid; border-right: 2px solid;">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total'))); ?>
            </td>
        </tr>
        <?php $nomor++; ?>
    <?php endforeach; ?>
    <?php for ($j = 12, $i = $i % $j + 1; $j > $i; $j--): ?>
        <tr>
            <td style="text-align: center;border-left: 2px solid; border-right: 1px solid;">&nbsp;</td>
            <td style="text-align: center;border-left: 1px solid; border-right: 1px solid;">&nbsp;</td>
            <td style="text-align: center;border-left: 1px solid; border-right: 1px solid;">&nbsp;</td>
            <td style="text-align: center;border-left: 1px solid; border-right: 1px solid;">&nbsp;</td>
            <td style="text-align: center;border-left: 1px solid; border-right: 2px solid;">&nbsp;</td>

        </tr>
    <?php endfor; ?>
    <tr>
        <td colspan="3" class="title-row-border left-border top-border" style="text-align: left; border-bottom: 0px solid;">Terbilang</td>
        <td class="title-row-border top-border" style="text-align: right;">Sub Total</td>
        <td class="title-row-border right-border top-border" style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($saleReturn, 'subTotal')))); ?></td>
    </tr>
    <tr>
        <td colspan="3" class="title-row-border left-border" style="text-align: left; border-top: 0px solid; border-bottom: 0px solid;"></td>
        <td class="title-row-border" style="text-align: right;">Discount</td>
        <td class="title-row-border right-border" style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($saleReturn, 'discount')))); ?></td>
    </tr>
    <tr>
        <td colspan="3" class="title-row-border left-border " style="text-align: left; border-top: 0px solid; border-bottom: 0px solid;"></td>
        <td class="title-row-border" style="text-align: right;">PPN (VAT) 10% </td>
        <td class="title-row-border" style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($saleReturn, 'taxTotal')))); ?></td>
    </tr>
    <tr>
        <td colspan="3" class="title-row-border left-border" style="text-align: left; border-top: 0px solid; border-bottom: 1px solid;"></td>
        <td class="title-row-border" style="text-align: right;">GrandTotal</td>
        <td class="title-row-border" style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($saleReturn, 'grandTotal')))); ?></td>
    </tr>
    <tr>
        <td colspan="2" class="title-row-border left-border" style="text-align: left; border-bottom: 0px solid;">
            <div class="div-separator-20">&nbsp;</div>
            1. Persyaratan harus disesuaikan dengan Kontrak/PO
        </td>
        <td class="title-row-border" style="text-align: left; border-bottom: 0px solid;">
            <div class="div-separator-20">&nbsp;</div>
            Pemesan
        </td>
        <td class="title-row-border right-border" colspan="2" style="text-align: left; border-bottom: 0px solid;">
            <div class="div-separator-20">&nbsp;</div>
            Atas Nama,
        </td>
    </tr>
    <tr>
        <td colspan="2" class="side-border left-border" style="text-align: left;"></td>
        <td class="side-border" style="text-align: left;">	</td>
        <td class="side-border right-border" colspan="2" style="text-align: left;">
            PT. EGA TEKELINDO PRIMA
        </td>
    </tr>
    <tr>
        <td colspan="2" class="side-border left-border" style="text-align: left;">2. Cara Pembayaran dengan cek/Giro dianggap sah</td>
        <td class="side-border" style="text-align: left;">Disetujui Tgl :</td>
        <td class="side-border right-border" colspan="2" style="text-align: left;"></td>
    </tr>
    <tr>
        <td colspan="2" class="side-border left-border" style="text-align: left;">setelah diadakan clearing atas nama PT.EGA</td>
        <td class="side-border" style="text-align: left;"></td>
        <td class="side-border right-border" colspan="2" style="text-align: left;"></td>
    </tr>
    <tr>
        <td colspan="2" class="side-border left-border" style="text-align: left;">&nbsp;</td>
        <td class="side-border" style="text-align: left;"></td>
        <td class="side-border right-border" colspan="2" style="text-align: left;"></td>
    </tr>
    <tr>
        <td colspan="2" class="side-border left-border" style="text-align: left;">3. Barang yang telah dibeli tidak dapat dikembalikan</td>
        <td class="side-border" style="text-align: left;"></td>
        <td class="side-border right-border" colspan="2" style="text-align: left;"></td>
    </tr>
    <tr>
        <td colspan="2" class="side-border left-border" style="text-align: left;">&nbsp;</td>
        <td class="side-border" style="text-align: left;"></td>
        <td class="side-border right-border" colspan="2" style="text-align: left;"></td>
    </tr>
    <tr>
        <td colspan="2" class="side-border left-border" style="text-align: left;">&nbsp;</td>
        <td class="side-border" style="text-align: left;">___________________</td>
        <td class="side-border right-border" colspan="2" style="text-align: left;">(Ir. Suhartono Hadiwarsito)</td>
    </tr>
    <tr>
        <td colspan="2" class="side-border left-border" style="text-align: left;">&nbsp;</td>
        <td class="side-border" style="text-align: left;">Cap Perusahaan</td>
        <td class="side-border right-border" colspan="2" style="text-align: left;"></td>
    </tr>
    <tr>
        <td colspan="2" class="side-border bottom-border left-border" style="text-align: left;">&nbsp;</td>
        <td class="side-border bottom-border" style="text-align: left;"></td>
        <td class="side-border bottom-border right-border bottom-border" colspan="2" style="text-align: left;"></td>
    </tr>
</table>


