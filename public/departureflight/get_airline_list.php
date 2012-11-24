<?php
  $dh = "localhost";
  $dbDatabase = "diaflight";
  $dbUser = "root";
  $pswd = "yinghan";

  try {
  $departureDB = new PDO("mysql:host=$dh;dbname=$dbDatabase", $dbUser, $pswd);
  $departureDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
  echo "Database collection failed.";
  file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
  }

  $q = strtolower($_GET["q"]);
  if (!$q)
  return;

  $sql = "select DISTINCT Airline from departureflightschedule where Airline LIKE '%$q%' ORDER BY Airline";
  $results = $departureDB->query($sql);

  while ($row = $results->fetch()) {
  echo $row['Airline'] ."\n";
  }

?>
