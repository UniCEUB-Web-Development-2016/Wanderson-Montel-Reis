<?php

class Request
{
    private $name;
    private $cpf;
    private $email;
    private $logon;
    private $password;

    //CONSTRUCTOR
    public function __construct($name, $cpf, $email, $logon, $password)
    {
        $this->setName($name);
        $this->setCpf($cpf);
        $this->setEmail($email);
        $this->setLogon($logon);
        $this->setPassword($password);

    }

    //GET
    public function getName()
    {
        return $this->name;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getEmail()
    {
        return $this->email;
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
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setEmail($email)
    {
        $this->email = $email;
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