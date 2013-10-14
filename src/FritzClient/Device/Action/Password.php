<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Device\Action;


class Password {
    protected  $challenge;
    protected  $password;

    public function __construct($challenge, $password)
    {
        $this->challenge =(string) $challenge;
        $this->password =(string) $password;
    }

    public function __toString()
    {
        $prospectResponse =   $this->challenge . '-' . $this->password;
        return $this->challenge . '-' . md5($this->convert($prospectResponse));
    }

    protected function convert($toConvert)
    {

        return iconv(mb_detect_encoding($toConvert), "UTF-16LE", $toConvert);
    }
}