<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'supplier-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name', array('size'=>60, 'maxlength'=>60)); ?>
		<?php echo $form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'company'); ?>
		<?php echo $form->textField($model, 'company', array('size'=>60, 'maxlength'=>60)); ?>
		<?php echo $form->error($model, 'company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'address'); ?>
		<?php echo $form->textField($model, 'address', array('size'=>60, 'maxlength'=>60)); ?>
		<?php echo $form->error($model, 'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'phone'); ?>
		<?php echo $form->textField($model, 'phone', array('size'=>60, 'maxlength'=>60)); ?>
		<?php echo $form->error($model, 'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'email'); ?>
		<?php echo $form->textField($model, 'email', array('size'=>60, 'maxlength'=>60)); ?>
		<?php echo $form->error($model, 'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'fax'); ?>
		<?php echo $form->textField($model, 'fax', array('size'=>60, 'maxlength'=>60)); ?>
		<?php echo $form->error($model, 'fax'); ?>
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