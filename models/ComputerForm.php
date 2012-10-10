<?php
/**
 *
 */
class ComputerForm extends CFormModel
{
    public $computer;

    public function rules()
    {
        return array(
            array('computer', 'required'),
        );
    }

    public function getComObject($computer = null)
    {
        if ($computer === null) {
            $computer = $this->computer;
        }
        return new COM ('winmgmts:{impersonationLevel=impersonate}//' . $computer . '/root/cimv2');
    }
}