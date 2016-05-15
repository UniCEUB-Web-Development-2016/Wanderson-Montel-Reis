<?php

class Logon
{
    private $logon;
    private $passwd;
    private $id_user;

    //CONSTRUCTOR
    public function __construct( $logon, $passwd, $id_user)
    {
        $this->setLogon($logon);
        $this->setPasswd($passwd);
        $this->setId_user($id_user);

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

    public function getId_user()
    {
        return $this->id_user;
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

     public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }


}