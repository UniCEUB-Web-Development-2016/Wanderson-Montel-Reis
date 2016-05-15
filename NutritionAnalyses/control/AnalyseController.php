<?php
include_once "model/Request.php";
include_once "model/Analyse.php";
include_once "database/DatabaseConnector.php";

class AnalyseController{
    public function register($request)
    {
        $params = $request ->getParams();
        $analyse = new Analyse(            
            $params["nameAnalyse"],
            $params["descAnalyse"],
            $params["id_patient"]
            );

        $db = new DatabaseConnector ("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        return $conn->query($this->generateInsertQuery($analyse));
    }

    private function generateInsertQuery($analyse)
    {
        $query =  "INSERT INTO analyse (nameAnalyse, descAnalyse, id_patient) VALUES (
        '".$analyse->getNameAnalyse()."','".
            $analyse->getDescAnalyse()."','".  
           $analyse->getId_patient()."')";
        return $query;
    }

    public function search($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("SELECT nameAnalyse, descAnalyse, id_patient FROM analyse WHERE ".$crit);
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
    /*http://localhost/NutritionAnalyses/analyse/?nameAnalyse=Hemograma22&descAnalyse=exame de mama&patientAnalyse=Hemografia*/

}