<?php

class ComputerController extends Controller
{
    public function actionScan()
    {
        $model=new Computer;

        if(isset($_POST['ajax']) && $_POST['ajax']==='computer-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['Computer']))
        {
            $model->attributes=$_POST['Computer'];
            $comObject = $model->getcomObject();
            if (isset($comObject)) {
                $computer=Computer::scan($comObject);
                $os=Os::scan($comObject);
                $motherBoard=Motherboards::scan($comObject);
                $bios=BIOS::scan($comObject);
                $processor=Processor::scan($comObject);
                $physicalDrives=PhysicalDrives::scan($comObject);
                $cdDrives=CdDrives::scan($comObject);
                $memory=Memory::scan($comObject);
                $soundDevice=SoundDevice::scan($comObject);
                $monitor=Monitors::scan($comObject);
                $videoAdapter=Videoadapters::scan($comObject);
                $networkAdapter=NetworkAdapters::scan($comObject);
                $inputDevice=InputDevice::scan($comObject);
                $printer=Printers::scan($comObject);
                $this->render('scan',array(
                    'model'=>$model,
                    'computer'=>$computer,
                    'os'=>$os,
                    'motherBoard'=>$motherBoard,
                    'bios'=>$bios,
                    'processor'=>$processor,
                    'physicalDrives'=>$physicalDrives,
                    'cdDrives'=>$cdDrives,
                    'memory'=>$memory,
                    'soundDevice'=>$soundDevice,
                    'monitor'=>$monitor,
                    'videoAdapter'=>$videoAdapter,
                    'networkAdapter'=>$networkAdapter,
                    'inputDevice'=>$inputDevice,
                    'printer'=>$printer,
                ));
                Yii::app()->end();
            }
        }

        $this->render('scan',array(
            'model'=>$model,
        ));
    }
}