<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Requirement #', false); ?>
                <?php if ($requirement->header->isNewRecord) : ?>
                    <?php echo CHtml::activeTextField($requirement->header, 'cn_ordinal', array('size' => 10, 'maxlength' => 20)); ?>
                    <?php echo CHtml::error($requirement->header, 'cn_ordinal'); ?>
                    <?php echo CHtml::error($requirement->header, 'ordinal'); ?>
                <?php else : ?>
                    <?php echo CHtml::encode($requirement->header->getCodeNumber(RequirementHeader::CN_CONSTANT)); ?>
                <?php endif; ?>
                <?php //echo CHtml::encode($requirement->header->getCodeNumber(RequirementHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $requirement->header,
                    'attribute' => 'date',
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($requirement->header, 'date'); ?>
            </div>

            <div class="row">
                <?php //echo CHtml::label('Is Component?', ''); ?>
                <?php
                echo CHtml::activeRadioButtonList($requirement->header, 'is_component', array(
                    1 => 'Component',
                    0 => 'CU'), array('labelOptions' => array('style' => 'display:inline')
                ));
                ?>
                <?php //echo CHtml::activeCheckBox($requirement->header, 'is_component'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($requirement->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($requirement->header, 'note'); ?>
            </div>


        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('SPK Produksi #', ''); ?>
                <?php //if ($requirement->header->isNewRecord): ?>
                <?php //echo CHtml::activeTextField($requirement->header, 'sale_order_header_id', array('readonly' => true, 'onclick' => '$("#sale-order-header-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#sale-order-header-dialog").dialog("open"); return false; }')); ?>
                <?php //echo CHtml::openTag('span', array('id' => 'sale_order_code_number')); ?>
                <?php //echo CHtml::encode(($saleOrderHeader === null) ? '' : $saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)); ?>
                <?php //echo CHtml::closeTag('span'); ?>
                <?php //echo CHtml::error($requirement->header, 'sale_order_header_id'); ?>

                <?php
//                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
//                        'id' => 'sale-order-header-dialog',
//                        // additional javascript options for the dialog plugin
//                        'options' => array(
//                            'title' => 'Sale Order',
//                            'autoOpen' => false,
//                            'width' => 'auto',
//                            'modal' => true,
//                        ),
//                    ));
                ?>
                <?php
//                    $this->widget('zii.widgets.grid.CGridView', array(
//                        'id' => 'sale-order-header-grid',
//                        'dataProvider' => $saleOrderHeaderDataProvider,
//                        'filter' => $saleOrderHeader,
//                        'selectionChanged' => 'js:function(id) {
//							$("#' . CHtml::activeId($requirement->header, 'sale_order_header_id') . '").val($.fn.yiiGridView.getSelection(id));
//							$("#sale-order-header-dialog").dialog("close");
//							if ($.fn.yiiGridView.getSelection(id) == "")
//							{
//								$("#sale_order_code_number").html("");
//								$("#sale_order_date").html("");
//					
//							}
//							else
//							{
//								$.ajax({
//									type: "POST",
//									dataType: "JSON",
//									url: "' . CController::createUrl('AjaxJsonSaleOrder', array('id' => $requirement->header->id)) . '",
//									data: $("form").serialize(),
//									success: function(data) {
//										$("#sale_order_code_number").html(data.sale_order_code_number);
//										$("#sale_order_date").html(data.sale_order_date);
//										
//									},
//								});
//							}
//                                                        $.ajax({
//								type: "POST",
//								url: "' . CController::createUrl('ajaxHtmlAddDetail', array('id' => $requirement->header->id)) . '",
//								data: $("form").serialize(),
//								success: function(html) { $("#detail_div").html(html); },
//							});
//							
//						}',
//                        'columns' => array(
//                            array(
//                                'name' => 'cn_ordinal',
//                                'header' => 'Order #',
//                                'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($saleOrderHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
//                                '<div style="display: inline-block"> &nbsp; /' . SaleOrderHeader::CN_CONSTANT . '/ &nbsp; </div>' .
//                                '<div style="display: inline-block">' . CHtml::activeDropDownList($saleOrderHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
//                                '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
//                                '<div style="display: inline-block">' . CHtml::activeTextField($saleOrderHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
//                                'value' => '$data->getCodeNumber(SaleOrderHeader::CN_CONSTANT)',
//                                'htmlOptions' => array('style' => 'width: 200px'),
//                            ),
//                            array(
//                                'header' => 'Tanggal',
//                                'name' => 'date',
//                                'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
//                            ),
//                        ),
//                    ));
                ?>
                <?php //$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
                <?php //else: ?>
                <?php echo CHtml::encode($requirement->header->workOrderProductionHeader->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT)); ?>
                <?php echo CHtml::activeHiddenField($requirement->header, 'work_order_production_header_id', array('value' => $requirement->header->work_order_production_header_id)); ?>
                <?php //endif; ?>
            </div>
            <br/>
            <div class="row">
                <?php echo CHtml::label('Project Name', ''); ?>
                <?php echo CHtml::encode($requirement->header->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->project_name); ?>
            </div>
            <br/>
            <div class="row">
                <?php echo CHtml::label('SO #', ''); ?>
                <?php echo CHtml::encode($requirement->header->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)); ?>
            </div>
            <br/>
            <div class="row">
                <?php echo CHtml::label('Customer Company', ''); ?>
                <?php echo CHtml::encode($requirement->header->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->client_company); ?>
            </div>



        </div>
    </div>

    <hr />
    <div class="row">
        <?php echo CHtml::errorSummary($requirement->header); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('requirement' => $requirement)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn_blue')); ?>
        <?php //echo CHtml::submitButton('Next', array('name' => 'Next', 'confirm' => 'Are you sure you want to next?', 'class' => 'btn_blue')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
