<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Result;


class Session implements Message{

    protected $data = array();

    /**
     * @throws ResultException
     */
    public function __construct($rawMessage)
    {
       try {
        $messageXml = simplexml_load_string($rawMessage);
        if (!isset($messageXml)) {
            throw new ResultException('Message not understood: '. var_export($rawMessage, true));
        }
        foreach($messageXml as $key=>$value) {
            $this->data[$key] = (string) $value;
        }
       } catch (\Exception $e) {
           throw new ResultException($e->getMessage());
       }
    }

    public function isOk()
    {
       return !empty($this->data);
    }

    public function getData()
    {
        return $this->data;
    }

    public function getSessionId()
    {
       if (isset($this->data['SID'])) {
            return $this->data['SID'];
       }
       throw new ResultException('no Session Id found');
    }

    public function getChallenge()
    {
        if (isset($this->data['Challenge'])) {
            return $this->data['Challenge'];
        }
        throw new ResultException('no Challenge found');
    }



}