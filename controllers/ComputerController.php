<?php

class ComputerController extends Controller
{
    public function actionScan()
    {
        $model = new Computer;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'computer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Computer'])) {
            $model->attributes = $_POST['Computer'];
            $comObject = $model->getcomObject();
            if (isset($comObject)) {

                $computer = new Computer;
                $computer = $computer->scan($comObject);

                $os = new Os;
                $os = $os->scan($comObject);

                $motherBoard = new Motherboards;
                $motherBoard = $motherBoard->scan($comObject);

                $bios = new BIOS;
                $bios = $bios->scan($comObject);

                $processor = new Processor;
                $processor = $processor->scan($comObject);

                $physicalDrives = new PhysicalDrives;
                $physicalDrives = $physicalDrives->scan($comObject);

                $cdDrives = new CdDrives;
                $cdDrives = $cdDrives->scan($comObject);

                $memory = new Memory;
                $memory = $memory->scan($comObject);

                $soundDevice = new SoundDevice;
                $soundDevice = $soundDevice->scan($comObject);

                $monitor = new Monitors();
                $monitor = $monitor->scan($comObject);

                $videoAdapter = new Videoadapters;
                $videoAdapter = $videoAdapter->scan($comObject);

                $networkAdapter = new NetworkAdapters;
                $networkAdapter = $networkAdapter->scan($comObject);

                $inputDevice = new InputDevice;
                $inputDevice = $inputDevice->scan($comObject);

                $printer = new Printers;
                $printer = $printer->scan($comObject);

                $this->render(
                    'scan',
                    array(
                        'model' => $model,
                        'computer' => $computer,
                        'os' => $os,
                        'motherBoard' => $motherBoard,
                        'bios' => $bios,
                        'processor' => $processor,
                        'physicalDrives' => $physicalDrives,
                        'cdDrives' => $cdDrives,
                        'memory' => $memory,
                        'soundDevice' => $soundDevice,
                        'monitor' => $monitor,
                        'videoAdapter' => $videoAdapter,
                        'networkAdapter' => $networkAdapter,
                        'inputDevice' => $inputDevice,
                        'printer' => $printer,
                    )
                );
                Yii::app()->end();
            }
        }

        $this->render(
            'scan',
            array(
                'model' => $model,
            )
        );
    }
}