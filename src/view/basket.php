<section class="basket">

    <h3>Shopping cart</h3>
    <hr class="basket__hr">

    <?php if (empty($products)) : ?>

        <div class="basket__empty">
            <div class="basket__empty__icon">
                <img src="/src/view/images/shopping-cart-empty.svg" alt="Empty">
            </div>
            <p>Shopping cart is empty</p>
        </div>

    <?php else : ?>
    
        <ul>
            <?php foreach ($products as $product) : ?>
                <li>
                    <div class="basket__item">
                        <div 
                            class="basket__item__img" 
                            style="background-image: url('/src/view/images/<?= $product->image; ?>');">
                        </div>
                        <div class="basket__item__info">
                            <p><?= $product->name ?></p>
                            <p>Color: <?= $product->color ?></p>
                            <p>Size: <?= $product->size ?></p>
                            <form action="/order/removeItem" method="post">
                                <input type="hidden" name="id" value="<?= $product->order_id ?>" />
                                <input type="hidden" name="amount" value="<?= $product->amount ?>" />
                                <button class="checkoutButton" type="submit">remove</button>
                            </form>
                        </div>
                        <div class="basket__item__right">
                            <form action="/order/updateAmount" method="post">
                                <input type="hidden" name="id" value="<?= $product->order_id ?>" />
                                <input type="number" name="amount" min="1" value="<?= $product->amount ?>">
                                <button class="checkoutButton" type="submit">Update Amount</button>
                            </form>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <form action="/product/payForm" method="post">
            <button type="submit">Pay</button>
        </form>
    
    <?php endif; ?>

</section>