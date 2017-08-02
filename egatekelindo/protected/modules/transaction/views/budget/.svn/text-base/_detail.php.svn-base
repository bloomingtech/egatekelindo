<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center; width: 10%">Brand</th>
        <th style="text-align: center; width: 10%">Disc 1</th>
        <th style="text-align: center; width: 8%">Type 1</th>
        <th style="text-align: center; width: 10%">Disc 2</th>
        <th style="text-align: center; width: 8%">Type 2</th>
        <th style="text-align: center; width: 10%">Disc 3</th>
        <th style="text-align: center; width: 8%">Type 3</th>
        <th style="text-align: center; width: 10%">Disc 4</th>
        <th style="text-align: center; width: 8%">Type 4</th>
        <th style="text-align: center; width: 10%">Disc 5</th>
        <th style="text-align: center; width: 8%">Type 5</th>
    </tr>
    <?php foreach ($budget->discounts as $i => $discount): ?>
        <tr style="background-color: azure">
            <td>
                <?php echo CHtml::activeHiddenField($discount, "[$i]brand_id"); ?>
                <?php echo CHtml::encode(CHtml::value($discount, 'brand.name')); ?>
            </td>

            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($discount, 'discount_value_1')); ?></td>
            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($discount, 'type1')); ?> </td>

            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($discount, 'discount_value_2')); ?></td>
            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($discount, 'type2')); ?> </td>

            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($discount, 'discount_value_3')); ?></td>
            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($discount, 'type3')); ?></td>

            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($discount, 'discount_value_4')); ?></td>
            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($discount, 'type4')); ?> </td>

            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($discount, 'discount_value_5')); ?></td>
            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($discount, 'type5')); ?> </td>

        </tr>
    <?php endforeach; ?> 
</table>
