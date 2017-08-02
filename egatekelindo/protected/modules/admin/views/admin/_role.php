<table>
	<tr>
		<td>
			<?php echo CHtml::checkBox("Admin[roles][administrator]", CHtml::resolveValue($model, "roles[administrator]"), array('id'=>'Admin_roles_' . $counter, 'value'=>'administrator')); ?>
			<?php echo CHtml::label('Administrator', 'Admin_roles_' . $counter++, array('style'=>'display: inline')); ?>
		</td>
		<td>
			<?php echo CHtml::checkBox("Admin[roles][master]", CHtml::resolveValue($model, "roles[master]"), array('id'=>'Admin_roles_' . $counter, 'value'=>'master')); ?>
			<?php echo CHtml::label('Master', 'Admin_roles_' . $counter++, array('style'=>'display: inline')); ?>
		</td>
                <td>
			<?php echo CHtml::checkBox("Admin[roles][transaction]", CHtml::resolveValue($model, "roles[transaction]"), array('id'=>'Admin_roles_' . $counter, 'value'=>'transaction')); ?>
			<?php echo CHtml::label('All Transaction', 'Admin_roles_' . $counter++, array('style'=>'display: inline')); ?>
		</td>
              
	</tr>
</table>

<table>
	<tr>
		<th style="text-align: center; width: 50%">Transaction</th>
		<th style="text-align: center">Create</th>
		<th style="text-align: center">Edit</th>
	</tr>
	<tr>
		<td>Sale Order</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][saleOrderCreate]", CHtml::resolveValue($model, "roles[saleOrderCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'saleOrderCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][saleOrderEdit]", CHtml::resolveValue($model, "roles[saleOrderEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'saleOrderEdit')); ?></td>
	</tr>
        <tr>
		<td>Estimation</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][estimationCreate]", CHtml::resolveValue($model, "roles[estimationCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'estimationCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][estimationEdit]", CHtml::resolveValue($model, "roles[estimationEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'estimationEdit')); ?></td>
	</tr>
        <tr>
		<td>Budgeting</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][budgetingCreate]", CHtml::resolveValue($model, "roles[budgetingCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'budgetingCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][budgetingEdit]", CHtml::resolveValue($model, "roles[budgetingEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'budgetingEdit')); ?></td>
	</tr>
         <tr>
		<td>Work Order Drawing</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][workOrderDrawingCreate]", CHtml::resolveValue($model, "roles[workOrderDrawingCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'workOrderDrawingCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][workOrderDrawingEdit]", CHtml::resolveValue($model, "roles[workOrderDrawingEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'workOrderDrawingEdit')); ?></td>
	</tr>
         <tr>
		<td>Work Order Production</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][workOrderProductionCreate]", CHtml::resolveValue($model, "roles[workOrderProductionCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'workOrderProductionCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][workOrderProductionCreateEdit]", CHtml::resolveValue($model, "roles[workOrderProductionCreateEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'workOrderProductionCreateEdit')); ?></td>
	</tr>
         <tr>
		<td>Requirement</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][requirementCreate]", CHtml::resolveValue($model, "roles[requirementCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'requirementCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][requirementEdit]", CHtml::resolveValue($model, "roles[requirementEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'requirementEdit')); ?></td>
	</tr>
	
</table>
