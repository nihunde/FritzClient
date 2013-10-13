<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


class Challenge implements Command
{
    /**
     * @throws ExecutionException
     */
    public function getParams()
    {
        return array();
    }

    public function getEndpoint()
    {
       return 'login_sid';
    }


}