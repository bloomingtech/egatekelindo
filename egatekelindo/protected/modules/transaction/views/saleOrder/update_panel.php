<h3>Update Panel SO# <?php echo $saleOrder->header->getNumber(SaleOrder::CN_CONSTANT) ?></h3>
<?php echo CHtml::beginForm(); ?>
<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center; width: 10%">Panel Name</th>
        <th style="text-align: right; width: 10%">Quantity</th>
        <th style="text-align: right; width: 10%">Unit Price</th>
        <th style="text-align: right; width: 10%">Total</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>
    <?php foreach ($saleOrder->details as $i => $detail): ?>
        <tr style="background-color: azure">
            <td>
                <?php echo CHtml::activeHiddenField($detail, "[$i]sale_order_header_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'panel_name')); ?>
            </td>
            <td style="text-align: right">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?>
            </td>
            <td style="text-align: right">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unit_price'))); ?>
            </td>

            <td style="text-align: right">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total'))); ?>
            </td>
            <td>
                <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>

            </td>
        </tr>
    <?php endforeach; ?>
    <tr style="background-color: aquamarine">
        <td colspan="3" style="text-align: right;font-weight: bold">Sub Total</td>
        <td style="text-align: right;font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder->header, 'subTotal'))); ?>
        </td>
        <td>&nbsp;</td>
    </tr>

</table>
<div class="row buttons">
    <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
</div>

<?php echo CHtml::endForm(); ?>
