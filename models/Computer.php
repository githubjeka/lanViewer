<?php
class Computer extends ComputerForm
{
    public function scan($comObject)
    {
        $i = 0;
        $var = array();
        foreach ($comObject->instancesof('Win32_ComputerSystem') as $comp) {
            $var[$i]['id'] = "$i";
            $var[$i]['name'] = $comp->name;
            $var[$i]['ip'] = gethostbyname($comp->name);
            break;
        }
        foreach ($comObject->instancesof('Win32_NTDomain') as $ntDomain) {
            if ($ntDomain->Status == 'OK') {
                $var[$i]['id'] = "$i";
                $var[$i]['domain'] = $ntDomain->DomainName;
            } else {
                $var[$i]['id'] = "$i";
                $var[$i]['domain'] = $ntDomain->DomainName;
                $var[$i]['domain'] = gethostbyaddr($var[$i]['ip']);
            }
            break;
        }
        return new CArrayDataProvider($var, array('keyField' => 'id'));
    }
}