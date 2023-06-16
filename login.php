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
	<h1> Авторизація </h1><br>
    
    <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

<form action="loginscript.php" method="post">
            <div class="form-group">
                <label>Ім'я</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <br>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>       <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ввійти">
            </div>       <br>
            <a href="register.php">Реєстрація</a></p>
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



