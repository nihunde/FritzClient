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
use FritzClient\Device\Action\SwitchList;
use FritzClient\Device\Action\SwitchOff;
use FritzClient\Device\Action\SwitchOn;
use FritzClient\Device\Action\SwitchStatus;
use FritzClient\Device\Result\Message;
use FritzClient\Device\Result\ResultException;
use FritzClient\Device\Result\Session;
use FritzClient\Device\Result\SwitchCircuit;

class ActionResultResolver {
    /**
     * @param Action $command
     * @param $rawResult
     * @return Message
     * @throws ResultException
     */
    public function getResultContainer(Action\Command $command, $rawResult) {
       switch(true) {
           case $command instanceof Logout:
                //break intentionally omitted
           case $command instanceof Login:
                //break intentionally omitted
           case $command instanceof Challenge:
               return new Session($rawResult);
               break;
           case $command instanceof SwitchList:
               // break intentionally omitted
           case $command instanceof SwitchStatus:
               //break intentionally omitted
           case $command instanceof SwitchOff:
               //break intentionally omitted
           case $command instanceof SwitchOn:
               return new SwitchCircuit($rawResult);
               break;
           default:
               throw new ResultException('could not find matching Result Class for '. get_class($command). ' : '
                                            . $rawResult.PHP_EOL);
               break;
       }
   }
}