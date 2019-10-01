<div class="products__item_detail">
    <div class="products__item__img">
        <div style="background-image: url(../src/view/images/<?=$product->Image;?>);width: 100%;height: 100%;"></div>
    </div>
    <div class="products__item__desc">
        <h2><?= $product->Name; ?></h2>
        <h4><?= $product->Description; ?></h4>
    </div>
    <form action="/order/addBasket" method="post">
        <p>Wählen sie ihre Farbe aus: </p>
        <input type="hidden" name="product_id" value="<?= $product->ID ?>" />
        <fieldset>
            <?php foreach ($colors as $color): ?>
                <input type="radio" id="<?= $color->Name; ?>" name="color" value="<?= $color->ID;?>"checked>
                <label for="<?= $color->ID; ?>"> <?= $color->Name; ?></label>
            <?php endforeach ?>
        </fieldset>
        <p>Wählen sie ihre Grösse aus: </p>
        <select name="size">
            <?php foreach ($sizes as $size): ?>
                <option id="<?= $size->ID; ?>" value="<?= $size->ID; ?>"><?= $size->Name; ?></option>
            <?php endforeach ?>
        </select>
        <p>Menge</p>
        <input type="number" name="amount" min="1" max="5" value="1">
        <?php if(isset($_SESSION['user_id'])) : ?>
            <input type="submit">
        <?php endif; ?>
    </form>
</div>