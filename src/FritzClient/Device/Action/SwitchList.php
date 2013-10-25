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
        return array('switchcmd'=>'getswitchlist', 'sid'=>$this->sid, Command::ACTION=>Command::ACTION_POST);
    }

    public function getEndpoint()
    {
        return 'webservices/homeautoswitch';
    }
}