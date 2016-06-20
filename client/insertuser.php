<?php
// Point to where you downloaded the phar
include('httpful.phar');


$url = "http://localhost/NutritionAnalyses/user/?name=".$_POST['name']."&cpf=".$_POST['cpf']."&email=".$_POST['email']."&logon=".$_POST['logon']."&passwd=".$_POST['passwd'];

$response = \Httpful\Request::post($url)->send();


echo "Cadastrado com sucesso";
header('Location: login.html');
/*
echo "<script type='text/javascript'>window.alert('Cadastrado com sucesso!');</script>";
echo '<meta HTTP-EQUIV="Refresh" CONTENT="1; URL=logon.html">';*/
exit;