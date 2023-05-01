<?php

include("config.php");

// Button 'kirim' onClick
if (isset($_POST['kirim'])) {

    $user_id = $_POST['user_id'];
    $content = $_POST['pesan'];

    $sql = "INSERT INTO ucapan (user_id, content) VALUE ('$user_id', '$content')";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $ucapan_id = mysqli_insert_id($db);

        $ret = array(
            'success' => true,
            'ucapan_id' => $ucapan_id
        );
        echo json_encode($ret);
    } else {
        $ret = array(
            'success' => false,
        );
        echo json_encode($ret);
    }
} else {
    die("You are not authorized");
}

?>