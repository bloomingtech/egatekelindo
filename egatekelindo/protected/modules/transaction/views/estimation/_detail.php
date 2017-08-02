<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center; ">Brand</th>
        <th style="text-align: center; ">Value 1</th>
        <th style="text-align: center; ">Value 2</th>
        <th style="text-align: center; ">Value 3</th>
        <th style="text-align: center; ">Currency Rate</th>
    </tr>
    <?php
    $estimationDetails = $estimation->details; 
    usort($estimationDetails, function ($a, $b) {
                if ($a['isPrimary'] == $b['isPrimary'])
                    return 0;
                return ($a['isPrimary'] < $b['isPrimary']) ? 1 : -1;
            });
    ?>
    <?php $currentIsPrimary = NULL; ?>
    <?php foreach ($estimationDetails as $i => $detail): ?>
        <?php if ($detail->isPrimary != $currentIsPrimary && $currentIsPrimary != NULL) : ?>
            <tr style="background-color: azure">
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr style="background-color: azure">
                <td colspan="5" style="border-bottom: 1px solid;font-weight: bold;">Komponen Pendukung</td>
            </tr>
        <?php endif; ?>
        <?php if ($currentIsPrimary == NULL): ?>
            <tr style="background-color: azure">
                <td colspan="5" style="border-bottom: 1px solid;font-weight: bold;">Komponen Utama</td>
            </tr>
        <?php endif; ?>
        <tr style="background-color: azure">
            <td>
                <?php echo CHtml::activeTextField($detail, "[$i]name", array('size' => 60, 'maxlength' => 60)); ?>
                <?php echo CHtml::error($detail, 'name'); ?>
                <?php //echo CHtml::encode(CHtml::value($detail, 'componentBrandDiscount.componentBrand.name')); ?>
            </td>

            <td style="text-align: center; ">
                <?php echo CHtml::activeHiddenField($detail, "[$i]component_brand_discount_id"); ?>
                <?php echo CHtml::activeTextField($detail, "[$i]value_1", array('size' => 5, 'maxlength' => 20)); ?>
                <?php echo CHtml::error($detail, 'value_1'); ?>
            </td>

            <td style="text-align: center; ">
                <?php echo CHtml::activeTextField($detail, "[$i]value_2", array('size' => 5, 'maxlength' => 20)); ?>
                <?php echo CHtml::error($detail, 'value_2'); ?>
            </td>

            <td style="text-align: center; ">
                <?php echo CHtml::activeTextField($detail, "[$i]value_3", array('size' => 5, 'maxlength' => 20)); ?>
                <?php echo CHtml::error($detail, 'value_3'); ?>
            </td>

            <td style="text-align: center; ">
                <?php //echo CHtml::activeHiddenField($detail, "[$i]currency_id"); ?>
                <?php echo CHtml::activeDropDownList($detail, "[$i]estimation_currency_id", CHtml::listData(Currency::model()->findAll(), 'id', 'name'), array('empty' => 'Select Currency')); ?>
                <?php //echo CHtml::encode(CHtml::value($detail, 'currentRate')); ?>
            </td>
        </tr>
        <?php $currentIsPrimary = $detail->isPrimary; ?>
    <?php endforeach; ?> 

</table>