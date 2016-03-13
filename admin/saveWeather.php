<?php
  include 'adminUtils.php';
  checkLoggedIn();
  $conn = getWriteConnection();
  $location = $_POST['location'];
  $appid = $_POST['appid'];
  $validated = true;

  if($location == "" || $location == NULL)
  {
    $validated = false;
  }

  if($appid == "" || $appid == NULL)
  {
    $validated = false;
  }

  if($validated)
  {
    $sql = "UPDATE Weather SET Location = :location, AppID = :appid";
    $statement = $conn->prepare($sql);
    $statement->bindParam(":location", $location);
    $statement->bindParam(":appid", $appid);
    $statement->execute();
  }
 ?>
