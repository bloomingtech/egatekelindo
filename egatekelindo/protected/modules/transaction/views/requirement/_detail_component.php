<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Component Name</th>
        <th style="text-align: center">Type</th>
        <th style="text-align: center">Brand</th>
        <th style="text-align: center; width: 10%">Qty</th>
        <th style="text-align: center; width: 10%">Unit Price</th>
        <th style="text-align: center; width: 10%">Total</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>

    <?php foreach ($requirement->detailComponents as $i => $detail): ?>
        <?php $index = Yii::app()->session['index']; ?>
        <?php if ($detail->requirement_detail_id == $index): ?>
            <tr style="background-color: azure;">
                <!--nama item-->
                <td style="text-align: center;">
                    <?php echo CHtml::activeHiddenField($detail, "[$i]budgeting_detail_id"); ?>
                    <?php echo CHtml::activeHiddenField($detail, "[$i]budgeting_detail_accesories_id"); ?>
                    <?php echo CHtml::activeHiddenField($detail, "[$i]requirement_detail_id"); ?>
                    <?php echo CHtml::activeTextField($detail, "[$i]component_name"); ?>
                </td>
                <td style="text-align: center;">
                    <?php echo CHtml::encode(CHtml::value($detail->budgetingDetailAccesories, 'type')); ?>
                    <?php echo CHtml::encode(CHtml::value($detail->budgetingDetail, 'type')); ?>
                </td>
                <td style="text-align: center;">
                    <?php echo CHtml::encode(CHtml::value($detail->budgetingDetailAccesories, 'brand_name')); ?>
                    <?php echo CHtml::encode(CHtml::value($detail->budgetingDetail, 'brand_name')); ?>
                </td>
                <td>
                    <?php
                    echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 5, 'maxlength' => 10,
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'dataType' => 'JSON',
                            'url' => CController::createUrl('ajaxJsonTotalPanel', array('id' => $requirement->header->id, 'i' => $i, 'index' => $index)),
                            'success' => 'function(data) {
							$("#total_' . $i . '").html(data.total);
							$("#sub_total").html(data.subTotal);
						}',
                        ))
                    ));
                    ?>
                    <?php echo CHtml::error($detail, 'quantity'); ?>
                </td>

                <td>
                    <?php
                    echo CHtml::activeTextField($detail, "[$i]unit_price", array('size' => 5, 'maxlength' => 10,
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'dataType' => 'JSON',
                            'url' => CController::createUrl('ajaxJsonTotalPanel', array('id' => $requirement->header->id, 'i' => $i, 'index' => $index)),
                            'success' => 'function(data) {
							$("#total_' . $i . '").html(data.total);
							$("#sub_total").html(data.subTotal);
						}',
                        ))
                    ));
                    ?>
                    <?php echo CHtml::error($detail, 'unit_price'); ?>
                </td>

                <td style="text-align: right;">
                    <span id="total_<?php echo $i; ?>">
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->total)); ?>
                    </span>
                </td>

                <td>
                    <?php if ($detail->isNewRecord): ?>
                        <?php
                        echo CHtml::button('Delete', array(
                            'onclick' => CHtml::ajax(array(
                                'type' => 'POST',
                                'url' => CController::createUrl('ajaxHtmlRemoveDetailComponent', array('id' => $requirement->header->id, 'i' => $i, 'index' => $index)),
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-weight: bold; text-align: right;">Sub Total</td>
        <td style="font-weight: bold; text-align: right;">
            <span id="sub_total">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $requirement->getSubTotalPanel($index))); ?>
            </span>
        </td>
        <td></td>
    </tr>

</table>

