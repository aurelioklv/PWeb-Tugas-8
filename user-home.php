<?php 
  session_start();
  include("config.php");
  
  // Belum login, redirect ke halaman login
  if (!isset($_SESSION['loginInfo'])) {
    header("Location: login-page.php");
    exit;
  }
  
  $loginInfo = $_SESSION['loginInfo'];

  // Admin tidak bisa membuka halaman user
  // Bukan user, redirect ke halaman admin
  if ($loginInfo['permission'] != 'user') {
    header("Location: admin-home.php");
    exit;
  }
  $name = '';
  $user_id = 0;
  $sql = "SELECT * FROM user WHERE user_id = '" . $loginInfo['user_id'] . "'";
  $query = mysqli_query($db, $sql);
  if (mysqli_num_rows($query)) {
    $row = mysqli_fetch_array($query);
    $name = $row['name'];
    $user_id = $row['user_id'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <title>Halaman Kirim Ucapan</title>
</head>
<body>
  <nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <div class="d-flex align-items-center gap-3">
          <img src="img/user-icon.png" alt="Logo" width="50" height="50">
          <h4><?= $name; ?></h4>
      </div>
      <a class="btn btn-danger" href="logout.php">log out</a>
    </div>
  </nav>
  
  <button type="button" class="btn btn-primary fixed-bottom rounded-0 py-3" data-bs-toggle="modal" data-bs-target="#ucapan-modal">Kirim Ucapan</button>
  <!-- Modal Kirim Ucapan -->
  <form action="POST_ucapan.php" method="post">
    <div class="modal fade" id="ucapan-modal" tabindex="-1" aria-labelledby="ucapan-modal-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="reply-modal-label">Buat Ucapan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <textarea class="form-control" id="reply-textarea" name="content" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" name="kirim">Kirim</button>
          </div>
        </div>
      </div>
    </div>
  </form>

    <!-- Tampilkan semua pesan yang pernah dikirim beserta balasannya -->
    <!-- Mengambil data dari database -->
  <?php
    $query = "SELECT u.id, u.content, u.createdAt, r.content AS replyContent 
              FROM ucapan u 
              LEFT JOIN reply r ON u.id = r.ucapan_id 
              INNER JOIN user ON u.user_id = user.user_id
              WHERE u.user_id = '" . $user_id . "'";
    $result = mysqli_query($db, $query);
  ?>
  <!-- Menampilkan data pesan -->
  <div class="container pt-5 mt-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col">
          <div class="card">
            <?php $isReplied = !empty($row['replyContent']); ?>
            <div class="card-header <?php echo $isReplied ? 'bg-success' : 'bg-warning'; ?>">
              <?php echo $isReplied ? 'Dibalas' : 'Belum dibalas'; ?>
            </div>
            <div class="card-body">
              <p class="card-text"><?php echo $row['content']; ?></p>
              <?php if ($isReplied) { ?>
                <p class="card-text text-end"><?php echo $row['replyContent']; ?></p>
              <?php } ?>
            </div>
            <div class="card-footer text-muted">
              Dikirim pada <?php echo date('d F Y', strtotime($row['createdAt'])); ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</body>
</html>