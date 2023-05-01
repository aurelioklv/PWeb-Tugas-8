<?php

include("config.php");

// Button 'daftar' onClick
if (isset($_POST['daftar'])) {
    $permission = '';
    $user_id = '';

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if ($name == "admin") {
        if ($password == "admin") {
            $permission = 'admin';
        }
    }

    if ($permission == '') {
        $sql = "SELECT * FROM user WHERE name = '" . $name . "'";
        $query = mysqli_query($db, $sql);
        if (mysqli_num_rows($select)) {
            $row = mysqli_fetch_array($select);

            if ($row['password'] == $password) {
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
        echo json_encode($ret);
    } else {
        $ret = array(
            'success' => false,
            'message' => 'Invalid username or password'
        );
        echo json_encode($ret);
    }

} else {
    die("You are not authorized");
}

?>