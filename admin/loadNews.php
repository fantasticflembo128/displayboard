<?php
  include 'adminUtils.php';
  checkLoggedIn();
  $conn = getReadConnection();
  $sql = "SELECT ID, Name FROM NewsFeeds";
  $statement = $conn->query($sql);
  $results = array();
  while($row = $statement->fetch())
  {
    $name = $row['Name'];
    $id = $row['ID'];
    $result = array(
      "name" => $name,
      "id" => $id
    );
    array_push($results, $result);
  }
  echo json_encode($results);
 ?>
