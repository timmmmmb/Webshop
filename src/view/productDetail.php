<div class="products__item_detail">
    <div class="products__item__img">
        <div style="background-image: url(../src/view/images/<?=$product->Image;?>);width: 100%;height: 100%;"></div>
    </div>
    <div class="products__item__desc">
        <h2><?= $product->Name; ?></h2>
        <h4><?= $product->Description; ?></h4>
    </div>
    <form action="/order/addBasket?product_id=<?= $product->id; ?>">
        <p>Wählen sie ihre Farbe aus: </p>
        <fieldset>
            <?php foreach ($colors as $color): ?>
                <input type="radio" id="<?= $color->Name; ?>" name="color" value="<?= $color->Name;?>"checked>
                <label for="<?= $color->Name; ?>"> <?= $color->Name; ?></label>
            <?php endforeach ?>
        </fieldset>
        <p>Wählen sie ihre Grösse aus: </p>
        <select name="size">
            <?php foreach ($sizes as $size): ?>
                <option value="<?= $size->Name; ?>"><?= $size->Name; ?></option>
            <?php endforeach ?>
        </select>
        <p>Menge</p>
        <input type="number" name="quantity" min="1" max="5" value="1">
        <input type="submit">
    </form>
</div>