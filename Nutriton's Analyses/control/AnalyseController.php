<?php
include_once "model/Request.php";
include_once "model/Analyse.php";
include_once "database/DatabaseConnector.php";

class AnalyseController
{
    public function register($request)
    {
        $params = $request ->getParams();
        $Analyse = new Analyse(
            $params["descAnalyse"],
            $params["nameAnalyse"],
            $params["idAnalyse"],
            $params["patientAnalyse"]
            );

        $db = new DatabaseConnector ("localhost", "Nutrition's Analyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        return $conn->query($this->generateInsertQuery($Analyse));

    }

    private function generateInsertQuery($Analyse)
    {
        $query =  "INSERT INTO Analyse (descAnalyse, nameAnalyse, idAnalyse, patientAnalyse) VALUES (
        '".$Analyse->getDescAnalyse()."','".
            $Analyse->getNameAnalyse()."','".
            $Analyse->getIdAnalyse()."','".
            $Analyse->getPatientAnalyse()."')";
        return $query;
    }
}
