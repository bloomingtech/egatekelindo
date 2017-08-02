<?php
Yii::app()->clientScript->registerScript('userRoles', "
	function checkRoles(number, start, end)
	{
		if ($('#".CHtml::activeId($model, 'roles')."_' + number).attr('checked') || $('#".CHtml::activeId($model, 'roles')."_' + number).attr('disabled'))
		{
			for (i = start; i <= end; i++)
			{
				$('#".CHtml::activeId($model, 'roles')."_' + i).removeAttr('checked');
				$('#".CHtml::activeId($model, 'roles')."_' + i).attr('disabled', true);
			}
		}
		else
		{
			for (i = start; i <= end; i++)
			{
				$('#".CHtml::activeId($model, 'roles')."_' + i).removeAttr('disabled');
			}
		}
	}

	$(document).ready(function(){
		checkRoles(0, 1,14);
                checkRoles(2, 3, 14);

		checkRoles();
	});

	$('#".CHtml::activeId($model, 'roles')."_0').click(function(){
		checkRoles(0, 1, 14);
	});


	$('#".CHtml::activeId($model, 'roles')."_2').click(function(){
		checkRoles(2, 3, 14);
	});
       
	
");
?>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'admin-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 60, 'maxlength' => 60)); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <?php if ($model->isNewRecord): ?>

        <div class="row">
            <?php echo CHtml::activeLabelEx($model, 'new_password'); ?>
            <?php echo CHtml::activePasswordField($model, 'new_password', array('size' => 32, 'maxlength' => 32)); ?>
            <?php echo CHtml::error($model, 'new_password'); ?>
        </div>

        <div class="row">
            <?php echo CHtml::activeLabelEx($model, 'confirm_password'); ?>
            <?php echo CHtml::activePasswordField($model, 'confirm_password', array('size' => 32, 'maxlength' => 32)); ?>
            <?php echo CHtml::error($model, 'confirm_password'); ?>
        </div>


    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 60)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phone'); ?>
        <?php echo $form->textField($model, 'phone', array('size' => 60, 'maxlength' => 60)); ?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 60)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    
    <div class="row">
        <fieldset style="width: 100%">
            <legend><span style="font-weight: bold">Roles</span></legend>
            <?php $this->renderPartial('_role', array('model' => $model, 'counter' => 0)); ?>
        </fieldset>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'is_inactive'); ?>
        <?php echo $form->dropDownList($model, 'is_inactive', array(ActiveRecord::ACTIVE => ActiveRecord::ACTIVE_LITERAL, ActiveRecord::INACTIVE => ActiveRecord::INACTIVE_LITERAL)); ?>
        <?php echo $form->error($model, 'is_inactive'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->