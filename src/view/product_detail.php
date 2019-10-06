<section class="product">

    <section class="product__view">
        <div class="product__view__img" style="background-image: url('/src/view/images/<?= $product->Image; ?>');"></div>
        <hr class="product__view__hr">
        <div class="product__view__colors">
            <?php foreach ($colors as $color) : ?>
                <div 
                    class="product__view__colors__radio" 
                    value="<?= $color->ID; ?>"
                    style="background: #<?= $color->HexValue ?>">
                </div>               
            <?php endforeach ?>
        </div>
    </section>

    <section class="product__info">

        <h2><?= $product->Name; ?></h2>
        <h4><?= $product->Description; ?></h4>

        <form action="/order/addBasket" method="post">
            <input type="hidden" name="product_id" value="<?= $product->ID ?>" />
            <input type="hidden" name="color" value="<?= $colors[0]->ID ?>" id="productColor"/>
        
            <select name="size" class="product__info__size">
                <?php foreach ($sizes as $size) : ?>
                    <option value="<?= $size->ID; ?>"><?= $size->Name; ?></option>
                <?php endforeach ?>
            </select>

            <input type="number" class="product__info__amount" name="amount" min="1" max="5" value="1">
            
            <hr class="product__info__hr">
            
            <?php if (isset($_SESSION['user_id'])) : ?>
                <button type="submit" class="product__info__submit">Buy</button>
            <?php endif; ?>
        </form>

    </section>

</section>