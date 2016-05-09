<?php

include_once "model/Request.php";
include_once "model/Logon.php";
include_once "database/DatabaseConnector.php";

class LogonController
{
    public function register($request)
    {
        $params = $request ->getParams();
        $Logon = new Logon(
            $params["logon"],
            $params["passwd"]
            );

        $db = new DatabaseConnector ("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        return $conn->query($this->generateInsertQuery($Logon));

    }

    private function generateInsertQuery($Logon)
    {
        $query =  "INSERT INTO Logon (logon, passwd) VALUES (
        '".$Logon->getLogon()."','".
            $Logon->getPasswd()."')";
        return $query;
    }
}
