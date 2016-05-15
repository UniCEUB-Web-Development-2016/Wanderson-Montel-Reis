<?php
include_once "model/Request.php";
include_once "model/Patient.php";
include_once "database/DatabaseConnector.php";

class PatientController{
	public function register($request)
    {
        $params = $request ->getParams();
        $patient = new Patient(            
            $params["fileName"],
            $params["namePatient"],
            $params["id_logon"]
            );

        $db = new DatabaseConnector ("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        return $conn->query($this->generateInsertQuery($patient));
	}

    private function generateInsertQuery($patient)
    {
        $query =  "INSERT INTO patient (fileName, namePatient, id_logon) VALUES (
        '".$patient->getFileName()."','".
            $patient->getNamePatient()."','".  
           $patient->getId_logon()."')";
        return $query;
    }

    public function search($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("SELECT fileName, namePatient, id_logon FROM patient WHERE ".$crit);
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