<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device;


use FritzClient\Adapter\AdapterInterface;
use FritzClient\Device\Action\SwitchList;
use FritzClient\Device\Action\SwitchOff;
use FritzClient\Device\Action\SwitchOn;
use FritzClient\Device\Action\SwitchStatus;
use FritzClient\Device\Result\Message;
use FritzClient\Device\Result\ResultException;

class OutletFacade {
    /**
     * @var AdapterInterface
     */
    protected $adapter = null;
    protected $id = null;
    public function __construct(AdapterInterface $adapter, $id=16)
    {
      $this->adapter = $adapter;
      $this->id = $id;
      $this->adapter->open();
    }
    public function switchOn()
    {
        $this->adapter->send(new SwitchOn($this->id));
    }
    public function switchOff()
    {
        $this->adapter->send(new SwitchOff($this->id));
    }
    public function switchStatus()
    {
        $flag = true;
        $i = 1;
        $result = $this->adapter->send(new SwitchList());
        /** @var Message $result */
        if (!$result->isOk())
        {
            throw new ResultException('non valid response');
        }
        $data = $result->getData();
        for($i = $data['Outlet_count'];$i>0; $i--)
        {
            if ($data['DeviceID_'.$i] == $this->id && (int)$data['DeviceConnectState_1'] > 0 )
            {
                return (boolean)$data['DeviceSwitchState_'.$i];
            }
        }
        throw new ResultException('Switch not Found');
    }

    function __destruct()
    {
        $this->adapter->close();
    }


}