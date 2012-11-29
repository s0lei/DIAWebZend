<?php
  $dh = "localhost";
  $dbDatabase = "diaflightzendafternoon";
  $dbUser = "root";
  $pswd = "yinghan";

  try {
  $arrivalDB = new PDO("mysql:host=$dh;dbname=$dbDatabase", $dbUser, $pswd);
  $arrivalDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
  echo "I'm sorry, Dave. I'm afraid I can't do that.";
  file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
  }

  $q = strtolower($_GET["q"]);
  if (!$q)
  return;

  $sql = "select DISTINCT CityState from arrivalflightschedule where CityState LIKE '$q%' ORDER BY CityState";
  $results = $arrivalDB->query($sql);

  while ($row = $results->fetch()) {
  echo $row['CityState'] ."\n";
  }
?>
