<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('SPK Gambar #', false); ?>
                <?php if ($workOrderDrawing->header->isNewRecord) : ?>
                    <?php echo CHtml::activeTextField($workOrderDrawing->header, 'cn_ordinal', array('size' => 10, 'maxlength' => 20)); ?>
                    <?php echo CHtml::error($workOrderDrawing->header, 'cn_ordinal'); ?>
                    <?php echo CHtml::error($workOrderDrawing->header, 'ordinal'); ?>
                <?php else : ?>
                    <?php echo CHtml::encode($workOrderDrawing->header->getCodeNumber(WorkOrderDrawingHeader::CN_CONSTANT)); ?>
                <?php endif; ?>
                <?php //echo CHtml::encode($workOrderDrawing->header->getCodeNumber(WorkOrderDrawingHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $workOrderDrawing->header,
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
                <?php echo CHtml::error($workOrderDrawing->header, 'date'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('UP', ''); ?>
                <?php echo CHtml::activeTextField($workOrderDrawing->header, 'order_to'); ?>
                <?php echo CHtml::error($workOrderDrawing->header, 'order_to'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('CC', ''); ?>
                <?php echo CHtml::activeTextField($workOrderDrawing->header, 'order_to_copy'); ?>
                <?php echo CHtml::error($workOrderDrawing->header, 'order_to_copy'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Gambar Layout? :', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderDrawing->header, 'is_drawing_layout_attached'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Spesifikasi Teknis? :', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderDrawing->header, 'is_technical_specification_attached'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Single Line Diagram? :', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderDrawing->header, 'is_single_line_diagram_attached'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Break Down Component? :', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderDrawing->header, 'is_break_down_component_attached'); ?>
            </div>
            <div>
                <?php echo CHtml::label('Order Handling', ''); ?>
                <?php echo CHtml::activeDropDownList($workOrderDrawing->header, 'employee_id_incharge', CHtml::listData(Employee::model()->findAll(), 'id', 'name'), array('empty' => '-- Pilih Karyawan --')); ?>
                <?php echo CHtml::error($workOrderDrawing->header, 'employee_id_incharge'); ?>
            </div>

            <div>
                <?php echo CHtml::label('Factory Manager', ''); ?>
                <?php echo CHtml::activeDropDownList($workOrderDrawing->header, 'employee_id_related', CHtml::listData(Employee::model()->findAll(), 'id', 'name'), array('empty' => '-- Pilih Karyawan --')); ?>
                <?php echo CHtml::error($workOrderDrawing->header, 'employee_id_related'); ?>
            </div>

        </div>

        <div class="span-12 last">
            <div>
                <?php echo CHtml::label('SO #', ''); ?>
                <?php echo CHtml::encode($workOrderDrawing->header->budgetingHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)); ?>
            </div>
            <br/>
            <div>
                <?php echo CHtml::label('Client Company', ''); ?>
                <?php echo CHtml::encode(CHtml::value($workOrderDrawing->header->budgetingHeader->saleOrderHeader, 'client_company')); ?>
            </div>
            <br/>
            <div>
                <?php echo CHtml::label('Project Name', ''); ?>
                <?php echo CHtml::encode(CHtml::value($workOrderDrawing->header->budgetingHeader->saleOrderHeader, 'project_name')); ?>
            </div>
            <br/>
            <div class="row">
                <?php echo CHtml::label('Budgeting #', ''); ?>
                <?php //if ($workOrderDrawing->header->isNewRecord): ?>
                <?php //echo CHtml::activeTextField($workOrderDrawing->header, 'budgeting_header_id', array('readonly' => true, 'onclick' => '$("#budgeting-header-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#budgeting-header-dialog").dialog("open"); return false; }')); ?>
                <?php //echo CHtml::openTag('span', array('id' => 'budgeting_header_code_number')); ?>
                <?php //echo CHtml::encode(($budgetingHeader === null) ? '' : $budgetingHeader->getCodeNumber(BudgetingHeader::CN_CONSTANT)); ?>
                <?php //echo CHtml::closeTag('span'); ?>
                <?php //echo CHtml::error($workOrderDrawing->header, 'budgeting_header_id'); ?>

                <?php
//                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
//                        'id' => 'budgeting-header-dialog',
//                        // additional javascript options for the dialog plugin
//                        'options' => array(
//                            'title' => 'Budgeting',
//                            'autoOpen' => false,
//                            'width' => 'auto',
//                            'modal' => true,
//                        ),
//                    ));
                ?>
                <?php
//                    $this->widget('zii.widgets.grid.CGridView', array(
//                        'id' => 'budgeting-header-grid',
//                        'dataProvider' => $budgetingHeaderDataProvider,
//                        'filter' => $budgetingHeader,
//                        'selectionChanged' => 'js:function(id) {
//							$("#' . CHtml::activeId($workOrderDrawing->header, 'budgeting_header_id') . '").val($.fn.yiiGridView.getSelection(id));
//							$("#budgeting-header-dialog").dialog("close");
//							if ($.fn.yiiGridView.getSelection(id) == "")
//							{
//								$("#budgeting_header_code_number").html("");
//								$("#budgeting_header_date").html("");
//					
//							}
//							else
//							{
//								$.ajax({
//									type: "POST",
//									dataType: "JSON",
//									url: "' . CController::createUrl('AjaxJsonBudgeting', array('id' => $workOrderDrawing->header->id)) . '",
//									data: $("form").serialize(),
//									success: function(data) {
//										$("#budgeting_header_code_number").html(data.budgeting_header_code_number);
//										$("#budgeting_header_date").html(data.budgeting_header_date);
//										
//									},
//								});
//							}
//                                                        $.ajax({
//								type: "POST",
//								url: "' . CController::createUrl('ajaxHtmlAddDetail', array('id' => $workOrderDrawing->header->id)) . '",
//								data: $("form").serialize(),
//								success: function(html) { $("#detail_div").html(html); },
//							});
//							
//						}',
//                        'columns' => array(
//                            array(
//                                'name' => 'cn_ordinal',
//                                'header' => 'Order #',
//                                'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($budgetingHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
//                                '<div style="display: inline-block"> &nbsp; /' . BudgetingHeader::CN_CONSTANT . '/ &nbsp; </div>' .
//                                '<div style="display: inline-block">' . CHtml::activeDropDownList($budgetingHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
//                                '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
//                                '<div style="display: inline-block">' . CHtml::activeTextField($budgetingHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
//                                'value' => '$data->getCodeNumber(BudgetingHeader::CN_CONSTANT)',
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
                <?php echo CHtml::encode($workOrderDrawing->header->budgetingHeader->getCodeNumber(BudgetingHeader::CN_CONSTANT)); ?>
                <?php echo CHtml::activeHiddenField($workOrderDrawing->header, 'budgeting_header_id', array('value' => $workOrderDrawing->header->budgeting_header_id)); ?>
                <?php //endif; ?>
            </div>
            <br/>
            <div class="row">
                <?php echo CHtml::label('Gambar Konstruksi?', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderDrawing->header, 'is_construction_layout'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Front & Side View?', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderDrawing->header, 'is_front_side_view'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Section?', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderDrawing->header, 'is_section'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Gambar Kontrol?', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderDrawing->header, 'is_control_layout'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Komponen List?', ''); ?>
                <?php echo CHtml::activeCheckBox($workOrderDrawing->header, 'is_component_list'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($workOrderDrawing->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($workOrderDrawing->header, 'note'); ?>
            </div>

        </div>
    </div>

    <hr />
    <div class="row">
        <?php echo CHtml::errorSummary($workOrderDrawing->header); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('workOrderDrawing' => $workOrderDrawing)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn_blue')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
