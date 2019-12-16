<!--
  _____   _             __        __   __                       _        _   
 |_   _| (_)  _ __     / _|___    \ \ / /  __ _   _ _    _ _   (_)  __  | |__
   | |   | | | '  \    > _|_ _|    \ V /  / _` | | ' \  | ' \  | | / _| | / /
   |_|   |_| |_|_|_|   \_____|      |_|   \__,_| |_||_| |_||_| |_| \__| |_\_\
                                                                                                                                                                                                                                                  
   Createn on 17. Sept. 2019
   by Tim Frey & Yannick Ruefenacht
-->
<!DOCTYPE html>
<html lang="<?=$_SESSION['lang']['name']?>">

<head>
    <!-- META -->
    <meta charset="utf-8" />
    <meta name="description" content="T and Y Webshop">
    <meta name="keywords" content="Clean, Web, Shop">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?=_ROOT?>src/view/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <!-- SHORTCUT -->
    <link href="<?=_ROOT?>src/view/images/tandy-dark.png" rel="shortcut icon">
    <!-- TITLE -->
    <title><?=_TITLE?> | <?= $title ?></title>
</head>

<body>
    <header>
        <div class="header--wrapper">
            <div class="header__languages">
                <nav>
                    <ul>
                        <li><a href="<?= Dispatcher::getURL('de'); ?>">de</a></li>
                        <li><a href="<?= Dispatcher::getURL('en'); ?>">en</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header__menu">
                <h1><?=_TITLE?></h1>
                <div class="header__menu__line">
                    <div class="header__menu__line__hr"></div>
                    <div class="header__menu__line__square">
                        <img src="<?=_ROOT?>src/view/images/tandy-light.png" alt="T&Y">
                    </div>
                    <div class="header__menu__line__hr"></div>
                </div>
                <nav>
                    <ul>
                        <li><a href="<?=_ROOT.$_SESSION['lang']['name']?>"><?=_HOME?></a></li>
                        <li><a href="<?=_ROOT.$_SESSION['lang']['name']?>/product/men"><?=_MEN?></a></li>
                        <li><a href="<?=_ROOT.$_SESSION['lang']['name']?>/product/women"><?=_WOMEN?></a></li>
                        <?php if (isset($_SESSION['user_type_de']) && $_SESSION["user_type_de"]=="Admin") : ?>
                            <li><a href="<?=_ROOT.$_SESSION['lang']['name']?>/admin"><?=_ADMIN?></a></li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['user_id'])) : ?>
                            <li><a href="<?=_ROOT.$_SESSION['lang']['name']?>/user/logout"><?=_LOGOUT?></a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <div class="header__icons">
                <nav>
                    <ul>
                        <li>
                            <div class="header__icons__item" id="header__icons__search">
                                <i class="fa fa-search fa-2x" aria-hidden="true"></i>
                            </div>
                        </li>
                        <li>
                            <a href="<?=_ROOT.$_SESSION['lang']['name']?>/user/login">
                                <div class="header__icons__item">
                                    <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
                                </div>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['user_id'])) : ?>
                            <li>
                                <a href="<?=_ROOT.$_SESSION['lang']['name']?>/basket">
                                    <div class="header__icons__item header__icons__item--cart">
                                        <span id="orderCount"><?=$_SESSION['user_order_count']?></span>
                                        <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                                    </div>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="header__search" hidden>
            <form action="<?=_ROOT.$_SESSION['lang']['name']?>/product/search" method="GET">
                <input type="text" class="header__search__bar input--validate-me" name="q" placeholder="<?=_SEARCH?>">
            </form>
        </div>
    </header>
    <main>