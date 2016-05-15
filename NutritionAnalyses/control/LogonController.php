<?php

include_once "model/Request.php";
include_once "model/Logon.php";
include_once "database/DatabaseConnector.php";

class LogonController
{
    public function register($request)
    {
        $params = $request ->getParams();
        $logon = new Logon(
            $params["logon"],
            $params["passwd"],
            $params["id_user"]);

        $db = new DatabaseConnector ("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        return $conn->query($this->generateInsertQuery($logon));

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

}
    /*private function generateValidLogon($user){
        $query1 =  "SELECT user (logon, passwd, id_user) VALUES (
        '".$user->getLogon()."','".
            $user->getPasswd()."','".
            $user->getId_user()."')";

        $query2 = "SELECT logon (logon, passwd, id_user) VALUES (
        '".$logon->getLogon()."','".
            $logon->getPasswd()."','".
            $logon->getId_user()."')";

        $arrayValid = array_diff($query1, query2)
        return echo '$arrayValid';        
    }*/

