<table style="border: 1px solid; width: 30%">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Currency</th>
        <th style="text-align: center; ">Value</th>
    </tr>
    <?php foreach ($budget->budgetingCurrencies as $i => $detail): ?>
        <tr style="background-color: azure">
            <td>
                <?php echo CHtml::activeHiddenField($detail, "[$i]currency_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'currency.name')); ?>
            </td>

            <td style="text-align: center; ">
                <?php echo CHtml::activeTextField($detail, "[$i]value", array('size' => 5, 'maxlength' => 20)); ?>
                <?php echo CHtml::error($detail, 'value'); ?>
            </td>
        </tr>
    <?php endforeach; ?> 
</table>