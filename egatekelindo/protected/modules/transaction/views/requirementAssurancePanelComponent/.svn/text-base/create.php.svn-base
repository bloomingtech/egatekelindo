<h1>Kerja Tambah</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($requirementAssurancePanelComponent->header); ?>
    <div class="span-12">
        <div class="row">
            <?php echo CHtml::label('SO #', false); ?>
            <?php echo CHtml::encode($requirementAssurancePanelComponent->header->requirementAssuranceHeader->requirementHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Tanggal', false); ?>
            <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", $requirementAssurancePanelComponent->header->requirementAssuranceHeader->requirementHeader->saleOrderHeader->date)); ?>
        </div>

		<div class="row">
            <?php echo CHtml::label('Project', false); ?>
            <?php echo CHtml::encode($requirementAssurancePanelComponent->header->requirementAssuranceHeader->requirementHeader->saleOrderHeader->project_name); ?>
        </div>
		
		<div class="row">
            <?php echo CHtml::label('Client', false); ?>
            <?php echo CHtml::encode($requirementAssurancePanelComponent->header->requirementAssuranceHeader->requirementHeader->saleOrderHeader->client_name); ?>
        </div>
		
        <div class="row">
            <?php echo CHtml::label('Panel Name', false); ?>
            <?php echo CHtml::encode($requirementAssurancePanelComponent->header->requirementDetail->saleOrderDetail->panel_name); ?>
        </div>
    </div>
    <br/>

    <div id="detail_component">
        <?php $this->renderPartial('_detail', array('requirementAssurancePanelComponent' => $requirementAssurancePanelComponent)); ?>
    </div>
        
	<br/>
	
    <div class="row buttons">
        <?php echo CHtml::submitButton('Save', array('name' => 'Save', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>
    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
