<section class="profile">
    <div class="profile__name"><?= $user->Name ?></div>
    <div class="h3__hr">
        <div class="h3__hr__line"></div>
        <div class="h3__hr__circle"></div>
        <div class="h3__hr__line"></div>
    </div>
    <h3 class="profile__h3"><?=_ORDERS_TITLE?></h3>
    <?php if (empty($orders)): ?>
        <div class="basket__empty basket__empty--profile">
            <div class="basket__empty__icon">
                <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
            </div>
            <p><?=_ORDERS_EMPTY?></p>
        </div>
    <?php else: ?>
        <ul class="checkout__products checkout__products--profile">
            <?php foreach ($orders as $product): ?>
            <li>
                <div class="checkout__products__img">
                    <a href="<?=_ROOT.$_SESSION['lang']['name']?>/product?product_id=<?= $product->ID ?>">
                        <div style="background-image: url('<?=_ROOT?>src/view/images/<?= $product->image; ?>');"></div> 
                    </a>
                </div>
                <div class="checkout__products__desc">
                    <span>
                        <?=$product->amount." x ".$product->{'name_'.$_SESSION['lang']['name']}?>
                        <span class="checkout__products__desc__separator"></span>
                        <?=$product->{'color_'.$_SESSION['lang']['name']}?>
                        <span class="checkout__products__desc__separator"></span>
                        <?=$product->{'size_'.$_SESSION['lang']['name']}?>
                    </span>
                    <span>CHF <?=$product->total_prize ?></span>
                </div>
            </li>
            <?php endforeach ?>
            <li></li>
        </ul>
    <?php endif; ?>
    <h3 class="profile__h3">Email</h3>
    <div class="profile__section">
        <form id="formEditEmail" method="POST" data-url="<?=_ROOT.$_SESSION['lang']['name']?>/user/doEdit">
            <input type="text" class="profile__section__email" name="email" value="<?= $user->EMail ?>"/>
            <i class="fa fa-pencil" aria-hidden="true"></i><br>
            <button type="submit" class="profile__section__submit" disabled><?=_SAVE?></button>
        </form>
    </div>
</section>