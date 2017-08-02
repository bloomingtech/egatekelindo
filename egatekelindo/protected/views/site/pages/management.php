<?php
$this->pageTitle = Yii::app()->name . ' - Management';
$this->breadcrumbs = array(
    'Egatekelindo',
);
?>
<h1>Halaman Management</h1>

<div class="form">
    <fieldset>
		<legend>SALES</legend>
        <ul style="display: table-cell; width: 800px">
            <?php //if (Yii::app()->user->checkAccess('saleOrderEdit')): ?>

                <li style="width: 50%"><?php echo CHtml::link('Sales Order', array('/transaction/saleOrder/admin')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('estimationEdit')): ?>
                <li style="width: 50%"><?php echo CHtml::link('Estimasi', array('/transaction/estimation/admin')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('budgetingEdit')): ?>
                <li style="width: 50%"><?php echo CHtml::link('Budgeting', array('/transaction/budget/admin')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('workOrderDrawingEdit')): ?>
                <li style="width: 50%"><?php echo CHtml::link('SPK Gambar', array('/transaction/workOrderDrawing/admin')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('workOrderProductionEdit')): ?>
                <li style="width: 50%"><?php echo CHtml::link('SPK Produksi', array('/transaction/workOrderProduction/admin')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('requirementEdit')): ?>
                <li style="width: 50%"><?php echo CHtml::link('Requirement', array('/transaction/requirement/admin')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
        </ul>
    </fieldset>
	
	<fieldset>
		<legend>PURCHASING</legend>
        <ul style="display: table-cell; width: 800px">
			<?php //if (Yii::app()->user->checkAccess('saleOrderEdit')): ?>
                <li style="width: 50%">
					<?php echo CHtml::link('Revisi Purchase Request', array('/transaction/purchaseRequest/admin')); ?>
				</li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('saleOrderEdit')): ?>
                <li style="width: 50%">
					<?php echo CHtml::link('Revisi PO by Requirement', array('/transaction/purchaseByRequirement/admin')); ?>
				</li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('estimationEdit')): ?>
                <li style="width: 50%">
					<?php echo CHtml::link('Revisi PO by Purchase Request', array('/transaction/purchaseByRequest/admin')); ?>
				</li>
                <br class="clear" />
            <?php //endif; ?>
        </ul>
    </fieldset>
</div>