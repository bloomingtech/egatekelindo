<?php
$this->breadcrumbs = array(
    'estimation' => array('/transaction/budget/create'),
    'view',
);
?>

<h1>
    <?php echo $this->id . '/' . $this->action->id; ?>
</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $budget,
    'attributes' => array(
        array(
            'label' => 'Budget #',
            'value' => CHtml::encode($budget->getCodeNumber(BudgetingHeader::CN_CONSTANT)),
        ),
        array(
            'label' => 'Tanggal',
            'value' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', CHtml::value($budget, 'date'))),
        ),
        array(
            'label' => 'Note',
            'value' => CHtml::encode(CHtml::value($budget, 'note'))
        ),
    ),
));
?>
<?php echo CHtml::beginForm(); ?>
<div class="row">
    <?php echo CHtml::button('Add Component', array('name' => 'Search', 'onclick' => '$("#component-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#component-dialog").dialog("open"); return false; }')); ?>
    <?php echo CHtml::hiddenField('ComponentId'); ?>
</div>
<div id="detail_component">
    <?php $this->renderPartial('_detail_budget', array('budget' => $budget)); ?>
</div>


<?php echo CHtml::submitButton('Submit', array('name' => 'save')); ?>
<?php echo CHtml::endForm(); ?>