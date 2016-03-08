<?php

include "Math.php";

$math = new Math();

echo $math->calculateCircleArea($_POST["radius"]);
echo "<br>";
//$math1 = new Math();
echo $math->calculaHipotenusa($_POST["Adj"],$_POST["Op"]);