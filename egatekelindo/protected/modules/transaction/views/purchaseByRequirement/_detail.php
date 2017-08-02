<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Komponen</th>
        <th style="text-align: center; width: 5%">Requirement</th>
        <th style="text-align: center; width: 5%">Quantity</th>
        <th style="text-align: center; width: 15%">Harga Satuan</th>
        <th style="text-align: center; width: 5%">: 1.1</th>
        <th style="text-align: center; width: 5%">Disc 1(%)</th>
        <th style="text-align: center; width: 5%">Disc 2(%)</th>
        <th style="text-align: center; width: 5%">Disc 3(%)</th>
        <th style="text-align: center; width: 5%">Disc 4(%)</th>
        <th style="text-align: center; width: 15%">Total</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>

    <?php foreach ($purchase->details as $i => $detail): ?>
        <tr style="background-color: azure;">
            <!--nama komponen-->
            <td>
                <?php echo CHtml::activeHiddenField($detail, "[$i]requirement_detail_component_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'requirementDetailComponent.component_name')); ?>
            </td>

            <td style="text-align: center;">
                <?php echo CHtml::encode(CHtml::value($detail, 'quantity_requested')); ?>
            </td>

            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 5, 'maxLength' => 10,
                    'onchange' => CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('ajaxJsonTotal', array('id' => $purchase->header->id, 'index' => $i)),
                        'success' => 'function(data) {
                            $("#total_' . $i . '").html(data.total);
                            $("#total_quantity").html(data.totalQuantity);
							$("#sub_total").html(data.subTotal);
							$("#tax_value").html(data.taxValue);
                            $("#grand_total").html(data.grandTotal);
                        }',
                    )),
                )); ?>
                <?php echo CHtml::error($detail, 'quantity'); ?>
            </td>

    <!--            <td style="text-align: center;">
            <?php /*
              echo CHtml::activeTextField($detail, "[$i]weight", array('size' => 5, 'maxLength' => 10,
              'onchange' => CHtml::ajax(array(
              'type' => 'POST',
              'dataType' => 'JSON',
              'url' => CController::createUrl('ajaxJsonTotal', array('id' => $purchase->header->id, 'index' => $i)),
              'success' => 'function(data) {
              $("#total_' . $i . '").html(data.total);
              $("#total_weight").html(data.totalWeight);
              $("#sub_total").html(data.subTotal);
              $("#tax_value").html(data.taxValue);
              $("#grand_total").html(data.grandTotal);
              }',
              )),
              ));
              ?>
              <?php echo CHtml::error($detail, 'weight'); */ ?>
                </td>-->

            <td style="text-align: right;">
                <?php echo CHtml::activeHiddenField($detail, "[$i]unit_price"); ?>
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'unit_price'))); ?>
                <?php /* echo CHtml::activeTextField($detail, "[$i]unit_price", array('size' => 15, 'maxLength' => 20, 
                  'onchange' => CHtml::ajax(array(
                  'type' => 'POST',
                  'dataType' => 'JSON',
                  'url' => CController::createUrl('ajaxJsonTotal', array('id' => $purchase->header->id, 'index' => $i)),
                  'success' => 'function(data) {
                  $("#total_' . $i . '").html(data.total);
                  $("#grand_total").html(data.grandTotal);
                  }',
                  )),
                  )); */ ?>
                <?php echo CHtml::error($detail, 'unit_price'); ?>
            </td>

            <td style="text-align: center;">
                <?php echo CHtml::activeCheckBox($detail, "[$i]is_divided"); ?>
                <?php echo CHtml::error($detail, 'is_divided'); ?>
            </td>

            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detail, "[$i]discount_1", array('size' => 3, 'maxLength' => 3,
                    'onchange' => CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('ajaxJsonTotal', array('id' => $purchase->header->id, 'index' => $i)),
                        'success' => 'function(data) {
                            $("#total_' . $i . '").html(data.total);
                            $("#sub_total").html(data.subTotal);
                            $("#tax_value").html(data.taxValue);
                            $("#grand_total").html(data.grandTotal);
                        }',
                    )),
                )); ?>
                <?php echo CHtml::error($detail, 'discount_1'); ?>
            </td>

            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detail, "[$i]discount_2", array('size' => 3, 'maxLength' => 3,
                    'onchange' => CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('ajaxJsonTotal', array('id' => $purchase->header->id, 'index' => $i)),
                        'success' => 'function(data) {
                            $("#total_' . $i . '").html(data.total);
                            $("#sub_total").html(data.subTotal);
                            $("#tax_value").html(data.taxValue);
                            $("#grand_total").html(data.grandTotal);
                        }',
                    )),
                )); ?>
                <?php echo CHtml::error($detail, 'discount_2'); ?>
            </td>

            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detail, "[$i]discount_3", array('size' => 3, 'maxLength' => 3,
                    'onchange' => CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('ajaxJsonTotal', array('id' => $purchase->header->id, 'index' => $i)),
                        'success' => 'function(data) {
                            $("#total_' . $i . '").html(data.total);
                            $("#sub_total").html(data.subTotal);
                            $("#tax_value").html(data.taxValue);
                            $("#grand_total").html(data.grandTotal);
                        }',
                    )),
                )); ?>
                <?php echo CHtml::error($detail, 'discount_3'); ?>
            </td>

            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detail, "[$i]discount_4", array('size' => 3, 'maxLength' => 3,
                    'onchange' => CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('ajaxJsonTotal', array('id' => $purchase->header->id, 'index' => $i)),
                        'success' => 'function(data) {
                            $("#total_' . $i . '").html(data.total);
                            $("#sub_total").html(data.subTotal);
                            $("#tax_value").html(data.taxValue);
                            $("#grand_total").html(data.grandTotal);
                        }',
                    )),
                )); ?>
                <?php echo CHtml::error($detail, 'discount_4'); ?>
            </td>

            <td style="text-align: right; width: 15%">
                <span id="total_<?php echo $i; ?>">
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->totalAfterDiscount)); ?>
                </span>
            </td>

            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $purchase->header->id, 'index' => $i)),
                            'update' => '#detail_div',
                        )),
                    )); ?>
                <?php else: ?>
                    <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                <?php endif; ?>
            </td>
        </tr>	
    <?php endforeach; ?>
    <tr style="background-color: aquamarine">
        <td style="font-weight: bold; text-align: right" colspan="2">Total :</td>
        <td style="font-weight: bold; text-align: center">
            <span id="total_quantity">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->header->totalQuantityRequirement)); ?>
            </span>
        </td>
        <td style="font-weight: bold; text-align: center">
            <span id="total_weight">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->header->totalWeightRequirement)); ?>
            </span>
        </td>
        <td colspan="5">&nbsp;</td>
        <td style="font-weight: bold; text-align: right">
            <span id="sub_total">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->header->subTotalRequirement)); ?>
            </span>
        </td>
        <td></td>
    </tr>
    <tr style="background-color: aquamarine">
        <td style="font-weight: bold; text-align: right" colspan="9">
            PPn
            <span id="tax_percentage">
                <?php echo CHtml::encode($purchase->header->taxPercentage); ?>
            </span>% :
        </td>
        <td style="font-weight: bold; text-align: right">
            <span id="tax_value">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->header->calculatedTaxRequirement)); ?>
            </span>
        </td>
        <td></td>
    </tr>
    <tr style="background-color: aquamarine">
        <td style="font-weight: bold; text-align: right" colspan="9">Grand Total :</td>
        <td style="font-weight: bold; text-align: right">
            <span id="grand_total">
                <?php echo CHtml::encode($purchase->header->grandTotalRequirement); ?>
            </span>
        </td>
        <td></td>
    </tr>
</table>