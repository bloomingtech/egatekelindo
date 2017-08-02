<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center;">Component Name</th>
        <th style="text-align: center;">Type</th>
        <th style="text-align: center;">Brand</th>
        <th style="text-align: center;">Quantity</th>
        <th style="text-align: center;">Memo</th>
		<th style="text-align: center;">Stok?</th>
        <th></th>
    </tr>
    <?php if ($requirementDetail->detailComponents): ?>
        <?php foreach ($requirementDetail->detailComponents as $i => $detail): ?>
            <?php if ($detail->is_inactive == 0): ?>
                <tr>
                    <td><!--name-->
                        <?php echo CHtml::activeHiddenField($detail, "[$i]component_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]component_cu_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]budgeting_detail_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]budgeting_detail_accesories_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]requirement_detail_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]component_name"); ?>
                        <?php echo CHtml::encode(CHtml::value($detail, 'component_name')); ?>
                    </td>

                    <td style="text-align: center;">
                        <?php echo CHtml::encode(CHtml::value($detail->budgetingDetailAccesories, 'type')); ?>
                        <?php echo CHtml::encode(CHtml::value($detail->budgetingDetail, 'type')); ?>
                        <?php echo CHtml::encode(CHtml::value($detail->component, 'type')); ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo CHtml::encode(CHtml::value($detail->budgetingDetailAccesories, 'brand_name')); ?>
                        <?php echo CHtml::encode(CHtml::value($detail->budgetingDetail, 'brand_name')); ?>
                        <?php echo CHtml::encode(CHtml::value($detail->component, 'componentBrand.name')); ?>
                    </td>

                    <td style="text-align: center;">
                        <?php
                        echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 5, 'maxlength' => 10,));
                        ?>
                        <?php echo CHtml::error($detail, 'quantity'); ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo CHtml::activeTextField($detail, "[$i]memo", array('size' => 30)); ?>
						<?php echo CHtml::error($detail, 'memo'); ?>
                    </td>
					<td style="text-align: center;">
                        <?php echo CHtml::activeCheckBox($detail, "[$i]is_stock"); ?>
                        <?php echo CHtml::error($detail, 'is_stock'); ?>
                    </td>
                    <td style="width: 5%">
                        <?php if ($detail->isNewRecord): ?>
                            <?php
                            echo CHtml::button('Delete', array(
                                'onclick' => CHtml::ajax(array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $requirementDetail->header->id, 'index' => $i)),
                                    'update' => '#detail_component',
                                )),
                            ));
                            ?>
                        <?php else: ?>
                            <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</table>