<?php
// Point to where you downloaded the phar
include('httpful.phar');

$uri = "http://localhost/NutritionAnalyses/user/?name=".$_POST['name']."&cpf=".$_POST['cpf']."&email=".$_POST['email']."&logon=".$_POST['logon']."&passwd=".$_POST['passwd'];

$response = \Httpful\Request::put($uri)                  // Build a PUT request...
    ->sendsJson()                               // tell it we're sending (Content-Type) JSON...
    ->authenticateWith('logon', 'passwd')  // authenticate with basic auth...
    ->body('{"json":"is awesome"}')             // attach a body/payload...
    ->send();

echo "<script type='text/javascript'>window.alert('Atualizado com sucesso!');</script>";
echo '<meta HTTP-EQUIV="Refresh" CONTENT="1; URL=analyses.html">';
exit;