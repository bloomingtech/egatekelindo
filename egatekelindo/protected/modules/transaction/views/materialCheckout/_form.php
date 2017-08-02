<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($materialCheckout->header); ?>
    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Material Checkout #', false); ?>
                <?php echo CHtml::encode($materialCheckout->header->getCodeNumber(MaterialCheckoutHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $materialCheckout->header,
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
                <?php echo CHtml::error($materialCheckout->header, 'date'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($materialCheckout->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($materialCheckout->header, 'note'); ?>
            </div>

        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Packing List #', ''); ?>
                <?php if ($materialCheckout->header->isNewRecord): ?>
                    <?php echo CHtml::activeTextField($materialCheckout->header, 'packing_list_header_id', array('readonly' => true, 'onclick' => '$("#packing-list-header-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#packing-list-header-dialog").dialog("open"); return false; }')); ?>
                    <?php echo CHtml::openTag('span', array('id' => 'packing_list_header_code_number')); ?>
                    <?php echo CHtml::encode(($packingListHeader === null) ? '' : $packingListHeader->getCodeNumber(PackingListHeader::CN_CONSTANT)); ?>
                    <?php echo CHtml::closeTag('span'); ?>
                    <?php echo CHtml::error($materialCheckout->header, 'packing_list_header_id'); ?>

                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'packing-list-header-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Packing List',
                            'autoOpen' => false,
                            'width' => 'auto',
                            'modal' => true,
                        ),
                    ));
                    ?>
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'sale-header-grid',
                        'dataProvider' => $packingListHeaderDataProvider,
                        'filter' => $packingListHeader,
                        'selectionChanged' => 'js:function(id) {
							$("#' . CHtml::activeId($materialCheckout->header, 'packing_list_header_id') . '").val($.fn.yiiGridView.getSelection(id));
							$("#packing-list-header-dialog").dialog("close");
							if ($.fn.yiiGridView.getSelection(id) == "")
							{
								$("#packing_list_header_code_number").html("");
								$("#packing_list_header_date").html("");
					
							}
							else
							{
								$.ajax({
									type: "POST",
									dataType: "JSON",
									url: "' . CController::createUrl('AjaxJsonPackingList', array('id' => $materialCheckout->header->id)) . '",
									data: $("form").serialize(),
									success: function(data) {
										$("#packing_list_header_code_number").html(data.packing_list_header_code_number);
										$("#packing_list_header_date").html(data.packing_list_header_date);
										
									},
								});
							}
							$.ajax({
								type: "POST",
								url: "' . CController::createUrl('ajaxHtmlShowPackingList', array('id' => $materialCheckout->header->id)) . '",
								data: $("form").serialize(),
								success: function(html) { $("#detail_div").html(html); },
							});
						}',
                        'columns' => array(
                            array(
                                'name' => 'cn_ordinal',
                                'header' => 'Packing List#',
                                'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($packingListHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; /' . PackingListHeader::CN_CONSTANT . '/ &nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeDropDownList($packingListHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeTextField($packingListHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
                                'value' => '$data->getCodeNumber(PackingListHeader::CN_CONSTANT)',
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
                    <?php echo CHtml::encode($materialCheckout->header->packingListHeader->getCodeNumber(PackingListHeader::CN_CONSTANT)); ?>
                    <?php echo CHtml::activeHiddenField($materialCheckout->header, 'packing_list_header_id', array('value' => $materialCheckout->header->packing_list_header_id)); ?>
                <?php endif; ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal Packing', ''); ?>
                <span id="packing_list_header_date">
                    <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($materialCheckout->header, 'packingListHeader.date'))) ?>
                </span>
            </div>

        </div>
    </div>

    <hr />

    <div class="row">
        <?php echo CHtml::error($materialCheckout->header, 'error'); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('materialCheckout' => $materialCheckout)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn_blue')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
