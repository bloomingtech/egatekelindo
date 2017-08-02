<?php
$this->breadcrumbs = array(
    'Input Data Expense' => array('create'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('indent-header-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Expense</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<div id="link">
    <?php
    if ($expense->is_bank) {
        echo CHtml::link('Create', array('create', 'bank' => 1));
    } else {
        echo CHtml::link('Create', array('create'));
    }
    ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'indent-header-grid',
    'dataProvider' => $dataProvider,
    'filter' => $expense,
    'columns' => array(
        array(
            'name' => 'cn_ordinal',
            'header' => 'Pengeluaran #',
            'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($expense, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; // &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($expense, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($expense, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber(($data->is_bank) ? ExpenseHeader::CN_CONSTANT_BANK : ExpenseHeader::CN_CONSTANT_CASH)',
            'htmlOptions' => array('style' => 'width: 200px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
        ),
        array(
            'name' => 'account_id',
            'filter' => CHtml::listData(Account::model()->findAll(array('order' => 't.name')), 'id', 'name'),
            'value' => '$data->account->name',
        ),
        array(
            'name' => 'is_inactive',
            'filter' => array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive'),
            'value' => '$data->Status',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
        ),
    ),
));
?>