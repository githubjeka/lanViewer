<?php

/**
 * This is the model class for table "physical_drives".
 *
 * The followings are the available columns in table 'physical_drives':
 * @property integer $id
 * @property integer $comp_id
 * @property string $model_physical_drives
 * @property string $InterfaceType_physical_drives
 * @property string $Manufacturer_physical_drives
 * @property string $MediaType_physical_drives
 * @property string $Partitions_physical_drives
 * @property string $Size_physical_drives
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class PhysicalDrives extends ComputerForm
{
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'comp_id' => 'Comp',
			'model_physical_drives' => 'Наименование',
			'InterfaceType_physical_drives' => 'Тип интерфейса',
			'Manufacturer_physical_drives' => 'Производитель',
			'MediaType_physical_drives' => 'Тип носителя',
			'Partitions_physical_drives' => 'Разделы',
			'TotalHeads' => 'Число глав',
			'TotalCylinders' => 'Число цилиндров',			
			'TracksPerCylinder' => 'Число дорожек в цилиндре',	
			'TotalTracks' => 'Число дорожек',
			'TotalSectors' => 'Число секторов',					
			'Size_physical_drives' => 'Размер',
		);
	}
    
    public static function scan($comObject)
    {
        $i=0;
        $var=array();
        foreach ($comObject->instancesof('Win32_DiskDrive') as $diskDrive) {
            $var[$i]['id']="$i";
            $var[$i]['name']=$diskDrive->model;
            $var[$i]['interfaceType']=$diskDrive->InterfaceType;
            $var[$i]['manufacturer']=$diskDrive->Manufacturer;
            $var[$i]['mediaType']=$diskDrive->MediaType;
            $var[$i]['partitions']=$diskDrive->Partitions;
            $var[$i]['size']=ceil($diskDrive->Size/1024/1024/1024);
            $var[$i]['totalCylinders']=$diskDrive->TotalCylinders;
            $var[$i]['totalHeads']=$diskDrive->TotalHeads;
            $var[$i]['totalSectors']=$diskDrive->TotalSectors;
            $var[$i]['totalTracks']=$diskDrive->TotalTracks;
            $var[$i]['tracksPerCylinder']=$diskDrive->TracksPerCylinder;
            $i++;
        }
        return new CArrayDataProvider($var,array('keyField'=>'id'));
    }
}