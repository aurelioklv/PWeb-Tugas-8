<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>Login Form</title>
</head>
<body class="d-flex flex-column align-items-center">
  <h2>Signup Form</h2>

  <div class="container w-50">
    <form action="POST_signup.php" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password">
      </div>
      <div class="mb-3">
        <label for="confirmation-password" class="form-label">Password</label>
        <input type="password" class="form-control" name="confirm_password" id="confirmation-password">
      </div>
      <button type="submit" name="daftar" class="btn btn-primary">Submit</button>
    </form>
  </div>

</body>
</html>
