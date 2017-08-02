<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Item Name</th>
        <th style="text-align: center; width: 15%">Quantity</th>
        <th style="text-align: center; width: 15%">Unit Price</th>
        <th style="text-align: center; width: 15%" >Total</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>

    <?php foreach ($saleReturn->details as $i => $detail): ?>
        <tr style="background-color: azure">
            <!--nama item-->
            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detail, "[$i]item_description", array('size' => 40)); ?>
            </td>

            <!--quantity-->
            <td style="text-align: center;">
                <?php
                echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 5, 'maxLength' => 20,
                    'onchange' => CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('ajaxJsonTotal', array('id' => $saleReturn->header->id, 'index' => $i)),
                        'success' => 'function(data) {
							$("#total_' . $i . '").html(data.total);
							$("#sub_total").html(data.subTotal);
							$("#tax_total").html(data.taxTotal);
							$("#grand_total").html(data.grandTotal);
							
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
                        'url' => CController::createUrl('ajaxJsonTotal', array('id' => $saleReturn->header->id, 'index' => $i)),
                        'success' => 'function(data) {
							$("#total_' . $i . '").html(data.total);
							$("#sub_total").html(data.subTotal);
							$("#tax_total").html(data.taxTotal);
							$("#grand_total").html(data.grandTotal);
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

            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $saleReturn->header->id, 'index' => $i)),
                            'update' => '#detail_div',
                        )),
                    ));
                    ?>
                <?php else: ?>
                    <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => ActiveRecord::ACTIVE_LITERAL, ActiveRecord::INACTIVE => ActiveRecord::INACTIVE_LITERAL)); ?>
                <?php endif; ?>
            </td>
        </tr>

    <?php endforeach; ?>
    <tr style="background-color: aquamarine">
        <td></td>
        <td></td>
        <td style="font-weight: bold; text-align: right;">Sub Total</td>
        <td style="font-weight: bold; text-align: right;">
            <span id="sub_total">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleReturn, 'subTotal'))); ?>
            </span>
        </td>
        <td></td>
    </tr>

    <tr style="background-color: aquamarine">
        <td></td>
        <td></td>
        <td style="font-weight: bold; text-align: right;">Diskon</td>
        <td style="font-weight: bold; text-align: right;">
            <?php
            echo CHtml::activeTextField($saleReturn->header, "discount", array('size' => 5, 'maxLength' => 20,
                'onchange' => CHtml::ajax(array(
                    'type' => 'POST',
                    'dataType' => 'JSON',
                    'url' => CController::createUrl('ajaxJsonTotalByDiscount', array('id' => $saleReturn->header->id)),
                    'success' => 'function(data) {
							$("#grand_total").html(data.grandTotal);
						}',
                )),
            ));
            ?>
            <?php echo CHtml::error($saleReturn->header, 'discount'); ?>
        </td>
        <td></td>
    </tr>
    <tr style="background-color: aquamarine">
        <td></td>
        <td></td>
        <td style="font-weight: bold; text-align: right;">PPN 10%</td>
        <td style="font-weight: bold; text-align: right;">
            <span id="tax_total">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleReturn, 'taxTotal'))); ?>
            </span>
        </td>
        <td></td>
    </tr>

    <tr style="background-color: aquamarine">
        <td></td>
        <td></td>
        <td style="font-weight: bold; text-align: right;">Grand Total</td>
        <td style="font-weight: bold; text-align: right;">
            <span id="grand_total">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleReturn, 'grandTotal'))); ?>
            </span>
        </td>
        <td></td>
    </tr>
</table>

