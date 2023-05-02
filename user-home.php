<?php 
  session_start();
  include("config.php");
  
  // Belum login, redirect ke halaman login
  if (!isset($_SESSION['login']) || !isset($_SESSION['ret'])) {
    header("Location: login-page.php");
    exit;
  }
  
  $ret = $_SESSION['ret'];

  // Admin tidak bisa membuka halaman user
  // Bukan user, redirect ke halaman admin
  if ($ret['permission'] != 'user') {
    header("Location: admin-home.php");
    exit;
  }
  $name = '';
  $sql = "SELECT * FROM user WHERE user_id = '" . $ret['user_id'] . "'";
  $query = mysqli_query($db, $sql);
  if (mysqli_num_rows($query)) {
    $row = mysqli_fetch_array($query);
    $name = $row['name'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <title>Halaman Kirim Ucapan</title>
</head>
<body>
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <div class="d-flex align-items-center gap-3">
          <img src="img/user-icon.png" alt="Logo" width="50" height="50">
          <h4><?= $name; ?></h4>
      </div>
      <a class="btn btn-danger" href="logout.php">log out</a>
    </div>
  </nav>
  <h1>Yuk kirim ucapan</h1>
  <form action="post">
    <label for="ucapan">Ucapan</label>
    <input type="text" name="content" id="ucapan">

    <input type="submit" name="kirim" value="Kirim Ucapan">
  </form>
</body>
</html>