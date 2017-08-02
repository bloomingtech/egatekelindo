<h1>Kelola Data Kerja Tambah</h1>
<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
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
    'id' => 'materialReceive-grid',
    'dataProvider' => $dataProvider,
    'filter' => $requirementAssurance,
    'columns' => array(
        array(
            'name' => 'cn_ordinal',
            'header' => 'Kerja Tambah #',
            'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($requirementAssurance, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . RequirementAssuranceHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($requirementAssurance, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($requirementAssurance, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber(RequirementAssuranceHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($data, "date"))',
			'htmlOptions' => array('style' => 'width: 200px'),
        ),
		array(
            'header' => 'Requirement #',
            'filter' => false, 
//			'<div style="display: inline-block">' . CHtml::textField('SaleOrderCnOrdinal', $saleOrderCnOrdinal, array('maxLength' => 4, 'size' => 2)) . '</div>' .
//            '<div style="display: inline-block"> &nbsp; /' . SaleOrderHeader::CN_CONSTANT . '/ &nbsp; </div>' .
//            '<div style="display: inline-block">' . CHtml::dropDownList('SaleOrderCnMonth', $saleOrderCnMonth, array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
//            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
//            '<div style="display: inline-block">' . CHtml::textField('SaleOrderCnYear', $saleOrderCnYear, array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => 'CHtml::encode($data->requirementHeader->getCodeNumber($data->requirementHeader->cnConstant))',
            'htmlOptions' => array('style' => 'width: 200px'),
        ),
        array(
            'header' => 'SO #',
            'filter' => '<div style="display: inline-block">' . CHtml::textField('SaleOrderCnOrdinal', $saleOrderCnOrdinal, array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . SaleOrderHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::dropDownList('SaleOrderCnMonth', $saleOrderCnMonth, array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::textField('SaleOrderCnYear', $saleOrderCnYear, array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => 'CHtml::encode($data->requirementHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT))',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Project',
            'value' => 'CHtml::encode(CHtml::value($data, "requirementHeader.saleOrderHeader.project_name"))'
        ),
        array(
            'header' => 'Client Company',
            'value' => 'CHtml::encode(CHtml::value($data, "requirementHeader.saleOrderHeader.client_company"))'
        ),
        array(
            'name' => 'is_inactive',
            'filter' => array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive'),
            'value' => 'CHtml::encode(CHtml::value($data, "status"))',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',
//            'updateButtonUrl' => 'CHtml::normalizeUrl(array("update", "id"=>$data->id))',
            'afterDelete' => 'function(){ location.reload(); }'
        ),
    ),
));
?>
