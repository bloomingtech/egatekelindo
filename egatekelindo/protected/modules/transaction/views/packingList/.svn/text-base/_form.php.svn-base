<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($packingList->header); ?>
    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Packing List #', false); ?>
                <?php echo CHtml::encode($packingList->header->getCodeNumber(PackingListHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $packingList->header,
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
                <?php echo CHtml::error($packingList->header, 'date'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($packingList->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($packingList->header, 'note'); ?>
            </div>

        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Part List #', ''); ?>
                <?php if ($packingList->header->isNewRecord): ?>
                    <?php echo CHtml::activeTextField($packingList->header, 'part_list_header_id', array('readonly' => true, 'onclick' => '$("#part-list-header-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#part-list-header-dialog").dialog("open"); return false; }')); ?>
                    <?php echo CHtml::openTag('span', array('id' => 'part_list_header_code_number')); ?>
                    <?php echo CHtml::encode(($partListHeader === null) ? '' : $partListHeader->getCodeNumber(PartListHeader::CN_CONSTANT)); ?>
                    <?php echo CHtml::closeTag('span'); ?>
                    <?php echo CHtml::error($packingList->header, 'part_list_header_id'); ?>

                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'part-list-header-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Part List',
                            'autoOpen' => false,
                            'width' => 'auto',
                            'modal' => true,
                        ),
                    ));
                    ?>
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'sale-header-grid',
                        'dataProvider' => $partListHeaderDataProvider,
                        'filter' => $partListHeader,
                        'selectionChanged' => 'js:function(id) {
							$("#' . CHtml::activeId($packingList->header, 'part_list_header_id') . '").val($.fn.yiiGridView.getSelection(id));
							$("#part-list-header-dialog").dialog("close");
							if ($.fn.yiiGridView.getSelection(id) == "")
							{
								$("#part_list_header_code_number").html("");
								$("#part_list_header_date").html("");
					
							}
							else
							{
								$.ajax({
									type: "POST",
									dataType: "JSON",
									url: "' . CController::createUrl('AjaxJsonPartList', array('id' => $packingList->header->id)) . '",
									data: $("form").serialize(),
									success: function(data) {
										$("#part_list_header_code_number").html(data.part_list_header_code_number);
										$("#part_list_header_date").html(data.part_list_header_date);
										
									},
								});
							}
							$.ajax({
								type: "POST",
								url: "' . CController::createUrl('ajaxHtmlShowPartList', array('id' => $packingList->header->id)) . '",
								data: $("form").serialize(),
								success: function(html) { $("#detail_div").html(html); },
							});
						}',
                        'columns' => array(
                            array(
                                'name' => 'cn_ordinal',
                                'header' => 'Part List #',
                                'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($partListHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; /' . PartListHeader::CN_CONSTANT . '/ &nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeDropDownList($partListHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeTextField($partListHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
                                'value' => '$data->getCodeNumber(PartListHeader::CN_CONSTANT)',
                                'htmlOptions' => array('style' => 'width: 200px'),
                            ),
                            array(
                                'header' => 'Tanggal',
                                'name' => 'date',
                                'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
                            ),
                        ),
                    ));
                    ?>
                    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
                <?php else: ?>
                    <?php echo CHtml::encode($packingList->header->partListHeader->getCodeNumber(PartListHeader::CN_CONSTANT)); ?>
                    <?php echo CHtml::activeHiddenField($packingList->header, 'part_list_header_id', array('value' => $packingList->header->part_list_header_id)); ?>
                <?php endif; ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal Part List', ''); ?>
                <span id="part_list_header_date">
                    <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($packingList->header, 'partListHeader.date')))) ?>
                </span>
            </div>

        </div>
    </div>

    <hr />

    <div class="row">
        <?php echo CHtml::error($packingList->header, 'error'); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('packingList' => $packingList)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn_blue')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
