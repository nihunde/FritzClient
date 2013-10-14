<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device;


use FritzClient\Device\Action\Challenge;
use FritzClient\Device\Action\Login;
use FritzClient\Device\Action\Logout;
use FritzClient\Device\Result\ResultException;
use FritzClient\Device\Result\Session;

class ActionResultResolver {
   public function getResultContainer(Action\Command $command, $rawResult) {
       switch(true) {
           case $command instanceof Logout:
                //break intentionally omitted
           case $command instanceof Login:
                //break intentionally omitted
           case $command instanceof Challenge:
               return new Session($rawResult);
               break;

           default:
               throw new ResultException('could not find matching Result Class for '. get_class($command));
               break;
       }
   }
}