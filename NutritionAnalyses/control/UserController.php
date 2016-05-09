<?php
include_once "model/User.php";
include_once "model/Request.php";
include_once "database/DatabaseConnector.php";


class UserController
{
    public function register($request)
    {
        $params = $request ->getParams();
        $user = new user(
                        $parameters["name"],
                        $parameters["cpf"],
                        $parameters["email"],
                        $parameters["logon"],
                        $parameters["passwd"]
                        );

        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");

        $conn = $db->getConnection();        
        
        return $conn->query($this->generateInsertQuery($user));
    }
    private function generateInsertQuery($user)
    {
        $query =  "INSERT INTO user (name, cpf, email, logon, passwd) VALUES (
                 '".$user->getName()."','".
                    $user->getCpf()."','".
                    $user->getEmail()."','".
                    $user->getLogon()."','".
                    $user->getPasswd()."')";
        return $query;                      
    }

    public function search($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("SELECT name, cpf, email, logon, passwd FROM user WHERE ".$crit);
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
