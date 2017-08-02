<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center; width: 15%">Tanggal</th>
        <th style="text-align: center; width: 20%">Target</th>
        <th style="text-align: center; width: 20%">Real</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>
    <?php foreach ($workOrderDrawingRevisionComponent->details as $i => $detail): ?>
        <tr style="background-color: azure;">

            <td style="text-align: center;">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'id' => 'WorkOrderDrawingRevision_' . $i . '_date_revised',
                    'name' => 'WorkOrderDrawingRevision[' . $i . '][date_revised]',
                    'value' => $detail->date_revised,
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'showAnim' => 'fold',
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($detail, '_date_revised'); ?>
            </td>
            <td style="text-align: center;">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'id' => 'WorkOrderDrawingRevision_' . $i . '_date_target',
                    'name' => 'WorkOrderDrawingRevision[' . $i . '][date_target]',
                     'value' => $detail->date_target,
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'showAnim' => 'fold',
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($detail, 'date_target'); ?>
            </td>
             <td style="text-align: center;">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'id' => 'WorkOrderDrawingRevision_' . $i . '_date_real',
                    'name' => 'WorkOrderDrawingRevision[' . $i . '][date_real]',
                     'value' => $detail->date_real,
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'showAnim' => 'fold',
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($detail, 'date_real'); ?>
            </td>
            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $workOrderDrawingRevisionComponent->header->id, 'index' => $i)),
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