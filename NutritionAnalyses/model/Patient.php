<?php

class Patient
{
    private $protocolo;
    private $logon;
    private $fileName;
    private $namePatient;
    //CONSTRUCTOR
    public function __construct($protocolo, $logon, $fileName, $namePatient)
    {
        $this->setProtocolo($protocolo);
        $this->setLogon($logon);
        $this->setFileName($fileName);
        $this->setNamePatient($namePatient);
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getNamePatient()
    {
        return $this->namePatient;
    }

    public function setNamePatient($namePatient)
    {
        $this->namePatient = $namePatient;
    }

    public function getProtocolo()
    {
        return $this->protocolo;
    }

    public function setProtocolo($protocolo)
    {
        $this->protocolo = $protocolo;
    }

    public function getLogon()
    {
        return $this->logon;
    }

    public function setLogon($logon)
    {
        $this->logon = $logon;
    }
}