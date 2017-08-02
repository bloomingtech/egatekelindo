<?php
Yii::app()->clientScript->registerCss('_memo', '
    table, td, th {
        border: 1px solid black;
    } 
');
?>

<h3>Panel : <?php echo CHtml::encode(CHtml::value($workOrderDrawingRevision->header->saleOrderDetail, 'panel_name')) ?></h3>
<br/><h3>Revisi SPK Gambar</h3>
<table style="width: 50%;border-collapse: collapse;">
    <tr>
        <th width="5%">No</th>
        <th width="30%">Tanggal</th>
        <th width="30%">Target</th>
        <th width="30%">Real</th>
    </tr>
    <?php foreach ($workOrderDrawingRevision->details as $i => $detail): ?>
        <tr>
            <td><?php echo $i + 1; ?></td>
            <td><?php echo Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($detail, 'date_revised'))); ?></td>
            <td><?php echo Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($detail, 'date_target'))); ?></td>
            <td><?php echo Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($detail, 'date_real'))); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div id="link">
    <?php echo CHtml::link('Back', array('workOrderDrawing/view', 'id' => $workOrderDrawingRevision->header->work_order_drawing_header_id)); ?>
</div>