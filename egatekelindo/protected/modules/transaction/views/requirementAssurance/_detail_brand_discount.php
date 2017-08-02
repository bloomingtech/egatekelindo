<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center; ">Brand</th>
        <th style="text-align: center; ">Type 1</th>
		<th style="text-align: center; ">Value 1</th>
        <th style="text-align: center; ">Type 2</th>
		<th style="text-align: center; ">Value 2</th>
        <th style="text-align: center; ">Type 3</th>
		<th style="text-align: center; ">Value 3</th>
        <th style="text-align: center; ">Type 4</th>
		<th style="text-align: center; ">Value 4</th>
    </tr>
    <?php
    $requirementAssuranceBrandDiscounts = $requirementAssurance->brandDiscounts;
    foreach ($requirementAssuranceBrandDiscounts as $requirementAssuranceBrandDiscount) {
        $requirementAssuranceBrandDiscount->isPrimary = $requirementAssuranceBrandDiscount->componentBrandDiscount->is_primary;
    }
    usort($requirementAssuranceBrandDiscounts, function ($a, $b) {
		if ($a['isPrimary'] == $b['isPrimary'])
			return 0;
		return ($a['isPrimary'] < $b['isPrimary']) ? 1 : -1;
	});
    ?>
    <?php $currentIsPrimary = NULL; ?>
	
    <?php foreach ($requirementAssuranceBrandDiscounts as $i => $detail): ?>
        <?php if ($detail->isPrimary != $currentIsPrimary && $currentIsPrimary != NULL) : ?>
            <tr style="background-color: azure">
                <td colspan="10">&nbsp;</td>
            </tr>
            <tr style="background-color: azure">
                <td colspan="10" style="border-bottom: 1px solid;font-weight: bold;">Komponen Pendukung</td>
            </tr>
        <?php endif; ?>
        <?php if ($currentIsPrimary == NULL): ?>
            <tr style="background-color: azure">
                <td colspan="10" style="border-bottom: 1px solid;font-weight: bold;">Komponen Utama</td>
            </tr>
        <?php endif; ?>
        <tr style="background-color: azure">
            <td>
                <?php echo CHtml::activeHiddenField($detail, "[$i]component_brand_discount_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'componentBrandDiscount.componentBrand.name')); ?>
                <?php echo CHtml::error($detail, 'component_brand_discount_id'); ?>
            </td>

            <td style="text-align: center; ">  
				<?php echo CHtml::activeDropDownList($detail, "[$i]value_calculation_type_1", array(
                1 => 'X',
                2 => '/',
                3 => '-',
				4 => '+'));
                ?>
            </td>

            <td style="text-align: center; ">
                <?php echo CHtml::activeTextField($detail, "[$i]value_1", array('size' => 5, 'maxlength' => 20)); ?>
                <?php echo CHtml::error($detail, 'value_1'); ?>
            </td>

            <td style="text-align: center; ">  
				<?php echo CHtml::activeDropDownList($detail, "[$i]value_calculation_type_2", array(
                1 => 'X',
                2 => '/',
                3 => '-',
				4 => '+'));
                ?>
            </td>

            <td style="text-align: center; ">
                <?php echo CHtml::activeTextField($detail, "[$i]value_2", array('size' => 5, 'maxlength' => 20)); ?>
                <?php echo CHtml::error($detail, 'value_2'); ?>
            </td>

            <td style="text-align: center; ">
				<?php echo CHtml::activeDropDownList($detail, "[$i]value_calculation_type_3", array(
					1 => 'X',
					2 => '/',
					3 => '-',
					4 => '+'));
			?>
            </td>

            <td style="text-align: center; ">
                <?php echo CHtml::activeTextField($detail, "[$i]value_3", array('size' => 5, 'maxlength' => 20)); ?>
                <?php echo CHtml::error($detail, 'value_3'); ?>
            </td>

            <td style="text-align: center; ">
				<?php echo CHtml::activeDropDownList($detail, "[$i]value_calculation_type_4", array(
					1 => 'X',
					2 => '/',
					3 => '-',
					4 => '+'));
			?>
            </td>
			
            <td style="text-align: center; ">
                <?php echo CHtml::activeTextField($detail, "[$i]value_4", array('size' => 5, 'maxlength' => 20)); ?>
                <?php echo CHtml::error($detail, 'value_4'); ?>
            </td>

        </tr>
        <?php $currentIsPrimary = $detail->isPrimary; ?>
    <?php endforeach; ?> 
</table>