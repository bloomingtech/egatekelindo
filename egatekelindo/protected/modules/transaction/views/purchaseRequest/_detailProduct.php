<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Barang</th>
        <th style="text-align: center; width: 15%">Brand</th>
		<th style="text-align: center; width: 15%">Type</th>
        <th style="text-align: center; width: 10%">PCS</th>
		<th style="text-align: center; width: 10%">Berat (kg)</th>
		<th style="text-align: center; width: 20%">Keterangan</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>

    <?php foreach ($purchaseRequest->details as $i => $detail): ?>
        <tr style="background-color: azure">
            <td>
                <?php echo CHtml::activeHiddenField($detail, "[$i]component_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'component.name')); ?>
            </td>
            <td>
                <?php echo CHtml::encode(CHtml::value($detail, 'component.componentBrand.name')); ?>
            </td>
			<td>
                <?php echo CHtml::encode(CHtml::value($detail, 'component.type')); ?>
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
                <?php echo CHtml::activeTextField($detail, "[$i]memo", array('size' => 20, 'maxLength' => 100)); ?>
                <?php echo CHtml::error($detail, 'memo'); ?>

            </td>
            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveComponentProduct', array('id' => $purchaseRequest->header->id, 'index' => $i)),
                            'update' => '#detail_product_div',
                        )),
                    ));
                    ?>
                <?php else: ?>
                    <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                <?php endif; ?>
            </td>
        </tr>

    <?php endforeach; ?>

</table>

