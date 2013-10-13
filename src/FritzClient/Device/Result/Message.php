<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Result;


interface Message {

    /**
     * @throws ResultException
     */
    public function __construct($rawMessage);
    public function isOk();


    public function getData();
}