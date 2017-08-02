<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Barang</th>
        <th style="text-align: center; width: 15%">Brand</th>
        <th style="text-align: center; width: 10%">Qty Part List</th>
        <th style="text-align: center; width: 10%">Qty Stock</th>
        <th style="text-align: center; width: 10%">Remaining</th>
        <th style="text-align: center; width: 10%">Qty</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>

    <?php foreach ($packingList->details as $i => $detail): ?>
        <tr style="background-color: azure;">
            <td>
                <?php echo CHtml::activeHiddenField($detail, "[$i]part_list_detail_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'partListDetail.component.name')); ?>

            </td>
            <td style="text-align: center">
                <?php echo CHtml::encode(CHtml::value($detail, 'partListDetail.component.componentBrand.name')); ?>
            </td>

            <td style="text-align: center">
                <?php echo CHtml::encode(CHtml::value($detail, 'partListDetail.quantity')); ?>
            </td>

            <td style="text-align: center">
                &nbsp;

            </td>

            <td style="text-align: center">
                <?php echo CHtml::encode(CHtml::value($detail, 'partListQuantityRemaining')); ?>
                <?php echo CHtml::hiddenField("part_list_quantity_{$i}", CHtml::value($detail, 'partListQuantityRemaining')); ?>
            </td>

            <td>
                <?php
                echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 5, 'maxlength' => 10,
                    'onchange' => '
							if (parseInt($(this).val()) > parseInt($("#part_list_quantity_' . $i . '").val())) 
								$(this).val($("#part_list_quantity_' . $i . '").val())
						',
                ));
                ?>
                <?php echo CHtml::error($detail, 'quantity'); ?>
            </td>

            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $packingList->header->id, 'index' => $i)),
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