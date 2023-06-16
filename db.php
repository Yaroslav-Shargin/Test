<?PHP
$connection = mysqli_connect('localhost', 'root', '', 'blog');
if (!$connection) {
  printf("Неможливо підключитися до бд: %s\n", mysqli_connect_error());
  exit;
}
?>