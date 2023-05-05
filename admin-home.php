<?php 
  session_start();
  include("config.php");
  
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
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
  
  <div class="container pt-5">
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php
    // mengambil data ucapan dari database
    $ucapan_query = mysqli_query($db, "SELECT * FROM ucapan");
    while ($ucapan = mysqli_fetch_assoc($ucapan_query)) {
      // mencari apakah ucapan telah dibalas atau belum
      $isReplied_query = mysqli_query($db, "SELECT * FROM reply WHERE ucapan_id={$ucapan['id']}");
      $isReplied = mysqli_num_rows($isReplied_query) > 0;
      $query = "SELECT u.user_id, u.name, uc.content FROM ucapan uc INNER JOIN user u ON uc.user_id = u.user_id WHERE uc.id = {$ucapan['id']}";
      $result = mysqli_query($db, $query);

      if(mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $ucapan_name = $row['name'];
          $user_id = $row['user_id'];
      } else {
          echo "Tidak ada data yang ditemukan";
      }
    ?>
      <div class="col">
        <div class="card">
          <div class="card-header <?php echo $isReplied ? 'bg-success' : 'bg-warning'; ?>">
            <?php echo $isReplied ? 'Dibalas' : 'Belum dibalas'; ?>
          </div>
          <div class="card-body">
            <p class="card-text"><?php echo $ucapan['content']; ?></p>
            <?php if (!$isReplied) { ?>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reply-modal-<?php echo $ucapan['id']; ?>">
                Balas
              </button>
            <?php } else { ?>
              <hr>
              <?php
              // mengambil data balasan dari database
              $reply_query = mysqli_query($db, "SELECT * FROM reply WHERE ucapan_id={$ucapan['id']}");
              $reply = mysqli_fetch_assoc($reply_query);
              ?>
              <p class="card-text text-end"><?php echo $reply['content']; ?></p>
            <?php } ?>
          </div>
          <div class="card-footer text-muted">
            Dikirim pada <?php echo $ucapan['createdAt']; ?> oleh <?php echo $ucapan_name ?>
          </div>
        </div>
        <?php if (!$isReplied) { ?>
          <form action="POST_reply.php" method="post">
            <div class="modal fade" id="reply-modal-<?php echo $ucapan['id']; ?>" tabindex="-1" aria-labelledby="reply-modal-label" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="reply-modal-label">Balas pesan <?php echo $ucapan_name ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p class="card-text"><?php echo $ucapan['content']; ?></p>
                    <p>Berikan balasan:</p>
                    <textarea class="form-control" id="reply-textarea" name="pesan" required></textarea>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="ucapan_id" value="<?php echo $ucapan['id']; ?>">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="kirim">Balas</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
    
</body>
</html>