
<?php foreach ($panel->componentGroups as $i => $detailGroup): ?>

    <div><?php echo CHtml::encode(CHtml::value($detailGroup, 'name')); ?></div>

    <div class="row">
        <?php echo CHtml::button('Add Component', array('name' => 'Search', 'onclick' => '$("#' . $i . '").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#' . $i . '").dialog("open"); return false; }')); ?>
        <?php echo CHtml::hiddenField('ComponentId'); ?>
    </div>

    <div id="detail_component_<?php echo $i; ?>">
        <?php $this->renderPartial('_addPanelComponent', array('panel' => $panel)); ?>
    </div>
<?php endforeach; ?>
