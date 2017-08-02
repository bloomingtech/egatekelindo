
<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center;">Component Name</th>
        <th style="text-align: center;">Type</th>
        <th style="text-align: center;">Brand</th>
        <th style="text-align: center;">Quantity</th>
        <th style="text-align: center;">Unit Price</th>
        <th style="text-align: center;">Total</th>
        <th></th>
    </tr>
    <?php if ($budgetingDetail->detailComponents): ?>
        <?php foreach ($budgetingDetail->detailComponents as $i => $detail): ?>
            <?php if ($detail->is_inactive == 0): ?>
                <tr>
                    <td><!--name-->
                        <?php echo CHtml::activeHiddenField($detail, "[$i]sale_order_detail_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]budgeting_header_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]budgeting_brand_discount_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]component_name"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]type"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]brand_name"); ?>
                        <?php echo CHtml::encode(CHtml::value($detail, 'component_name')); ?>
                    </td>

                    <td style="text-align: center;">
                        <?php echo CHtml::encode(CHtml::value($detail, 'type')); ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo CHtml::encode(CHtml::value($detail, 'brand_name')); ?>
                    </td>

                    <td style="text-align: center;">
                        <?php
                        echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 5, 'maxlength' => 10,
                            'onchange' => CHtml::ajax(array(
                                'type' => 'POST',
                                'dataType' => 'JSON',
                                'url' => CController::createUrl('ajaxJsonTotal', array('id' => $budgetingDetail->header->id, 'index' => $i, 'saleOrderDetailId' => $saleOrderDetail->id)),
                                'success' => 'function(data) {
							$("#total_' . $i . '").html(data.total);
							$("#sub_total").html(data.subTotal);
						}',
                            )),
                        ));
                        ?>
                        <?php echo CHtml::error($detail, 'quantity'); ?>
                    </td>
                    <!--unit price-->
                    <td style="text-align: center;">
                        <?php
                        echo CHtml::activeTextField($detail, "[$i]unit_price", array('size' => 5, 'maxLength' => 20,
                            'onchange' => CHtml::ajax(array(
                                'type' => 'POST',
                                'dataType' => 'JSON',
                                'url' => CController::createUrl('ajaxJsonTotal', array('id' => $budgetingDetail->header->id, 'index' => $i, 'saleOrderDetailId' => $saleOrderDetail->id)),
                                'success' => 'function(data) {
							$("#total_' . $i . '").html(data.total);
							$("#sub_total").html(data.subTotal);
						}',
                            )),
                        ));
                        ?>
                        <?php echo CHtml::error($detail, 'unit_price'); ?>
                    </td>

                    <td style="text-align: right;">
                        <span id="total_<?php echo $i; ?>">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total'))); ?>
                        </span>
                    </td>

                    <td style="width: 5%">
                        <?php if ($detail->isNewRecord): ?>
                            <?php
                            echo CHtml::button('Delete', array(
                                'onclick' => CHtml::ajax(array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $budgetingDetail->header->id, 'index' => $i)),
                                    'update' => '#detail_component',
                                )),
                            ));
                            ?>
                        <?php else: ?>
                            <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>

        <?php endforeach; ?>
        <tr style="background-color: aquamarine">

            <td style="font-weight: bold; text-align: right;" colspan="5">Sub Total</td>
            <td style="font-weight: bold; text-align: right;">
                <span id="sub_total">
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $budgetingDetail->header->getSubTotal($saleOrderDetail->id))); ?>
                </span>
            </td>
            <td></td>
        </tr>
    <?php endif; ?>

</table>