<h1>Kelola Purchase Request</h1>
<div id="link">
    <?php echo CHtml::link('Create', array('create'), array('target' => '_blank')); ?>
</div>
<br />

<?php if (Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>

<center>
    <?php echo CHtml::beginForm(array(''), 'get'); ?>
    <div class="row">
        Tanggal Mulai
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'StartDate',
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
            ),
            'htmlOptions' => array(
                'readonly' => true,
            ),
        ));
        ?>

        Sampai
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'EndDate',
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
            ),
            'htmlOptions' => array(
                'readonly' => true,
            ),
        ));
        ?>
    </div>
    <div class="row">
        <?php echo CHtml::hiddenField('sort', '', array('id' => 'CurrentSort')); ?>
    </div>

    <div class="row button">
        <?php echo CHtml::submitButton('Show', array('onclick' => '$("#CurrentSort").val(""); return true;', 'name' => 'Submit')); ?>
        <?php echo CHtml::resetButton('Clear'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</center>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'sale-grid',
    'dataProvider' => $dataProvider,
    'filter' => $purchaseRequest,
    'columns' => array(
        array(
            'name' => 'cn_ordinal',
            'header' => 'Purchase Request #',
            'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($purchaseRequest, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . PurchaseRequestHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($purchaseRequest, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($purchaseRequest, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber(PurchaseRequestHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'filter' => false,
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
        ),
        array(
            'header' => 'SPK #',
            'filter' => false,
            'value' => '(empty($data->workOrderProductionHeader)) ? "N/A" : CHtml::encode($data->workOrderProductionHeader->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT))',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'SO #',
            'filter' => false,
            'value' => '(empty($data->workOrderProductionHeader)) ? "N/A" : CHtml::encode($data->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT))',
            'htmlOptions' => array('style' => 'width: 250px'),
        ),
        array(
            'header' => 'Project',
            'filter' => false,
            'value' => '(empty($data->workOrderProductionHeader)) ? "N/A" : CHtml::encode($data->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->project_name)',
        ),
        array(
            'header' => 'Company',
            'filter' => false,
            'value' => '(empty($data->workOrderProductionHeader)) ? "N/A" : CHtml::encode($data->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->client_company)',
        ),
        'department.name',
        'job.name',
        array(
            'name' => 'is_inactive',
            'header' => 'Status',
            'filter' => array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive'),
            'value' => '$data->status',
        ),
        array(
            'class' => 'CButtonColumn',
            'updateButtonUrl' => 'CHtml::normalizeUrl(array("update", "id"=>$data->id))',
            'afterDelete' => 'function(){ location.reload(); }'
        ),
    ),
));
?>
