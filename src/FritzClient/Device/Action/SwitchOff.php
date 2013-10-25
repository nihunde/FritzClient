<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


class SwitchOff extends SwitchOn{

    function __construct($id)
    {
        parent::__construct($id);
        $this->data['value_to_set']= '0';
    }

}