<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


interface Command {
    /**
     * @throws ExecutionException
     */
    public function getParams();
    public function getEndpoint();
}