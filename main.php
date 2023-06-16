<?php
require_once "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shargin</title>

  <link rel="stylesheet" type="text/css" href="\media/css/grid12.css">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="\media/css/style.css">
  <style type="text/css">
body {
background:#FFF3DB url("http://s54.radikal.ru/i144/0808/b7/0c8cdf28253f.jpg")repeat;}
.ssss{
  margin:0;
padding:0;
font-size: small;
text-align:center;
color:$textColor;
line-height:1.3em;
background:#FFF3DB url("http://s54.radikal.ru/i144/0808/b7/0c8cdf28253f.jpg")repeat;
}

form {
  position: relative;
  width: 300px;
  margin: 0 auto;
}

.d1 input {
  width: 100%;
  height: 42px;
  padding-left: 10px;
  border: 2px solid black;
  border-radius: 5px;
  outline: none;
  background: #F9F0DA;
  color: black;
}
.d1 button {
  position: absolute;
  top: 0;
  right: 0px;
  width: 42px;
  height: 42px;
  border: none;
  background: black;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
}
.d1 button:before {
  content: "\f002";
  font-family: FontAwesome;
  font-size: 16px;
  color: #F9F0DA;
}

  </style>

</head>
<body>

  <div id="wrapper">

    <header id="header">
      <div class="header__top">
        <div class="container">
          <div class="header__top__logo">

            <h1>Блог-сайт</h1>
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
    </header>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
             
              <h3>Записи</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">
                  <?php

$sql = "SELECT * FROM `posts` ORDER BY `posts`.`id` DESC";
$posts = mysqli_query($connection, $sql);

?>
<?php
while ($post = mysqli_fetch_assoc($posts)) {
 ?>

                  <article class="article">
                  <div class="article__image" style="background-image: url(images.png);"></div>
                    <div class="article__info">
                    <a href="article.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a><br><br>
                       <div class="article__info__preview"><?= $post['description'] ?></div>
                    </div>
                  </article>
 <?php
}
?>


                </div>
              </div>
            </div>
          </section>
          <section class="content__right col-md-4">
      <div class="ssss">
        <script type="text/javascript" src="//ra.revolvermaps.com/0/0/6.js?i=02op3nb0crr&amp;m=7&amp;s=320&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script></div>



           
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

  </div>
</body>
</html>

