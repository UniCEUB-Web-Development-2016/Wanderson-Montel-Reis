<?php
include_once "model/Request.php";

class RequestController
{
	public function createRequest($protocol, $method, $uri, $server_addr)
	{
		$uri_array = explode("/", $uri);
		return new Request(
			$protocol,
			$method,
			$uri_array[2],
			$this->getParams($uri_array[3]),
			$server_addr);

	}
	public function getParams($stringParams)
	{
		$a = str_replace ("?" , "" , $stringParams);
		$b = explode("&", $a);

		$paramsMap = array();
		foreach ($b as $value) {
			$c = explode("=", $value);
			$paramsMap[$c[0]] = $c[1];
		}
		return $paramsMap;
	}
	private function isValid($params)
    {
        $keys = array_keys($params);
        $diff1 = array_diff($keys, $this->requiredParams);
        $diff2 = array_diff($this->requiredParams, $keys);
        if (empty($diff2) && empty($diff1))
            return true;
        return false;
    }
}