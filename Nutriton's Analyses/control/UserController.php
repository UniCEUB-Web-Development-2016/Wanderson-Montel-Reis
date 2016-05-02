<?php
include_once "model/Request.php";
include_once "model/User.php";
include_once "database/DatabaseConnector.php";

class UserController
{
    public function register($request)
    {
        $params = $request ->getParams();
        $User = new User(
            $params["name"],
            $params["cpf"],
            $params["email"],
            $params["logon"],
            $params["passwd"]
            );

        $db = new DatabaseConnector ("localhost", "Nutrition's Analyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        return $conn->query($this->generateInsertQuery($User));

    }

    private function generateInsertQuery($User)
    {
        $query =  "INSERT INTO User (name, cpf, email, logon, passwd) VALUES (
        '".$User->getName()."','".
            $User->getCpf()."','".
            $User->getEmail()."','".
            $User->getLogon()."','".
            $User->getPasswd()."')";
        return $query;
    }
}
