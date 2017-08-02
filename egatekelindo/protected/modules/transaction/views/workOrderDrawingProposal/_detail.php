<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center; width: 15%">Kirim ke Proyek</th>
        <th style="text-align: center; width: 20%">Kembali ke OHD</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>
    <?php foreach ($workOrderDrawingProposalComponent->details as $i => $detail): ?>
        <tr style="background-color: azure;">

            <td style="text-align: center;">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'id' => 'WorkOrderDrawingProposal_' . $i . '_date_delivery',
                    'name' => 'WorkOrderDrawingProposal[' . $i . '][date_delivery]',
                    'value' => $detail->date_delivery,
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
                <?php echo CHtml::error($detail, 'date_delivery'); ?>
            </td>
            <td style="text-align: center;">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'id' => 'WorkOrderDrawingProposal_' . $i . '_date_return',
                    'name' => 'WorkOrderDrawingProposal[' . $i . '][date_return]',
                     'value' => $detail->date_return,
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
                <?php echo CHtml::error($detail, 'date_return'); ?>
            </td>
            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $workOrderDrawingProposalComponent->header->id, 'index' => $i)),
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