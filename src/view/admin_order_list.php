<section class="admin">

    <h3><?=_ADMIN_ORDERLIST?></h3>

    <div class="h3__hr">
        <div class="h3__hr__line"></div>
        <div class="h3__hr__circle"></div>
        <div class="h3__hr__line"></div>
    </div>

    <ul class="admin__list">
        <?php foreach ($orders as $order) : ?>
            <li><?= $order->ID?></li>
        <?php endforeach; ?>
    </ul>

    <a href="/admin">
        <div class="admin__return">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </div>
    </a>

</section>
