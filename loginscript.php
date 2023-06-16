<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location:index.php");
    exit;
}

require_once "db.php";
$name = $password = "";
$username_err = $password_err = $login_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["name"]))) {
        $username_err = "Введіть ім'я.";
        echo $username_err;
    } else {
        $name = trim($_POST["name"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Введіть пароль";
        echo $password_err ;
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, name, password FROM users WHERE name = ?";

        if ($stmt = $connection->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $name;
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $name, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $name;

                            header("location: index.php");
                        } else {
               
                            $login_err = "Н";
                            echo $login_err;
                        }
                    }
                } else {
                    $login_err = "Невірний логін або пароль";
                    echo $login_err;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

    $connection->close();
}
?>