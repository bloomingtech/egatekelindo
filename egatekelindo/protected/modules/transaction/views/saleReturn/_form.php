<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('RETUR #', false); ?>
                <?php echo CHtml::encode($saleReturn->header->getCodeNumber(SaleReturnHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $saleReturn->header,
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
                <?php echo CHtml::error($saleReturn->header, 'date'); ?>
            </div>



        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Sale Order #', ''); ?>
                <?php if ($saleReturn->header->isNewRecord): ?>
                    <?php echo CHtml::activeTextField($saleReturn->header, 'sale_order_header_id', array('readonly' => true, 'onclick' => '$("#sale-order-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#sale-order-dialog").dialog("open"); return false; }')); ?>
                    <?php echo CHtml::openTag('span', array('id' => 'sale_order_code_number')); ?>
                    <?php echo CHtml::encode(($saleOrder === null) ? '' : $saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?>
                    <?php echo CHtml::closeTag('span'); ?>
                    <?php echo CHtml::error($saleReturn->header, 'sale_order_header_id'); ?>

                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'sale-order-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Sale Order',
                            'autoOpen' => false,
                            'width' => 'auto',
                            'modal' => true,
                        ),
                    ));
                    ?>
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'sale-header-grid',
                        'dataProvider' => $saleOrderDataProvider,
                        'filter' => $saleOrder,
                        'selectionChanged' => 'js:function(id) {
							$("#' . CHtml::activeId($saleReturn->header, 'sale_order_header_id') . '").val($.fn.yiiGridView.getSelection(id));
							$("#sale-order-dialog").dialog("close");
							if ($.fn.yiiGridView.getSelection(id) == "")
							{
								$("#sale_order_code_number").html("");
								$("#sale_order_date").html("");
								$("#sale_order_work_order_number").html("");
								$("#sale_order_project_name").html("");
					
							}
							else
							{
								$.ajax({
									type: "POST",
									dataType: "JSON",
									url: "' . CController::createUrl('AjaxJsonSaleOrder', array('id' => $saleReturn->header->id)) . '",
									data: $("form").serialize(),
									success: function(data) {
										$("#sale_order_code_number").html(data.sale_order_code_number);
										$("#sale_order_date").html(data.sale_order_date);
										$("#sale_order_work_order_number").html(data.sale_order_work_order_number);
										$("#sale_order_project_name").html(data.sale_order_project_name);
									},
								});
							}
							
						}',
                        'columns' => array(
                            array(
                                'name' => 'cn_ordinal',
                                'header' => 'Sale Order #',
                                'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($saleOrder, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; /' . SaleOrder::CN_CONSTANT . '/ &nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeDropDownList($saleOrder, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeTextField($saleOrder, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
                                'value' => '$data->getCodeNumber(SaleOrder::CN_CONSTANT)',
                                'htmlOptions' => array('style' => 'width: 200px'),
                            ),
                            array(
                                'header' => 'Tanggal',
                                'name' => 'date',
                                'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
                            ),
                            array(
                                'header' => 'No PO',
                                'value' => '$data->work_order_number'
                            ),
                            'project_name',
                        ),
                    ));
                    ?>
                    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
                <?php else: ?>
                    <?php echo CHtml::encode($saleReturn->header->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?>
                    <?php echo CHtml::activeHiddenField($saleReturn->header, 'sale_order_header_id', array('value' => $saleReturn->header->sale_order_header_id)); ?>
                <?php endif; ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal SO', ''); ?>
                <span id="sale_order_date">
                    <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($saleReturn->header, 'saleOrder.date'))); ?>
                </span>
            </div>
            <div class="row">
                <?php echo CHtml::label('No PO', ''); ?>
                <span id="sale_order_work_order_number">
                    <?php echo CHtml::encode(CHtml::value($saleReturn->header, 'saleOrder.work_order_number')); ?>
                </span>
            </div>

            <div class="row">
                <?php echo CHtml::label('Project Name', ''); ?>
                <span id="sale_order_project_name">
                    <?php echo CHtml::encode(CHtml::value($saleReturn->header, 'saleOrder.project_name')); ?>
                </span>
            </div>

        </div>
    </div>

    <hr />

    <div class="row">
        <?php
        echo CHtml::button('Add Item', array(
            'name' => 'Search',
            'onclick' => '$.ajax({
				type: "POST",
				url: "' . CController::createUrl('ajaxHtmlAddDetail', array('id' => $saleReturn->header->id,)) . '",
				data: $("form").serialize(),
				success: function(html) { $("#detail_div").html(html); },
			});',
            'onkeypress' => '$.ajax({
				type: "POST",
				url: "' . CController::createUrl('ajaxHtmlAddDetail', array('id' => $saleReturn->header->id,)) . '",
				data: $("form").serialize(),
				success: function(html) { $("#detail_div").html(html); },
			});'
        ));
        ?>
        <?php //echo CHtml::hiddenField('Sal');  ?>
    </div>

    <div class="row">
        <?php echo CHtml::error($saleReturn->header, 'error'); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('saleReturn' => $saleReturn)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->