<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


interface Command {
    CONST ACTION_GET='GET';
    CONST ACTION_POST='POST';
    CONST ACTION='ACTION';
    CONST SID_FIELD ='sid';
    /**
     * @throws ExecutionException
     */
    public function getParams();
    public function getEndpoint();

}