<section class="admin">

    <h3><?=_ADMIN_PRODUCTLIST?></h3>

    <div class="h3__hr">
        <div class="h3__hr__line"></div>
        <div class="h3__hr__circle"></div>
        <div class="h3__hr__line"></div>
    </div>

    <ul class="admin__list">
        <?php foreach ($products as $product) : ?>
            <li><?= $product->{'Name_'.strtoupper($_SESSION['lang']['name'])}?></li>
        <?php endforeach; ?>
    </ul>
        
    <a href="<?=_ROOT?>admin">
        <div class="admin__return">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </div>
    </a>
   
</section>