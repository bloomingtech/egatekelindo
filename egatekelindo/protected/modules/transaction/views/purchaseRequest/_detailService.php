<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Barang</th>
        <th style="text-align: center; width: 10%">PCS</th>
		<th style="text-align: center; width: 10%">Berat (kg)</th>
		<th style="text-align: center; width: 30%">Keterangan</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>

    <?php foreach ($purchaseRequest->detailServices as $i => $detail): ?>
        <tr style="background-color: azure">
            <td style="text-align: center">
                <?php echo CHtml::activeTextField($detail, "[$i]name", array('size' => 50, 'maxLength' => 100)); ?>
				<?php echo CHtml::error($detail, 'name'); ?>
            </td>
            <td style="text-align: center">
                <?php echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 10, 'maxLength' => 10)); ?>
                <?php echo CHtml::error($detail, 'quantity'); ?>
            </td>
			<td style="text-align: center">
                <?php echo CHtml::activeTextField($detail, "[$i]weight", array('size' => 10, 'maxLength' => 10)); ?>
                <?php echo CHtml::error($detail, 'weight'); ?>
            </td>
			<td style="text-align: center">
                <?php echo CHtml::activeTextField($detail, "[$i]memo", array('size' => 50, 'maxLength' => 100)); ?>
                <?php echo CHtml::error($detail, 'memo'); ?>
            </td>
            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveComponentService', array('id' => $purchaseRequest->header->id, 'index' => $i)),
                            'update' => '#detail_service_div',
                        )),
                    )); ?>
                <?php else: ?>
                    <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                <?php endif; ?>
            </td>
        </tr>

    <?php endforeach; ?>

</table>

