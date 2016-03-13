<?php
  function getReadConnection()
  {
    $dsn = "mysql:host=localhost;dbname=displayboard";
    $username = "displayRead";
    $password = "Daleks-12";

    $conn = new PDO($dsn, $username, $password);

    return $conn;
  }

  function getWriteConnection()
  {
    $dsn = "mysql:host=localhost;dbname=displayboard";
    $username = "displayWrite";
    $password = "Daleks-12";

    $conn = new PDO($dsn, $username, $password);

    return $conn;
  }

  function getSslPage($url)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }

  function date_compare($a, $b)
  {
    $t1 = $a['date'];
    $t2 = $b['date'];
    return $t1 < $t2;
  }
?>
