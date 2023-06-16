<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $body = $_POST["body"];

    $sql = "INSERT INTO `posts` (`id`, `user`, `title`, `description`, `body`) VALUES (NULL, ?, ?, ?, ?)";

    $stmt = $connection->prepare($sql);
    if ($stmt) {
      $stmt->bind_param("isss", $user, $title, $description, $body);
      if ($stmt->execute()) {
        $_SESSION['success_message'] = "Пост створення";
        header("Location: index.php");
        exit;
      } else {
        echo "Помилка";
      }
      $stmt->close();
    } else {
      echo "Помилка";
    }
  } else {
    echo "Ви неавторизований";
  }
}
?>