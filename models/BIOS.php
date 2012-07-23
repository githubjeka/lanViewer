<?php

class BIOS extends ComputerForm
{
    public $name;
    public $manufacturer;
    public $releaseDate;
    public $smVersion;
    public $serialNumber;

    public static function scan($comObject)
    {
        $i=0;
        $var=array();
        foreach ($comObject->instancesof('Win32_BIOS') as $bios) {
            $var[$i]['id']="$i";
            $var[$i]['name']=$bios->Name;
            $var[$i]['manufacturer']=$bios->Manufacturer;
            $var[$i]['releaseDate']=$bios->ReleaseDate;
            $var[$i]['smVersion']=$bios->SMBIOSBIOSVersion;
            $var[$i]['serialNumber']=$bios->SerialNumber;
            $i++;
        }
        return new CArrayDataProvider($var,array('keyField'=>'id'));
    }
}