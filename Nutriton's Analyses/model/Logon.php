<?php

class Request
{
    private $cpf;
    private $logon;
    private $password;

    //CONSTRUCTOR
    public function __construct($cpf, $logon, $password)
    {
        $this->setCpf($cpf);
        $this->setLogon($logon);
        $this->setPassword($password);

    }

    //GET

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getLogon()
    {
        return $this->logon;
    }

    public function getPassword()
    {
        return $this->password;
    }

    //SET

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setLogon($logon)
    {
        $this->logon = $logon;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

}