<?php
//Adicionar o php do xampp no windows e reiniciar o xampp para conectar com o banco. Além de remover o libmysql.dll
include('httpful.phar');

$response = \Httpful\Request::get("http://localhost/NutritionAnalyses/user/?logon=".$_POST['logon']."&passwd=".$_POST['passwd'])->send();
$request_response = json_decode($response->body);

echo "Voce logou com sucesso!";
 header("Location:patient.html");
