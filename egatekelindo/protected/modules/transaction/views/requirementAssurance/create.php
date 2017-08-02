<?php
$this->breadcrumbs = array(
    'Kerja Tambah' => array('admin'),
    'Create',
);
?>

<h1>Kerja Tambah</h1>

<?php
echo $this->renderPartial('_form', array(
    'requirementAssurance' => $requirementAssurance,
));