<?php

class Request
{
    private $protocol;
    private $method;
    private $resource;
    private $params;
    private $server_addr;


    public function __construct($protocol, $method, $resource, $params, $server_addr)
    {
        $this->protocol = $protocol;
        $this->method = $method;
        $this->resource = $resource;
        $this->params = $params;
        $this->server_addr = $server_addr;
    }


    public function getProtocol(){
        return $this->protocol;
    }

    public function setProtocol($protocol){
        $this->protocol = $protocol;
    }

    public function getMethod(){
        return $this->method;
    }

    public function setMethod($method){
        $this->method = $method;
    }

    public function getResource(){
        return $this->resource;
    }

    public function setResource($resource){
        $this->resource = $resource;
    }

    public function getParams(){
        return $this->params;
    }

    public function setParams($params){
        $this->params = $params;
    }

    public function getServer_addr(){
        return $this->server_addr;
    }

    public function setServer_addr($server_addr){
        $this->server_addr = $server_addr;
    }
}