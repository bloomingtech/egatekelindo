<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Panel</th>
        <th style="text-align: center; width: 15%">Satuan</th>
        <th style="text-align: center; width: 10%">Qty. Kirim</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>

    <?php foreach ($delivery->details as $i => $detail): ?>
        <tr style="background-color: azure;">
            <!--nama item-->
            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detail, "[$i]panel_name", array('size' => 40)); ?>
            </td>

            <!--satuan-->
            <td style="text-align: center;">
                <?php echo CHtml::activeDropDownList($detail, "[$i]unit_id", CHtml::listData(Unit::model()->findAll(), 'id', 'name')); ?>
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
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $delivery->header->id, 'index' => $i)),
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