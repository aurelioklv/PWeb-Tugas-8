<?php
  use Dotenv\Dotenv;
  require __DIR__ . '/vendor/autoload.php';

  $dotenv = Dotenv::createImmutable(__DIR__);
  $dotenv->load();
  
  $hostname = $_ENV['DB_HOST'];
  $username = $_ENV['DB_USER'];
  $password = $_ENV['DB_USER_PASSWORD'];
  $database = $_ENV['DB_NAME'];

  $db = mysqli_connect($hostname, $username, $password, $database);

  if( !$db ){
      die("Connection failed: " . mysqli_connect_error());
  }
?>
