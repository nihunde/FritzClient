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
use FritzClient\Device\Action\SessionBased;
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
        $sid = $session->getSessionId();
        if ($sid === '0000000000000000') {
            throw new AdapterException('Login not successfull');
        }
        $this->sid = $sid;
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


    /**
     * @param Command $command
     * @return Message
     * @throws ExecutionException
     * @throws AdapterException
     */
    public function send(Command $command)
    {
        if ($command instanceof SessionBased  ) {
            if (isset($this->sid)) {
                $command->acceptSession($this->sid);
            } else {
                throw new ExecutionException('Please Login First');
            }
        }
        $url = 'http://' . $this->host. '/'. $command->getEndpoint().'.lua';
        $params =  $command->getParams();
        if (isset($params[Command::ACTION]) && $params[Command::ACTION] === Command::ACTION_POST ) {
            unset($params[Command::ACTION]);
            $curlHandle = curl_init($url);
            $fields = http_build_query($params);
            curl_setopt($curlHandle,CURLOPT_POSTFIELDS, $fields);
            curl_setopt($curlHandle, CURLOPT_POST,count($params));
        } else {
            $url .='?'. http_build_query($command->getParams());
            $curlHandle = curl_init($url);

        }
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



    function close()
    {
        if ($this->lastCommand instanceof Command) {
            $this->send(new Logout());
        }
    }


}