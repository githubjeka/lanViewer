<?php

/**
 * This is the model class for table "Input_Device".
 *
 * The followings are the available columns in table 'Input_Device':
 * @property integer $id
 * @property integer $comp_id
 * @property string $Keyboard
 * @property string $PointingDevice
 *
 */
class InputDevice extends ComputerForm
{
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'comp_id' => 'Comp',
            'Keyboard' => 'Клавиатура',
            'PointingDevice' => 'Мышь',
        );
    }

    public function scan($comObject)
    {
        $var = array();
        foreach ($comObject->instancesof('Win32_Keyboard') as $device) {
            if ($device->Status == 'OK') {
                $var[0]['id'] = 0;
                $var[0]['keyboard'] = $device->Name;
                break;
            }
        }
        foreach ($comObject->instancesof('Win32_PointingDevice') as $device) {
            if ($device->Status == 'OK') {
                $var[0]['pointingDevice'] = $device->Name;
                break;
            }
        }
        return new CArrayDataProvider($var, array('keyField' => 'id'));
    }
}