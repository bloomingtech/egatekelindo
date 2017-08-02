<h1>Kelola Data Sale Order</h1>
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

    <div class="row button">
        <?php echo CHtml::submitButton('Show', array('onclick' => '$("#CurrentSort").val(""); return true;', 'name' => 'Submit')); ?>
        <?php echo CHtml::resetButton('Clear'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</center>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'purchase-grid',
    'dataProvider' => $dataProvider,
    'filter' => $saleOrder,
    'columns' => array(
        array(
            'name' => 'cn_ordinal',
            'header' => 'Penjualan #',
            'filter' =>
            '<div style="display: inline-block"> &nbsp; ' . SaleOrderHeader::CN_CONSTANT . '&nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($saleOrder, 'cn_year', array('maxLength' => 2, 'size' => 1)) . '</div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($saleOrder, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($saleOrder, 'is_temporary', array(ActiveRecord::ACTIVE => 'Real', ActiveRecord::INACTIVE => 'Sementara'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($saleOrder, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; </div>',
            'value' => '$data->getNumber(SaleOrderHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
			'filter' => false,
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($data, "date")))',
            'htmlOptions' => array('style' => 'width: 100px'),
        ),
		'project_name',
		'client_company',
//        array(
//            'filter' => CHtml::activeDropDownList($saleOrder, 'is_inactive', array(
//                'empty' => '',
//                ActiveRecord::ACTIVE => ActiveRecord::ACTIVE_LITERAL,
//                ActiveRecord::INACTIVE => ActiveRecord::INACTIVE_LITERAL
//            )),
//            'value' => '$data->status',
//        ),
        array(
            'class' => 'CButtonColumn',
            'updateButtonUrl' => 'CHtml::normalizeUrl(array("update", "id"=>$data->id))',
            'afterDelete' => 'function(){ location.reload(); }'
        ),
    ),
));
?>
