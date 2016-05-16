<?php

include_once "model/Request.php";
include_once "model/Logon.php";
include_once "database/DatabaseConnector.php";

class LogonController
{
    private $requiredParams = ["logon", "passwd", "id_user"];
    public function register($request)
    {
        $params = $request ->getParams();
        if($this->isValid($params)){
            $logon = new Logon(
            $params["logon"],
            $params["passwd"],
            $params["id_user"]);

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
        $query =  "INSERT INTO logon (logon, passwd, id_user) VALUES (
        '".$logon->getLogon()."','".
            $logon->getPasswd()."','".
            $logon->getId_user()."')";
        return $query;
    }

     public function search($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("SELECT logon, passwd, id_user FROM logon WHERE ".$crit);
        //foreach($result as $row)
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

     private function generateCriteria($params)
    {
        $criteria = "";
        foreach($params as $key => $value)
        {
            $criteria = $criteria.$key." LIKE '%".$value."%' OR ";
        }
        return substr($criteria, 0, -4);
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
    

