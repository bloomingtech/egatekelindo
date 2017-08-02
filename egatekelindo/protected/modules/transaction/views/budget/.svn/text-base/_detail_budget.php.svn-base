<br/>
<h3>Panel Name : <?php echo $saleOrderDetail->panel_name; ?></h3>
<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th>Component Name</th>
        <th>Type</th>
        <th>Brand</th>
        <th>Accesories Phase Value</th>
        <th style="text-align: right;">Quantity</th>
        <th style="text-align: right;">Unit Price</th>
        <th style="text-align: right;">Total</th>
        <th style="text-align: center;"></th>
    </tr>
    <?php foreach ($detailDataProvider->data as $i => $detail) : ?>
        <tr>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'component_name')); ?></td>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'type')); ?></td>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'brand_name')); ?></td>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'accessories_phase_value')); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unit_price'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total'))); ?></td>
            <td style="text-align: center; ">  
                <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                <?php
                //echo CHtml::activeDropDownList($detail, "[$i]budgeting_brand_discount_id", CHtml::listData(BudgetingBrandDiscount::model()->resetScope()->findAllByAttributes(array('budgeting_header_id' => $budget->id), array('order' => 'name ASC')), 'id', 'name'), array('empty' => 'Select'));
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="6" style="text-align: right; font-weight: bold;border-top:1px solid;">Sub Total</td>
        <td style="text-align: right; font-weight: bold;border-top:1px solid;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $budget->getSubTotal($saleOrderDetail->id))); ?></td>
        <td style="border-top:1px solid;">&nbsp;</td>
    </tr>
</table>

<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th>Component Name</th>
        <th>Type</th>
        <th>Brand</th>
        <th style="text-align: right;">Weight</th>
        <th style="text-align: right;">Quantity</th>
        <th style="text-align: right;">Unit Price</th>
        <th style="text-align: right;">Total</th>
        <th style="text-align: center;">Brand Discount</th>
    </tr>
    <?php foreach ($budgetingDetailAccesories->data as $i => $detail) : ?>
        <tr>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'component_name')); ?></td>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'type')); ?></td>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'brand_name')); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'weight'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unit_price'))); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total'))); ?></td>
            <td style="text-align: center; ">  
                <?php
                echo CHtml::activeDropDownList($detail, "[$i]budgeting_brand_discount_id", CHtml::listData(BudgetingBrandDiscount::model()->resetScope()->findAllByAttributes(array('budgeting_header_id' => $budget->id), array('order' => 'name ASC')), 'id', 'name'), array('empty' => 'Select'));
                ?>
            </td>

        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="6" style="text-align: right; font-weight: bold;border-top:1px solid;">Total Accesories</td>
        <td style="text-align: right; font-weight: bold;border-top:1px solid;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $budget->getTotalAccesories($saleOrderDetail->id))); ?></td>
        <td style="border-top:1px solid;">&nbsp;</td>
    </tr>
<!--    <tr>
        <td colspan="5" style="text-align: right; font-weight: bold;">Total CU</td>
        <td style="text-align: right; font-weight: bold;"><?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $budget->getTotalCu($saleOrderDetail->id)));             ?></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: right; font-weight: bold;">Total Wiring</td>
        <td style="text-align: right; font-weight: bold;"><?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $budget->getTotalWiring($saleOrderDetail->id)));             ?></td>
    </tr>-->
</table>