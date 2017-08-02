<?php
$this->breadcrumbs = array(
    'Expense' => array('/transaction/expense/create'),
    'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<?php
$expenseHeaderConstant;
if ($expense->is_bank) {
    $expenseHeaderConstant = ExpenseHeader::CN_CONSTANT_BANK;
} else {
    $expenseHeaderConstant = ExpenseHeader::CN_CONSTANT_CASH;
}
?>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $expense,
    'attributes' => array(
        array(
            'label' => 'Pengeluaran #',
            'value' => $expense->getCodeNumber($expenseHeaderConstant)
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", $expense->date),
        ),
        array(
            'label' => 'Akun',
            'value' => $account->name,
        ),
        array(
            'label' => 'Catatan',
            'value' => $expense->note,
        ),
    ),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'expense-detail-grid',
    'dataProvider' => $detailsDataProvider,
    'columns' => array(
        'account.code: Kode Akun',
        'account.name: Nama Akun',
        array(
            'header' => 'Jumlah',
            'value' => 'number_format($data->amount, 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        'memo: Memo',
    ),
));
?>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Print', array('memo', 'id' => $expense->id), array('target' => '_blank')); ?>
</div>