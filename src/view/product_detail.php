<section class="product">

    <div class="product__view">
        <div class="product__view__img" style="background-image: url('<?=_ROOT?>src/view/images/<?= $product->Image; ?>');"></div>
        <hr class="product__view__hr">
        <div class="product__view__colors">
            <?php foreach ($colors as $color) : ?>
                <div 
                    class="product__view__colors__radio" 
                    data-color-id="<?= $color->ID; ?>"
                    style="background: #<?= $color->HexValue ?>">
                </div>               
            <?php endforeach ?>
        </div>
    </div>

    <div class="product__info">

        <h5>CHF <?= $product->Price; ?></h5>
        <h2><?= $product->{'Name_'.strtoupper($_SESSION['lang']['name'])}; ?></h2>
        <h4><?= $product->{'Description_'.strtoupper($_SESSION['lang']['name'])}; ?></h4>
        
        <?php if (isset($_SESSION['user_id'])) : ?>
        <form id="formAddBasket" method="post" data-url="<?=_ROOT.$_SESSION['lang']['name']?>/order/addBasket">
            <input type="hidden" name="product_id" value="<?= $product->ID ?>" />
            <input type="hidden" name="color" value="<?= $colors[0]->ID ?>" id="productColor"/>
        
            <select name="size" class="product__info__size">
                <?php foreach ($sizes as $size) : ?>
                    <option value="<?= $size->ID; ?>"><?= $size->{'Name_'.strtoupper($_SESSION['lang']['name'])}; ?></option>
                <?php endforeach ?>
            </select>

            <input type="number" name="amount" min="1" value="1">
            
            <hr class="product__info__hr">

            <button type="submit" class="product__info__submit"><?=_PRODUCT_DETAIL_ORDER?></button>
        </form>
        <?php else: ?>
        <a href="<?=_ROOT.$_SESSION['lang']['name']?>/user/login">
        <button class="basket__checkout">
            <?=_PRODUCT_DETAIL_ORDER?>
        </button>     
        </a>
        <?php endif; ?>
    </div>

</section>