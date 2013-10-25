<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


abstract class SessionBased implements Command {
   protected $sid = null;
   public function acceptSession($sessionId) {
        $this->sid = $sessionId;
   }
}