<?php
include_once "model/Request.php";
include_once "model/Patient.php";
include_once "database/DatabaseConnector.php";

class PatientController
{
    private $requiredParams = ["protocolo", "logon", "fileName", "namePatient"];
	
    public function register($request)
    {
        $params = $request ->getParams();
        if($this->isValid($params)){
        $patient = new Patient(            
            $params["protocolo"],
            $params["logon"],
            $params["fileName"],
            $params["namePatient"]
            );

        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();

        return $conn->query($this->generateInsertQuery($patient));
        }else
        {
            echo "Error 400: Bad Request: ";
        }
	}

    private function generateInsertQuery($patient)
    {
        $query =  "INSERT INTO patient (protocolo, logon, fileName, namePatient) VALUES (
        '".$patient->getProtocolo()."',
        '".$patient->getLogon()."',
        '".$patient->getFileName()."',
        '".$patient->getNamePatient()."')"; 
        return $query;
    }

    public function search($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("SELECT protocolo, logon, fileName, namePatient FROM patient WHERE ".$crit);
        //foreach($result as $row)
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

     public function delete($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("DELETE FROM patient WHERE ".$crit);
        return $result;
    }

    public function update($request)
    {
        if(!empty($_GET["protocolo"]) && 
           !empty($_GET["logon"]) && 
           !empty($_GET["fileName"]) && 
           !empty($_GET["namePatient"])) 
        {
            $protocolo = addslashes(trim($_GET["protocolo"]));
            $logon = addslashes(trim($_GET["logon"]));
            $fileName = addslashes(trim($_GET["fileName"]));
            $namePatient = addslashes(trim($_GET["namePatient"]));
            $params = $request->getParams();
            $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE patient SET protocolo=:protocolo, logon=:logon, fileName=:fileName, namePatient=:namePatient WHERE protocolo=:protocolo");
            $result->bindValue(":protocolo", $protocolo);
            $result->bindValue(":logon", $logon);
            $result->bindValue(":fileName", $fileName);
            $result->bindValue(":namePatient", $namePatient);
            $result->execute();
            
            if ($result->rowCount() > 0){
                echo "Paciente alterado com sucesso!";
            } else {
                echo "Paciente não alterado";
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