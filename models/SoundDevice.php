<?php

/**
 * This is the model class for table "SoundDevice".
 *
 * The followings are the available columns in table 'SoundDevice':
 * @property integer $id
 * @property integer $comp_id
 * @property string $name_SoundDevice
 * @property string $Manufacturer_SoundDevice
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class SoundDevice extends ComputerForm
{
    public static function scan($comObject)
    {
        $i=0;
        $var=array();
        foreach ($comObject->instancesof('Win32_SoundDevice') as $soundDevice) {
            $var[$i]['id']="$i";
            $var[$i]['name']=$soundDevice->Name;
            $var[$i]['manufacturer']=$soundDevice->Manufacturer;
            $i++;
        }
        return new CArrayDataProvider($var,array('keyField'=>'id'));
    }
}