<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'type'); ?>
		<?php echo $form->textField($model, 'type', array('size'=>60, 'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'unit_price'); ?>
		<?php echo $form->textField($model, 'unit_price', array('size'=>18, 'maxlength'=>18)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'material_id'); ?>
		<?php echo $form->textField($model, 'material_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'accesories_ampere_id'); ?>
		<?php echo $form->textField($model, 'accesories_ampere_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'accesories_category_id'); ?>
		<?php echo $form->textField($model, 'accesories_category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'is_inactive'); ?>
		<?php echo $form->textField($model, 'is_inactive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->