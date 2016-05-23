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
            $user = new User(
                $params["name"],
                $params["cpf"],
                $params["email"],
                $params["logon"],
                $params["passwd"]);

        $db = new DatabaseConnector("localhost", 
        "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();

        return $conn->query($this->generateInsertQuery($user));
        }else
        {
            echo "Error 400: Bad Request: ";
        }
    }
    
    private function generateInsertQuery($user)
    {
        $query =  "INSERT INTO user (name, cpf, email, logon, passwd) 
        VALUES (
        '".$user->getName()."',
        '".$user->getCpf()."',
        '".$user->getEmail()."',
        '".$user->getLogon()."',
        '".$user->getPasswd()."')";
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
            $criteria = $criteria.$key." LIKE '".$value."' AND ";
        }
        return substr($criteria, 0, -4);
    }

    public function delete($request)
    {
        $params = $request->getParams();
        $crit = $this->generateCriteria($params);
        $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("DELETE FROM user WHERE ".$crit);
        return $result;
    }
    
    public function update($request)
    {
        if(!empty($_GET["name"]) && !empty($_GET["cpf"]) && !empty($_GET["email"]) && !empty($_GET["logon"]) && !empty($_GET["passwd"])) 
        {
            $name = addslashes(trim($_GET["name"]));
            $cpf = addslashes(trim($_GET["cpf"]));
            $email = addslashes(trim($_GET["email"]));
            $logon = addslashes(trim($_GET["logon"]));
            $passwd = addslashes(trim($_GET["passwd"]));
            $params = $request->getParams();
            $db = new DatabaseConnector("localhost", "NutritionAnalyses", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE user SET name=:name, cpf=:cpf, email=:email, logon=:logon, passwd=:passwd WHERE logon=:logon");
            $result->bindValue(":name", $name);
            $result->bindValue(":cpf", $cpf);
            $result->bindValue(":email", $email);
            $result->bindValue(":logon", $logon);
            $result->bindValue(":passwd", $passwd);
            $result->execute();
            
            if ($result->rowCount() > 0){
                echo "Usuário alterado com sucesso!";
            } else {
                echo "Usuário não atualizado";
            }
        }
    }     

    private function isValid($params)
    {
        $keys = array_keys($params);
        $diff1 = array_diff($keys, $this->requiredParams);
        $diff2 = array_diff($this->requiredParams, $keys);
        var_dump($diff1);
        if (empty($diff2) && empty($diff1))
            return true;
        return false;
    }
}