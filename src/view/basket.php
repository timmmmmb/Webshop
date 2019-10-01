<h1>
    Warenkorb
</h1>
<ul>
    <?php foreach ($products as $product): ?>
        <li><?= $product->amount." ".$product->color." ".$product->name." ".$product->size." Preis: ".$product->prize." CHF total: ".$product->total_prize." CHF"?></li>
    <?php endforeach ?>
    <form action="/product/payForm" method="post">
        <button type="submit">Pay</button>
    </form>
</ul>
