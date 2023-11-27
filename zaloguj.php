<?php 

    require_once "connect.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND passwordd='$password'";
    $result = $conn->query($sql);
    if (!$result){
        die("Query failed:" . $conn->$error)
    }

    if($result->num_rows > 0) {

        $row =  $result->fetch_assoc();
        $email = $row['email'];

        $result->free_result();
        header("Location: chose.php");

    } else {
        session_start();
        $_SESSION['wrong_log'] = "wrong login";
        header("Location: index.php");

    }

    $conn->close();
?>