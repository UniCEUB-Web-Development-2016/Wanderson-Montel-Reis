<?php

class User
{
    private $name;
    private $cpf;
    private $email;
    private $logon;
    private $passwd;

    //CONSTRUCTOR
    public function __construct($name, $cpf, $email, $logon, $passwd)
    {
        $this->setName($name);
        $this->setCpf($cpf);
        $this->setEmail($email);
        $this->setLogon($logon);
        $this->setPasswd($passwd);

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

    public function getPasswd()
    {
        return $this->passwd;
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

    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

}