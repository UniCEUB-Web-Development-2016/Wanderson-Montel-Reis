<?php

class Request
{
    private $descAnalyse, $nameAnalyse, $idAnalyse, $patientAnalyse;

    //CONSTRUCTOR
    public function __construct($descAnalyse, $nameAnalyse, $idAnalyse, $patientAnalyse){

        $this->setDescAnalyse($descAnalyse);
        $this->setNameAnalyse($nameAnalyse);
        $this->setIdAnalyse($idAnalyse);
        $this->setPatientAnalyse($patientAnalyse);
    }

    public function getDescAnalyse()
    {
        return $this->descAnalyse;
    }

    public function getNameAnalyse()
    {
        return $this->nameAnalyse;
    }

    public function getIdAnalyse()
    {
        return $this->idAnalyse;
    }

    public function getPatientAnalyse()
    {
        return $this->patientAnalyse;
    }

    public function setDescAnalyse($descAnalyse)
    {
        $this->descAnalyse = $descAnalyse;
    }

    public function setNameAnalyse($nameAnalyse)
    {
        $this->nameAnalyse = $nameAnalyse;
    }

    public function setIdAnalyse($idAnalyse)
    {
        $this->idAnalyse = $idAnalyse;
    }

    public function setPatientAnalyse($patientAnalyse)
    {
        $this->patientAnalyse = $patientAnalyse;
    }

}