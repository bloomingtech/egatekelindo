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
    
    .div-70 {width:70%; float:left}
    .div-30 {widht 30%; float:left}
    .div-50 {width:50%; float:left}
    
    .table-border {border-collapse:collapse}
    
    table, tr, td, th {border:1px solid}
    th {text-align:center;}
');
?>

<div>PT EGA TEKELINDO PRIMA</div>
<div>RINCIAN PERUBAHAN/PENAMBAHAN KOMPONEN</div>
<br/>
<table>
    <tr>
        <th>Nama Client</th>
        <th><?php echo CHtml::encode(CHtml::value($requirement->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'client_company')); ?></th>
        <th>No S.O</th>
        <th><?php echo CHtml::encode($requirement->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)); ?></th>
    </tr>
    <tr>
        <th>Nama Project</th>
        <th><?php echo CHtml::encode(CHtml::value($requirement->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'project_name')); ?></th>
        <th>No. Req</th>
        <th><?php echo CHtml::encode($requirement->getCodeNumber($requirement->cnConstant)); ?></th>
    </tr>
</table>

<div class="div-50">
    <table class="table-border">
        <tr>
            <th rowspan="2" style="vertical-align: middle">No</th>
            <th rowspan="2" style="vertical-align: middle">Nama Panel</th>
            <th colspan="6">SPESIFIKASI LAMA</th>
        </tr>
        <tr>
            <th>Nama Komponen</th>
            <th>Merk</th>
            <th>Type</th>
            <th>Qty</th>
            <th>Harga(Sat)</th>
            <th>Total(Rp.)</th>

        </tr>
        <?php foreach ($requirement->requirementDetails as $j => $requirementDetail): ?>
            <?php foreach ($requirementDetail->requirementDetailComponents as $i => $component): ?>
                <tr>
                    
                    <?php if ($i == 0): ?>
                        <td rowspan="<?php echo count($requirementDetail->requirementDetailComponents) ?>" style="text-align: center; vertical-align: top"><?php echo $j + 1; ?></td>
                        <td rowspan="<?php echo count($requirementDetail->requirementDetailComponents) ?>" style="vertical-align: top">
                            <?php echo CHtml::encode(CHtml::value($requirementDetail, 'saleOrderDetail.panel_name')); ?>
                        </td>
                    <?php endif; ?>
                    <td><?php echo CHtml::encode(CHtml::value($component, 'component_name')); ?></td>
                    <td><?php echo CHtml::encode($component->getTypeString()); ?></td>
                    <td><?php echo CHtml::encode($component->getBrandString()); ?></td>
                    <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($component, 'quantity'))); ?></td>
                    <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($component, 'unit_price'))); ?></td>
                    <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($component, 'total'))); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>
</div>

<div class="div-50">
    <table class="table-border">
        <tr>  
            <th rowspan="2" style="vertical-align: middle">No</th>
            <th rowspan="2" style="vertical-align: middle">Nama Panel</th>
            <th colspan="6">SPESIFIKASI BARU</th>
        </tr>
        <tr>
            <th>Nama Komponen</th>
            <th>Merk</th>
            <th>Type</th>
            <th>Qty</th>
            <th>Harga(Sat)</th>
            <th>Total(Rp.)</th>

        </tr>
        <?php foreach ($requirement->requirementDetails as $j=>$requirementDetail): ?>
            <?php foreach ($requirementDetail->requirementDetailAdditionals as $i => $detail): ?>
                <tr>
                   
                    <?php if ($i == 0): ?>
                        <td rowspan="<?php echo count($requirementDetail->requirementDetailAdditionals) ?>"style="text-align: center; vertical-align: top"><?php echo $j + 1; ?></td>
                        <td rowspan="<?php echo count($requirementDetail->requirementDetailAdditionals) ?>" style="vertical-align: top">
                            <?php echo CHtml::encode(CHtml::value($requirementDetail, 'saleOrderDetail.panel_name')); ?>
                        </td>
                    <?php endif; ?>
                    <td><?php echo CHtml::encode(CHtml::value($detail, 'component.name')); ?><?php echo CHtml::encode(CHtml::value($detail, 'componentCu.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($detail, 'component.brand.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($detail, 'component.type')); ?></td>
                    <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'quantity'))); ?></td>
                    <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unit_price'))); ?></td>
                    <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total'))); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>
</div>
<div class="clear"></div>

<table>
    <tr>
        <td width="35%" style="text-align: center;">Sub Total Spesifikasi Lama</td>
        <td width="15%" style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($requirement, 'subTotalComponent'))); ?></td>
        <td width="35%" style="text-align: center;">Sub Total Spesifikasi Baru</td>
        <td width="15%" style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($requirement, 'subTotalAdditional'))); ?></td>
    </tr>
</table>
<br/>
<table style="border: 0px solid;">
    <tr>
        <td width="50%" style="text-align: right;border: 0px solid;"> Total Nilai Perubahan</td>
        <td width="20%" style="text-align: left;border: 0px solid;">    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($requirement, 'subTotalAdditional'))); ?> - <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($requirement, 'subTotalComponent'))); ?> = <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($requirement, 'subTotalDifference'))); ?></td>
        <td width="30%" style="text-align: left;border: 0px solid;">(Exc, PPn 10%)</td>
    </tr>
</table>

