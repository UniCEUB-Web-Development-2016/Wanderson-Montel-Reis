<?php

class Patient
{
    private $fileName;

    //CONSTRUCTOR
    public function __construct($fileName){
        $this->setFileName($fileName);
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

}