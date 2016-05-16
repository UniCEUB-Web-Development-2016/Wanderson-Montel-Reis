<?php
include_once "model/Request.php";
include_once "model/Analyse.php";
include_once "database/DatabaseConnector.php";

class AnalyseController{
    private $requiredParams = ["nameAnalyse", "descAnalyse", "id_patient"];

    public function register($request)
    {
        $params = $request ->getParams();
        if($this->isValid($params)){
        $analyse = new Analyse(            
            $params["nameAnalyse"],
            $params["descAnalyse"],
            $params["id_patient"]
            );

        $db = new DatabaseConnector ("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        
        return $conn->query($this->generateInsertQuery($analyse));        
        }else
        {
            echo "Error 400: Bad Request";
        }
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