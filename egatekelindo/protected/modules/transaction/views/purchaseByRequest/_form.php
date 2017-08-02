<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::errorSummary($purchase->header); ?>
            </div>

            <?php if (!$purchase->header->isNewRecord): ?>
                <div class="row">
                    <?php echo CHtml::label('PO #', false); ?>
                    <?php echo CHtml::encode($purchase->header->getCodeNumber(PurchaseHeader::CN_CONSTANT)); ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $purchase->header,
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
                <?php echo CHtml::error($purchase->header, 'date'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('PPn / non', false); ?>
                <?php
                echo CHtml::activeDropDownList($purchase->header, 'is_tax', array(
                    '1' => 'PPn',
                    '0' => 'Non-PPn'), array(
                    'onchange' => CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('ajaxJsonGrandTotal', array('id' => $purchase->header->id)), //index is any number
                        'success' => 'function(data) {
                            $("#tax_percentage").html(data.taxPercentage);
                            $("#tax_value").html(data.taxValue);
                            $("#grand_total").html(data.grandTotal);
                        }',
                    )),
                ));
                ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Project', ''); ?>
                <?php echo CHtml::activeTextField($purchase->header, 'project_name'); ?>
                <?php echo CHtml::error($purchase->header, 'project_name'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Client', ''); ?>
                <?php echo CHtml::encode(CHtml::value($purchaseRequestHeader, 'workOrderProductionHeader.workOrderDrawingHeader.budgetingHeader.saleOrderHeader.client_company')); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('SO #', ''); ?>
                <?php echo (empty($purchaseRequestHeader->workOrderProductionHeader)) ? 'N/A' : CHtml::encode($purchaseRequestHeader->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal Kirim', ''); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $purchase->header,
                    'attribute' => 'delivery_date',
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($purchase->header, 'delivery_date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Kirim Ke', ''); ?>
                <?php echo CHtml::activeTextField($purchase->header, 'delivery_place'); ?>
                <?php echo CHtml::error($purchase->header, 'delivery_place'); ?>
            </div>

        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Jenis Pembayaran', false); ?>
                <?php echo CHtml::activeDropDownList($purchase->header, 'is_cash', array(
                    PurchaseHeader::PAYMENT_TERM => PurchaseHeader::PAYMENT_TERM_LITERAL,
                    PurchaseHeader::CASH => PurchaseHeader::CASH_LITERAL)
                ); ?>
            </div>
            
            <div class="row">
                <?php echo CHtml::label('Jenis PO', ''); ?>
                <?php echo CHtml::activeDropDownList($purchase->header, 'purchasing_type_id', CHtml::listData(PurchasingType::model()->findAll(), 'id', 'name'), array(
                    'empty' => '-Select Jenis PO-'
                )); ?>
                <?php echo CHtml::error($purchase->header, 'purchasing_type_id'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Payment Term', ''); ?>
                <?php echo CHtml::activeTextField($purchase->header, 'payment_term'); ?>
                <?php echo CHtml::error($purchase->header, 'payment_term'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Supplier', ''); ?>
                <?php echo CHtml::activeTextField($purchase->header, 'supplier_id', array(
                    'readonly' => true,
                    'onclick' => '$("#supplier-dialog").dialog("open"); return false;',
                    'onkeypress' => 'if (event.keyCode == 13) { $("#supplier-dialog").dialog("open"); return false; }'
                )); ?>

                <?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                    'id' => 'supplier-dialog',
                    // additional javascript options for the dialog plugin
                    'options' => array(
                        'title' => 'Supplier',
                        'autoOpen' => false,
                        'width' => 'auto',
                        'modal' => true,
                    ),
                )); ?>

                <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'supplier-grid',
                    'dataProvider' => $supplierDataProvider,
                    'filter' => $supplier,
                    'selectionChanged' => 'js:function(id) {
                        $("#' . CHtml::activeId($purchase->header, 'supplier_id') . '").val($.fn.yiiGridView.getSelection(id));
                        $("#supplier-dialog").dialog("close");
                        if ($.fn.yiiGridView.getSelection(id) == "")
                        {
                            $("#supplier_name").html("");
                            $("#supplier_company").html("");
                        }
                        else
                        {
                            $.ajax({
                                type: "POST",
                                dataType: "JSON",
                                url: "' . CController::createUrl('ajaxJsonSupplier', array('id' => $purchase->header->id)) . '",
                                data: $("form").serialize(),
                                success: function(data) {
                                    $("#supplier_name").html(data.supplier_name);
                                    $("#supplier_company").html(data.supplier_company);
                                },
                            });
                        }
                    }',
                    'columns' => array(
                        'company',
                        'name',
                    ),
                )); ?>
                <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
                <?php echo CHtml::error($purchase->header, 'supplier_id'); ?>
            </div>

            <?php $purchaseSupplier = $purchase->header->supplier(array('scopes' => 'resetScope')); ?>
            <div class="row">
                <?php if ($purchase->header->isNewRecord): ?>
                    <?php echo CHtml::openTag('span', array('id' => 'supplier_company')); ?>
                    <?php echo CHtml::closeTag('span'); ?>
                <?php else: ?>
                    <?php echo CHtml::encode(CHtml::value($purchaseSupplier, 'company')); ?>
                <?php endif; ?>
            </div>
            <div class="row">
                <?php if ($purchase->header->isNewRecord): ?>
                    <?php echo CHtml::openTag('span', array('id' => 'supplier_name')); ?>
                    <?php echo CHtml::closeTag('span'); ?>
                <?php else: ?>
                    <?php echo CHtml::encode(CHtml::value($purchaseSupplier, 'name')); ?>
                <?php endif; ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($purchase->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($purchase->header, 'note'); ?>
            </div>
        </div>
    </div>

    <hr />

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('purchase' => $purchase)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn_blue')); ?>
    </div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->
