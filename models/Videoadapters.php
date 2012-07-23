<?php

/**
 * This is the model class for table "videoadapters".
 *
 * The followings are the available columns in table 'videoadapters':
 * @property integer $id
 * @property integer $comp_id
 * @property string $AdapterCompatibility
 * @property string $VideoProcessor
 * @property string $AdapterDACType
 * @property string $videoadapter_name
 * @property string $AdapterRAM
 * @property string $VideoModeDescription
 * @property string $InstalledDisplayDrivers
 * @property string $DriverVersion_videoadapters
 * @property string $MaxRefreshRate_videoadapters
 * @property string $MinRefreshRate_videoadapters
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class Videoadapters extends ComputerForm
{
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'comp_id' => 'Comp',
			'AcceleratorCapabilities' => '3D возможности',
			'CapabilityDescriptions' => 'Описание 3D возможностей',
			'CurrentScanMode' => 'Тип развертки',
			'AdapterCompatibility' => 'Семейство',
			'VideoProcessor' => 'Процессор',
			'AdapterDACType' => 'Тип DAC (ЦАП)',
			'videoadapter_name' => 'Наименование',
			'AdapterRAM' => 'Установленная память',
			'VideoArchitecture' => 'Архитектура',
			'VideoMemoryType' => 'Тип видео памяти',
			'VideoModeDescription' => 'Текущий видеорежим',
			'CurrentBitsPerPixel' => 'Глубина цвета',
			'InstalledDisplayDrivers' => 'Драйвер',
			'DriverVersion_videoadapters' => 'Версия драйвера',
			'MaxRefreshRate_videoadapters' => 'Макс. частота обновления',
			'MinRefreshRate_videoadapters' => 'Мин. частота обновления',
		);
	}

	
	protected function afterFind() {
		
		if ($this->AcceleratorCapabilities==1) {
			$this->AcceleratorCapabilities='Другие: '.$this->CapabilityDescriptions;
		} elseif ($this->AcceleratorCapabilities==2) {
			$this->AcceleratorCapabilities='Графический ускоритель: '.$this->CapabilityDescriptions;
		} elseif ($this->AcceleratorCapabilities==3) {
			$this->AcceleratorCapabilities='3-D ускоритель: '.$this->CapabilityDescriptions;
		}
		
		if ($this->CurrentScanMode==1) {
			$this->CurrentScanMode='Другая';
		} elseif ($this->CurrentScanMode==3) {
			$this->CurrentScanMode='Построчная (Non-Interlaced)';
		} elseif ($this->CurrentScanMode==4) {
			$this->CurrentScanMode='Чересстрочная (Interlaced)';
		}
		
		switch ($this->VideoArchitecture) {
			case 1:
				$this->VideoArchitecture='Другое';
				break;
			case 2:
				$this->VideoArchitecture='Не определено';
				break;
			case 3:
				$this->VideoArchitecture='CGA';
				break;
			case 4:
				$this->VideoArchitecture='EGA';
				break;
			case 5:
				$this->VideoArchitecture='VGA';
				break;
			case 6:
				$this->VideoArchitecture='SVGA';
				break;
			case 7:
				$this->VideoArchitecture='MDA';
				break;
			case 8:
				$this->VideoArchitecture='HGC';
				break;
			case 9:
				$this->VideoArchitecture='MCGA';
				break;
			case 10:
				$this->VideoArchitecture='8514A';
				break;
			case 11:
				$this->VideoArchitecture='XGA';
				break;
			case 12:
				$this->VideoArchitecture='Linear Frame Buffer';
				break;
			case 160:
				$this->VideoArchitecture='PC-98';
				break;
		}
		
		switch ($this->VideoMemoryType) {
			case 1:
				$this->VideoMemoryType='Другое';
				break;
			case 2:
				$this->VideoMemoryType='Не определено';
				break;
			case 3:
				$this->VideoMemoryType='VRAM';
				break;
			case 4:
				$this->VideoMemoryType='DRAM';
				break;
			case 5:
				$this->VideoMemoryType='SRAM';
				break;
			case 6:
				$this->VideoMemoryType='WRAM';
				break;
			case 7:
				$this->VideoMemoryType='EDO RAM';
				break;
			case 8:
				$this->VideoMemoryType='Burst Synchronous DRAM';
				break;
			case 9:
				$this->VideoMemoryType='Pipelined Burst SRAM';
				break;
			case 10:
				$this->VideoMemoryType='CDRAM';
				break;
			case 11:
				$this->VideoMemoryType='3DRAM';
				break;
			case 12:
				$this->VideoMemoryType='SDRAM';
				break;
			case 13:
				$this->VideoMemoryType='SGRAM';
				break;
		}
	}

	
	public static function scan($comObject)
	{
        $i=0;
        $var=array();
        foreach ($comObject->instancesof('Win32_VideoController') as $videoController) {
            $var[$i]['id']="$i";
            $var[$i]['name']=$videoController->Name;
            $var[$i]['acceleratorCapabilities']=$videoController->acceleratorCapabilities;
            $var[$i]['capabilityDescriptions']=$videoController->capabilityDescriptions;
            $var[$i]['currentScanMode']=$videoController->currentScanMode;
            $var[$i]['adapterCompatibility']=$videoController->adapterCompatibility;
            $var[$i]['videoProcessor']=$videoController->videoProcessor;
            $var[$i]['adapterDACType']=$videoController->adapterDACType;
            $var[$i]['adapterRAM']=ceil($videoController->adapterRAM/1024/1024);
            $var[$i]['videoModeDescription']=$videoController->videoModeDescription;
            $var[$i]['currentBitsPerPixel']=$videoController->currentBitsPerPixel;
            $var[$i]['videoArchitecture']=$videoController->videoArchitecture;
            $var[$i]['videoMemoryType']=$videoController->videoMemoryType;
            $var[$i]['installedDisplayDrivers']=$videoController->installedDisplayDrivers;
            $var[$i]['driverVersion']=$videoController->driverVersion;
            $var[$i]['maxRefreshRate']=$videoController->maxRefreshRate;
            $var[$i]['minRefreshRate']=$videoController->minRefreshRate;
            $i++;
        }
        return new CArrayDataProvider($var,array('keyField'=>'id'));
	}
}