<!--<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Panel</th>
        <th></th>
    </tr>
    
<?php //foreach($budget->panels as $i => $panel): ?>
        <tr style="background-color: azure">
            <td> <?php //echo CHtml::encode(CHtml::value($panel,'panel_name'));    ?></td>
            <td><?php //echo CHtml::encode(CHtml::value($panel,'status'));    ?></td>
        </tr>
<?php // endforeach; ?> 
     
</table>-->

<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Panel</th>
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Quantity</th>
        <th style="text-align: center">Unit Price</th>
        <th style="text-align: center">Accesories Main</th>
        <th style="text-align: center">Accesories Secondary</th>
        <th style="text-align: center">Total</th>
    </tr>

    <?php $lastId = ''; ?>
    <?php foreach ($budget->details as $i => $detail): ?>
        <?php $panelId = CHtml::value($detail, 'estimationComponent.estimation_panel_id'); ?>

        <?php if ($lastId !== $panelId && $lastId !== ''): ?>
            <tr>
                <td colspan="7" style="border-top: thin solid ; background-color: azure;"></td>
            </tr>
        <?php endif; ?>

        <tr style="background-color: azure">
            <td>
                <?php if ($lastId !== $panelId): ?>
                    <?php echo CHtml::encode(CHtml::value($detail, 'estimationComponent.estimationPanel.panel_name')); ?>
                <?php endif; ?>
            </td>
            <td style="text-align: left">
                <?php echo CHtml::activeHiddenField($detail, "[$i]estimation_component_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'estimationComponent.component.name')); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'estimationComponent.quantity')); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'estimationComponent.unit_price')); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'estimationComponent.accesoriesIdMain.type')); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'estimationComponent.accesoriesIdSecondary.type')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'estimationComponent.total'))); ?></td>
        </tr>
        <?php $lastId = $panelId; ?>
    <?php endforeach; ?> 
    <tr style="background-color: aquamarine">
        <td style="text-align: right; font-weight: bold" colspan="6">Sub Total:</td>
        <td style="text-align: right; font-weight: bold">

            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', ($budget->header->estimationHeader) ? $budget->header->estimationHeader->subTotal : 0)); ?>
        </td>
    </tr>
</table>
