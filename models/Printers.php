<?php

/**
 * This is the model class for table "printers".
 *
 * The followings are the available columns in table 'printers':
 * @property integer $id
 * @property integer $comp_id
 * @property string $printer_name
 * @property string $PortName_printers
 * @property string $PrintProcessor
 * @property string $HorizontalResolution_printers
 * @property string $VerticalResolution_printers
 * @property string $type_printers
 * @property string $date_kartridje_printer
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class Printers extends ComputerForm
{
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'comp_id' => 'Comp',
			'printer_name' => 'Наименование',
			'Capabilities' => 'Возможности',
			'PortName_printers' => 'Порт',
			'PrintProcessor' => 'Процессор',
			'HorizontalResolution_printers' => 'Горизонтальное разрешение',
			'VerticalResolution_printers' => 'Вертикальное разрешение',
			'type_printers' => 'Описание',
			'date_kartridje_printer' => 'Картридж',
		);
	}
	
	protected function AfterFind() {
		$temp = explode(',',$this->Capabilities);		
		$this->Capabilities='';
		foreach ($temp as $val) {
			switch ($val) {			
				case 0:
					$this->Capabilities.='Некорректная информация. ';
					break;
				case 1:
					$this->Capabilities.='Разные. ';
					break;
				case 2:
					$this->Capabilities.='Цветная печать. ';
					break;
				case 3:
					$this->Capabilities.='Двусторонняя печать. ';
					break;
				case 4:
					$this->Capabilities.='Копир. ';
					break;
				case 5:
					$this->Capabilities.='Сортировка. ';
					break;
				case 6:
					$this->Capabilities.='Сшивание. ';
					break;
				case 7:
					$this->Capabilities.='Прозрачность печати. ';
					break;
				case 8:
					$this->Capabilities.='Перфорирование. ';
					break;
				case 9:
					$this->Capabilities.='Создание обложек. ';
					break;
				case 10:
					$this->Capabilities.='Связывание. ';
					break;
				case 11:
					$this->Capabilities.='Черно-белая печать. ';
					break;
				case 12:
					$this->Capabilities.='Одностороння печать. ';
					break;
				case 13:
					$this->Capabilities.='Двусторонная длинная печать. ';
					break;				
				case 14:
					$this->Capabilities.='Двусторонная короткая печать. ';
					break;				
				case 15:
					$this->Capabilities.='Портрет. ';
					break;
				case 16:
					$this->Capabilities.='Ландшафтная печать. ';
					break;
				case 17:
					$this->Capabilities.='Обратнай портрет. ';
					break;
				case 18:
					$this->Capabilities.='Обратная Ландшафтная печать. ';
					break;
				case 19:
					$this->Capabilities.='Высокое качество печати. ';
					break;
				case 20:
					$this->Capabilities.='Среднее качество печати. ';
					break;	
				case 21:
					$this->Capabilities.='Плохое качество печати. ';
					break;				
			}		
		}
	}
    
    public static function scan($comObject)
    {
        $i=0;
        $var=array();
        foreach ($comObject->instancesof('Win32_Printer') as $printer) {
            if ($printer->Local) {
                $var[$i]['id']="$i";
                $var[$i]['name']=$printer->Name;
                foreach ($printer->Capabilities as $capabilities) {
                    $temp[]=$capabilities;
                }
                $var[$i]['capabilities']=implode(',', $temp);
                $var[$i]['portName']=$printer->PortName;
                $var[$i]['printProcessor']=$printer->PrintProcessor;
                $var[$i]['horizontalResolution']=$printer->HorizontalResolution_printers;
                $var[$i]['verticalResolution']=$printer->VerticalResolution;
                $var[$i]['caption']=$printer->Caption;
                $i++;
            }

        }
        return new CArrayDataProvider($var,array('keyField'=>'id'));
    }
}