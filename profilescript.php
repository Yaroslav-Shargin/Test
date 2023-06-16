<?php
require_once "db.php";
session_start();
$id = $_SESSION["id"];
if (!isset($id)) {
  header("location: login.php");
  exit;
}

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $website = $_POST['website'];

  $sql = "UPDATE `users` SET `name`=?, `lastname`=?, `age`=?, `gender`=?, `address`=?, `website`=? WHERE `id`=?";
  $stmt = $connection->prepare($sql);
  if ($stmt) {
    $stmt->bind_param("ssisssi", $name, $lastname, $age, $gender, $address, $website, $id);
    if ($stmt->execute()) {
      header("location: index.php");
      exit;
    } else {
      echo "Oops! Something went wrong. Please try again later.";
    }
    $stmt->close();
  } else {
    echo "Oops! Something went wrong. Please try again later.";
  }
}

header("location: profile.php?edit=1");
exit;
?>