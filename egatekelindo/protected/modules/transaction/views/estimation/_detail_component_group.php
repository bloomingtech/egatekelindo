<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center;">Component Group Name</th>
    </tr>
    <?php foreach ($panel->componentGroups as $i => $detailGroup): ?>

        <tr>
            <td style="text-align: center;">
                <?php echo CHtml::activeTextField($detailGroup, "[$i]name", array('size' => 100)); ?>
                <?php echo CHtml::error($detailGroup, 'name'); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>