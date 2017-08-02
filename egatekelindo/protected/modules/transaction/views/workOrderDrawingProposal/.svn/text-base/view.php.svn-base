<?php
Yii::app()->clientScript->registerCss('_memo', '
    table, td, th {
        border: 1px solid black;
    } 
');
?>

<h3>Panel : <?php echo CHtml::encode(CHtml::value($workOrderDrawingProposal->header->saleOrderDetail, 'panel_name')) ?></h3>
<br/><h3>Proposal SPK Gambar</h3>
<table style="width: 50%;border-collapse: collapse;">
    <tr>
        <th width="5%">No</th>
        <th width="45%">Kirim ke Proyek</th>
        <th width="45%">Kembali ke OHD</th>
    </tr>
    <?php foreach ($workOrderDrawingProposal->details as $i => $detail): ?>
        <tr>
            <td style="text-align: center"><?php echo $i + 1; ?></td>
            <td><?php echo Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($detail, 'date_delivery'))); ?></td>
            <td><?php echo Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($detail, 'date_return'))); ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<div id="link">
    <?php echo CHtml::link('Back', array('workOrderDrawing/view', 'id' => $workOrderDrawingProposal->header->work_order_drawing_header_id)); ?>
</div>