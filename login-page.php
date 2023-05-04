<?php
  session_start();

  // Sudah login, redirect ke halaman user/admin
  if (isset($_SESSION['loginInfo'])) {
      $loginInfo = $_SESSION['loginInfo'];
      if ($loginInfo['permision'] != 'admin') {
          header("Location: user-home.php");
          exit;
      }
      header("Location: admin-home.php");
      exit;
  }
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <title>Login Form</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
  <div class="card" style="  min-width: 300px;
  min-height: 400px;">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login-form">Masuk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="signup-tab" data-toggle="tab" href="#signup-form">Daftar</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="login-form">
        <form action="POST_login.php" method="post">
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember-me" disabled>
            <label class="form-check-label" for="remember-me">Ingat saya</label>
          </div>
          <button type="submit" name="login" class="btn btn-primary">Masuk</button>
        </form>
        </div>
        <div class="tab-pane fade" id="signup-form">
          <form action="POST_signup.php" method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" class="form-control" name="name" id="name" required maxlength="60">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" required minlength="6" maxlength="12">
            </div>
            <div class="mb-3">
              <label for="confirmation-password" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" name="confirm_password" id="confirmation-password" required minlength="6" maxlength="12">
            </div>
            <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#login-tab').click(function() {
        $('#signup-form').removeClass('active show');
        $('#login-form').addClass('active show');
        $(this).addClass('active');
        $('#signup-tab').removeClass('active');
      });

      $('#signup-tab').click(function() {
        $('#login-form').removeClass('active show');
        $('#signup-form').addClass('active show');
        $(this).addClass('active');
        $('#login-tab').removeClass('active');
      });
    });
  </script>
</body>
</html>
