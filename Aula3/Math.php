<?php
class Math
{
	private $pi = 3.141592;
    public function calculateCircleArea($radius)
    {
    return $this->pi * ($radius * $radius);
    }

    public function calculaHipotenusa($arg1, $arg2)
    {
        $hipotenusa = sqrt(($arg1 * $arg1 + $arg2 * $arg2));
        return $hipotenusa;
    }
}