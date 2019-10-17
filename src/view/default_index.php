<div class="banner">
    <div class="banner__overlay">
        <div class="banner__overlay__title"><?=_POPULAR?></div>
    </div>
</div>
<section class="products">
    <?php foreach ($products as $product) : ?>
        <a href="/<?=$_SESSION['lang']['name']?>/product?product_id=<?= $product->ID; ?>">
            <div class="products__item">
                <div class="products__item__img">
                    <div style="background-image: url('/src/view/images/<?= $product->Image; ?>');"></div>
                </div>
                <div class="products__item__desc">
                    <span>CHF <?=$product->Price?></span>
                    <h2><?= $product->{'Name_'.strtoupper($_SESSION['lang']['name'])}; ?></h2>
                    <h4><?= $product->{'Description_'.strtoupper($_SESSION['lang']['name'])}; ?></h4>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</section>