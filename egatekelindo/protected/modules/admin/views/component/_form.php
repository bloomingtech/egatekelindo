<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'component-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model, 'code'); ?>
		<?php echo $form->textField($model, 'code', array('size'=>30, 'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name', array('size'=>60, 'maxlength'=>60)); ?>
		<?php echo $form->error($model, 'name'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model, 'budget_price'); ?>
		<?php echo $form->textField($model, 'budget_price', array('size'=>60, 'maxlength'=>60)); ?>
		<?php echo $form->error($model, 'budget_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'Merk'); ?>
		<?php echo $form->dropDownList($model, 'component_brand_id', CHtml::listData(ComponentBrand::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model, 'component_brand_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'type'); ?>
		<?php echo $form->textField($model, 'type', array('size'=>60, 'maxlength'=>60)); ?>
		<?php echo $form->error($model, 'type'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model, 'Kategori'); ?>
		<?php echo $form->dropDownList($model, 'component_category_id', CHtml::listData(ComponentCategory::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model, 'component_category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'Grup'); ?>
		<?php echo $form->dropDownList($model, 'component_group_id', CHtml::listData(ComponentGroup::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model, 'component_group_id'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model, 'Faktor Pengali'); ?>
		<?php echo $form->dropDownList($model, 'component_brand_discount_id', CHtml::listData(ComponentBrandDiscount::model()->findAll(), 'id', 'componentBrand.name')); ?>
		<?php echo $form->error($model, 'component_brand_discount_id'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model, 'note'); ?>
		<?php echo $form->textArea($model, 'note', array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model, 'note'); ?>
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