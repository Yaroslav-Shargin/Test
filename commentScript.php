<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["name"];
  $message = $_POST["message"];
  $postID = $_POST["post"];

  $sql = "INSERT INTO `comments` (`name`, `comment`, `post`) VALUES (?, ?, ?)";
  $stmt = $connection->prepare($sql);
  
  if ($stmt) {
    $stmt->bind_param("sss", $name, $message, $postID);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      $_SESSION["success_message"] = "Коментар успішно додано до публікації!";
    } else {
      $_SESSION["error_message"] = "Не вдалося додати коментар. Будь ласка, спробуйте ще раз.";
    }
  } else {
    $_SESSION["error_message"] = "Не вдалося підготувати запит. Будь ласка, спробуйте ще раз.";
  }

  header("Location: index.php");
  exit();
}
?>