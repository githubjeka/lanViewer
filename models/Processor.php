<?php

class Processor extends ComputerForm
{
    public $name;
    public $architecture;
    public $dataWidth;
    public $socket_designation;
    public $speed;
    public $maxClockSpeed;
    public $extClock;
    public $level;
    public $description;
    public $manufacturer;
    public $status;
    public $stepping;
    public $l2CacheSize;
    public $l2CacheSpeed;
    public $l3CacheSize;
    public $l3CacheSpeed;
    public $currentVoltage;
    public $version;
    public $coreCount;

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'processor_name' => 'Наименование',
            'architecture' => 'Архитектура',
            'dataWidth' => 'Разрядность',
            'socket_designation' => 'Разъем',
            'speed' => 'Текущая частота',
            'maxClockSpeed' => 'Максимальная частота',
            'extClock' => 'Частота шины',
            'level' => 'Множитель',
            'description' => 'Описание',
            'manufacturer' => 'Производитель',
            'status' => 'Статус процессора',
            'stepping' => 'Степпинг',
            'l2CacheSize' => 'Размер кеша 2 уровня',
            'l2CacheSpeed' => 'Частота кеша 2 уровня',
            'l3CacheSize' => 'Размер кеша 3 уровня',
            'l3CacheSpeed' => 'Частота кеша 3 уровня',
            'currentVoltage' => 'Напряжение ядра',
            'version' => 'Версия выпуска',
            'coreCount' => 'Количество ядер',
        );
    }

    protected function AfterFind() {
        switch ($this->architecture) {
            case 0:
                $this->architecture='x86';
                break;
            case 1:
                $this->architecture='MIPS';
                break;
            case 2:
                $this->architecture='Alpha';
                break;
            case 3:
                $this->architecture='PowerPC';
                break;
            case 6:
                $this->architecture='Itanium-based systems';
                break;
            case 9:
                $this->architecture='x64';
                break;
        }
    }


    public static function scan($comObject)
    {
        $i=0;
        $var=array();
        foreach ($comObject->instancesof('Win32_Processor') as $processor) {
            ++$i;
        }
        $var[0]['coreCount']=$i;
        $i=0;
        foreach ($comObject->instancesof('Win32_Processor') as $processor) {
            $var[0]['id']="$i";
            $var[0]['name']=$processor->Name;
            $var[0]['architecture']=$processor->architecture;
            $var[0]['dataWidth']=$processor->dataWidth;
            $var[0]['socketDesignation']=$processor->SocketDesignation;
            $var[0]['currentClockSpeed']=$processor->currentClockSpeed;
            $var[0]['maxClockSpeed']=$processor->maxClockSpeed;
            $var[0]['extClock']=$processor->ExtClock;
            if (!empty($var[0]['extClock']))
                $var[0]['level']=floor($var[0]['currentClockSpeed']/$var[0]['extClock']);
            $var[0]['description']=$processor->description;
            $var[0]['manufacturer']=$processor->manufacturer;
            $var[0]['stepping']=$processor->stepping;
            $var[0]['l2CacheSize']=$processor->l2CacheSize;
            $var[0]['l2CacheSpeed']=$processor->l2CacheSpeed;
            if (isset($processor->L3CacheSize)) {
                $var[0]['l3CacheSpeed']=$processor->L3CacheSpeed;
                $var[0]['l3CacheSize']=$processor->l3CacheSize;
            }
            $var[0]['currentVoltage']=$processor->currentVoltage;
            $var[0]['version']='('.$processor->Revision.') '.$processor->Version;            
            break;
        }
        return new CArrayDataProvider($var,array('keyField'=>'id'));
    }
}