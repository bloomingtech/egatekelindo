<?php
$this->breadcrumbs = array(
    'estimation' => array('/transaction/estimationHeader/create'),
    'view',
);
?>

<h1>
    <?php echo $this->id . '/' . $this->action->id; ?>
</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $estimation,
    'attributes' => array(
        array(
            'label' => 'Estimasi #',
            'value' => CHtml::encode($estimation->getCodeNumber($estimation->cn_initial)),
        ),
        array(
            'label' => 'Revisi #',
            'value' => CHtml::encode($estimation->cn_revision),
        ),
        array(
            'label' => 'Tanggal',
            'value' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', CHtml::value($estimation, 'date'))),
        ),
        array(
            'label' => 'Tanggal Revisi',
            'value' => $estimation->getAllReviseDate(),
        ),
        array(
            'label' => 'Project',
            'value' => CHtml::encode(CHtml::value($estimation, 'project_name')),
        ),
        array(
            'label' => 'Company',
            'value' => CHtml::encode(CHtml::value($estimation, 'client_company')),
        ),
        array(
            'label' => 'Name',
            'value' => CHtml::encode(CHtml::value($estimation, 'client_name')),
        ),
        array(
            'label' => 'Note',
            'value' => CHtml::encode(CHtml::value($estimation, 'note')),
        ),
        array(
            'label' => 'Status',
            'value' => CHtml::encode(CHtml::value($estimation, 'status')),
        ),
    ),
));
?>
<br/>
<h4>Panel : <?php echo CHtml::encode(CHtml::value($panel, 'panel_name')); ?></h4>
<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th>Component Group</th>
        <th></th>
    </tr>
    <?php foreach ($panel->estimationComponentGroups as $estimationGroup): ?>
        <tr>
            <td><?php echo CHtml::encode(CHtml::value($estimationGroup, 'name')); ?></td>
            <td><div id="link">
                    <?php echo CHtml::link('Edit', array('/transaction/estimationComponentGroup/create', 'id' => $estimationGroup->id)); ?>  
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<div id="link">
    <?php echo CHtml::link('Back To Estimation', array('backToEstimation', 'id' => $panel->estimation_header_id)); ?>
</div>