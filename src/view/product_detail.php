<section class="product">

    <section class="product__img">
        <div style="background-image: url('/src/view/images/<?= $product->Image; ?>');"></div>
    </section>

    <section class="product__info">

        <h2><?= $product->Name; ?></h2>
        <h4><?= $product->Description; ?></h4>

        <form action="/order/addBasket" method="post">
            <input type="hidden" name="product_id" value="<?= $product->ID ?>" />

            <fieldset>
                <?php foreach ($colors as $color) : ?>
                    <input type="radio" id="<?= $color->Name; ?>" name="color" value="<?= $color->ID; ?>" checked>
                    <label for="<?= $color->ID; ?>"> <?= $color->Name; ?></label>
                <?php endforeach ?>
            </fieldset>

            <select name="size">
                <?php foreach ($sizes as $size) : ?>
                    <option id="<?= $size->ID; ?>" value="<?= $size->ID; ?>"><?= $size->Name; ?></option>
                <?php endforeach ?>
            </select>

            <input type="number" name="amount" min="1" max="5" value="1">

            <?php if (isset($_SESSION['user_id'])) : ?>
                <button type="submit" class="product__info__submit">Buy</button>
            <?php endif; ?>
        </form>

    </section>

</section>