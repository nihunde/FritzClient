<?php
/**
 * 
 * @author: Christian Klaeren <christian.klaeren@googlemail.com>
 * 
 */

namespace FritzClient\Adapter;


use FritzClient\Device\Action\Challenge;
use FritzClient\Device\Action\Command;
use FritzClient\Device\Action\ExecutionException;
use FritzClient\Device\Action\Login;
use FritzClient\Device\Action\Logout;
use FritzClient\Device\Action\Password;
use FritzClient\Device\ActionResultResolver;
use FritzClient\Device\Result\Message;
use FritzClient\Device\Result\Session;

class BasicAdapter implements  AdapterInterface {

    protected $password='';
    protected $host='';
    protected $sid = null;
    protected $lastCommand = null;
    protected $lastResult = null;
    /**
     * @var ActionResultResolver
     */
    protected $resolver =null;
    public function open()
    {
        $this->send(new Challenge());

        $challenge = $this->getLastResult();
        /** @var Session $challenge */
        $this->send(new Login(new Password($challenge->getChallenge(), $this->password)));
        $session = $this->getLastResult();
        /** @var Session $session */
        $this->sid = $session->getSessionId();
        if ($this->sid === '0000000000000000') {
            throw new AdapterException('Login not successfull');
        }
    }


    function __construct(ActionResultResolver $resultResolver, $password, $host='fritz.box')
    {
        $this->password = $password;
        $this->host = $host;
        $this->resolver = $resultResolver;
    }

    /**
     * @return Message
     */
    public function getLastResult()
    {
      if (! $this->lastCommand || ! $this->lastResult) {
          throw new ExecutionException('no Command executed so far');
      }
      return $this->lastResult;

    }



    public function send(Command $command)
    {
        echo $command->getEndpoint(). var_export($command->getParams(), true) . PHP_EOL;
        $url = 'http://' . $this->host. '/'. $command->getEndpoint().'.lua?'. http_build_query($command->getParams());
        $curlHandle = curl_init($url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curlHandle);
        if (!isset($result)) {
            throw new AdapterException(curl_error($curlHandle));
        }
        unset($curlHandle);
        $this->lastResult= $this->resolver->getResultContainer($command,$result);
        $this->lastCommand = $command;
        return $this->lastResult;
    }



    function __destruct()
    {
        if ($this->lastCommand instanceof Command) {
            $this->send(new Logout($this->sid));
        }
    }


}