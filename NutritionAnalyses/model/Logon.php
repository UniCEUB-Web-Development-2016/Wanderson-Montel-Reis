<?php

class Logon
{
    private $logon;
    private $passwd;

    //CONSTRUCTOR
    public function __construct( $logon, $passwd)
    {
        $this->setLogon($logon);
        $this->setPasswd($passwd);

    }

    //GET
    public function getLogon()
    {
        return $this->logon;
    }

    public function getPasswd()
    {
        return $this->passwd;
    }

    //SET

    public function setLogon($logon)
    {
        $this->logon = $logon;
    }

    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

}