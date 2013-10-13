<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClientTest\Device\Action;


class PasswordTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @url http://www.avm.de/de/Extern/files/session_id/AVM_Technical_Note_-_Session_ID.pdf
     */
    public function testAgainstReference()
    {
        $testObj = new \FritzClient\Device\Action\Password('1234567z','äbc');
        $this->assertEquals('1234567z-9e224a41eeefa284df7bb0f26c2913e2', (string) $testObj);
    }

}