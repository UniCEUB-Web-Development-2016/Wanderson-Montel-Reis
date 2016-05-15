<?php

class Analyse
{
    private $nameAnalyse; 
    private $descAnalyse;
    private $id_patient;

    //CONSTRUCTOR
    public function __construct($nameAnalyse, $descAnalyse, $id_patient)
    {

        $this->setNameAnalyse($nameAnalyse);
        $this->setDescAnalyse($descAnalyse);
        $this->setId_patient($id_patient);
    }

    public function getDescAnalyse()
    {
        return $this->descAnalyse;
    }

    public function getNameAnalyse()
    {
        return $this->nameAnalyse;
    }

    public function getId_patient()
    {
        return $this->id_patient;
    }

    public function setDescAnalyse($descAnalyse)
    {
        $this->descAnalyse = $descAnalyse;
    }

    public function setNameAnalyse($nameAnalyse)
    {
        $this->nameAnalyse = $nameAnalyse;
    }

    public function setId_patient($id_patient)
    {
        $this->id_patient = $id_patient;
    }
}