<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


class Logout extends  SessionBased{

    protected $sid=null;

    public function acceptSession($sessionId)
    {
        $this->sid = $sessionId;
    }


    /**
     * @throws ExecutionException
     */
    public function getParams()
    {
        return array(
            'logout'=> 'logout',
            'sid' => $this->sid
        );
    }

    public function getEndpoint()
    {
        return 'login_sid';
    }

}