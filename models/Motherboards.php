<?php

/**
 * This is the model class for table "motherboards".
 *
 * The followings are the available columns in table 'motherboards':
 * @property integer $id
 * @property integer $comp_id
 * @property string $board_name
 * @property string $Manufacturer_motherboards
 * @property string $SerialNumber_motherboards
 * @property string $Version_motherboards
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class Motherboards extends ComputerForm
{
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'comp_id' => 'Comp',
            'board_name' => 'Модель',
            'Manufacturer_motherboards' => 'Производитель',
            'SerialNumber_motherboards' => 'Серийный номер',
            'Version_motherboards' => 'Версия',
        );
    }

    public static function scan($comObject)
    {
        $i=0;
        $var=array();
        foreach ($comObject->instancesof('Win32_BaseBoard') as $baseBoard) {
            $var[$i]['id']="$i";
            $var[$i]['name']=$baseBoard->Product;
            $var[$i]['manufacturer']=$baseBoard->Manufacturer;
            $var[$i]['version']=$baseBoard->Version;
            $var[$i]['serialNumber']=$baseBoard->SerialNumber;
            $i++;
        }
        return new CArrayDataProvider($var,array('keyField'=>'id'));
    }
}