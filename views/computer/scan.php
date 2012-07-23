<?php
$this->pageTitle=Yii::app()->name . ' - Сведения';
$this->breadcrumbs=array(
    'Сведения о компьютере',
);
?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'computer-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <div class="row">
        <?php
        /** @var $model class Computer */
        echo $form->labelEx($model,'computer');
        echo $form->textField($model,'computer');
        echo $form->error($model,'computer'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Получить сведения'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>

<?php
if (isset($model)) {
    if (isset($computer)) {
        echo CHtml::tag('h1',array(),'Информация');
        echo CHtml::tag('h2',array(),'Компьютер');
        foreach ($computer->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    'name',
                    'ip',
                    'domain',
                ),
            ));
        }
    }
    if (isset($os)) {
        echo CHtml::tag('h2',array(),'Операционная система');
        foreach ($os->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'name'=>'Name',
                        'type'=>'raw',
                        'value'=>iconv('windows-1251','UTF-8', $data['name']),
                    ),
                    'installDate',
                    'windowsDirectory',
                    'serialNumber',
                ),
            ));
        }
    }
    if (isset($motherBoard)) {
        echo CHtml::tag('h2',array(),'Материнская плата');
        foreach ($motherBoard->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'label'=>Yii::t('LanViewerModule.bios','Name'),
                        'value'=>$data['name']
                    ),
                    'manufacturer',
                    'version',
                    'serialNumber',
                ),
            ));
        }
    }
    if (isset($bios)) {
        echo CHtml::tag('h2',array(),'BIOS');
        foreach ($bios->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'label'=>Yii::t('LanViewerModule.bios','Name'),
                        'value'=>$data['name']
                    ),
                    'manufacturer',
                    'releaseDate',
                    'smVersion',
                    'serialNumber',
                ),
            ));
        }
    }
    if (isset($processor)) {
        echo CHtml::tag('h2',array(),'Процессор');
        foreach ($processor->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'label'=>Yii::t('LanViewerModule.bios','Name'),
                        'value'=>$data['name']
                    ),
                    'architecture',
                    'dataWidth',
                    'socketDesignation',
                    'coreCount',
                    'currentClockSpeed',
                    'maxClockSpeed',
                    'extClock',
                    'level',
                    'description',
                    'manufacturer',
                    'stepping',
                    'l2CacheSize',
                    'l2CacheSpeed',
                    'l3CacheSpeed',
                    'l3CacheSize',
                    'currentVoltage',
                    'version',
                ),
            ));
        }
    }
    if (isset($physicalDrives)) {
        echo CHtml::tag('h2',array(),'Жесткие диски');
        foreach ($physicalDrives->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'label'=>Yii::t('LanViewerModule.bios','Name'),
                        'value'=>$data['name']
                    ),
                    'interfaceType',
                    'manufacturer',
                    'mediaType',
                    'partitions',
                    'size',
                    'totalCylinders',
                    'totalHeads',
                    'totalSectors',
                    'totalTracks',
                    'tracksPerCylinder',
                ),
            ));
        }
    }
    if (isset($cdDrives)) {
        echo CHtml::tag('h2',array(),'Дисководы');
        foreach ($cdDrives->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'label'=>Yii::t('LanViewerModule.bios','Name'),
                        'value'=>$data['name']
                    ),
                    'label',
                    'manufacturer',
                    'capabilities',
                    'description',
                    'SCSIBus',
                    'SCSILogicalUnit',
                    'SCSIPort',
                    'SCSITargetId',
                ),
            ));
        }
    }
    if (isset($memory)) {
        echo CHtml::tag('h2',array(),'Память');
        foreach ($memory->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'label'=>Yii::t('LanViewerModule.bios','Name'),
                        'value'=>$data['name']
                    ),
                    'size',
                    'manufacturer',
                    'dataWidth',
                    'totalWidth',
                    'formFactor',
                    'memoryType',
                    'speed',
                    'bBankLabel',
                ),
            ));
        }
    }
    if (isset($soundDevice)) {
        echo CHtml::tag('h2',array(),'Звуковые устройства');
        foreach ($soundDevice->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'label'=>Yii::t('LanViewerModule.bios','Name'),
                        'value'=>$data['name']
                    ),
                    'manufacturer',
                ),
            ));
        }
    }
    if (isset($monitor)) {
        echo CHtml::tag('h2',array(),'Монитор');
        foreach ($monitor->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'label'=>Yii::t('LanViewerModule.bios','Name'),
                        'value'=>$data['name']
                    ),
                    'manufacturer',
                    'bandWidth',
                    'screenHeight',
                    'screenWidth',
                ),
            ));
        }
    }
    if (isset($videoAdapter)) {
        echo CHtml::tag('h2',array(),'Видеоадаптер');
        foreach ($videoAdapter->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'label'=>Yii::t('LanViewerModule.bios','Name'),
                        'value'=>$data['name']
                    ),
                    'acceleratorCapabilities',
                    'capabilityDescriptions',
                    'currentScanMode',
                    'adapterCompatibility',
                    'videoProcessor',
                    'adapterDACType',
                    'adapterRAM',
                    'videoModeDescription',
                    'currentBitsPerPixel',
                    'videoArchitecture',
                    'videoMemoryType',
                    'installedDisplayDrivers',
                    'driverVersion',
                    'maxRefreshRate',
                    'minRefreshRate',
                ),
            ));
        }
    }
    if (isset($networkAdapter)) {
        echo CHtml::tag('h2',array(),'Сеть');
        foreach ($networkAdapter->getData() as $data) {
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$data,
                'attributes'=>array(
                    array(
                        'label'=>Yii::t('LanViewerModule.bios','Name'),
                        'value'=>$data['name']
                    ),
                    'MACAddress',
                    'adapterType',
                    'Speed',
                    'defaultIPGateway',
                    'defaultTTL',
                    'dhcpEnabled',
                    'dhcpServer',
                    'dnsDomain',
                    'ipSubnet',
                ),
            ));
        }
    }
    if (isset($inputDevice)) {
        echo CHtml::tag('h2',array(),'Мышь, клавиатура.');
        foreach ($inputDevice->getData() as $data) {
            $this->widget('zii.widgets.grid.CDetailView',array(
                'data' => $data,
                'attributes'=>array(
                    'keyboard',
                    'pointingDevice',
                ),
            ));
        }
    }
    if (isset($printer)) {
        echo CHtml::tag('h2',array(),'Принтеры');
        foreach ($printer->getData() as $data) {
            $this->widget('zii.widgets.grid.CDetailView',array(
                'data' => $data,
                'attributes'=>array(
                    'name',
                    'capabilities',
                    'portName',
                    'printProcessor',
                    'horizontalResolution',
                    'verticalResolution',
                    'caption',
                ),
            ));
        }
    }
};
?>