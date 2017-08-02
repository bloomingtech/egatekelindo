<?php echo CHtml::beginForm(); ?>
<?php $index = Yii::app()->session['index']; ?>
<h1>Nama Panel : <?php echo $requirement->details[$index]->saleOrderDetail->panel_name; ?></h1>
<div class="row buttons">
    <?php
    echo CHtml::button('Tambah', array(
        'onclick' => CHtml::ajax(array(
            'type' => 'POST',
            'url' => CController::createUrl('ajaxHtmlAddDetailComponent', array('id' => $requirement->header->id, 'index' => $index)),
            'update' => '#detail_component',
        )),
    ));
    ?>
</div>
<br/>
<div id="detail_component">
    <?php $this->renderPartial('_detail_component', array('requirement' => $requirement)); ?>
</div>
<br/>
<?php if (count($requirement->details) == $index + 1) : ?>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to submit?', 'class' => 'btn_blue')); ?>
    </div>
<?php else : ?>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Next', array('name' => 'Next', 'confirm' => 'Are you sure you want to next?', 'class' => 'btn_blue')); ?>
    </div>
<?php endif; ?>
<?php echo CHtml::endForm(); ?>