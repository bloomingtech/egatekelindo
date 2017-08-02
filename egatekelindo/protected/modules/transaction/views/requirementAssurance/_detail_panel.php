<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Panel</th>
        <th style="text-align: center; width: 10%">Qty</th>
        <th style="text-align: center; width: 1%"></th>
		<th style="text-align: center; width: 10%">Wiring Rp</th>
		<th style="text-align: center; width: 10%">Wiring Tipe</th>
        <th style="text-align: center;width: 5%" ></th>
    </tr>

    <?php foreach ($requirementAssurance->details as $i => $detail): ?>
        <tr style="background-color: azure;">
            <!--nama item-->
            <td style="text-align: center;">
                <?php echo CHtml::activeHiddenField($detail, "[$i]requirement_detail_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'requirementDetail.saleOrderDetail.panel_name')); ?>
            </td>

            <td style="text-align: center">
                <?php echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 5, 'maxlength' => 10)); ?>
                <?php echo CHtml::error($detail, 'quantity'); ?>
            </td>

			<td style="text-align: center">
				<?php echo CHtml::activeHiddenField($detail, "[$i]unit_price"); ?>
				<?php echo CHtml::error($detail, 'unit_price'); ?>
			</td>
			<td style="text-align: center">
				<?php echo CHtml::activeTextField($detail, "[$i]wiring_value", array('size' => 20, 'maxlength' => 20)); ?>
				<?php echo CHtml::error($detail, 'wiring_value'); ?>
			</td>
			<td style="text-align: center">
				<?php echo CHtml::activeDropDownList($detail, "[$i]wiring_name", array('A' => 'A', 'B' => 'B', 'C' => 'C')); ?>
				<?php echo CHtml::error($detail, 'wiring_name'); ?>
			</td>

            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $requirementAssurance->header->id, 'index' => $i)),
                            'update' => '#detail_div',
                        )),
                    ));
                    ?>
                <?php else: ?>
                    <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                <?php endif; ?>
            </td>
        </tr>	
    <?php endforeach; ?>
</table>