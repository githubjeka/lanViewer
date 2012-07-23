<?php

/**
 * This is the model class for table "monitors".
 *
 * The followings are the available columns in table 'monitors':
 * @property integer $id
 * @property integer $comp_id
 * @property string $monitor_name
 * @property string $MonitorManufacturer
 * @property integer $ScreenHeight_monitors
 * @property integer $ScreenWidth_monitors
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class Monitors extends ComputerForm
{
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'comp_id' => 'Comp',
			'monitor_name' => 'Наименование',
			'MonitorManufacturer' => 'Производитель',
			'Bandwidth' => 'Пропускная способность',
			'ScreenHeight_monitors' => 'Высота разрешения',
			'ScreenWidth_monitors' => 'Ширина разрешения',
		);
	}

    public static function scan($comObject)
    {
        $i=0;
        foreach ($comObject->instancesof('Win32_DesktopMonitor') as $desktopMonitor) {
            $var[$i]['id']="$i";
            $var[$i]['name']=$desktopMonitor->Name;
            $var[$i]['manufacturer']=$desktopMonitor->MonitorManufacturer;
            $var[$i]['bandWidth']=$desktopMonitor->Bandwidth;
            $var[$i]['screenHeight']=$desktopMonitor->ScreenHeight;
            $var[$i]['screenWidth']=$desktopMonitor->ScreenWidth;
            $i++;
        }
        return new CArrayDataProvider($var,array('keyField'=>'id'));
    }
}