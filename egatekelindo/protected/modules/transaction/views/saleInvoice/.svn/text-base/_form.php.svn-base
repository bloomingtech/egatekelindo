<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('No Faktur #', false); ?>
                <?php echo CHtml::encode($saleInvoice->header->getCodeNumber(SaleInvoiceHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $saleInvoice->header,
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
                <?php echo CHtml::error($saleInvoice->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Faktur Pajak', ''); ?>
                <?php echo CHtml::activeTextField($saleInvoice->header, 'tax_number'); ?>
                <?php echo CHtml::error($saleInvoice->header, 'tax_number'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Customer Order Number', ''); ?>
                <?php echo CHtml::activeTextField($saleInvoice->header, 'customer_order_number'); ?>
                <?php echo CHtml::error($saleInvoice->header, 'customer_order_number'); ?>
            </div>

        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Delivery #', ''); ?>
                <?php if ($saleInvoice->header->isNewRecord): ?>
                    <?php echo CHtml::activeTextField($saleInvoice->header, 'delivery_header_id', array('readonly' => true, 'onclick' => '$("#sale-order-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#sale-order-dialog").dialog("open"); return false; }')); ?>
                    <?php echo CHtml::openTag('span', array('id' => 'delivery_header_code_number')); ?>
                    <?php echo CHtml::encode(($deliveryHeader === null) ? '' : $deliveryHeader->getCodeNumber(DeliveryHeader::CN_CONSTANT)); ?>
                    <?php echo CHtml::closeTag('span'); ?>
                    <?php echo CHtml::error($saleInvoice->header, 'delivery_header_id'); ?>

                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'sale-order-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Delivery',
                            'autoOpen' => false,
                            'width' => 'auto',
                            'modal' => true,
                        ),
                    ));
                    ?>
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'sale-header-grid',
                        'dataProvider' => $deliveryHeaderDataProvider,
                        'filter' => $deliveryHeader,
                        'selectionChanged' => 'js:function(id) {
							$("#' . CHtml::activeId($saleInvoice->header, 'delivery_header_id') . '").val($.fn.yiiGridView.getSelection(id));
							$("#sale-order-dialog").dialog("close");
							if ($.fn.yiiGridView.getSelection(id) == "")
							{
								$("#delivery_header_code_number").html("");
								$("#delivery_header_date").html("");
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
									url: "' . CController::createUrl('AjaxJsonDelivery', array('id' => $saleInvoice->header->id)) . '",
									data: $("form").serialize(),
									success: function(data) {
										$("#delivery_header_code_number").html(data.delivery_header_code_number);
										$("#delivery_header_date").html(data.delivery_header_date);
										$("#sale_order_code_number").html(data.sale_order_code_number);
										$("#sale_order_date").html(data.sale_order_date);
										$("#sale_order_work_order_number").html(data.sale_order_work_order_number);
										$("#sale_order_project_name").html(data.sale_order_project_name);
									},
								});
							}
							$.ajax({
								type: "POST",
								url: "' . CController::createUrl('ajaxHtmlShowDelivery', array('id' => $saleInvoice->header->id)) . '",
								data: $("form").serialize(),
								success: function(html) { $("#detail_div").html(html); },
							});
							
						}',
                        'columns' => array(
                            array(
                                'name' => 'cn_ordinal',
                                'header' => 'Delivery #',
                                'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($deliveryHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; /' . DeliveryHeader::CN_CONSTANT . '/ &nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeDropDownList($deliveryHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeTextField($deliveryHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
                                'value' => '$data->getCodeNumber(DeliveryHeader::CN_CONSTANT)',
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
                    <?php echo CHtml::encode($saleInvoice->header->deliveryHeader->getCodeNumber(DeliveryHeader::CN_CONSTANT)); ?>
                    <?php echo CHtml::activeHiddenField($saleInvoice->header, 'delivery_header_id', array('value' => $saleInvoice->header->delivery_header_id)); ?>
                <?php endif; ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('SO #', ''); ?>
                <span id="sale_order_code_number">
                    <?php if (!$saleInvoice->header->isNewRecord): ?>
                        <?php echo CHtml::encode($saleInvoice->header->deliveryHeader->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?>
                    <?php endif; ?>
                </span>
            </div>
            <div class="row">
                <?php echo CHtml::label('Tanggal SO', ''); ?>
                <span id="sale_order_date">
                    <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($saleInvoice->header->deliveryHeader, 'saleOrder.date'))); ?>
                </span>
            </div>
            <div class="row">
                <?php echo CHtml::label('No PO', ''); ?>
                <span id="sale_order_work_order_number">
                    <?php echo CHtml::encode(CHtml::value($saleInvoice->header->deliveryHeader, 'saleOrder.work_order_number')); ?>
                </span>
            </div>

            <div class="row">
                <?php echo CHtml::label('Project Name', ''); ?>
                <span id="sale_order_project_name">
                    <?php echo CHtml::encode(CHtml::value($saleInvoice->header->deliveryHeader, 'saleOrder.project_name')); ?>
                </span>
            </div>

            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($saleInvoice->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($saleInvoice->header, 'note'); ?>
            </div>
        </div>
    </div>

    <hr />

    <div class="row">
        <?php echo CHtml::error($saleInvoice->header, 'error'); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('saleInvoice' => $saleInvoice)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->