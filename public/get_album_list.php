<?php

$departureflight = new Application_Model_DbTable_Departureflightschedule();
$departureairlineList = $departureflight->airlineList();

//$q = strtolower($_GET["q"]);
$q = $_GET["q"];
if (!$q)
    return;

foreach ($departureairlineList as $airline) {
    echo $airline['Airline'];
}
?>
