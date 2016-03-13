<?php
  include 'adminUtils.php';
  checkLoggedIn();
  $conn = getWriteConnection();
  $name = $_POST['name'];
  $url = $_POST['url'];
  $validated = true;

  if($name == "" || $name == NULL)
  {
    $validated = false;
  }

  if($url == "" || $url == NULL)
  {
    $validated = false;
  }

  if($validated)
  {
    $sql = "INSERT INTO NewsFeeds (Name, URL) VALUES (:name, :url)";
    $statement = $conn->prepare($sql);
    $statement->bindParam(":name", $name);
    $statement->bindParam(":url", $url);
    $statement->execute();
  }
 ?>
