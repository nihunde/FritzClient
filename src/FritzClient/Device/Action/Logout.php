<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


class Logout implements Command{

    protected $sid=null;

    function __construct($sid)
    {
        $this->sid = $sid;
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