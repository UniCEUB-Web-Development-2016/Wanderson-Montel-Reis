<?php
class Request
{
	private $method;
	private $protocol;
	private $serverAddr;  //ip do servidor
	private $resource;
	private $parameters;

	public function __construct($method, $protocol, $serverAddr, $resource, $parameters)
	{
		$this-> setMethod = $method;
		$this-> setProtocol = $protocol;
		$this-> setServerAddr = $serverAddr;
		$this-> setResource = $resource;
		$this-> setParameters = $parameters;
	}

	public function setMethod($method)
	{
		$this->method = $method;
	}
	public function getMethod()
	{
		return $this->method;
	}
	public function setProtocol($protocol)
	{
		$this->protocol = $protocol;
	}
	public function getProtocol()
	{
		return $this->protocol;
	}
	public function setServerAddr($serverAddr)
	{
		$this->ip = $serverAddr;
	}
 	public function getServerAddr()
	{
		return $this->serverAddr;
	}
	public function setResource($resource)
	{
		$this->resource = chop(end($resource), '.php');
	}
	public function getResource()
	{
		return $this->resource;
	}
	public function setParameters($parameters)
	{
		$this->parameters = $parameters;
	}
	public function getParameters()
	{
		return $this->parameters;
	}
}