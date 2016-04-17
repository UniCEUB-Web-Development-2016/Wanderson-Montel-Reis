<?php
include "control/RequestContoller.php";

class RequestRouter
{

	public function route()
	{
		new Request(
			$_SERVER["SERVER_PROTOCOL"],
			$_SERVER["REQUEST_METHOD"],
			$_SERVER["REQUEST_URI"],
			$_SERVER["SERVER_ADDR"]
		);

	}
}