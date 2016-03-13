<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../jquery/jquery-2.2.1.min.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>
</head>
<body>
  <div class="container-fluid">
    <form role="form" action="processLogin.php" method="post">
      <div class="form-group">
        <label>Username:</label>
        <input type="text" class="form-control"/>
      </div>
      <div class="form-group">
        <label>Password:</label>
        <input type="password" class="form-control"/>
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
