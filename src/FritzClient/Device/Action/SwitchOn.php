<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


class SwitchOn extends SessionBased{
    protected $id=16;
    /**
     * @throws ExecutionException
     */
    public function getParams()
    {
        return array(
            'command'=>'SwitchOnOff',
            'value_to_set'=>'1',
            'id'=>$this->id,
            'xhr'=>'1',
            'sid'=> $this->sid,

            Command::ACTION=>Command::ACTION_POST
        );
    }

    function __construct($id)
    {
        $this->id = $id;
    }

    public function getEndpoint()
    {
        return 'net/home_auto_query';
    }

}