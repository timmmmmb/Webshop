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
            <?php foreach ($products as $product) : ?>
                <li>
                    <div class="basket__item">
                        <div class="basket__item__img">
                            <a href="/product?product_id=<?= $product->ID ?>">
                                <div style="background-image: url('/src/view/images/<?= $product->image; ?>');"></div> 
                            </a>
                        </div>
                        <div class="basket__item__info">
                            <p><?= $product->name ?></p>
                            <p>Color: <?= $product->color ?></p>
                            <p>Size: <?= $product->size ?></p>
                            <form action="/order/removeItem" method="post">
                                <input type="hidden" name="id" value="<?= $product->order_id ?>" />
                                <input type="hidden" name="amount" value="<?= $product->amount ?>" />
                                <button class="basket__item__info__submit" type="submit"><i class="fa fa-trash"></i> <?=_BASKET_REMOVE?></button>
                            </form>
                        </div>
                        <div class="basket__item__right">
                            <form action="/order/updateAmount" method="post">
                                <input type="hidden" name="id" value="<?= $product->order_id ?>" />
                                <input type="number" name="amount" class="basket__item__right__number" min="1" value="<?= $product->amount ?>">
                            </form>
                            <span><?= $product->total_prize ?>.- CHF</span>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="basket__hr">
            <div class="basket__hr__line"></div>
            <div class="basket__hr__circle"></div>
            <div class="basket__hr__line"></div>
        </div>
        <form action="/product/payForm" class="basket__form" method="post">
            <button class="basket__form__submit" type="submit"><?=_BASKET_CHECKOUT?></button>
        </form>
    
    <?php endif; ?>

</section>