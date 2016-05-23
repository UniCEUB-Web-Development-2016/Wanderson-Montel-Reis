<?php
include_once "model/Request.php";
include_once "model/Analyse.php";
include_once "database/DatabaseConnector.php";

class AnalyseController{
    private $requiredParams = ["nameAnalyse", "descAnalyse", "protocolo"];

    public function register($request)
    {
        $params = $request ->getParams();
        if($this->isValid($params)){
        $analyse = new Analyse(            
            $params["nameAnalyse"],
            $params["descAnalyse"],
            $params["protocolo"]
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
        $query =  "INSERT INTO analyse (nameAnalyse, descAnalyse, protocolo) VALUES (
        '".$analyse->getNameAnalyse()."','".
            $analyse->getDescAnalyse()."','".  
           $analyse->getProtocolo()."')";
        return $query;
    }
    public function search($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("SELECT nameAnalyse, descAnalyse, protocolo FROM analyse WHERE ".$crit);
        
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

     public function delete($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("DELETE FROM analyse WHERE ".$crit);
        return $result;
    }
    
    public function update($request)
    {
        if(!empty($_GET["nameAnalyse"]) && !empty($_GET["descAnalyse"]) && !empty($_GET["protocolo"])) 
        {
            $nameAnalyse = addslashes(trim($_GET["nameAnalyse"]));
            $descAnalyse = addslashes(trim($_GET["descAnalyse"]));
            $protocolo = addslashes(trim($_GET["protocolo"]));
            $params = $request->getParams();
            $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE analyse SET nameAnalyse=:nameAnalyse, descAnalyse=:descAnalyse, protocolo=:protocolo WHERE nameAnalyse=:nameAnalyse");
            $result->bindValue(":nameAnalyse", $nameAnalyse);
            $result->bindValue(":descAnalyse", $descAnalyse);
            $result->bindValue(":protocolo", $protocolo);
            $result->execute();
            
            if ($result->rowCount() > 0){
                echo "Análise alterada com sucesso!";
            } else {
                echo "Análise não atualizada";
            }
        }
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