<?php
require_once "db.php";

session_start();

$id = $_SESSION["id"];
if (!isset($id)) {
  header("location: login.php");
  exit;
}

$sql = "SELECT * FROM `users` WHERE id = {$id}";
$user = mysqli_query($connection, $sql);
$user = $user->fetch_assoc();
?>
<html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shargin</title>


  <link rel="stylesheet" type="text/css" href="../media/css/grid12.css">


  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">


  <link rel="stylesheet" type="text/css" href="../media/css/style.css">
</head>
	<style>
	.ot{
	width: :30%;
	height:30%;
	}
     body{
background:#FFF3DB url("http://s54.radikal.ru/i144/0808/b7/0c8cdf28253f.jpg")repeat;}

  .conteeiner {

height: 20%;
			width: 20%;
    font-weight: bold;
font-size: 15px;
height: 40px;
margin: 0 auto;
padding: 20px 20px 20px 20px;
}
</style>
</head>
<body>
	 <div id="wrapper">

    <header id="header">
      <div class="header__top">
        <div class="container">
          <div class="header__top__logo">
            <h1>Блог-сайт </h1>
          </div>


        </div>
      </div>

      <div class="header__bottom">
        <div class="container">
        <nav>
         <?php  if (isset($_SESSION['id'])) {
           echo '<ul>
           <li class="menu__list">
             <a href="index.php" class="menu__link">Головна</a>
           </li>  <li class="menu__list">
           <a href="post.php" class="menu__link">Додавання постів</a>
           </li> <li class="menu__list">
           <a href="profile.php" class="menu__link">Профіль</a>
           </li><li class="menu__list">
           <a href="reset-password.php" class="menu__link">Зміна пароля</a>
           </li> <li class="menu__list">
           <a href="logout.php" class="menu__link">Вийти</a>
           </li> /ul>'  ;

        } else {
          echo 
        '<ul>  <li class="menu__list">
          <a href="index.php" class="menu__link">Головна</a>
        </li> <li class="menu__list">
        <a href="login.php" class="menu__link">Увіти</a>
        </li> </ul>'  ; 
        } ?>
          </nav>
        </div>
      </div>
    </header></div>

	<div class="ot"></div>
<div class="conteeiner">
<h1>Створення поста</h1><br>
    <form method="post" action="postscript.php">
      <div class="form-group">
        <label for="title">Назва</label>
        <input type="text" id="title" name="title" class="form-control" required><br>
      </div><br>
      <div class="form-group">
        <label for="description">Опис</label>
        <input type="text" id="description" name="description" class="form-control" required><br>
      </div><br>
      <div class="form-group">
        <label for="body">Текст</label>
        <textarea id="body" name="body" required class="form-control"></textarea><br>
      </div><br>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Додати">
      </div>
    </form>
</div>
	<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br>
<br>
 <footer id="footer">
      <div class="container">
        <div class="footer__logo">
 <h3>Блог-сайт</h3>
        </div>
        <nav class="footer__menu">
          <ul>
        <li><h3>Розробник:Шаргін Я.В.</h3></li>
          </ul>
        </nav>
      </div>
    </footer>

	</body>
	</html>






