<div class="form">
    <?php echo CHtml::beginForm('', 'post', array('enctype' => 'multipart/form-data',)); ?>
    <?php echo CHtml::errorSummary($receive->header); ?>
    
    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Penerimaan #', false); ?>
                <?php echo CHtml::encode($receive->header->getCodeNumber(ReceiveHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false, array('class' => 'required')); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $receive->header,
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
                <?php echo CHtml::error($receive->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Gudang', ''); ?>
                <?php echo CHtml::activeDropDownList($receive->header, 'warehouse_id', CHtml::listData(Warehouse::model()->findAll(), 'id', 'name'), array(
                    'empty' => '-Pilih Gudang-'
                )); ?>
                <?php echo CHtml::error($receive->header, 'warehouse_id'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($receive->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($receive->header, 'note'); ?>
            </div>
        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('PO #', false); ?>
                <?php echo CHtml::encode($receive->header->purchaseHeader->getCodeNumber(PurchaseHeader::CN_CONSTANT)); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Tanggal PO', false); ?>
                <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", $receive->header->purchaseHeader->date)); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Supplier', false); ?>
                <?php echo CHtml::encode($receive->header->purchaseHeader->supplier->company); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('SO #', false); ?>
                <?php echo ($receive->header->purchaseHeader->saleOrderHeader != null) ? CHtml::encode($receive->header->purchaseHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)) : 'N/A'; ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Client', false); ?>
                <?php echo ($receive->header->purchaseHeader->saleOrderHeader != null) ? CHtml::encode($receive->header->purchaseHeader->saleOrderHeader->client_company) : 'N/A'; ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Project', false); ?>
                <?php echo ($receive->header->purchaseHeader != null) ? CHtml::encode($receive->header->purchaseHeader->project_name) : 'N/A'; ?>
            </div>
        </div>
    </div>

    <hr />

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('receive' => $receive)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
