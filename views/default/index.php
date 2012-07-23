<?php
$this->breadcrumbs=array(
	'Сведения о компьютере',
);
?>
<h1>Действия</h1>
<?php $this->widget('zii.widgets.CMenu',array(
    'items'=>array(
        array('label'=>'Получение сведений о компьютере', 'url'=>array('/lanViewer/computer/scan'))
    ),
)); ?>
