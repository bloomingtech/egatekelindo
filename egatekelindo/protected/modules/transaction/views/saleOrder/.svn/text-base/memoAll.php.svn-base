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

<div class="div-separator-20">&nbsp;</div>
<div class="div-separator-20">&nbsp;</div>

<div class="float-left width-12 font-bold">PROJECT</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php echo CHtml::encode(CHtml::value($saleOrder, 'project_name')); ?></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">CLIENT</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php echo CHtml::encode(CHtml::value($saleOrder, 'client_name')); ?></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">SO</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php echo CHtml::encode($saleOrder->getNumber(SaleOrder::CN_CONSTANT)); ?></div>
<div class="clear"></div>
<br/>
<table class="memo">
    <tr id="theader">
        <th rowspan="2" style="vertical-align: middle">No</th>
        <th rowspan="2" style="vertical-align: middle">Nama Panel</th>
        <th rowspan="2" style="vertical-align: middle">Unit</th>
        <th colspan="4">SPK GAMBAR</th>
        <?php for ($i = 1; $i <= $maxCounterProposal; $i++) : ?>
            <th colspan="2">Pengajuan ke-<?php echo $i; ?></th>
        <?php endfor; ?>
        <?php for ($i = 1; $i <= $maxCounterRevision; $i++) : ?>
            <th colspan="3">Revisi</th>
        <?php endfor; ?>
        <th rowspan="2" style="vertical-align: middle">Status</th>
        <th colspan="2">SPK PRODUKSI</th>
        <th rowspan="2" style="vertical-align: middle">Status Produksi</th>
        <th rowspan="2" style="vertical-align: middle">Target Kirim</th>
        <th rowspan="2" style="vertical-align: middle">Pengiriman Aktual</th>
        <th colspan="3">REQUIREMENT</th>
        <th colspan="3">REQUIREMENT CU</th>
        <th colspan="3">Harga & Bobot</th>
        <th colspan="2">Keterangan</th>
    </tr>
    <tr id="theader">
        <th>No.</th>
        <th>Tanggal</th>
        <th>Deadline</th>
        <th>Keluar</th>
        <?php for ($i = 1; $i <= $maxCounterProposal; $i++) : ?>
            <th>Kirim ke Proyek</th>
            <th>Kembali ke OHD</th>
        <?php endfor; ?>

        <?php for ($i = 1; $i <= $maxCounterRevision; $i++) : ?>
            <th>Tanggal</th>
            <th>Target</th>
            <th>Real</th>
        <?php endfor; ?>

        <th>No</th>
        <th>Tanggal</th>
        <th>Status Req</th>
        <th>No.Req</th>
        <th>Tanggal</th>
        <th>Status Req</th>
        <th>No.Req</th>
        <th>Tanggal</th>
        <th>Harga Satuan</th>
        <th>Harga Total</th>
        <th>Bobot</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($saleOrder->saleOrderDetails as $i => $saleOrderDetail) : ?>
        <tr class="titems">
            <td><?php echo $i + 1; ?></td>
            <td><?php echo CHtml::encode(CHtml::value($saleOrderDetail, 'panel_name')); ?></td>
            <td><?php echo CHtml::encode(CHtml::value($saleOrderDetail, 'quantity')); ?></td>

            <?php $workOrderDrawingDetail = WorkOrderDrawingDetail::model()->findByAttributes(array('sale_order_detail_id' => $saleOrderDetail->id)) ?>
            <?php if ($workOrderDrawingDetail): ?>
                <td><?php echo CHtml::encode(CHtml::value($workOrderDrawingDetail, 'workOrderDrawingHeader.cn_ordinal')); ?></td>
                <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($workOrderDrawingDetail, 'workOrderDrawingHeader.date')))); ?></td>
                <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($workOrderDrawingDetail, 'finish_date')))); ?></td>
                <td></td>

                <?php $workOrderDrawingProposals = WorkOrderDrawingProposal::model()->findAllByAttributes(array('work_order_drawing_detail_id' => $workOrderDrawingDetail->id)); ?>
                <?php foreach ($workOrderDrawingProposals as $workOrderDrawingProposal) : ?>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($workOrderDrawingProposal, 'date_delivery')))); ?></td>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($workOrderDrawingProposal, 'date_return')))); ?></td>
                <?php endforeach; ?>
                <?php $remainingColumn = $maxCounterProposal - count($workOrderDrawingProposals); ?>
                <?php for ($i = 1; $i <= $remainingColumn; $i++) : ?>
                    <td></td>
                    <td></td>
                <?php endfor; ?>

                <?php $workOrderDrawingRevisions = WorkOrderDrawingRevision::model()->findAllByAttributes(array('work_order_drawing_detail_id' => $workOrderDrawingDetail->id)); ?>
                <?php foreach ($workOrderDrawingRevisions as $workOrderDrawingRevisions) : ?>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($workOrderDrawingRevisions, 'date_revised')))); ?></td>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($workOrderDrawingRevisions, 'date_target')))); ?></td>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($workOrderDrawingRevisions, 'date_real')))); ?></td>
                <?php endforeach; ?>
                <?php $remainingColumn = $maxCounterRevision - count($workOrderDrawingRevisions); ?>
                <?php for ($i = 1; $i <= $remainingColumn; $i++) : ?>
                    <td></td>
                    <td></td>
                    <td></td>
                <?php endfor; ?>
            <?php endif; ?>
            <td></td>
            <?php
            $criteria = new CDbCriteria();
            $criteria->with = 'workOrderDrawingDetail';
            $criteria->condition = 'workOrderDrawingDetail.sale_order_detail_id = :saleOrderDetailId';
            $criteria->params = array(':saleOrderDetailId' => $saleOrderDetail->id);
            ?>
            <?php $workOrderProductionDetail = WorkOrderProductionDetail::model()->find($criteria); ?>
            <?php if ($workOrderProductionDetail): ?>
                <td><?php echo CHtml::encode(CHtml::value($workOrderProductionDetail, 'workOrderProductionHeader.cn_ordinal')); ?></td>
                <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($workOrderProductionDetail, 'workOrderProductionHeader.date')))); ?></td>
                <td></td>
                <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($workOrderProductionDetail, 'delivery_date')))); ?></td>

                <td></td>
                <?php $requirementHeaders = RequirementHeader::model()->findAllByAttributes(array('is_component' => 1, 'work_order_production_header_id' => $workOrderProductionDetail->work_order_production_header_id)); ?>
                <?php
                $ordinal = '';
                $dates = '';
                foreach ($requirementHeaders as $i => $requirementHeader) :
                    if ($i == 0) {
                        $ordinal .= CHtml::encode(CHtml::value($requirementHeader, 'cn_ordinal'));
                        $dates .= CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($requirementHeader, 'date'))));
                    } else {
                        $ordinal .= ', ' . CHtml::encode(CHtml::value($requirementHeader, 'cn_ordinal'));
                        $dates .= ', ' . CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($requirementHeader, 'date'))));
                    }
                    ?>
                    <?php $ordinal .= '' ?>
                <?php endforeach; ?>

                <td></td>
                <td><?php echo $ordinal; ?></td>
                <td><?php echo $dates; ?></td>
                <?php $requirementHeaders = RequirementHeader::model()->findAllByAttributes(array('is_component' => 0, 'work_order_production_header_id' => $workOrderProductionDetail->work_order_production_header_id)); ?>
                <?php
                $ordinal = '';
                $dates = '';
                foreach ($requirementHeaders as $i => $requirementHeader) :
                    if ($i == 0) {
                        $ordinal .= CHtml::encode(CHtml::value($requirementHeader, 'cn_ordinal'));
                        $dates .= CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($requirementHeader, 'date'))));
                    } else {
                        $ordinal .= ', ' . CHtml::encode(CHtml::value($requirementHeader, 'cn_ordinal'));
                        $dates .= ', ' . CHtml::encode(Yii::app()->dateFormatter->format('dd-MMM-yy', strtotime(CHtml::value($requirementHeader, 'date'))));
                    }
                    ?>
                    <?php $ordinal .= '' ?>
                <?php endforeach; ?>
                <td></td>
                <td><?php echo $ordinal; ?></td>
                <td><?php echo $dates; ?></td>
            <?php else: ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <?php endif; ?>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($saleOrderDetail, 'unit_price'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($saleOrderDetail, 'total'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $saleOrderDetail->getPercentage())); ?>%</td>
            <td></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
</table>