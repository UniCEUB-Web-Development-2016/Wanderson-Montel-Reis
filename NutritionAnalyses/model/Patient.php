<?php

class Patient
{
    private $fileName;
    private $namePatient;
    private $id_logon;

    //CONSTRUCTOR
    public function __construct($fileName, $namePatient, $id_logon){
        $this->setFileName($fileName);
        $this->setNamePatient($namePatient);
        $this->setId_logon($id_logon);

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

    public function getId_logon()
    {
        return $this->id_logon;
    }

    public function setId_logon($id_logon)
    {
        $this->id_logon = $id_logon;
    }

}