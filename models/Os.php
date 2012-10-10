<?php

/**
 * This is the model class for table "os".
 *
 * The followings are the available columns in table 'os':
 * @property integer $id
 * @property integer $comp_id
 * @property string $os_name
 * @property string $os_product_key
 * @property integer $date_install
 * @property string $Path
 */
class Os extends ComputerForm
{
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'comp_id' => 'Comp',
            'os_name' => 'Наименование',
            'os_product_key' => 'Серийный ключ',
            'date_install' => 'Дата установки',
            'Path' => 'Путь к папке Windows',
        );
    }

    public function scan($comObject)
    {
        $i = 0;
        $var = array();
        foreach ($comObject->instancesof('Win32_OperatingSystem') as $operatingSystem) {
            $var[$i]['id'] = "$i";
            $var[$i]['name'] = $operatingSystem->Name;
            $var[$i]['installDate'] = $operatingSystem->InstallDate;
            $var[$i]['windowsDirectory'] = $operatingSystem->windowsDirectory;
            $var[$i]['serialNumber'] = $operatingSystem->SerialNumber;
            $i++;
        }
        return new CArrayDataProvider($var, array('keyField' => 'id'));
    }
}