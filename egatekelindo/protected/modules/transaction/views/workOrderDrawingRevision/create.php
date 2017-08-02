<h1>SPK Gambar Reivisi</h1>
<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('SPK Gambar #', false); ?>
                <?php echo CHtml::encode($workOrderDrawingRevision->header->workOrderDrawingHeader->getCodeNumber(WorkOrderDrawingHeader::CN_CONSTANT)); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Tanggal #', false); ?>
                <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($workOrderDrawingRevision->header->workOrderDrawingHeader, 'date')))); ?>
            </div>

        </div>

        <div class="span-12 last">
            <div>
                <?php echo CHtml::label('SO #', ''); ?>
                <?php echo CHtml::encode($workOrderDrawingRevision->header->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)); ?>
            </div>
            <br/>
            <div>
                <?php echo CHtml::label('Client Company', ''); ?>
                <?php echo CHtml::encode(CHtml::value($workOrderDrawingRevision->header->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'client_company')); ?>
            </div>
            <br/>
            <div>
                <?php echo CHtml::label('Project Name', ''); ?>
                <?php echo CHtml::encode(CHtml::value($workOrderDrawingRevision->header->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'project_name')); ?>
            </div>
            <br/>

        </div>
    </div>

    <hr />
    <div class="row">
        <?php echo CHtml::errorSummary($workOrderDrawingRevision->header); ?>
    </div>

    <div class="row">
        <?php
        echo CHtml::button('Tambah', array(
            'id' => 'btn_product',
            'onclick' => '$.ajax({
				type: "POST",
				data: $("form").serialize(),
				url: "' . CController::createUrl('ajaxHtmlAddDetail', array('id' => $workOrderDrawingRevision->header->id)) . '",
				success: function(html){
					$("#detail_div").html(html);
				}
			})'
        ));
        ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('workOrderDrawingRevisionComponent' => $workOrderDrawingRevision), false, true); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn_blue')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
