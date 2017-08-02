<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_price')); ?>:</b>
	<?php echo CHtml::encode($data->unit_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('material_id')); ?>:</b>
	<?php echo CHtml::encode(CHtml::value($data,'material.name')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ampere_id')); ?>:</b>
	<?php echo CHtml::encode(CHtml::value($data, 'ampere.name')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accesories_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->accesoriesCategory->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_inactive')); ?>:</b>
	<?php echo CHtml::encode($data->is_inactive); ?>
	<br />


</div>