<?php
  include '../utils.php';

  function checkLoggedIn()
  {
    session_start();
    if(!$_SESSION['loggedIn'])
    {
      header("Location: login.php");
    }
  }
?>
