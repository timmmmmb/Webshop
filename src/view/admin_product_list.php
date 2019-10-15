<section class="admin">

    <h3><?=_ADMIN_PRODUCTLIST?></h3>

    <div class="basket__hr">
        <div class="basket__hr__line"></div>
        <div class="basket__hr__circle"></div>
        <div class="basket__hr__line"></div>
    </div>

    <ul class="admin__list">
        <?php foreach ($products as $product) : ?>
            <li><?= $product->Name?></li>
        <?php endforeach; ?>
    </ul>
        
    <a href="/admin">
        <div class="admin__return">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </div>
    </a>
   
</section>