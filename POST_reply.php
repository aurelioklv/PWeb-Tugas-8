<?php

include("config.php");

// Button 'kirim' onClick
if (isset($_POST['kirim'])) {

    $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
    $ucapan_id = mysqli_real_escape_string($db, $_POST['ucapan_id']);
    $content = mysqli_real_escape_string($db, $_POST['pesan']);

    $sql = "INSERT INTO reply (user_id, ucapan_id, content) VALUE ('$user_id', '$content')";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $ret = array(
            'success' => true,
        );
        echo json_encode($ret);
    } else {
        $ret = array(
            'success' => false,
            "message" => "Failed to add reply"
        );
        echo json_encode($ret);
    }
} else {
    die("You are not authorized");
}

?>