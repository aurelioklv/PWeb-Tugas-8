<?php

include("config.php");

// Button 'kirim' onClick
if (isset($_POST['kirim'])) {
    $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
    $ucapan_id = mysqli_real_escape_string($db, $_POST['ucapan_id']);
    $content = mysqli_real_escape_string($db, $_POST['pesan']);

    $user_sql = "SELECT permission FROM user WHERE user_id = '$user_id'";
    $user_query = mysqli_query($db, $sql);

    if ($user_query->num_rows > 0) {
        $row = $user_query->fetch_assoc();
        if ($row["permission"] == "ADMIN") {
            $sql = "INSERT INTO reply (user_id, ucapan_id, content) VALUE ('$user_id', '$ucapan_id', '$content')";
            $query = mysqli_query($db, $sql);

            if ($query) {
                $ret = array(
                    'success' => true,
                    "message" => "Reply Successfully",
                );
                echo json_encode($ret);
                header("Location:admin-home.php");
            } else {
                $ret = array(
                    'success' => false,
                    "message" => "Failed to add reply"
                );
                echo json_encode($ret);
                header("Location:admin-home.php");
            }
        } else {
            $ret = array(
                'success' => false,
                "message" => "User cannot reply"
            );
            echo json_encode($ret);
            header("Location:admin-home.php");
        }
    } else {
        $ret = array(
            'success' => false,
            "message" => "User does not exist"
        );
        echo json_encode($ret);
        header("Location:admin-home.php");
    }
} else {
    die("You are not authorized");
}

?>