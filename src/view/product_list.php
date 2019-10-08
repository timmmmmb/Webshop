<section class="admin__products">
    <ul>
        <?php foreach ($products as $product) : ?>
            <li><?= $product->Name?></li>
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