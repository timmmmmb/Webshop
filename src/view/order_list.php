<section class="admin">
    <h3>Order list</h3>
    <hr class="admin__hr">
    <ul class="admin_list">
        <?php foreach ($orders as $order) : ?>
            <li><?= $order->ID?></li>
        <?php endforeach; ?>
    </ul>
    <ul class="admin__nav__ul">
        <li class="admin__nav_item">
            <a href="/admin">
                <div class="admin__nav__back__icon">
                    <img src="/src/view/images/back.svg" alt="Empty">
                </div>
            </a>
        </li>
    </ul>
</section>
