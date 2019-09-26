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
      <span class="header__line">
        <div class="header__line__hr"></div>
        <div class="header__line__square"></div>
        <div class="header__line__hr"></div>
      </span>
      <nav>
        <ul>
          <li><a href="/">home</a></li>
          <?php
          if(isset($_SESSION['user_id'])) {
              echo '<li><a href="/user/profile">'.$_SESSION['user_name'].'</a></li>
                    <li><a href="/user/logout">logout</a></li>';
          } else {
              echo '<li><a href="/user/login">login</a></li>
                    <li><a href="/user/register">register</a></li>';
          }
          ?>
        </ul>
      </nav>
    </header>
    <main>