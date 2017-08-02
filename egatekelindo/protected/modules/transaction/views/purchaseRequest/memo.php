<?php
//$sale as SaleHeader model

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

<table>
    <tr>
        <td colspan="2" rowspan="4" style="text-align: center; font-weight: bold;">PT EGA TEKELINDO PRIMA</td>
        <td colspan="4" rowspan="2" style="text-align: center; font-weight: bold">PURCHASE REQUEST</td>
        <td>No Dokumen</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>No Revisi</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="4" rowspan="2" style="font-weight: bold;text-align: center; text-transform: uppercase">
            <?php echo CHtml::encode(CHtml::value($purchaseRequest, 'transactionType')); ?>
        </td>
        <td>Tanggal Terbit</td>
        <td width="10%">&nbsp;</td>
    </tr>
    <tr>
        <td>Halaman</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8" style="border-bottom: 2px solid transparent !important; text-align: center; font-weight: bold">
            PEKERJAAN: <?php echo CHtml::encode(CHtml::value($purchaseRequest, 'job.name')); ?>
        </td>
    </tr>
    <tr>
        <td colspan="8" style="border-top: 2px solid transparent !important; border-bottom: 2px solid transparent !important;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 10%; border-right: 2px solid transparent !important">Nama Klien</td>
        <td style="border-right: 2px solid transparent !important" colspan="2">: <?php echo CHtml::encode(CHtml::value($purchaseRequest, 'workOrderProductionHeader.workOrderDrawingHeader.budgetingHeader.saleOrderHeader.client_company')); ?></td>
        <td style="border-right: 2px solid transparent !important" colspan="2">&nbsp;</td>
        <td style="border-right: 2px solid transparent !important">Tanggal Request</td>
        <td colspan="2">: <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", $purchaseRequest->date)); ?></td>
    </tr>
    <tr>
        <td style="width: 10%; border-top: 2px solid transparent !important; border-right: 2px solid transparent !important">SO #</td>
        <td style="border-top: 2px solid transparent !important; border-right: 2px solid transparent !important" colspan="2">: <?php echo CHtml::encode($purchaseRequest->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)); ?></td>
        <td style="border-top: 2px solid transparent !important; border-right: 2px solid transparent !important" colspan="2">SPK: <?php echo CHtml::encode($purchaseRequest->workOrderProductionHeader->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT)); ?></td>
        <td style="border-top: 2px solid transparent !important; border-right: 2px solid transparent !important">Departemen</td>
        <td style="border-top: 2px solid transparent !important" colspan="2">: <?php echo CHtml::encode(CHtml::value($purchaseRequest, 'department.name')); ?></td>
    </tr>
    <tr>
        <td style="width: 10%; border-top: 2px solid transparent !important; border-right: 2px solid transparent !important">Nama Proyek</td>
        <td style="border-top: 2px solid transparent !important; border-right: 2px solid transparent !important" colspan="2">: <?php echo CHtml::encode(CHtml::value($purchaseRequest, 'workOrderProductionHeader.workOrderDrawingHeader.budgetingHeader.saleOrderHeader.project_name')); ?></td>
        <td style="border-top: 2px solid transparent !important; border-right: 2px solid transparent !important" colspan="2">&nbsp;</td>
        <td style="border-top: 2px solid transparent !important; border-right: 2px solid transparent !important">Request #</td>
        <td style="border-top: 2px solid transparent !important" colspan="2">: <?php echo CHtml::encode($purchaseRequest->getCodeNumber(PurchaseRequestHeader::CN_CONSTANT)); ?></td>
    </tr>
    <tr>
        <td colspan="5" style="border-top: 2px solid transparent !important; border-right: 2px solid transparent !important;">&nbsp;</td>
        <td style="border-top: 2px solid transparent !important; border-right: 2px solid transparent !important;">Kode Pembelian</td>
        <td colspan="2" style="border-top: 2px solid transparent !important;">: contoh: (R/M/S/SR/SM/G/C)</td>
    </tr>
</table>

<table class="memo">
    <tr id="theader">
        <th>Nama Barang</th>
        <th style="width: 10%">PCS</th>
        <th style="width: 10%">Berat (kg)</th>
        <th style="width: 15%">NO. PO</th>
        <th style="width: 25%">Keterangan</th>
    </tr>

    <?php if ($purchaseRequest->is_service): ?> 
        <?php foreach ($purchaseRequest->purchaseRequestDetailServices as $i => $detail): ?>
            <tr class="titems">
                <td style="text-align: left"><?php echo CHtml::encode(CHtml::value($detail, 'name')); ?></td>
                <td style="text-align: center;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
                <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'weight'))); ?></td>
                <td></td>
                <td><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <?php foreach ($purchaseRequest->purchaseRequestDetailComponents as $i => $detail): ?>
            <tr class="titems">
                <td style="text-align: left"><?php echo CHtml::encode(CHtml::value($detail, 'component.name')); ?></td>
                <td style="text-align: center;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
                <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'weight'))); ?></td>
                <td></td>
                <td><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php for ($j = 10, $i = $i % $j + 1; $j > $i; $j--): ?>
        <tr class="titems">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    <?php endfor; ?>
    <tr>
        <td style="text-align: right; font-weight: bold">TOTAL</td>
        <td style="text-align: center; font-weight: bold"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', ($purchaseRequest->is_service) ? CHtml::value($purchaseRequest, 'totalQuantityService') : CHtml::value($purchaseRequest, 'totalQuantityComponent'))); ?></td>
        <td style="text-align: center; font-weight: bold"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', ($purchaseRequest->is_service) ? CHtml::value($purchaseRequest, 'totalWeightService') : CHtml::value($purchaseRequest, 'totalWeightComponent'))); ?></td>
        <td colspan="2"></td>
    </tr>
</table>

<table>
    <tr>
        <td style="border-bottom: 1px solid transparent !important">
            Catatan: <?php echo nl2br(CHtml::encode(CHtml::value($purchaseRequest, 'note'))); ?>
        </td>
        <td style="text-align: center; width: 12%">DIBUAT</td>
        <td style="text-align: center; width: 12%">DIPERIKSA I</td>
        <td style="text-align: center; width: 12%">DIPERIKSA II</td>
        <td style="text-align: center; width: 12%">DIPERIKSA III</td>
        <td style="text-align: center; width: 12%">DIKETAHUI</td>
        <td style="text-align: center; width: 12%">DISETUJUI</td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid transparent !important">TEMPAT: </td>
        <td rowspan="3"></td>
        <td rowspan="3"></td>
        <td rowspan="3"></td>
        <td rowspan="3"></td>
        <td rowspan="3"></td>
        <td rowspan="3"></td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid transparent !important">WARNA: </td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid transparent !important">DELIVERY: </td>
    </tr>
    <tr>
        <td></td>
        <td>Date:</td>
        <td>Date:</td>
        <td>Date:</td>
        <td>Date:</td>
        <td>Date:</td>
        <td>Date:</td>
    </tr>
</table>

