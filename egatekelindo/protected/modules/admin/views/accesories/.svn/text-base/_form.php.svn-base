<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'accesories-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'type'); ?>
		<?php echo $form->textField($model, 'type', array('size'=>60, 'maxlength'=>60)); ?>
		<?php echo $form->error($model, 'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'unit_price'); ?>
		<?php echo $form->textField($model, 'unit_price', array('size'=>18, 'maxlength'=>18)); ?>
		<?php echo $form->error($model, 'unit_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'material_id'); ?>
		<?php echo $form->dropDownList($model, 'material_id', CHtml::listData(Material::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model, 'material_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'accesories_ampere_id'); ?>
		<?php echo $form->dropDownList($model, 'accesories_ampere_id', CHtml::listData(AccesoriesAmpere::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model, 'accesories_ampere_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'accesories_category_id'); ?>
		<?php echo $form->dropDownList($model, 'accesories_category_id', CHtml::listData(AccesoriesCategory::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model, 'accesories_category_id'); ?>
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