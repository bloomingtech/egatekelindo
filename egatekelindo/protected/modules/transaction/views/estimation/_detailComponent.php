<link rel="stylesheet" type="text/css" href="css/jquery.bsmselect.css" />
<link rel="stylesheet" type="text/css" href="css/example.css" />

<script type="text/javascript" src="js/jquery.bsmselect.js"></script>
<script type="text/javascript" src="js/jquery.bsmselect.sortable.js"></script>
<script type="text/javascript" src="js/jquery.bsmselect.compatibility.js"></script>

<script type="text/javascript">

    jQuery(function($) {

    $(".accesories").bsmSelect({
    showEffect: function($el){ $el.fadeIn(); },
    hideEffect: function($el){ $el.fadeOut(function(){ $(this).remove();}); },
    plugins: [$.bsmSelect.plugins.sortable()],
    title: 'Choose Accesories',
    highlight: 'highlight',
    addItemTarget: 'original',
    removeLabel: '<strong>X</strong>',
    containerClass: 'bsmContainer',                // Class for container that wraps this widget
    listClass: 'bsmList-custom',                   // Class for the list ($ol)
    listItemClass: 'bsmListItem-custom',           // Class for the <li> list items
    listItemLabelClass: 'bsmListItemLabel-custom', // Class for the label text that appears in list items
    removeClass: 'bsmListItemRemove-custom',       // Class given to the "remove" link
    extractLabel: function($o) {return $o.html();}
    });



    });

</script>

<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center;">Name</th>		
        <th style="text-align: center;">Qty</th>
        <th style="text-align: center;">Price</th>
        <th style="text-align: center;">Basic Price</th>
        <th style="text-align: center;">Accesories</th>
        <th style="text-align: center;">Accesories Value</th>
        <th style="text-align: center;">Total</th>
        <th style="text-align: center;"></th>
    </tr>
    <?php if ($estimation->detailComponents): ?>
        <?php foreach ($estimation->detailComponents as $i => $detail): ?>
            <?php if ($detail->estimation_panel_id == $index) : ?>
                <tr>
                    <td><!--name-->
                        <?php echo CHtml::activeHiddenField($detail, "[$i]estimation_panel_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]component_id"); ?>
                        <?php echo CHtml::encode(CHtml::value($detail, 'component.name')); ?>
                    </td>

                    <td style="text-align: center; width: 10%">
                        <?php
                        echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 7, 'maxLength' => 20,
                            'onchange' => CHtml::ajax(array(
                                'type' => 'POST',
                                'dataType' => 'JSON',
                                'url' => CController::createUrl('ajaxJsonTotal', array('id' => $estimation->header->id, 'i' => $i, 'index' => $index)),
                                'success' => 'function(data) {
                            $("#total_' . $i . '").html(data.total);
                            $("#sub_total").html(data.subTotal);
                           
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
                                'url' => CController::createUrl('ajaxJsonTotal', array('id' => $estimation->header->id, 'i' => $i, 'index' => $index)),
                                'success' => 'function(data) {
                            $("#total_' . $i . '").html(data.total);
                            $("#sub_total").html(data.subTotal);
                            $("#basic_price_' . $i . '").html(data.basicPrice);
                        }',
                            )),
                        ));
                        ?>
                        <?php echo CHtml::error($detail, 'unit_price'); ?>
                    </td>
                    
                    <td style="text-align: RIGHT; width: 10%">
                        <span id="basic_price_<?php echo $i; ?>">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $detail->getBasicPrice($estimation->details))); ?>
                        </span>                        
                    </td>
                    
                    <td style="text-align: center;">
                        <?php
                              echo CHtml::activeDropDownList($detail, "[$i]accesories_phase_id", CHtml::listData(AccesoriesPhase::model()->findAll(), 'id', 'nameFull'), array(
                                'empty' => '-Choose Accesories-',
                                'onchange' => CHtml::ajax(array(
                                        'type' => 'POST',
                                        'dataType' => 'JSON',
                                        'url' => CController::createUrl('ajaxJsonAccesoriesValue', array('id' => $estimation->header->id, 'i' => $i, 'index' => $index)),
                                        'success' => 'function(data) {
                                           
                                            $("#' . CHtml::activeId($detail, "[$i]accesories_phase_value") . '").val(data.value);    
                                }',
                                )),
                              ));
                        ?>
                        <?php echo CHtml::error($detail, 'accesories_phase_id');  ?> 
                    </td>

                    <td style="text-align: right;">
                        <span id="accesories_value_<?php echo $i; ?>">
                            <?php
                                echo CHtml::activeTextField($detail, "[$i]accesories_phase_value", array('size' => 7, 'maxLength' => 20,
                                ));
                            ?>
                            <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', (CHtml::value($detail, 'accesoriesPhase.value')))); ?>
                        </span>
                    </td>

<!--                    <td style="text-align: center;">location
                        <select id="accesories<?php //echo $i; ?>" class="accesories" multiple="multiple" name="accesories<?php echo $i; ?>[]>">
                            <?php //$accesories = Accesories::model()->findAll(); ?>
                            <?php //foreach ($accesories as $accesory): ?>
                                <option><?php //echo $accesory->type; ?></option>
                            <?php //endforeach; ?>
                        </select>

                    </td>-->


                    <td style="text-align: right; width: 15%">
                        <span id="total_<?php echo $i; ?>">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $detail->getTotal($estimation->details))); ?>
                        </span>
                    </td>


                    <td style="width: 5%">
                        <?php if ($detail->isNewRecord): ?>
                            <?php
                            echo CHtml::button('Delete', array(
                                'onclick' => CHtml::ajax(array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('ajaxHtmlRemoveComponent', array('id' => $estimation->header->id, 'i' => $i, 'index' => $index)),
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
    <?php endif; ?>


    <tr style="background-color: aquamarine">
        <td style="text-align: right; font-weight: bold" colspan="6">Sub Total:</td>
        <td style="text-align: right; font-weight: bold">
            <span id="sub_total">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->header->getSubTotalEachPanel($index, $estimation->detailComponents, $estimation))); ?>
                <?php //echo CHtml::encode(CHtml::value($panelDetail, 'panel_name'));   ?>
            </span>
        </td>
        <td></td>
    </tr>	

</table>