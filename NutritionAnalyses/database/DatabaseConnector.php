<?php
class DatabaseConnector
{
    private $ip;
    private $db_name;
    private $type;
    private $port;
    private $user;
    private $passwd;
    
    public function __construct($ip, $db_name, $type, $port, $user, $passwd)
    {
        $this->ip = $ip;
        $this->db_name = $db_name;
        $this->type = $type;
        $this->port = $port;
        $this->user = $user;
        $this->passwd = $passwd;
    }

    public function getConnection()
    {
        $stringPDO = $this->type.":host=".$this->ip.";dbname=".$this->db_name;
        
        try{
            $connection = new PDO($stringPDO,
                $this->user, 
                $this->passwd);           
        return $connection;
        
        }catch(PDOException $e)
        {
            echo 'Connection failed: '.$e->getMessage();
        }
    }
}