<?php
include "control/ManagerControl.php";
class RequestRouter
{

    public function route()
    {
        return (new ControlManager)->getResource();
    }
}