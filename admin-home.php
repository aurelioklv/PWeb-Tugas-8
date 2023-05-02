<?php 
  session_start();
  
  // Belum login, redirect ke halaman login
  if (!isset($_SESSION['loginInfo'])) {
    header("Location: login-page.php");
    exit;
  }

  $loginInfo = $_SESSION['loginInfo'];

  // Bukan admin, redirect ke halaman user
  if ($loginInfo['permission'] != 'admin') {
    header("Location: user-home.php");
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <title>Halaman Admin</title>
</head>
<body>
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <div class="d-flex align-items-center gap-3">
          <img src="img/user-icon.png" alt="Logo" width="50" height="50">
          <h4>Admin</h4>
      </div>
      <a class="btn btn-danger" href="logout.php">log out</a>
    </div>
  </nav>
</body>
</html>