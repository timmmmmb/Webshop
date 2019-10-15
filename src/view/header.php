<!--
  _____   _             __        __   __                       _        _   
 |_   _| (_)  _ __     / _|___    \ \ / /  __ _   _ _    _ _   (_)  __  | |__
   | |   | | | '  \    > _|_ _|    \ V /  / _` | | ' \  | ' \  | | / _| | / /
   |_|   |_| |_|_|_|   \_____|      |_|   \__,_| |_||_| |_||_| |_| \__| |_\_\
                                                                                                                                                                                                                                                  
   Createn on 17. Sept. 2019
   by Tim Frey & Yannick Ruefenacht
-->
<?php
//used to integrate the multilanguage

// Set Language variable
if(isset($_GET['lang']) && !empty($_GET['lang'])){
    $_SESSION['lang'] = $_GET['lang'];

    if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']){
        echo "<script type='text/javascript'> location.reload(); </script>";
    }
}

// Include Language file
if(isset($_SESSION['lang'])){
    include "languages/lang_".$_SESSION['lang'].".php";
}else{
    include "languages/lang_en.php";
}
?>
<!DOCTYPE html>
<html lang="<?=$_SESSION['lang']?>">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="/src/view/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?=_TITLE?> | <?= $title ?></title>
</head>

<body>
    <header>
        <div class="header__languages">
            <nav>
                <ul>
                    <script>
                        function changeLanguage(lang){
                            let url = window.location.href;
                            let index = url.indexOf("lang=");
                            //check if allready has lang parameter
                            if(index > -1){
                                url = url.substr(0, index+5)+lang+url.substr(index+7, url.length);
                            }else if (url.indexOf('?') > -1){
                                url += '&lang='+lang;
                            }else{
                                url += '?lang='+lang;
                            }
                            window.location.href = url;
                        }
                    </script>
                    <li><a onclick="changeLanguage('de')">de</a></li>
                    <!--<li><a onclick="changeLanguage('fr')">fr</a></li>-->
                    <li><a onclick="changeLanguage('en')">en</a></li>
                </ul>
            </nav>
        </div>
        <div class="header__menu">
            <h1><?=_TITLE?></h1>
            <div class="header__menu__line">
                <div class="header__menu__line__hr"></div>
                <div class="header__menu__line__square"></div>
                <div class="header__menu__line__hr"></div>
            </div>
            <nav>
                <ul>
                    <li><a href="/"><?=_HOME?></a></li>
                    <li><a href="/"><?=_WOMEN?></a></li>
                    <li><a href="/"><?=_MEN?></a></li>
                    <?php if (isset($_SESSION['user_type'])&&$_SESSION["user_type"]=="Admin") : ?>
                        <li><a href="/admin"><?=_ADMIN?></a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <li><a href="/user/logout"><?=_LOGOUT?></a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <div class="header__icons">
            <nav>
                <ul>
                    <li>
                        <a href="/user/login">
                            <div class="header__icons__item">
                                <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
                            </div>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <li>
                            <a href="/basket">
                                <div class="header__icons__item header__icons__item--cart">
                                    <span id="orderCount"><?= $_SESSION['user_order_count']; ?></span>
                                    <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main>