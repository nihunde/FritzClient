<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */
namespace FritzClient\Adapter;

use FritzClient\Device\Action\Command as Command;
use FritzClient\Device\Result\Message as Message;
interface AdapterInterface
{
    public function open();
    public function send(Command $command);

    /**
     * @return Message
     */
    public function getLastResult();

}