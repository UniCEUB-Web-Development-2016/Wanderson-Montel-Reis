<?php

class Analyse
{
    private $nameAnalyse; 
    private $descAnalyse;
    private $protocolo;

    //CONSTRUCTOR
    public function __construct($nameAnalyse, $descAnalyse, $protocolo)
    {

        $this->setNameAnalyse($nameAnalyse);
        $this->setDescAnalyse($descAnalyse);
        $this->setProtocolo($protocolo);
    }

    public function getDescAnalyse()
    {
        return $this->descAnalyse;
    }

    public function getNameAnalyse()
    {
        return $this->nameAnalyse;
    }

    public function getProtocolo()
    {
        return $this->protocolo;
    }

    public function setDescAnalyse($descAnalyse)
    {
        $this->descAnalyse = $descAnalyse;
    }

    public function setNameAnalyse($nameAnalyse)
    {
        $this->nameAnalyse = $nameAnalyse;
    }

    public function setProtocolo($protocolo)
    {
        $this->protocolo = $protocolo;
    }
}