<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center; width: 35%">Nama Panel</th>
        <th style="text-align: center; width: 15%">Gambar Selesai</th>
        <th style="text-align: center">Memo</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>
    <?php foreach ($workOrderDrawing->details as $i => $detail): ?>
        <tr style="background-color: azure;">
            <!--nama item-->
            <td style="text-align: center;">
                <?php echo CHtml::activeHiddenField($detail, "[$i]sale_order_detail_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'saleOrderDetail.panel_name')); ?>
            </td>
            
            <td style="text-align: center;">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'id' => 'WorkOrderDrawingDetail_' . $i . '_finish_date',
                    'name' => 'WorkOrderDrawingDetail[' . $i . '][finish_date]',
                    'value' => $detail->finish_date,
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
                <?php echo CHtml::error($detail, 'finish_date'); ?>
            </td>

            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detail, "[$i]memo", array('size' => 60, 'maxlength' => 60)); ?>
                <?php echo CHtml::error($detail, 'memo'); ?>
            </td>

            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $workOrderDrawing->header->id, 'index' => $i)),
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