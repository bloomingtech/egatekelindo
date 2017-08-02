<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('SPK Produksi #', false); ?>
                <?php if ($workOrderProduction->header->isNewRecord) : ?>
                    <?php echo CHtml::activeTextField($workOrderProduction->header, 'cn_ordinal', array('size' => 10, 'maxlength' => 20)); ?>
                    <?php echo CHtml::error($workOrderProduction->header, 'cn_ordinal'); ?>
                    <?php echo CHtml::error($workOrderProduction->header, 'ordinal'); ?>
                <?php else : ?>
                    <?php echo CHtml::encode($workOrderProduction->header->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT)); ?>
                <?php endif; ?>
                <?php //echo CHtml::encode($workOrderProduction->header->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $workOrderProduction->header,
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
                <?php echo CHtml::error($workOrderProduction->header, 'date'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('UP', ''); ?>
                <?php echo CHtml::activeTextField($workOrderProduction->header, 'order_to'); ?>
                <?php echo CHtml::error($workOrderProduction->header, 'order_to'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('CC', ''); ?>
                <?php echo CHtml::activeTextField($workOrderProduction->header, 'order_to_copy'); ?>
                <?php echo CHtml::error($workOrderProduction->header, 'order_to_copy'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Paint Color', ''); ?>
                <?php echo CHtml::activeTextField($workOrderProduction->header, 'paint_color'); ?>
                <?php echo CHtml::error($workOrderProduction->header, 'paint_color'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Gambar Konstruksi? :', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderProduction->header, 'is_construction_drawing'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Gambar Section? :', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderProduction->header, 'is_section_drawing'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Gambar Single Line? :', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderProduction->header, 'is_single_line_drawing'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Gambar Kontrol? :', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderProduction->header, 'is_control_drawing'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('List Komponen? :', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderProduction->header, 'is_component_listed'); ?>
            </div>



        </div>

        <div class="span-12 last">
            <div>
                <?php echo CHtml::label('SO #', ''); ?>
                <?php echo CHtml::encode($workOrderProduction->header->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)); ?>
            </div>
            <br/>
            <div>
                <?php echo CHtml::label('Client Company', ''); ?>
                <?php echo CHtml::encode(CHtml::value($workOrderProduction->header->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'client_company')); ?>
            </div>
            <br/>
            <div>
                <?php echo CHtml::label('Project Name', ''); ?>
                <?php echo CHtml::encode(CHtml::value($workOrderProduction->header->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'project_name')); ?>
            </div>
            <br/>
            <div class="row">
                <?php echo CHtml::label('SPK Gambar #', ''); ?>
                <?php //if ($workOrderProduction->header->isNewRecord): ?>
                <?php //echo CHtml::activeTextField($workOrderProduction->header, 'work_order_drawing_header_id', array('readonly' => true, 'onclick' => '$("#work-order-drawing-header-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#work-order-drawing-header-dialog").dialog("open"); return false; }')); ?>
                <?php //echo CHtml::openTag('span', array('id' => 'work_order_drawing_header_code_number')); ?>
                <?php //echo CHtml::encode(($workOrderDrawing === null) ? '' : $workOrderDrawing->getCodeNumber(WorkOrderDrawingHeader::CN_CONSTANT)); ?>
                <?php //echo CHtml::closeTag('span'); ?>
                <?php //echo CHtml::error($workOrderProduction->header, 'work_order_drawing_header_id'); ?>

                <?php
//                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
//                        'id' => 'work-order-drawing-header-dialog',
//                        // additional javascript options for the dialog plugin
//                        'options' => array(
//                            'title' => 'SPK Gambar',
//                            'autoOpen' => false,
//                            'width' => 'auto',
//                            'modal' => true,
//                        ),
//                    ));
                ?>
                <?php
//                    $this->widget('zii.widgets.grid.CGridView', array(
//                        'id' => 'work-order-drawing-header-grid',
//                        'dataProvider' => $workOrderDrawingDataProvider,
//                        'filter' => $workOrderDrawing,
//                        'selectionChanged' => 'js:function(id) {
//							$("#' . CHtml::activeId($workOrderProduction->header, 'work_order_drawing_header_id') . '").val($.fn.yiiGridView.getSelection(id));
//							$("#work-order-drawing-header-dialog").dialog("close");
//							if ($.fn.yiiGridView.getSelection(id) == "")
//							{
//								$("#work_order_drawing_code_number").html("");
//								$("#work_order_drawing_date").html("");
//					
//							}
//							else
//							{
//								$.ajax({
//									type: "POST",
//									dataType: "JSON",
//									url: "' . CController::createUrl('AjaxJsonWorkOrderDrawing', array('id' => $workOrderProduction->header->id)) . '",
//									data: $("form").serialize(),
//									success: function(data) {
//										$("#work_order_drawing_code_number").html(data.work_order_drawing_code_number);
//										$("#work_order_drawing_date").html(data.work_order_drawing_date);
//										
//									},
//								});
//							}
//                                                        $.ajax({
//								type: "POST",
//								url: "' . CController::createUrl('ajaxHtmlAddDetail', array('id' => $workOrderProduction->header->id)) . '",
//								data: $("form").serialize(),
//								success: function(html) { $("#detail_div").html(html); },
//							});
//							
//						}',
//                        'columns' => array(
//                            array(
//                                'name' => 'cn_ordinal',
//                                'header' => 'Order #',
//                                'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($workOrderDrawing, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
//                                '<div style="display: inline-block"> &nbsp; /' . WorkOrderDrawingHeader::CN_CONSTANT . '/ &nbsp; </div>' .
//                                '<div style="display: inline-block">' . CHtml::activeDropDownList($workOrderDrawing, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
//                                '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
//                                '<div style="display: inline-block">' . CHtml::activeTextField($workOrderDrawing, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
//                                'value' => '$data->getCodeNumber(WorkOrderDrawingHeader::CN_CONSTANT)',
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
                <?php echo CHtml::encode($workOrderProduction->header->workOrderDrawingHeader->getCodeNumber(WorkOrderDrawingHeader::CN_CONSTANT)); ?>
                <?php echo CHtml::activeHiddenField($workOrderProduction->header, 'work_order_drawing_header_id', array('value' => $workOrderProduction->header->work_order_drawing_header_id)); ?>
                <?php //endif; ?>
            </div>
            <br/>
            <div class="row">
                <?php echo CHtml::label('Urgent?', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderProduction->header, 'is_urgent'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Cat Grey?', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderProduction->header, 'is_grey_painted'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Cat Light Grey?', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderProduction->header, 'is_light_grey_painted'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Cat cream?', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderProduction->header, 'is_cream_painted'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($workOrderProduction->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($workOrderProduction->header, 'note'); ?>
            </div>

        </div>
    </div>

    <hr />


    <div class="row">
        <?php echo CHtml::errorSummary($workOrderProduction->header); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('workOrderProduction' => $workOrderProduction)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn_blue')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
