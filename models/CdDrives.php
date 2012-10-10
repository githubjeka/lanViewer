<?php
/**
 * @property string Capabilities
 */
class CdDrives extends ComputerForm
{
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'comp_id' => 'Comp',
            'name' => 'Наименование',
            'Capabilities' => 'Возможности',
            'SCSIBus' => 'Шина SCSI',
            'SCSILogicalUnit' => 'Логическая единица SCSI',
            'SCSIPort' => 'Порт SCSI',
            'SCSITargetId' => 'Целевой код SCSI',
            'cd_drives_label' => 'Метка',
            'Manufacturer_cd_drives' => 'Производитель',
            'Description_cd_drives' => 'Описание',
        );
    }

    protected function afterScan()
    {
        $temp = explode(',', $this->Capabilities);
        $this->Capabilities = '';
        foreach ($temp as $val) {
            switch ($val) {
                case 0:
                    $this->Capabilities .= 'Некорректная информация. ';
                    break;
                case 1:
                    $this->Capabilities .= 'Разные. ';
                    break;
                case 2:
                    $this->Capabilities .= 'Последовательный доступ. ';
                    break;
                case 3:
                    $this->Capabilities .= 'Случайный доступ. ';
                    break;
                case 4:
                    $this->Capabilities .= 'Поддерживает запись. ';
                    break;
                case 5:
                    $this->Capabilities .= 'Шифрование. ';
                    break;
                case 6:
                    $this->Capabilities .= 'Сжатие. ';
                    break;
                case 7:
                    $this->Capabilities .= 'Поддерживает сменные носители. ';
                    break;
                case 8:
                    $this->Capabilities .= 'Ручная очистка. ';
                    break;
                case 9:
                    $this->Capabilities .= 'Автоматическая очистка. ';
                    break;
                case 10:
                    $this->Capabilities .= 'Предупреждение SMART. ';
                    break;
                case 11:
                    $this->Capabilities .= 'Поддержка двусторонних носителей. ';
                    break;
                case 12:
                    $this->Capabilities .= 'Предварительное размонтирование не требуется. ';
                    break;
            }
        }
    }

    public static function scan($comObject)
    {
        $i = 0;
        $var = array();
        foreach ($comObject->instancesof('Win32_CDROMDrive') as $drive) {
            $var[$i]['id'] = "$i";
            $var[$i]['name'] = $drive->Name;
            $var[$i]['label'] = $drive->Drive;
            $temp = array();
            foreach ($drive->Capabilities as $capabilities) {
                $temp[] = $capabilities;
            }
            $var[$i]['capabilities'] = implode(',', $temp);
            unset ($capabilities, $temp);
            $var[$i]['manufacturer'] = $drive->Manufacturer;
            $var[$i]['description'] = $drive->Description;
            $var[$i]['SCSIBus'] = $drive->SCSIBus;
            $var[$i]['SCSILogicalUnit'] = $drive->SCSILogicalUnit;
            $var[$i]['SCSIPort'] = $drive->SCSIPort;
            $var[$i]['SCSITargetId'] = $drive->SCSITargetId;
            $i++;
        }
        return new CArrayDataProvider($var, array('keyField' => 'id'));
    }
}