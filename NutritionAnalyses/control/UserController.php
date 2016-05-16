<?php
include_once "model/Request.php";
include_once "model/User.php";
include_once "database/DatabaseConnector.php";

class UserController
{
    private $requiredParams = ["name", "cpf","email","logon","passwd"];
    public function register($request)
    {
        $params = $request->getParams();
        if($this->isValid($params)){
            $user = new User($params["name"],
                $params["cpf"],
                $params["email"],
                $params["logon"],
                $params["passwd"]);

        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();

        return $conn->query($this->generateInsertQuery($user));
        }else
        {
            echo "Error 400: Bad Request";
        }
    }
    
    private function generateInsertQuery($user)
    {
        $query =  "INSERT INTO user (name, cpf, email, logon, passwd) 
        VALUES (
        '".$user->getName()."','".
            $user->getCpf()."','".
            $user->getEmail()."','".
            $user->getLogon()."','".
            $user->getPasswd()."')";
        return $query;
    }

    private function generateUpdateQuery($user)
    {
        $query =  "UPDATE user SET 
            name = '".$user->getName()."', 
            cpf = '".$user->getCpf()."', 
            email = '".$user->getEmail()."', 
            logon = '".$user->getLogon()."', 
            passwd = '".$user->getPasswd()."' WHERE id_user = '".$user->getId_user()."' ";

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
    /*http://localhost/NutritionAnalyses/User/?name=wanderson&cpf=12314124&email=asdasd213@asd&logon=123asd&passwd=123asd*/
    
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
