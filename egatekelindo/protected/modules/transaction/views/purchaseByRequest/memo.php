<?php

Yii::app()->clientScript->registerScript('memo', '
    $("#header").addClass("hide");
    $("#mainmenu").addClass("hide");
    $(".breadcrumbs").addClass("hide");
    $("#footer").addClass("hide");
');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/transaction/memo.css');
Yii::app()->clientScript->registerCss('memo', '
    @page {
        size:auto;
        margin: 5px 0px 0px 0px;
    } 
            
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
    
    table{
        border-collapse: collapse;
    }
      
    table, td, th {
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        padding : 5px;
    }
');
?>

<table class="memo">
    <tr>
        <td colspan="2" rowspan="4" style="text-align: center; font-weight: bold;">PT EGA TEKELINDO PRIMA</td>
        <td colspan="4" rowspan="2" style="text-align: center; font-size: larger;">SURAT PEMESANAN BARANG</td>
        <td>No Dokumen</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>No Revisi</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="4" rowspan="2" style="font-weight: bold;text-align: center; font-size: larger;">PURCHASE ORDER</td>
        <td>Tanggal Terbit</td>
        <td width="10%">&nbsp;</td>
    </tr>
    <tr>
        <td>Halaman</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8" style="border-bottom: 2px solid transparent !important;">
            PT. EGA TEKELINDO PRIMA
        </td>
    </tr>
    <tr>
        <td colspan="8" style="border-top: 2px solid transparent !important; border-bottom: 2px solid transparent !important;">
            Office : Jl. P. Jayakarta 141 Blok E No. 4, Jakarta 10730 - Indonesia, Phone: +62 21-6008081, 82, 83 & 6008742, 43, 45, Fax: +62 21-6293054, email: egatek@rad.net.id
        </td>
    </tr>
	<tr>
        <td colspan="8" style="border-bottom: 2px solid transparent !important;">
            Factory: Kawasan Industri Jatake, Jl. Industri IV Blok. AE/7, Desa Bundar, Kec. Cikupa Tangerang 15136, Phone: +62 21-59307920, 22, Fax: +62 21-59307919
        </td>
    </tr> 
    <tr>
        <td colspan="8" style="border-top: 2px solid transparent !important; border-bottom: 2px solid transparent !important; text-align: right; font-weight: bold; font-size: large">
            No : <?php echo CHtml::encode($purchase->getCodeNumber(PurchaseHeader::CN_CONSTANT)); ?>
        </td>
    </tr>
    <tr>
        <td colspan="8" style="border-top: 2px solid transparent !important; text-align: right">
            Tanggal: <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($purchase, 'date')))); ?>
        </td>
    </tr>
    <tr>
        <td colspan="4" style="border-bottom: 2px solid transparent !important;">Kepada Yth./TO : </td>
        <td colspan="4" style="border-bottom: 2px solid transparent !important;">Syarat Pembayaran / TERMS OF PAYMENT</td>
    </tr>
    <tr>
        <td colspan="4" style="border-top: 2px solid transparent !important; border-bottom: 2px solid transparent !important;">
            <?php echo CHtml::encode(CHtml::value($purchase, 'supplier.company')); ?>
        </td>
        <td colspan="4"><?php echo CHtml::encode(CHtml::value($purchase, 'payment_term')); ?></td>
    </tr>
    <tr>
        <td colspan="4" style="border-top: 2px solid transparent !important">
            <?php echo nl2br(CHtml::encode(CHtml::value($purchase, 'supplier.address'))); ?>
        </td>
        <td colspan="4" style="border-bottom: 2px solid transparent !important;">
            Tgl / Tempat Penyerahan Barang (DELIVERY TIME / PLACE):
        </td>
    </tr>
    <tr>
        <td colspan="4">Dokumen</td>
        <td colspan="4" style="border-top: 2px solid transparent !important;">
            <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($purchase, 'delivery_date')))); ?> / 
            <?php echo CHtml::encode(CHtml::value($purchase, 'delivery_place')); ?>
        </td>
    </tr>
	<tr>
        <td colspan="4" style="border-top: 2px solid transparent !important;">
            REQ: <?php echo CHtml::encode($purchase->purchaseRequestHeader->getCodeNumber(PurchaseRequestHeader::CN_CONSTANT)); ?> |
            SPK: <?php echo (empty($purchase->purchaseRequestHeader->workOrderProductionHeader)) ? 'N/A' : CHtml::encode($purchase->purchaseRequestHeader->workOrderProductionHeader->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT)); ?>
        </td>
        <td colspan="4">Proyek: <?php echo CHtml::encode(CHtml::value($purchase, 'project_name')); ?></td>
    </tr>
    <tr>
        <td style="text-align: center" width="5%">NO</td>
        <td style="text-align: center" colspan="2">Uraian / Description</td>
        <td style="text-align: center" width="5%">Quantity</td>
        <td style="text-align: center" width="15%">Harga Satuan</td>
        <td style="text-align: center" width="15%">Total Price</td>
        <td style="text-align: center" width="10%">Disc (%)</td>
        <td style="text-align: center" width="15%">NET PRICE</td>
    </tr>
    <?php foreach ($purchase->purchaseDetailRequests as $i => $detail) : ?>
        <tr>
            <td style="text-align: center;border-bottom: 1px solid transparent !important"><?php echo $i + 1; ?></td>
            <td style="border-bottom: 1px solid transparent !important" colspan="2">
                <?php if ($detail->purchase_request_detail_component_id !== null): ?>
                    <?php echo CHtml::encode(CHtml::value($detail, 'purchaseRequestDetailComponent.component.name')); ?> - 
                    <?php echo CHtml::encode(CHtml::value($detail, 'purchaseRequestDetailComponent.component.componentBrand.name')); ?> - 
                    <?php echo CHtml::encode(CHtml::value($detail, 'purchaseRequestDetailComponent.component.type')); ?>
                <?php else: ?>
                    <?php echo CHtml::encode(CHtml::value($detail, 'purchaseRequestDetailService.name')); ?>
                <?php endif; ?>
            </td>
            <td style="text-align: center;border-bottom: 1px solid transparent !important"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
            <td style="text-align: right;border-bottom: 1px solid transparent !important"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, "unitPriceAfterDiscount"))); ?></td>
            <td style="text-align: right;border-bottom: 1px solid transparent !important"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, "totalAfterDiscount"))); ?></td>
            <td style="text-align: center;border-bottom: 1px solid transparent !important">0</td>
            <td style="text-align: right;border-bottom: 1px solid transparent !important"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, "totalAfterDiscount"))); ?></td>
        </tr>
    <?php endforeach; ?>
    <?php for ($j = 31, $i = $i % $j + 1; $j > $i; $j--): ?>
        <tr>
            <td style="border-bottom: 1px solid transparent !important">&nbsp;</td>
            <td style="border-bottom: 1px solid transparent !important" colspan="2">&nbsp;</td>
            <td style="border-bottom: 1px solid transparent !important">&nbsp;</td>
            <td style="border-bottom: 1px solid transparent !important">&nbsp;</td>
            <td style="border-bottom: 1px solid transparent !important">&nbsp;</td>
            <td style="border-bottom: 1px solid transparent !important">&nbsp;</td>
            <td style="border-bottom: 1px solid transparent !important">&nbsp;</td>
        </tr>
    <?php endfor; ?>
    <tr>
        <td colspan="7" style="text-align: right; border-top: 2px solid; border-bottom: 1px solid transparent !important">SUB TOTAL</td>
        <td style="text-align: right; border-top: 2px solid; border-bottom: 1px solid transparent !important"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($purchase, "subTotalRequest"))); ?></td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: right; border-bottom: 1px solid transparent !important">PPn <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($purchase, "taxPercentage"))); ?>%</td>
        <td style="text-align: right; border-bottom: 1px solid transparent !important"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($purchase, "calculatedTaxRequest"))); ?></td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: right; font-weight: bold">GRAND TOTAL Rp. </td>
        <td style="text-align: right; font-weight: bold"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($purchase, "grandTotalRequest"))); ?></td>
    </tr>
</table>

<table class="memo" style="width: 100%">
    <tr>
        <td style="width: 30%">Lembar/SHEET :</td>
        <td style="text-align: center; width: 30%">Catatan / Notes</td>
        <td style="text-align: center; width: 30%">Hormat Kami,</td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid transparent !important">1. White: Supplier</td>
        <td style="vertical-align: top" rowspan="5"><?php echo nl2br(CHtml::encode(CHtml::value($purchase, 'note'))); ?></td>
        <td style="vertical-align: bottom; text-align: center" rowspan="5">
            Ir. Suhartono Hadiwarsito  /  Agatha Hadiwarsito <br /><br /><br />
            (Direktur Utama)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Direktur)
        </td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid transparent !important">2. Red: Finance</td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid transparent !important">3. Yellow: Purchasing</td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid transparent !important">4. Green: Accounting</td>
    </tr>
    <tr>
        <td>5. Blue: Warehouse</td>
    </tr>
</table>

<!--<div class="memosig">
    <div style="font-weight:bold; font-style: italic;" class="divtable">
        <div  class="divtablecell sig2">
            <div>Mengetahui,</div>
            <div style="height: 50px;"></div>
            <div><?php //echo CHtml::encode(CHtml::value($purchase, 'employeeIdAuthorized.name'));         ?></div>
        </div>
        <div  class="divtablecell sig3">
            <div>Disetujui,</div>
            <div style="height: 50px;"></div>
            <div><?php //echo CHtml::encode(CHtml::value($purchase, 'employeeIdApproved.name'));         ?></div>
        </div>
        <div class="divtablecell sig4">
            <div >Customer,</div>
        </div>
    </div>
</div>-->
