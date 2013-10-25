<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Result;


class SwitchCircuit implements  Message {

    protected $data = array();

    /**
     * @throws ResultException
     */
    public function __construct($rawMessage)
    {
        $data = json_decode($rawMessage,true);
        if (is_array($data)) {
            $this->data = $data;
        }
    }

    public function isOk()
    {
        return empty($this->data);
    }

    public function getData()
    {
        return $this->data;
    }
}