<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'component-brand-discount-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'value_1'); ?>
		<?php echo $form->textField($model, 'value_1', array('size'=>18, 'maxlength'=>18)); ?>
		<?php echo $form->error($model, 'value_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'value_2'); ?>
		<?php echo $form->textField($model, 'value_2', array('size'=>18, 'maxlength'=>18)); ?>
		<?php echo $form->error($model, 'value_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'value_3'); ?>
		<?php echo $form->textField($model, 'value_3', array('size'=>18, 'maxlength'=>18)); ?>
		<?php echo $form->error($model, 'value_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'value_4'); ?>
		<?php echo $form->textField($model, 'value_4', array('size'=>18, 'maxlength'=>18)); ?>
		<?php echo $form->error($model, 'value_4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'value_5'); ?>
		<?php echo $form->textField($model, 'value_5', array('size'=>18, 'maxlength'=>18)); ?>
		<?php echo $form->error($model, 'value_5'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'currency_id'); ?>
		<?php echo $form->textField($model, 'currency_id'); ?>
		<?php echo $form->error($model, 'currency_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'component_brand_id'); ?>
		<?php echo $form->dropDownList($model, 'component_brand_id', CHtml::listData(ComponentBrand::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model, 'component_brand_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'is_inactive'); ?>
		<?php echo $form->dropDownList($model,'is_inactive', array(ActiveRecord::ACTIVE => ActiveRecord::ACTIVE_LITERAL, ActiveRecord::INACTIVE => ActiveRecord::INACTIVE_LITERAL)); ?>
		<?php echo $form->error($model, 'is_inactive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->