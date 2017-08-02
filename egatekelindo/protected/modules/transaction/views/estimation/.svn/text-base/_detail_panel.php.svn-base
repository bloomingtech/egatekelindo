<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama</th>
        <th></th>
    </tr>
    <?php foreach ($estimation->panels as $i => $detail): ?>
        <tr style="background-color: azure">

            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detail, "[$i]panel_name", array('size' => 70, 'maxlength' => 60)); ?>
                <?php echo CHtml::error($detail, 'panel_name'); ?>
            </td>

            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemovePanel', array('id' => $estimation->header->id, 'index' => $i)),
                            'update' => '#detail_man',
                        )),
                    ));
                    ?>
                <?php else: ?>
                    <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'inactive')); ?>
                <?php endif; ?>     
            </td>
        </tr>
    <?php endforeach; ?> 

</table>
