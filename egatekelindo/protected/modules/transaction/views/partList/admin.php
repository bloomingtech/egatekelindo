<h1>Kelola Data Part List</h1>
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
    'id' => 'materialReceive-grid',
    'dataProvider' => $dataProvider,
    'filter' => $partList,
    'columns' => array(
        array(
            'name' => 'cn_ordinal',
            'header' => 'Production Request #',
            'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($partList, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . PartListHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($partList, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($partList, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber(PartListHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 200px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($data, "date")))'
        ),
        array(
            'name' => 'saleOrderId',
            'header' => 'SO #',
            'filter' => false,
            'type' => 'raw',
            'filter' => 
            '<div style="display: inline-block"> &nbsp;' . SaleOrder::CN_CONSTANT . '&nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($partList, 'saleOrderCnYear', array('maxLength' => 2, 'size' => 2)) . '</div>'.
            '<div style="display: inline-block">' . CHtml::activeTextField($partList, 'saleOrderCnMonth', array('maxLength' => 2, 'size' => 2)) . '</div>'.
            '<div style="display: inline-block">' . CHtml::activeTextField($partList, 'saleOrderCnOrdinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; </div>' ,
            
            'value' => 'CHtml::link($data->saleOrder->getNumber(SaleOrder::CN_CONSTANT), array("saleOrder/view", "id" => $data->sale_order_id), array("target" => "_blank"))',
            'htmlOptions' => array('style' => 'width: 200px'),
        ),
        array(
            'name' => 'is_inactive',
            'filter' => array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive'),
            'value' => 'CHtml::encode(CHtml::value($data, "status"))',
        ),
        array(
            'class' => 'CButtonColumn',
            'updateButtonUrl' => 'CHtml::normalizeUrl(array("update", "id"=>$data->id))',
            'afterDelete' => 'function(){ location.reload(); }'
        ),
    ),
));
?>
