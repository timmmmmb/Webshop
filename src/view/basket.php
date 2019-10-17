<section class="basket">

    <h3><?=_BASKET_TITLE?></h3>
    <div class="basket__hr">
        <div class="basket__hr__line"></div>
        <div class="basket__hr__circle"></div>
        <div class="basket__hr__line"></div>
    </div>

    <?php if (empty($products)) : ?>

        <div class="basket__empty">
            <div class="basket__empty__icon">
                <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
            </div>
            <p><?=_BASKET_EMPTY?></p>
        </div>

    <?php else : ?>
    
        <ul>
            <?php $checkout_total = 0; ?>
            <?php foreach ($products as $product) : ?>
                <li>
                    <div class="basket__item">
                        <div class="basket__item__img">
                            <a href="/<?=$_SESSION['lang']['name']?>/product?product_id=<?= $product->ID ?>">
                                <div style="background-image: url('/src/view/images/<?= $product->image; ?>');"></div> 
                            </a>
                        </div>
                        <div class="basket__item__info">
                            <p><?= $product->{'name_'.$_SESSION['lang']['name']} ?></p>
                            <p><?=_BASKET_COLOR?> <?= $product->{'color_'.$_SESSION['lang']['name']} ?></p>
                            <p><?=_BASKET_SIZE?> <?= $product->{'size_'.$_SESSION['lang']['name']} ?></p>
                            <form action="/<?=$_SESSION['lang']['name']?>/order/removeItem" method="post">
                                <input type="hidden" name="id" value="<?= $product->order_id ?>" />
                                <input type="hidden" name="amount" value="<?= $product->amount ?>" />
                                <button class="basket__item__info__submit" type="submit"><i class="fa fa-trash"></i> <?=_BASKET_REMOVE?></button>
                            </form>
                        </div>
                        <div class="basket__item__right">
                            <form action="/<?=$_SESSION['lang']['name']?>/order/updateAmount" method="post">
                                <input type="hidden" name="id" value="<?= $product->order_id ?>" />
                                <input type="number" name="amount" class="basket__item__right__number" min="1" value="<?= $product->amount ?>">
                            </form>
                            <span>CHF <?= $product->total_prize ?></span>
                        </div>
                    </div>
                </li>
                <?php $checkout_total += $product->total_prize; ?>
            <?php endforeach; ?>
        </ul>
        <div class="basket__hr">
            <div class="basket__hr__line"></div>
            <div class="basket__hr__circle"></div>
            <div class="basket__hr__line"></div>
        </div>
        <form action="/<?=$_SESSION['lang']['name']?>/product/checkout" class="basket__form" method="post">
            <button class="basket__form__submit" type="submit">
                <?= _BASKET_CHECKOUT ?> &nbsp; CHF <?= number_format((float)$checkout_total, 2, '.', ''); ?>
            </button>
        </form>
    
    <?php endif; ?>

</section>