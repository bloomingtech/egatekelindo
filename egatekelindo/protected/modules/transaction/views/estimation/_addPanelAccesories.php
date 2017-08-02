<script type="text/javascript">

   jQuery(function($) {
        function numberingAccesories() {
            var i = 0;
            $(".accesories-sort-number").each(function(k, v) {
                $(this).val(++i);
            });
        }
        numberingAccesories();
        $(".accesories-move-up").click(function(event) {
            event.preventDefault();
            var p = $(this).closest(".accesories-row");
            p.prev(".accesories-row").before(p);
            numberingAccesories();
        });
        $(".accesories-move-down").click(function(event) {
            event.preventDefault();
            var p = $(this).closest(".accesories-row");
            p.next(".accesories-row").after(p);
            numberingAccesories();
        });
    });

</script>

<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center;">Name</th>
        <th style="text-align: center;">Brand</th>
        <th style="text-align: center;">Type</th>
        <th style="text-align: center;">Weight</th>
        <th style="text-align: center;">Qty</th>
        <th style="text-align: center;">Price</th>
        <th style="text-align: center;">Basic Price</th>
        <th style="text-align: center;">Accesories</th>
        <th style="text-align: center;">Accesories Value</th>
        <th style="text-align: center;">Total</th>
        <th style="text-align: center;">Lot?</th>
        <th style="text-align: center;">Memo</th>
        <th style="text-align: center;"></th>
        <th style="text-align: center;"></th>
    </tr>
    <?php if ($panel->detailAccesories): ?>
        <?php foreach ($panel->detailAccesories as $i => $detail): ?>

            <tr class="accesories-row">
                <td><!--name-->
                    <?php echo CHtml::activeHiddenField($detail, "[$i]component_id"); ?>
                    <?php echo CHtml::activeHiddenField($detail, "[$i]component_cu_id"); ?>
                    <?php echo CHtml::activeTextField($detail, "[$i]name", array('size' => 30)); ?>
                    
                </td>

                <td style="text-align: center;">
                    <?php
                    echo CHtml::activeDropDownList($detail, "[$i]brand_id", CHtml::listData(ComponentBrand::model()->findAll(), 'id', 'name'), array(
                    ));
                    ?>
                    <?php echo CHtml::error($detail, 'brand_id'); ?> 
                </td>

                <td style="text-align: center; width: 10%">
                    <?php
                    echo CHtml::activeTextField($detail, "[$i]type", array('size' => 7, 'maxLength' => 20,));
                    ?>
                    <?php echo CHtml::error($detail, 'type'); ?>
                </td>

                <td style="text-align: center; width: 10%">
                    <?php
                    echo CHtml::activeTextField($detail, "[$i]weight", array('size' => 7, 'maxLength' => 20,
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'dataType' => 'JSON',
                            'url' => CController::createUrl('ajaxJsonTotalAccesoriesPanel', array('id' => $panel->header->id, 'i' => $i)),
                            'success' => 'function(data) {
                            $("#total_accesories' . $i . '").html(data.total);
                            $("#sub_total_accesories").html(data.subTotal);
                           
                        }',
                        )),
                    ));
                    ?>
                    <?php echo CHtml::error($detail, 'weight'); ?>
                </td>

                <td style="text-align: center; width: 10%">
                    <?php
                    echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 7, 'maxLength' => 20,
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'dataType' => 'JSON',
                            'url' => CController::createUrl('ajaxJsonTotalAccesoriesPanel', array('id' => $panel->header->id, 'i' => $i)),
                            'success' => 'function(data) {
                            $("#total_accesories' . $i . '").html(data.total);
                            $("#sub_total_accesories").html(data.subTotal);
                           
                        }',
                        )),
                    ));
                    ?>
                    <?php echo CHtml::error($detail, 'quantity'); ?>
                </td>

                <td style="text-align: center; width: 10%">
                    <?php
                    echo CHtml::activeTextField($detail, "[$i]unit_price", array('size' => 7, 'maxLength' => 20,
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'dataType' => 'JSON',
                            'url' => CController::createUrl('ajaxJsonTotalAccesoriesPanel', array('id' => $panel->header->id, 'i' => $i)),
                            'success' => 'function(data) {
                            $("#total_accesories' . $i . '").html(data.total);
                            $("#sub_total_accesories").html(data.subTotal);
                            $("#basic_price_accesories_' . $i . '").html(data.basicPrice);
                        }',
                        )),
                    ));
                    ?>
                    <?php echo CHtml::error($detail, 'unit_price'); ?>
                </td>

                <td style="text-align: center; width: 10%">
                    <span id="basic_price_accesories_<?php echo $i; ?>">
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $detail->getBasicPrice($panel->header->estimationHeader->estimationBrandDiscounts))); ?>
                    </span>                        
                </td>

                <td style="text-align: center;">
                    <?php
                    echo CHtml::activeDropDownList($detail, "[$i]accesories_phase_id", CHtml::listData(AccesoriesPhase::model()->findAll(), 'id', 'nameFull', 'phaseNumberString'), array(
                        'empty' => '-Choose Accesories-',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'dataType' => 'JSON',
                            'url' => CController::createUrl('ajaxJsonAccesoriesValueAccesoriesPanel', array('id' => $panel->header->id, 'i' => $i)),
                            'success' => 'function(data) {
								$("#' . CHtml::activeId($detail, "[$i]accesories_phase_value") . '").val(data.value);
							}',
                        )),
                    ));
                    ?>
                    <?php echo CHtml::error($detail, 'accesories_phase_id'); ?> 
                </td>

                <td style="text-align: right;">
                    <span id="accesories_value_accesories<?php echo $i; ?>">
                        <?php
                        echo CHtml::activeTextField($detail, "[$i]accesories_phase_value", array('size' => 7, 'maxLength' => 20,
                        ));
                        ?>
                        <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', (CHtml::value($detail, 'accesoriesPhase.value')))); ?>
                    </span>
                </td>

                <td style="text-align: right; width: 15%">
                    <span id="total_accesories<?php echo $i; ?>">
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $detail->getTotal($panel->header->estimationHeader->estimationBrandDiscounts))); ?>
                    </span>
                </td>

                <td style="text-align: center; width: 5%">
                    <?php echo CHtml::activeCheckBox($detail, "[$i]is_lot"); ?>
                </td>
                
                <td>
                    <?php echo CHtml::activeTextField($detail, "[$i]memo", array('size' => 30)); ?>
                </td>
                 
                <td>
                    <?php echo CHtml::activeHiddenField($detail, "[$i]sort_number", array('class'=> 'accesories-sort-number')); ?>
                    <div style="width: 55px">
                        <?php
                        echo CHtml::imageButton(Yii::app()->request->baseUrl . '/images/up.png', array('width' => 25, 'height' => 25, 'class' => 'accesories-move-up'));
                        ?>

                        <?php
                        echo CHtml::imageButton(Yii::app()->request->baseUrl . '/images/down.png', array('width' => 25, 'height' => 25, 'class' => 'accesories-move-down'));
                        ?>
                    </div>
                </td>


                <td style="width: 5%">
                    <?php if ($detail->isNewRecord): ?>
                        <?php
                        echo CHtml::button('Delete', array(
                            'onclick' => CHtml::ajax(array(
                                'type' => 'POST',
                                'url' => CController::createUrl('ajaxHtmlRemoveAccesoriesPanel', array('id' => $panel->header->id, 'i' => $i)),
                                'update' => '#detail_accesories',
                            )),
                        ));
                        ?>
                    <?php else: ?>
                        <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                    <?php endif; ?>
                </td>

            </tr>

        <?php endforeach; ?>
    <?php endif; ?>


    <tr style="background-color: aquamarine">
        <td style="text-align: right; font-weight: bold" colspan="9">Sub Total:</td>
        <td style="text-align: right; font-weight: bold">
            <span id="sub_total_accesories">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $panel->getSubTotalAccesories())); ?>
            </span>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>	

</table>