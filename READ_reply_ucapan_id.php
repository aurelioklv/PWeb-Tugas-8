<?php

include("config.php");

// Query param 'ucapan_id'
if (isset($GET['ucapan_id'])) {
    $ucapan_id = mysqli_real_escape_string($db, $_GET['ucapan_id']);

    $sql = "SELECT * FROM reply WHERE ucapan_id = '$ucapan_id'";
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
            "message" => "Failed to retrieve reply by ucapan_id"
        );

        echo json_encode($ret);
    }
} else {
    die("You are not authorized");
}

?>