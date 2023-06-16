<?php

require_once "db.php";

$id = $_GET["id"];
$sql = "SELECT * FROM `posts` WHERE id = {$id}";
$post = mysqli_query($connection, $sql);
$post = $post->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shargin</title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="../media/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="../media/css/style.css">
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
</style>
</head>
<body>

  <div id="wrapper">

    <header id="header">
      <div class="header__top">
        <div class="container">
          <div class="header__top__logo">
            <h1>Блог-сайт викладача спец.дисциплін</h1>
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
              <a href="index.php">Усі записи</a>
              <div class="block__content">
                <div class="articles articles__horizontal">




          <div class="sh">
    
              <h2><?php echo $post['title']; ?>   </h2>
<h2><br></h2>
<h3><br><?php echo $post['description']; ?> </h3><h2><br></h2>
             <h3><br><?php echo $post['body']; ?> </h3><h2><br></h2>


          </div>


  <?php
?>

 <h3><br>  <br>  <br></h3>

 <h1>Коментарі</h1> 
      <?php
      $sql = "SELECT * FROM `comments` WHERE post = {$id}";
      $comments = mysqli_query($connection, $sql);
      while ($comment = $comments->fetch_assoc()) {
      ?><br><br>
       <h2><?= $comment['name'] ?>:</h2>
        <h5><?= $comment['comment'] ?></h5>
        <br>  <br><br><br>
        <div> </div>
      <?php
      }
      ?>

            <div class="block" id="comment-add-form">
              <h1>Додати коментар</h1><br>
              <div class="block__content">
              <form class="form" method="POST" action="commentScript.php">
  <div class="form__group">
    <div class="row">
      <div class="col-md-6">
        <input type="text" maxlength="10" class="form__control" required="" name="name" placeholder="Имя">
      </div>
    </div>
  </div>
  <div class="form__group">
    <textarea name="message" required="" class="form__control" placeholder="Текст комментария ..."></textarea>
  </div>
  <div class="form__group">
    <input type="hidden" name="post" value="<?php echo $post['id']; ?>">
    <input type="submit" class="form__control" name="do_post" value="Коментувати">
  </div>
</form>
              </div>
            </div>

                </div>
              </div>
            </div>
            <br>  <br>  <br>



   <footer id="footer">
      <div class="container">
        <div class="footer__logo">
 <h3>Блог-сайт </h3>
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
