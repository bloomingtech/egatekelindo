<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'component-cu-form',
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
		<?php echo $form->labelEx($model, 'weight'); ?>
		<?php echo $form->textField($model, 'weight', array('size'=>10, 'maxlength'=>10)); ?>
		<?php echo $form->error($model, 'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'component_brand_discount_id'); ?>
		<?php echo $form->dropDownList($model, 'component_brand_discount_id', CHtml::listData(ComponentBrandDiscount::model()->findAll(), 'id', 'value')); ?>
		<?php echo $form->error($model, 'component_brand_discount_id'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model, 'unit_id'); ?>
		<?php echo $form->dropDownList($model, 'unit_id', CHtml::listData(Unit::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model, 'unit_id'); ?>
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