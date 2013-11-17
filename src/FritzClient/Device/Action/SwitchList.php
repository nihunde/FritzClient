<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


class SwitchList extends SessionBased {

    /**
     * @throws ExecutionException
     */
    public function getParams()
    {
        return array(
            'command'=>'AllOutletStates',
            'sid'=>$this->sid,
            'xhr' => '1',
            Command::ACTION=>Command::ACTION_GET
        );
    }

    public function getEndpoint()
    {
        return 'net/home_auto_query';
    }
}