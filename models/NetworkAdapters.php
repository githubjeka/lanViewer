<?php

/**
 * This is the model class for table "network_adapters".
 *
 * The followings are the available columns in table 'network_adapters':
 * @property integer $id
 * @property integer $comp_id
 * @property string $adapter_name
 * @property string $MACAddress_adapters
 * @property string $AdapterType
 * @property string $adapter_linkspeed
 */
class NetworkAdapters extends ComputerForm
{
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'comp_id' => 'Comp',
            'adapter_name' => 'Наименование',
            'DefaultIPGateway' => 'Сервер шлюза',
            'DefaultTTL' => 'Время жизни пакетов (TTL)',
            'DHCPEnabled' => 'DHCP',
            'DHCPServer' => 'Сервер DHCP',
            'DNSDomain' => 'DNS корневой',
            'IPSubnet' => 'Маска подсети',
            'MACAddress_adapters' => 'MAC адрес',
            'AdapterType' => 'Тип адаптера',
            'adapter_linkspeed' => 'Скорость',
        );
    }

    protected function afterFind()
    {
        $this->DHCPEnabled == 0 ? $this->DHCPEnabled = 'Выключен' : $this->DHCPEnabled = 'Включен';
    }

    public function scan($comObject)
    {
        $i = 0;
        $var = array();
        foreach ($comObject->instancesof('Win32_NetworkAdapter') as $networkAdapter) {
            if ($networkAdapter->NetConnectionStatus == 1 || $networkAdapter->NetConnectionStatus == 2) {
                $var[$i]['id'] = "$i";
                $var[$i]['name'] = $networkAdapter->Name;
                $var[$i]['MACAddress'] = $networkAdapter->MACAddress;
                $var[$i]['adapterType'] = $networkAdapter->AdapterType;
                $var[$i]['Speed'] = ceil($networkAdapter->Speed / 8 / 1024 / 1024);
                $indexArray[$i] = $networkAdapter->Index;
                $i++;
            }
        }
        if (isset($indexArray)) {
            foreach ($comObject->instancesof('Win32_NetworkAdapterConfiguration') as $networkAdapter) {
                foreach ($indexArray as $index) {
                    if ($networkAdapter->Index == $index) {
                        if (!isset($networkAdapter->DefaultIPGateway)) {
                            foreach ($networkAdapter->DefaultIPGateway as $Ip) {
                                $var[$i]['defaultIPGateway'] = $Ip;
                                break;
                            }
                        }
                        $var[$i]['id'] = "$i";
                        $var[$i]['defaultTTL'] = $networkAdapter->DefaultTTL;
                        $var[$i]['dhcpEnabled'] = $networkAdapter->DHCPEnabled;
                        $var[$i]['dhcpServer'] = $networkAdapter->DHCPServer;
                        $var[$i]['dnsDomain'] = $networkAdapter->DNSDomain;
                        if (!isset($networkAdapter->IPSubnet)) {
                            foreach ($networkAdapter->IPSubnet as $ipSubnet) {
                                $var[$i]['ipSubnet'] = $ipSubnet;
                                break;
                            }
                        }
                        $i++;
                    }
                }
            }
        }

        return new CArrayDataProvider($var, array('keyField' => 'id'));
    }
}