<?php
$this->breadcrumbs = array(
    'estimation' => array('/transaction/budget/create'),
    'view',
);
?>

<h1>
    <?php echo $this->id . '/' . $this->action->id; ?>
</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $estimation,
    'attributes' => array(
        array(
            'label' => 'Estimation #',
            'value' => CHtml::encode($estimation->getCodeNumber(EstimationHeader::CN_CONSTANT)),
        ),
        array(
            'label' => 'Tanggal',
            'value' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', CHtml::value($estimation, 'date'))),
        ),
        array(
            'label' => 'Project',
            'value' => CHtml::encode(CHtml::value($estimation, 'project_name')),
        ),
        array(
            'label' => 'Company',
            'value' => CHtml::encode(CHtml::value($estimation, 'client_company')),
        ),
        array(
            'label' => 'Name',
            'value' => CHtml::encode(CHtml::value($estimation, 'client_name')),
        ),
        array(
            'label' => 'Note',
            'value' => CHtml::encode(CHtml::value($estimation, 'note')),
        ),
    ),
));
?>

<br/>
<h3>Panel Name : <?php echo $estimationPanel->panel_name; ?></h3>
<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th>Component Name</th>
        <th>Type</th>
        <th>Merk</th>       
        <th style="text-align: right;">Quantity</th>
        <th style="text-align: right;">Unit Price</th>
        <th style="text-align: right;">Total</th>
    </tr>
    <?php foreach ($componentDataProvider->data as $detail) : ?>
        <tr>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'name')); ?></td>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'type')); ?></td>
            <td><?php echo CHtml::encode(CHtml::value($detail->brand, 'name')); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unit_price'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'totalOnly'))); ?></td>
            
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="5" style="text-align: right; font-weight: bold;border-top:1px solid;">Total Komponen</td>
        <td style="text-align: right; font-weight: bold;border-top:1px solid;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->getSubTotalComponent($estimationPanel->id))); ?></td>
     
    </tr>
</table>

<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th>Component Cu</th>
        <th style="text-align: right;">Berat</th>
        <th style="text-align: right;">Quantity</th>
        <th style="text-align: right;">Unit Price</th>
        <th style="text-align: right;">Total</th>
    </tr>
    <?php foreach ($componentAccesoriesDataProvider->data as $detail) : ?>
        <tr>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'name')); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'weight'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'quantity'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unit_price'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'totalOnly'))); ?></td>
           
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="4" style="text-align: right; font-weight: bold;border-top:1px solid;">Total CU</td>
        <td style="text-align: right; font-weight: bold;border-top:1px solid;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->getTotalAccesories($estimationPanel->id))); ?></td>
    </tr>

</table>


<br/>
<div id="link">
    <?php echo CHtml::link('Back', array('view', 'id' => $estimation->id)); ?>
</div>
