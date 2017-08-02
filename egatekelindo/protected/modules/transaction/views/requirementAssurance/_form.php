<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Kerja Tambah #', false); ?>
                <?php if ($requirementAssurance->header->isNewRecord) : ?>
                    <?php echo CHtml::activeTextField($requirementAssurance->header, 'cn_ordinal', array('size' => 10, 'maxlength' => 20)); ?>
                    <?php echo CHtml::error($requirementAssurance->header, 'cn_ordinal'); ?>
                <?php else : ?>
                    <?php echo CHtml::encode($requirementAssurance->header->getCodeNumber(RequirementAssuranceHeader::CN_CONSTANT)); ?>
                <?php endif; ?>
                <?php //echo CHtml::encode($requirementAssurance->header->getCodeNumber(RequirementHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $requirementAssurance->header,
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
                <?php echo CHtml::error($requirementAssurance->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($requirementAssurance->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($requirementAssurance->header, 'note'); ?>
            </div>


        </div>

        <div class="span-12 last">
			<div class="row">
                <?php echo CHtml::label('SO #', ''); ?>
                <?php echo CHtml::encode($requirementAssurance->header->requirementHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)); ?>
            </div>
			<br/>
            <div class="row">
                <?php echo CHtml::label('Project Name', ''); ?>
                <?php echo CHtml::encode($requirementAssurance->header->requirementHeader->saleOrderHeader->project_name); ?>
            </div>
            <br/>
            <div class="row">
                <?php echo CHtml::label('Customer Company', ''); ?>
                <?php echo CHtml::encode($requirementAssurance->header->requirementHeader->saleOrderHeader->client_company); ?>
            </div>
        </div>
    </div>

    <hr />
    <div class="row">
        <?php echo CHtml::errorSummary($requirementAssurance->header); ?>
    </div>

    <div id="detail_brand_discount_div">
        <?php $this->renderPartial('_detail_brand_discount', array('requirementAssurance' => $requirementAssurance)); ?>
    </div>

    <div id="detail_panel_div">
        <?php $this->renderPartial('_detail_panel', array('requirementAssurance' => $requirementAssurance)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn_blue')); ?>
        <?php //echo CHtml::submitButton('Next', array('name' => 'Next', 'confirm' => 'Are you sure you want to next?', 'class' => 'btn_blue')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
