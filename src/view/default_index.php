<div class="banner">
    <div class="banner__overlay">
        <div class="banner__overlay__title"><?=_POPULAR?></div>
    </div>
</div>
<section class="products">
    <?php foreach ($products as $product) : ?>
        <a href="/product?product_id=<?= $product->ID; ?>">
            <div class="products__item">
                <div class="products__item__img">
                    <div style="background-image: url('/src/view/images/<?= $product->Image; ?>');"></div>
                </div>
                <div class="products__item__desc">
                    <h2><?= $product->Name; ?></h2>
                    <h4><?= $product->Description; ?></h4>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</section>