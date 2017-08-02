<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Panel</th>
        <th style="text-align: center; width: 15%">Qty</th><!--
        <th style="text-align: center; width: 10%">Unit Price</th>
        <th style="text-align: center; width: 10%">Total</th>-->
        <th style="text-align: center; width: 5%;" ></th>
    </tr>

    <?php foreach ($requirement->details as $i => $detail): ?>
        <tr style="background-color: azure;">
            <!--nama item-->
            <td style="text-align: center;">
                <?php echo CHtml::activeHiddenField($detail, "[$i]sale_order_detail_id"); ?>
                <?php echo CHtml::activeHiddenField($detail, "[$i]unit_price"); ?>
                <?php echo CHtml::activeHiddenField($detail, "[$i]sale_order_detail_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'saleOrderDetail.panel_name')); ?>
            </td>

            <td style="text-align: center">
                <?php
                echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 5, 'maxlength' => 10,
                    'onchange' => CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('ajaxJsonTotal', array('id' => $requirement->header->id, 'index' => $i)),
                        'success' => 'function(data) {
							$("#total_' . $i . '").html(data.total);
							$("#sub_total").html(data.subTotal);
						}',
                    )),
                ));
                ?>
                <?php echo CHtml::error($detail, 'quantity'); ?>
            </td>

        <!--            <td>
            <?php
//                echo CHtml::activeTextField($detail, "[$i]unit_price", array('size' => 5, 'maxlength' => 10,
//                    'onchange' => CHtml::ajax(array(
//                        'type' => 'POST',
//                        'dataType' => 'JSON',
//                        'url' => CController::createUrl('ajaxJsonTotal', array('id' => $requirement->header->id, 'index' => $i)),
//                        'success' => 'function(data) {
//							$("#total_' . $i . '").html(data.total);
//							$("#sub_total").html(data.subTotal);
//						}',
//                    )),
//                ));
            ?>
            <?php //echo CHtml::error($detail, 'unit_price'); ?>
                    </td>-->

        <!--            <td style="text-align: right;">
                        <span id="total_<?php //echo $i;   ?>">
            <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total'))); ?>
                        </span>
                    </td>-->

            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $requirement->header->id, 'index' => $i)),
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
<!--    <tr style="background-color: aquamarine">
<td></td>
<td></td>
<td style="font-weight: bold; text-align: right;">Sub Total</td>
<td style="font-weight: bold; text-align: right;">
    <span id="sub_total">
    <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($requirement, 'subTotal'))); ?>
    </span>
</td>
</tr>-->
</table>