<?php
$this->breadcrumbs = array(
    'requirement' => array('/transaction/requirement/admin'),
    'view',
);
?>

<h1>
    <?php echo $this->id . '/' . $this->action->id; ?>
</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $requirement,
    'attributes' => array(
        array(
            'label' => 'Requirement #',
            'value' => CHtml::encode($requirement->getCodeNumber($requirement->cnConstant)),
        ),
        array(
            'label' => 'Tanggal',
            'value' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', CHtml::value($requirement, 'date'))),
        ),
        array(
            'label' => 'Note',
            'value' => CHtml::encode(CHtml::value($requirement, 'note'))
        ),
    ),
));
?>

<br/>
<h3>Panel Name : <?php echo $requirementDetail->saleOrderDetail->panel_name; ?></h3>
<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Component Name</th>
        <th style="text-align: center; width: 15%">Type</th>
        <th style="text-align: center; width: 15%">Brand</th>
        <th style="text-align: center; width: 10%">Quantity</th>
        <th style="text-align: center">Memo</th>
		<th style="text-align: center; width: 10%">Stock?</th>
    </tr>
    <?php foreach ($detailDataProvider->data as $detail) : ?>
        <?php if ($detail->is_inactive == 0): ?>
            <tr>
                <td><?php echo CHtml::encode(CHtml::value($detail, 'component_name')); ?></td>
                <td><?php echo CHtml::encode($detail->getTypeString()); ?></td>
                <td><?php echo CHtml::encode($detail->getBrandString()); ?></td>
                <td style="text-align: center;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'quantity'))); ?></td>
                <td><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
				<td style="text-align: center;"><?php echo CHtml::encode($detail->getStockStatus()); ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>

</table>

<br/>
<div id="link">
    <?php echo CHtml::link('Back', array('requirement/view', 'id' => $requirement->id)); ?>
</div>
