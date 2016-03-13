<?php
  include 'adminUtils.php';
  checkLoggedIn();
  $conn = getWriteConnection();
  echo $id = $_POST['id'];
  $sql = "DELETE FROM NewsFeeds WHERE ID = :id";
  $statement = $conn->prepare($sql);
  $statement->bindParam(":id", $id);
  $statement->execute();
 ?>
