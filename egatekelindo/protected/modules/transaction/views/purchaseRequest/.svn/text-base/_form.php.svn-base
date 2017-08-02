<script type="text/javascript">

    window.onload = function() {

    var is_service = <?php echo ($purchaseRequest->header->is_service); ?>;

    if (is_service == 0)
    {
        $("#detail_product_div").show(); 
        $("#btn_product").show(); 
        $("#btn_check_history").show(); 
        $("#detail_service_div").hide();
        $("#btn_service").hide(); 
        $("#btn_check_history_service").hide(); 
    }
    else
    {
        $("#detail_product_div").hide(); 
        $("#btn_product").hide(); 
        $("#btn_check_history").hide();
        $("#detail_service_div").show();
        $("#btn_service").show(); 
        $("#btn_check_history_service").show(); 
    }

    }
</script>

<div class="form">

    <?php echo CHtml::beginForm('', 'post', array('enctype' => 'multipart/form-data',)); ?>
    <?php echo CHtml::errorSummary($purchaseRequest->header); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Purchase Request #', false); ?>
                <?php echo CHtml::encode($purchaseRequest->header->getCodeNumber(PurchaseRequestHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $purchaseRequest->header,
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
                <?php echo CHtml::error($purchaseRequest->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal Kirim', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $purchaseRequest->header,
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
                <?php echo CHtml::error($purchaseRequest->header, 'delivery_date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tempat', ''); ?>
                <?php echo CHtml::activeTextField($purchaseRequest->header, 'place'); ?>
                <?php echo CHtml::error($purchaseRequest->header, 'place'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Warna', ''); ?>
                <?php echo CHtml::activeTextField($purchaseRequest->header, 'color'); ?>
                <?php echo CHtml::error($purchaseRequest->header, 'color'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($purchaseRequest->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($purchaseRequest->header, 'note'); ?>
            </div>
        </div>

        <div class="span-12 last">

            <div class="row">
                <?php echo CHtml::label('Jenis Request', false); ?>
                <?php
                echo CHtml::activeDropDownList($purchaseRequest->header, 'is_service', array(PurchaseRequestHeader::PRODUCT => PurchaseRequestHeader::PRODUCT_LITERAL, PurchaseRequestHeader::SERVICE => PurchaseRequestHeader::SERVICE_LITERAL), array(
                    'onchange' =>
                    CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => "JSON",
                        'url' => CController::createUrl('ajaxHtmlResetDetail', array('id' => $purchaseRequest->header->id)),
                        'data' => array('type' => 'js:this.value'),
                        'success' => 'function(html) { 
                            $("#detail_product_div").html(html); 
                            $("#detail_service_div").html(html);
                        }',
                    )) .
                    'if ($(this).val() == 0) 
                    {
                        $("#detail_product_div").show(); 
                        $("#btn_product").show(); 
                        $("#detail_service_div").hide();
                        $("#btn_service").hide(); 
                    }
                    else if ($(this).val() == 1) 
                    {
                        $("#detail_product_div").hide(); 
                        $("#btn_product").hide(); 
                        $("#detail_service_div").show();
                        $("#btn_service").show(); 
                    }',
                ));
                ?>
                <?php echo CHtml::error($purchaseRequest->header, 'is_service'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Pekerjaan', false); ?>
                <?php echo CHtml::activeDropDownList($purchaseRequest->header, 'job_id', CHtml::listData(Job::model()->findAll(), 'id', 'name'), array(
                    'empty' => '-Pilih Pekerjaan-'
                )); ?>
                <?php echo CHtml::error($purchaseRequest->header, 'job_id'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Departemen', false); ?>
                <?php echo CHtml::activeDropDownList($purchaseRequest->header, 'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'name'), array(
                    'empty' => '-Pilih Departemen-'
                )); ?>
                <?php echo CHtml::error($purchaseRequest->header, 'department_id'); ?>
            </div>

            <div class="row">
                <?php if ($purchaseRequest->header->isNewRecord): ?>
                    <?php echo CHtml::label('SPK Produksi', ''); ?>

                    <?php echo CHtml::activeTextField($purchaseRequest->header, 'work_order_production_header_id', array(
                        'readonly' => true,
                        'onclick' => '$("#work-order-dialog").dialog("open"); return false;',
                        'onkeypress' => 'if (event.keyCode == 13) { $("#work-order-dialog").dialog("open"); return false; }'
                    )); ?>
                    <?php echo CHtml::error($purchaseRequest->header, 'work_order_production_header_id'); ?>

                    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'work-order-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'SPK Produksi',
                            'autoOpen' => false,
                            'width' => 'auto',
                            'modal' => true,
                        ),
                    )); ?>
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'work-order-grid',
                        'dataProvider' => $workOrderProductionDataProvider,
                        'filter' => $workOrderProduction,
                        'selectionChanged' => 'js:function(id) {
                            $("#' . CHtml::activeId($purchaseRequest->header, 'work_order_production_header_id') . '").val($.fn.yiiGridView.getSelection(id));
                            $("#work-order-dialog").dialog("close");
                            if ($.fn.yiiGridView.getSelection(id) == "")
                            {
                                $("#customer_project").html("");
                                $("#customer_company").html("");
                                $("#customer_sale_order").html("");
                                $("#customer_work_order").html("");
                            }
                            else
                            {
                                $.ajax({
                                    type: "POST",
                                    dataType: "JSON",
                                    url: "' . CController::createUrl('ajaxJsonWorkOrderProduction', array('id' => $purchaseRequest->header->id)) . '",
                                    data: $("form").serialize(),
                                    success: function(data) {
                                        $("#customer_project").html(data.customer_project);
                                        $("#customer_company").html(data.customer_company);
                                        $("#customer_sale_order").html(data.customer_sale_order);
                                        $("#customer_work_order").html(data.customer_work_order);
                                    },
                                });
                            }
                        }',
                        'columns' => array(
                            array(
                                'header' => 'SPK #',
                                'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($workOrderProduction, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; /' . WorkOrderProductionHeader::CN_CONSTANT . '/ &nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeDropDownList($workOrderProduction, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeTextField($workOrderProduction, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
                                'value' => 'CHtml::encode($data->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT))',
                                'htmlOptions' => array('style' => 'width: 300px'),
                            ),
                            array(
                                'header' => 'SO #',
                                'filter' => false,
                                'value' => 'CHtml::encode($data->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT))',
                                'htmlOptions' => array('style' => 'width: 250px'),
                            ),
                            array(
                                'header' => 'Project',
                                'filter' => false,
                                'value' => 'CHtml::encode($data->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->project_name)',
                            ),
                            array(
                                'header' => 'Company',
                                'filter' => false,
                                'value' => 'CHtml::encode($data->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->client_company)',
                            ),
                        ),
                    ));
                    ?>
                    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
                <?php endif; ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Nama Klien', ''); ?>
                <?php echo CHtml::openTag('span', array('id' => 'customer_company')); ?>
                <?php if (!$purchaseRequest->header->isNewRecord): ?>
                    <?php echo CHtml::encode($purchaseRequest->header->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->client_company); ?>
                <?php endif; ?>
                <?php echo CHtml::closeTag('span'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('SO #', ''); ?>
                <?php echo CHtml::openTag('span', array('id' => 'customer_sale_order')); ?>
                <?php if (!$purchaseRequest->header->isNewRecord): ?>
                    <?php echo CHtml::encode($purchaseRequest->header->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)); ?>
                <?php endif; ?>
                <?php echo CHtml::closeTag('span'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Nama Proyek', ''); ?>
                <?php echo CHtml::openTag('span', array('id' => 'customer_project')); ?>
                <?php if (!$purchaseRequest->header->isNewRecord): ?>
                    <?php echo CHtml::encode($purchaseRequest->header->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->project_name); ?>
                <?php endif; ?>
                <?php echo CHtml::closeTag('span'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('SPK #', ''); ?>
                <?php echo CHtml::openTag('span', array('id' => 'customer_work_order')); ?>
                <?php if (!$purchaseRequest->header->isNewRecord): ?>
                    <?php echo CHtml::encode($purchaseRequest->header->workOrderProductionHeader->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT)); ?>
                <?php endif; ?>
                <?php echo CHtml::closeTag('span'); ?>
            </div>

        </div>
    </div>

    <hr />

    <div class="row">
        <?php echo CHtml::button('Tambah Barang', array(
            'id' => 'btn_product',
            'name' => 'Search Product',
            'onclick' => '$("#product-component-dialog").dialog("open"); return false;',
            'onkeypress' => 'if (event.keyCode == 13) { $("#product-component-dialog").dialog("open"); return false; }'
        )); ?>

        <?php echo CHtml::button('Tambah Jasa', array(
            'id' => 'btn_service',
            'onclick' => '$.ajax({
                type: "POST",
                data: $("form").serialize(),
                url: "' . CController::createUrl('ajaxHtmlAddService', array('id' => $purchaseRequest->header->id)) . '",
                success: function(html){
                    $("#detail_service_div").html(html);
                }
            })'
        )); ?>

        <?php echo CHtml::hiddenField('ComponentId'); ?>
    </div>

    <div id="detail_product_div">
        <?php $this->renderPartial('_detailProduct', array('purchaseRequest' => $purchaseRequest)); ?>
    </div>

    <div id="detail_service_div">
        <?php $this->renderPartial('_detailService', array('purchaseRequest' => $purchaseRequest)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->

<div>
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'product-component-dialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Components',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    )); ?>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'product-component-grid',
        'dataProvider' => $componentDataProvider,
        'filter' => $component,
        'selectionChanged' => 'js:function(id) {
            $("#ComponentId").val($.fn.yiiGridView.getSelection(id));
            $("#product-component-dialog").dialog("close");
            $.ajax({
                type: "POST",
                url: "' . CController::createUrl('ajaxHtmlAddComponentProduct', array('id' => $purchaseRequest->header->id,)) . '",
                data: $("form").serialize(),
                success: function(html) { $("#detail_product_div").html(html); },
            });
        }',
        'columns' => array(
            'code',
            'name',
            'type',
            array(
                'header' => 'Brand',
                'name' => 'component_brand_id',
                'filter' => CHtml::listData(ComponentBrand::model()->findAll(), 'id', 'name'),
                'value' => 'CHtml::value($data, "componentBrand.name")',
            ),
        ),
    )); ?>

    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>

<div>
    <?php /*
      $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
      'id' => 'service-component-dialog',
      // additional javascript options for the dialog plugin
      'options' => array(
      'title' => 'Components',
      'autoOpen' => false,
      'width' => 'auto',
      'modal' => true,
      ),
      ));
      ?>

      <?php
      $this->widget('zii.widgets.grid.CGridView', array(
      'id' => 'service-component-grid',
      'dataProvider' => $componentDataProvider,
      'filter' => $component,
      'selectionChanged' => 'js:function(id) {
      $("#ComponentId").val($.fn.yiiGridView.getSelection(id));
      $("#service-component-dialog").dialog("close");
      $.ajax({
      type: "POST",
      url: "' . CController::createUrl('ajaxHtmlAddComponentService', array('id' => $purchaseRequest->header->id,)) . '",
      data: $("form").serialize(),
      success: function(html) { $("#detail_service_div").html(html); },
      });
      }',
      'columns' => array(
      'code',
      'name',
      'type',
      array(
      'header' => 'Brand',
      'name' => 'component_brand_id',
      'filter' => CHtml::listData(ComponentBrand::model()->findAll(), 'id', 'name'),
      'value' => 'CHtml::value($data, "componentBrand.name")',
      ),
      ),
      ));
      ?>

      <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); */ ?>
</div>
