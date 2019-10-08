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
                <li><?= $product->amount . " " . $product->color . " " . $product->name . " " . $product->size . " Preis: " . $product->prize . " CHF total: " . $product->total_prize . " CHF" ?>
                    <form action="/order/updateAmount" method="post">
                        <input type="hidden" name="id" value="<?= $product->order_id ?>" />
                        <input type="number" name="amount" min="1" value="<?= $product->amount ?>">
                        <button class="checkoutButton" type="submit">Update Amount</button>
                    </form>
                    <form action="/order/removeItem" method="post">
                        <input type="hidden" name="id" value="<?= $product->order_id ?>" />
                        <input type="hidden" name="amount" value="<?= $product->amount ?>" />
                        <button class="checkoutButton" type="submit">remove</button>
                    </form>
                </li>
            <?php endforeach; ?>
            <form action="/product/payForm" method="post">
                <button class="checkoutButton" type="submit">Pay</button>
            </form>
        </ul>
    <?php endif; ?>

</section>