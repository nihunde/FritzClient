<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClientTest\Device\Result;
use FritzClient\Device\Result as Result;

class SessionTest extends \PHPUnit_Framework_TestCase{

    /**
     * @dataProvider getData
     */
    public function testConstructor($xml)
    {
        $testObject = new Result\Session($xml);

    }

    /**
     * @expectedException FritzClient\Device\Result\ResultException
     */
    public function testConstructorThrowsExceptionOnRecievingNoXml()
    {
        $testObject = new Result\Session('gibberish');
    }

    /**
     * @dataProvider getData
     */
    public function testGetChallenge($xml)
    {
        $testObject = new Result\Session($xml);
        $this->assertEquals('2dd3db39',$testObject->getChallenge());
    }

    /**
     * @dataProvider getData
     */
    public function testGetSid($xml)
    {
        $testObject = new Result\Session($xml);
        $this->assertEquals('0000000000000000', $testObject->getSessionId());
    }

    /**
     * @dataProvider getData
     */
    public function testGetData($xml)
    {
        $testObject = new Result\Session($xml);
        $expected = array (
            'SID' => '0000000000000000',
            'Challenge' => '2dd3db39',
            'BlockTime' => '0',
            'Rights' => '',
        );
        $this->assertEquals($expected, $testObject->getData());
    }

    public function getData()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?><SessionInfo><SID>0000000000000000</SID><Challenge>2dd3db39</Challenge><BlockTime>0</BlockTime><Rights></Rights></SessionInfo>';
        return array(
            array($xml)
        );
    }
}