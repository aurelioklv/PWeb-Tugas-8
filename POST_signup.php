<?php
session_start();
include("config.php");

// Button 'daftar' onClick
if (isset($_POST['daftar'])) {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Cek password
    if ($password != $confirm_password) {
        $ret = array(
            'success' => false,
            'message' => 'Passwords do not match'
        );
        echo json_encode($ret);
        exit;
    }

    // Cek apakah data sudah ada di database
    $sql = "SELECT * FROM user WHERE name = '" . $name . "'";
    $query = mysqli_query($db, $sql);
    if (mysqli_num_rows($query)) {
        $ret = array(
            'success' => false,
            'message' => 'Username already exists'
        );
        echo json_encode($ret);
        exit;
    }

    // Insert user baru ke database
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (name, createdAt, permission, password) VALUES ('" . $name . "', CURDATE(), 'user', '" . $encrypted_password . "')";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $ret = array(
            'success' => true,
            'message' => 'Successfully signed up'
        );
        // minta user untuk login
        header("Location: login-page.php");
        echo json_encode($ret);
    } else {
        $ret = array(
            'success' => false,
            'message' => 'Error signing up'
        );
        echo json_encode($ret);
    }

} else {
    die("You are not authorized");
}

?>
