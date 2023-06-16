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
<?php if (isset($_GET['edit'])): ?>
    <div class="profile">
      <h3>Ваш профіль</h3> <br>
      <form action="profilescript.php" method="POST">
        <div class="form-group">
          <label for="name">Ім'я:</label>
          <input type="text" name="name" id="name" value="<?= $user['name'] ?>" required>
        </div>  <br>
        <div class="form-group">
          <label for="lastname">Прізвище</label>
          <input type="text" name="lastname" id="lastname" value="<?= $user['lastname'] ?>" required>
        </div>  <br>
        <div class="form-group">
          <label for="age">Вік</label>
          <input type="text" name="age" id="age" value="<?= $user['age'] ?>" required>
        </div>  <br>
        <div class="form-group">
          <label for="gender">Стать</label>
          <select name="gender" id="gender" required>
            <option value="Male" <?= ($user['gender'] === 'Male') ? 'selected' : '' ?>>М</option>
            <option value="Female" <?= ($user['gender'] === 'Female') ? 'selected' : '' ?>>Ж</option>
            <option value="Other" <?= ($user['gender'] === 'Other') ? 'selected' : '' ?>>Інше</option>
          </select>
        </div>  <br>
        <div class="form-group">
          <label for="address">Адреса</label>
          <input type="text" name="address" id="address" value="<?= $user['address'] ?>" required>
        </div>  <br>
        <div class="form-group">
          <label for="website">Сайт</label>
          <input type="text" name="website" id="website" value="<?= $user['website'] ?>" required>
        </div>  <br>
        <button type="submit" name="update" class="btn">Оновити</button>
      </form>
    </div>
  <?php else: ?>
    <div class="post_busk">
      <div class="post__title"><br>
      <h3><?= $user['Name'] ?></h3>
      <br>
        <h3><?= $user['email'] ?></h3><br>
      </div>
      <a href="profile.php?edit=1" class="edit-link">Перейти к оновленнню профіля</a>
    </div>
  <?php endif; ?>
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

























