<?php
include_once "model/Request.php";
include_once "control/UserController.php";
include_once "control/AnalyseController.php";
include_once "control/LogonController.php";
include_once "control/PatientController.php";


class ResourceController
{
    private $controlMap = [
            "Analyse" => "AnalyseController",
            "User" => "UserController",
            "Logon" => "LogonController",
            "Patient" => "PatientController"
        ];
    public function createResource($request)
    {
       return (new $this->controlMap[$request->get_resource()]())->register($request);
	}
}