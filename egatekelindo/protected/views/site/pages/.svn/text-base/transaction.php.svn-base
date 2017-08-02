<?php
$this->pageTitle = Yii::app()->name . ' - Transaction';
$this->breadcrumbs = array(
    'Egatekelindo',
);
?>
<h1>Transaksi Order</h1>

<div class="form">
    <fieldset>
		<legend>SALES</legend>
        <ul style="display: table-cell; width: 800px">
            <?php //if (Yii::app()->user->checkAccess('saleOrderCreate')): ?>
                <li style="width: 50%"><?php echo CHtml::link('Sales Order', array('/transaction/saleOrder/create')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('estimationCreate')): ?>
                <li style="width: 50%"><?php echo CHtml::link('Estimasi', array('/transaction/estimation/saleOrderList')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('budgetingCreate')): ?>
                <li style="width: 50%"><?php echo CHtml::link('Budgeting', array('/transaction/budget/saleOrderList')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('workOrderDrawingCreate')): ?>
                <li style="width: 50%"><?php echo CHtml::link('SPK Gambar', array('/transaction/workOrderDrawing/budgetingList')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('workOrderProductionCreate')): ?>
                <li style="width: 50%"><?php echo CHtml::link('SPK Produksi', array('/transaction/workOrderProduction/workOrderDrawingList')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('requirementCreate')): ?>
                <li style="width: 50%"><?php echo CHtml::link('Requirement', array('/transaction/requirement/workOrderProductionList')); ?></li>
                <br class="clear" />
            <?php //endif; ?>
        </ul>
    </fieldset>

	<fieldset>
		<legend>PURCHASING</legend>
        <ul style="display: table-cell; width: 800px">
			<?php //if (Yii::app()->user->checkAccess('saleOrderEdit')): ?>
                <li style="width: 50%">
					<?php echo CHtml::link('Purchase Request', array('/transaction/purchaseRequest/create')); ?>
				</li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('saleOrderEdit')): ?>
                <li style="width: 50%">
					<?php echo CHtml::link('PO by Requirement', array('/transaction/purchaseByRequirement/requirementList')); ?>
				</li>
                <br class="clear" />
            <?php //endif; ?>
            <?php //if (Yii::app()->user->checkAccess('estimationEdit')): ?>
                <li style="width: 50%">
					<?php echo CHtml::link('PO by Purchase Request', array('/transaction/purchaseByRequest/purchaseRequestList')); ?>
				</li>
                <br class="clear" />
            <?php //endif; ?>
        </ul>
    </fieldset>
</div>
