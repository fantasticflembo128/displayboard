<?php
  include 'adminUtils.php';
  session_start();
  $conn = getReadConnect();
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT Password FROM Login WHERE Username = :username";
  $statement = $conn->prepare($sql);
  $statement->bindParam(":username", $username);
  $statement->execute();
  $row = $statement->fetch();
  $hash = $row['Password'];
  $correctPassword = password_verify($password, $hash);
  if($correctPassword)
  {
    $_SESSION['loggedIn'] = true;
    header("Location: index.php");
  }
  else
  {
    header("Location: login.php?password=incorrect");
  }
?>
