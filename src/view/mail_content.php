<!DOCTYPE html>
<html lang="<?=$_SESSION['lang']['name']?>">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <style>
        h1 {
            text-transform: uppercase;
            letter-spacing: 0.225em;
            color: #333;
            font-size: 1.2em;
            margin-bottom: 1.25em;
        }
        ol, ul {
            list-style: none;
        }
        .checkout__products {
            width: 100%;
        }

        .checkout__products li {
            width: 80%;
            height: 100px;
            display: flex;
            margin: 0 auto;
            padding: 1em 0;
            border-bottom: 1px solid #ddd;
        }

        .checkout__products li:nth-last-child(2) {
            border-bottom: none;
        }

        .checkout__products--profile li {
            margin: 0;
        }

        .checkout__products--profile li:last-child {
            height: 0;
            border: none;
            padding: 0;
        }

        .checkout__products__img {
            width: 100px;
            height: 100px;
            background: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .checkout__products__img a {
            width: 80%;
            height: 80%;
        }

        .checkout__products__img a div {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .checkout__products__desc {
            width: calc(100% - 100px);
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1em;
        }

        .checkout__products__desc span {
            margin: 0 1em;
        }

        .checkout__products__desc__separator {
            width: 1px;
            height: 10px;
            background: #222;
            display: inline-block;
        }

        li.checkout__products__total {
            border-bottom: none;
            border-top: 1px solid #111;
            height: 40px;
            justify-content: space-between;
            font-weight: 700;
            margin: 0 auto;
            text-transform: uppercase;
        }

        li.checkout__products__total span {
            margin: 0 1em;
        }
    </style>
</head>
<body>

<?php
require_once 'src/model/OrderModel.php';

$orderModel = new OrderModel();
$basketid = $orderModel->getBasketID($_SESSION["user_id"]);
$products = $orderModel->getProductsInBasket($basketid);

?>
<h1><?=_ORDERS_TITLE?></h1>
<?php $total_prize = 0?>
<ul class="checkout__products">
    <?php foreach ($products as $product): ?>
    <li>
        <div class="checkout__products__desc">
            <span>
                <?=$product->amount." x ".$product->{'name_'.$_SESSION['lang']['name']}?>
                <span class="checkout__products__desc__separator"></span>
                <?=$product->{'color_'.$_SESSION['lang']['name']}?>
                <span class="checkout__products__desc__separator"></span>
                <?=$product->{'size_'.$_SESSION['lang']['name']}?>
            </span>
            <span>CHF <?=$product->total_prize ?></span>
        </div>
    </li>
    <?php $total_prize += $product->total_prize ?>
    <?php endforeach ?>
    <li class="checkout__products__total">
        <i>Total</i>
        <span>CHF <?=number_format((float)$total_prize, 2, '.', '');?></span>
    </li>
</ul>

</body>