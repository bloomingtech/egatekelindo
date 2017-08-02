<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Komponen</th>
        <th style="text-align: center; width: 15%">Brand</th>
        <th style="text-align: center; width: 10%">Qty</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>

    <?php foreach ($partList->details as $i => $detail): ?>
        <tr style="background-color: azure;">
            <td>
                <?php echo CHtml::activeHiddenField($detail, "[$i]component_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'component.name')); ?>
            </td>
            <td style="text-align: center">
                <?php echo CHtml::encode(CHtml::value($detail, 'component.componentBrand.name')); ?>
            </td>

            <td>
                <?php echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 5, 'maxlength' => 10,
                )); ?>
                <?php echo CHtml::error($detail, 'quantity'); ?>
            </td>

            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $partList->header->id, 'index' => $i)),
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