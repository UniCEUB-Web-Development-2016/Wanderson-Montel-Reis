<?php
include_once "model/Request.php";
include_once "control/UserController.php";
include_once "control/AnalyseController.php";
include_once "control/LogonController.php";
include_once "control/PatientController.php";

class ResourceController
{
	private $controlMap =
		[
			"user" => "UserController",			
			"logon" => "LogonController",
			"patient" => "PatientController",
			"analyse" => "AnalyseController",			
		];
	public function createResource($request)
	{
		return (new $this->controlMap[$request->getResource()]())->register($request);
	}
	public function searchResource($request)
	{
		return (new $this->controlMap[$request->getResource()]())->search($request);
	}
	
}