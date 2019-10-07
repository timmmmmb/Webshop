<section class="basket">
    <h2>Warenkorb</h2>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?= $product->amount." ".$product->color." ".$product->name." ".$product->size." Preis: ".$product->prize." CHF total: ".$product->total_prize." CHF"?>
                <form action="/product/removeItem" method="post">
                    <input type="hidden" name="product_id" value="<?= $product->ID ?>" />
                    <button type="submit">remove</button>
                </form>
            </li>
        <?php endforeach ?>
        <form action="/product/payForm" method="post">
            <button type="submit">Pay</button>
        </form>
    </ul>
</section>