<?php

include_once "model/Request.php";
include_once "model/Patient.php";
include_once "database/DatabaseConnector.php";

class PatientController
{
    public function register($request)
    {
        $params = $request ->getParams();
        $Patient = new Patient(
            $params["fileName"]
            );

        $db = new DatabaseConnector ("localhost", "Nutrition's Analyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        return $conn->query($this->generateInsertQuery($Patient));

    }

    private function generateInsertQuery($Patient)
    {
        $query =  "INSERT INTO Patient (fileName) VALUES (
        '".$Patient->getFileName()."')";
        return $query;
    }
}