<?php

include_once "model/Request.php";
include_once "model/Logon.php";
include_once "database/DatabaseConnector.php";

class LogonController
{
    private $requiredParams = ["logon", "passwd"];
    public function register($request)
    {
        $params = $request ->getParams();
        if($this->isValid($params)){
            $logon = new Logon(
            $params["logon"],
            $params["passwd"]);

        $db = new DatabaseConnector ("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        return $conn->query($this->generateInsertQuery($logon));
        }else
        {
            echo "Error 400: Bad Request";
        }
    }

    private function generateInsertQuery($logon)
    {
        $query =  "INSERT INTO logon (logon, passwd) VALUES (
        '".$logon->getLogon()."','".
            $logon->getPasswd()."')";
        return $query;
    }

     public function search($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("SELECT logon, passwd FROM logon WHERE ".$crit);
        //foreach($result as $row)
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("DELETE FROM logon WHERE ".$crit);
        return $result;
    }

     private function generateCriteria($params)
    {
        $criteria = "";
        foreach($params as $key => $value)
        {
            $criteria = $criteria.$key." LIKE '".$value."' AND ";
        }
        return substr($criteria, 0, -4);
    }

    public function update($request)
    {
        if(!empty($_GET["logon"]) && !empty($_GET["passwd"])) 
        {
            $logon = addslashes(trim($_GET["logon"]));
            $passwd = addslashes(trim($_GET["passwd"]));
            $params = $request->getParams();
            $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE logon SET logon=:logon, passwd=:passwd WHERE logon=:logon");
            $result->bindValue(":logon", $logon);
            $result->bindValue(":passwd", $passwd);
            $result->execute();
            
            if ($result->rowCount() > 0){
                echo "Logon alterado com sucesso!";
            } else {
                echo "Logon não atualizado";
            }
        }
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
    

