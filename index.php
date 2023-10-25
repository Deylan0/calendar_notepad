<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

    <?php 

        $username = $email = $password = "";
        $usernameErr = $emailErr = $passwordErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["username"])) {
                $usernameErr = "* Username required";
            } else {
                $username = test_input($_POST["username"]);
                if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
                    $usernameErr = "Only letters and white space allowed";
                  }
            }

            if( empty($_POST["email"])) {
                $emailErr = "* Email required";
            } else {
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                  }
            }

            if (empty($_POST["password"])) {
                $passwordErr = "* Password required";
            } else {
                $password = test_input($_POST["password"]);
            }
            
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return($data);
        }

    ?>

    <header><b>Welcome to your private calendar and notepad!<br/> To start please log in below.</b></header>
    <main>

        <form action="<?php echo htmlspecialchars("zaloguj.php") ?>" method="post">
            E-mail: <input type="text" name="email"><span class="error"> <?php echo $emailErr ?></span></br></br>
            Password: <input type="password" name="password"><span class="error"> <?php echo $passwordErr ?></span></br></br>
            <input type="submit"></br></br>
            <span class="error"><b>
            <?php 
                    session_start(); 
                $wrong_log = "";
                if (isset($_SESSION['wrong_log'])) {
                    $wrong_log = $_SESSION['wrong_log'];
                    unset($_SESSION['wrong_log']);
                    session_destroy();
                }
                echo $wrong_log;
            ?>
            </b></span>

        </form>

    </main>
</body>
</html>