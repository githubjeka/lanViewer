<?php

/**
 * This is the model class for table "Memory".
 *
 * The followings are the available columns in table 'Memory':
 * @property integer $id
 * @property integer $comp_id
 * @property string $model_Memory
 * @property integer $size_Memory
 * @property string $Manufacturer_Memory
 * @property integer $FormFactor_Memory
 * @property integer $MemoryType_Memory
 * @property integer $Speed_Memory
 * @property string $BankLabel_Memory
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class Memory extends ComputerForm
{
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'comp_id' => 'Comp',
			'model_Memory' => 'Модель',
			'size_Memory' => 'Объём',
			'DataWidth' => 'Ширина потока данных',
			'TotalWidth' => 'Общая ширина данных',
			'Manufacturer_Memory' => 'Производитель',
			'FormFactor_Memory' => 'Форм-фактор',
			'MemoryType_Memory' => 'Тип',
			'Speed_Memory' => 'Частота',
			'BankLabel_Memory' => 'Метка банка',
		);
	}
	
	protected function AfterFind() {
		switch ($this->FormFactor_Memory) {
			case 0:
				$this->FormFactor_Memory='Не определено';
				break;
			case 1:
				$this->FormFactor_Memory='Другое';
				break;
			case 2:
				$this->FormFactor_Memory='SIP';
				break;
			case 3:
				$this->FormFactor_Memory='DIP';
				break;
			case 4:
				$this->FormFactor_Memory='ZIP';
				break;
			case 5:
				$this->FormFactor_Memory='SOJ';
				break;
			case 6:
				$this->FormFactor_Memory='Proprietary';
				break;
			case 7:
				$this->FormFactor_Memory='SIMM';
				break;
			case 8:
				$this->FormFactor_Memory='DIMM';
				break;
			case 9:
				$this->FormFactor_Memory='TSOP';
				break;
			case 10:
				$this->FormFactor_Memory='PGA';
				break;
			case 11:
				$this->FormFactor_Memory='RIMM';
				break;
			case 12:
				$this->FormFactor_Memory='SODIMM';
				break;
			case 13:
				$this->FormFactor_Memory='SRIMM';
				break;
			case 14:
				$this->FormFactor_Memory='SMD';
				break;
			case 15:
				$this->FormFactor_Memory='SSMP';
				break;
			case 16:
				$this->FormFactor_Memory='QFP';
				break;
			case 17:
				$this->FormFactor_Memory='TQFP';
				break;
			case 18:
				$this->FormFactor_Memory='SOIC';
				break;
			case 19:
				$this->FormFactor_Memory='LCC';
				break;
			case 20:
				$this->FormFactor_Memory='PLCC';
				break;
			case 21:
				$this->FormFactor_Memory='BGA';
				break;
			case 22:
				$this->FormFactor_Memory='FPBGA';
				break;
			case 23:
				$this->FormFactor_Memory='LGA';
				break;
		}
		
		switch ($this->MemoryType_Memory) {
			case 0:
				$this->MemoryType_Memory='Не определено';
				break;
			case 1:
				$this->MemoryType_Memory='Другое';
				break;
			case 2:
				$this->MemoryType_Memory='DRAM';
				break;
			case 3:
				$this->MemoryType_Memory='Synchronous DRAM';
				break;
			case 4:
				$this->MemoryType_Memory='Cache DRAM';
				break;
			case 5:
				$this->MemoryType_Memory='EDO';
				break;
			case 6:
				$this->MemoryType_Memory='EDRAM';
				break;
			case 7:
				$this->MemoryType_Memory='VRAM';
				break;
			case 8:
				$this->MemoryType_Memory='SRAM';
				break;
			case 9:
				$this->MemoryType_Memory='RAM';
				break;
			case 10:
				$this->MemoryType_Memory='ROM';
				break;
			case 11:
				$this->MemoryType_Memory='Flash';
				break;
			case 12:
				$this->MemoryType_Memory='EEPROM';
				break;
			case 13:
				$this->MemoryType_Memory='FEPROM';
				break;
			case 14:
				$this->MemoryType_Memory='EPROM';
				break;
			case 15:
				$this->MemoryType_Memory='CDRAM';
				break;
			case 16:
				$this->MemoryType_Memory='3DRAM';
				break;
			case 17:
				$this->MemoryType_Memory='SDRAM';
				break;
			case 18:
				$this->MemoryType_Memory='SGRAM';
				break;
			case 19:
				$this->MemoryType_Memory='RDRAM';
				break;
			case 20:
				$this->MemoryType_Memory='DDR';
				break;
			case 21:
				$this->MemoryType_Memory='DDR-2';
				break;
			case 22:
				$this->MemoryType_Memory='DDR-3';
				break;			
		}
	}

    public static function scan($comObject)
    {
        $i=0;
        foreach ($comObject->instancesof('Win32_PhysicalMemory') as $memory) {
            $var[$i]['id']="$i";
            $var[$i]['name']=$memory->Name;
            $var[$i]['size']=$memory->Capacity/1024/1024;
            $var[$i]['manufacturer']=$memory->Manufacturer;
            $var[$i]['dataWidth']=$memory->DataWidth;
            $var[$i]['totalWidth']=$memory->TotalWidth;
            $var[$i]['formFactor']=$memory->FormFactor;
            $var[$i]['memoryType']=$memory->MemoryType;
            $var[$i]['speed']=$memory->Speed;
            $var[$i]['bBankLabel']=$memory->BankLabel;
            $i++;
        }
        return new CArrayDataProvider($var,array('keyField'=>'id'));
    }
}