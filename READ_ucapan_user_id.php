<?php

include("config.php");

// Query param 'user_id'
if (isset($GET['user_id'])) {
    $user_id = mysqli_real_escape_string($db, $_GET['user_id']);

    $sql = "SELECT * FROM ucapan WHERE user_id = '$user_id'";
    $result = mysqli_query($db, $sql);

    if ($result) {
        $replies = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $replies[] = $row;
        }

        $ret = array(
            "success" => true,
            "replies" => $replies
        );

        echo json_encode($ret);
    } else {
        $ret = array(
            "success" => false,
            "message" => "Failed to retrieve ucapan by user_id"
        );

        echo json_encode($ret);
    }
} else {
    die("You are not authorized");
}

?>