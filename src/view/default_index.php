<div class="products">
<?php foreach ($products as $product): ?>

    <div class="products__item">
        <div class="products__item__img"></div>
        <h2><?= $product->Name; ?></h2>
        <p><?= $product->Description; ?></p>
    </div>

<?php endforeach ?>
</div>