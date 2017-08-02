<div class="form">
    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Pengiriman #', false); ?>
                <?php echo CHtml::encode($delivery->header->getCodeNumber(DeliveryHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $delivery->header,
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
                <?php echo CHtml::error($delivery->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Customer Order Number', ''); ?>
                <?php echo CHtml::activeTextField($delivery->header, 'customer_order_number'); ?>
                <?php echo CHtml::error($delivery->header, 'customer_order_number'); ?>
            </div>
        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Sales Order #', ''); ?>
                <?php if ($delivery->header->isNewRecord): ?>
                    <?php echo CHtml::activeTextField($delivery->header, 'sale_order_header_id', array('readonly' => true, 'onclick' => '$("#sale-header-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#sale-header-dialog").dialog("open"); return false; }')); ?>
                    <?php echo CHtml::openTag('span', array('id' => 'sale_order_code_number')); ?>
                    <?php echo CHtml::encode(($saleOrder === null) ? '' : $saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?>
                    <?php echo CHtml::closeTag('span'); ?>
                    <?php echo CHtml::error($delivery->header, 'sale_order_header_id'); ?>

                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'sale-header-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Order Penjualan',
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
							$("#' . CHtml::activeId($delivery->header, 'sale_order_header_id') . '").val($.fn.yiiGridView.getSelection(id));
							$("#sale-header-dialog").dialog("close");
							if ($.fn.yiiGridView.getSelection(id) == "")
							{
								$("#sale_order_code_number").html("");
								$("#sale_order_date").html("");
					
							}
							else
							{
								$.ajax({
									type: "POST",
									dataType: "JSON",
									url: "' . CController::createUrl('AjaxJsonSale', array('id' => $delivery->header->id)) . '",
									data: $("form").serialize(),
									success: function(data) {
										$("#sale_order_code_number").html(data.sale_order_code_number);
										$("#sale_order_date").html(data.sale_order_date);
										
									},
								});
							}
							
						}',
                        'columns' => array(
                            array(
                                'name' => 'cn_ordinal',
                                'header' => 'Order #',
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
                        ),
                    ));
                    ?>
                    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
                <?php else: ?>
                    <?php echo CHtml::encode($delivery->header->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?>
                    <?php echo CHtml::activeHiddenField($delivery->header, 'sale_order_header_id', array('value' => $delivery->header->sale_order_header_id)); ?>
                <?php endif; ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal Jual', ''); ?>
                <span id="sale_order_date">
                    <?php echo CHtml::encode(CHtml::value($delivery->header, 'saleOrder.date')); ?>
                </span>
            </div>

        </div>
    </div>

    <hr />

    <div class="row">
        <?php
        echo CHtml::button('Add Panel', array(
            'name' => 'Search',
            'onclick' => '$.ajax({
				type: "POST",
				url: "' . CController::createUrl('ajaxHtmlAddDetail', array('id' => $delivery->header->id,)) . '",
				data: $("form").serialize(),
				success: function(html) { $("#detail_div").html(html); },
			});',
            'onkeypress' => '$.ajax({
				type: "POST",
				url: "' . CController::createUrl('ajaxHtmlAddDetail', array('id' => $delivery->header->id,)) . '",
				data: $("form").serialize(),
				success: function(html) { $("#detail_div").html(html); },
			});'
        ));
        ?>

    </div>

    <div class="row">
        <?php echo CHtml::error($delivery->header, 'error'); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('delivery' => $delivery)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn_blue')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
