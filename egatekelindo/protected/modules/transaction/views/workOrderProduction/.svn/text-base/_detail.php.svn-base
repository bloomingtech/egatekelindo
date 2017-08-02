<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center; width: 20%">Nama Panel</th>
        <th style="text-align: center; width: 15%">Dimensi Panel</th>
        <th style="text-align: center; width: 10%">Qty</th>
        <th style="text-align: center; width: 10%">Delivery Panel</th>
        <th style="text-align: center">Memo</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>
    
    <?php foreach ($workOrderProduction->details as $i => $detail): ?>
        <tr style="background-color: azure;">
            <!--nama item-->
            <td style="text-align: center;">
                <?php echo CHtml::activeHiddenField($detail, "[$i]work_order_drawing_detail_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'workOrderDrawingDetail.saleOrderDetail.panel_name')); ?>
            </td>

            <!--satuan-->
            <td style="text-align: center;">
                 <?php echo CHtml::activeTextField($detail, "[$i]panel_dimension", array('size' => 30, 'maxlength' => 60)); ?>
            </td>

            <td style="text-align: center;">
                <?php echo CHtml::activeHiddenField($detail, "[$i]quantity"); ?>
				<?php echo CHtml::encode(CHtml::value($detail, 'quantity')); ?>
                <?php echo CHtml::error($detail, 'quantity'); ?>
            </td>
            
             <td style="text-align: center;">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(

                    'id' => 'WorkOrderProductionDetail_'.$i.'_delivery_date',
                    'name' => 'WorkOrderProductionDetail['.$i.'][delivery_date]',
                    'value' => $detail->delivery_date,
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
                <?php echo CHtml::error($detail, 'delivery_date'); ?>
            </td>
            
            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detail, "[$i]memo", array('size' => 50, 'maxlength' => 60)); ?>
                <?php echo CHtml::error($detail, 'memo'); ?>
            </td>
            
            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $workOrderProduction->header->id, 'index' => $i)),
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