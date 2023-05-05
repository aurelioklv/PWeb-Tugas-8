<?php
session_start();
include("config.php");

// Button 'login' onClick
if (isset($_POST['login'])) {
    $permission = '';
    $user_id = '';
    $id_user = '';

    $name = $_POST["name"];
    $password = $_POST["password"];

    if ($name == "admin") {
        if ($password == "admin") {
            $permission = 'admin';
        }
    }

    if ($permission == '') {
        $sql = "SELECT * FROM user WHERE name = '" . $name . "'";
        $query = mysqli_query($db, $sql);
        if (mysqli_num_rows($query)) {
            $row = mysqli_fetch_array($query);
            $encrypted_password = $row['password'];

            if (password_verify($password, $encrypted_password)) {
                $user_id = strval($row['user_id']);
                $permission = 'user';
            }
        }
    }

    if ($permission != '') {
        $ret = array(
            'success' => true,
            'user_id' => $user_id,
            'permission' => $permission,
            'message' => 'Succesfully logged in'
        );
        if($permission != 'admin'){
          $_SESSION['loginInfo'] = $ret;
          echo json_encode($ret);
          header("Location: user-home.php");
          exit;
        }
        echo json_encode($ret);
        $_SESSION['loginInfo'] = $ret;
        header("Location: admin-home.php");
        exit;
    } else {
        $ret = array(
            'success' => false,
            'message' => 'Invalid username or password'
        );
        $_SESSION['loginAttempt'] = $ret;
        echo json_encode($ret);
    }

} else {
    die("You are not authorized");
}

?>