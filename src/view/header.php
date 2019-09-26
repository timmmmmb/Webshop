<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="/src/view/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <title>Webshop | <?= $title ?></title>
  </head>
  <body>
    <header>
      <h1>Webshop</h1>
      <nav>
        <?php
            if(isset($_SESSION['user_id'])){
                echo '<a href="../">home</a>
                        <a href="../user/profile">'.$_SESSION['user_name'].'</a>
                        <a href="../user/logout">logout</a>';
            }else{
                echo '<a href="../user/loginForm">login</a>
                        <a href="../user/registerForm">register</a>
                        <a href="../">home</a>';
            }
        ?>
      </nav>
    </header>
    <main>