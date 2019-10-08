<section class="basket">
    <h2>Warenkorb</h2>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?= $product->amount." ".$product->color." ".$product->name." ".$product->size." Preis: ".$product->prize." CHF total: ".$product->total_prize." CHF"?>
                <form action="/order/removeItem" method="post">
                    <input type="hidden" name="id" value="<?= $product->order_id ?>" />
                    <button type="submit">remove</button>
                </form>
                <form action="/order/updateAmount" method="post">
                    <input type="hidden" name="id" value="<?= $product->order_id ?>" />
                    <input type="number" name="amount" min="1" value="<?= $product->amount ?>">
                    <button type="submit">Update Amount</button>
                </form>
            </li>
        <?php endforeach ?>
        <?php if (isset($basketisempty)&&!$basketisempty) : ?>
            <form action="/product/payForm" method="post">
                <button type="submit">Pay</button>
            </form>
        <?php endif; ?>

    </ul>
</section>