<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


class Login implements Command
{
    protected $params = array();
    function __construct(Password $password)
    {
        $this->params['response'] = (string) $password;
    }

    /**
     * @throws ExecutionException
     */
    public function getParams()
    {
        return $this->params;
    }

    public function getEndpoint()
    {
        return 'login_sid';
    }

}