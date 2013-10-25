<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


class SwitchOn extends SessionBased{
    protected $id=16;
    protected $data = array();
    /**
     * @throws ExecutionException
     */
    public function getParams()
    {
        $this->data[Command::SID_FIELD] = $this->sid;
        return $this->data;
    }

    function __construct($id)
    {
        $this->id = $id;
        $this->data = array(
            'command'=>'SwitchOnOff',
            'value_to_set'=>'1',
            'id'=>$this->id,
            'xhr'=>'1',
            'sid'=> $this->sid,
            Command::ACTION=>Command::ACTION_POST
        );
    }

    public function getEndpoint()
    {
        return 'net/home_auto_query';
    }

}