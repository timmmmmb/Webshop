<!--
  _____   _             __        __   __                       _        _   
 |_   _| (_)  _ __     / _|___    \ \ / /  __ _   _ _    _ _   (_)  __  | |__
   | |   | | | '  \    > _|_ _|    \ V /  / _` | | ' \  | ' \  | | / _| | / /
   |_|   |_| |_|_|_|   \_____|      |_|   \__,_| |_||_| |_||_| |_| \__| |_\_\
                                                                                                                                                                                                                                                  
   Createn on 17. Sept. 2019
   by Tim Frey & Yannick Ruefenacht
-->
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="/src/view/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Webshop | <?= $title ?></title>
</head>

<body>
    <header>
        <h1>Webshop</h1>
        <div class="header__line">
            <div class="header__line__hr"></div>
            <div class="header__line__square"></div>
            <div class="header__line__hr"></div>
        </div>
        <nav>
            <ul>
                <li><a href="/">home</a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a href="/user/profile"><?= $_SESSION['user_name'] ?></a></li>
                    <li><a href="/basket">basket</a></li>
                    <li><a href="/user/logout">logout</a></li>
                <?php else : ?>
                    <li><a href="/user/login">login</a></li>
                    <li><a href="/user/register">register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>