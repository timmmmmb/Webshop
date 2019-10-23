<section class="checkout">
    
    <h3><?=_CHECKOUT_TITLE?></h3>
    <div class="h3__hr">
        <div class="h3__hr__line"></div>
        <div class="h3__hr__circle"></div>
        <div class="h3__hr__line"></div>
    </div>

    <?php $total_prize = 0?>
    <ul class="checkout__products">
        <?php foreach ($products as $product): ?>
        <li>
            <div class="checkout__products__img">
                <a href="/<?=$_SESSION['lang']['name']?>/product?product_id=<?= $product->ID ?>">
                    <div style="background-image: url('/src/view/images/<?= $product->image; ?>');"></div> 
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
        <?php $total_prize += $product->total_prize ?>
        <?php endforeach ?>
        <li class="checkout__products__total">
            <i>Total</i>
            <span>CHF <?=number_format((float)$total_prize, 2, '.', '');?></span>
        </li>
    </ul>

    <div class="h3__hr">
        <div class="h3__hr__line"></div>
        <div class="h3__hr__circle"></div>
        <div class="h3__hr__line"></div>
    </div>
    
    <form action="/<?=$_SESSION['lang']['name']?>/product/pay" class="checkout__form" method="post">
              
        <h4><?=_CHECKOUT_SHIPPING?></h4>
        <div class="checkout__form__section">
            <input type="text" name="address_street" placeholder="<?=_CHECKOUT_ADDRESS_STREET?>" required>
            <input type="text" name="address_plz" placeholder="<?=_CHECKOUT_ADDRESS_POSTCODE?>" required>
            <input type="text" name="address_place" placeholder="<?=_CHECKOUT_ADDRESS_STATE?>" required>
        </div>
   
        <h4><?=_CHECKOUT_PAYMENT?></h4>
        <div class="checkout__form__section checkout__form__section--cards">
            <i class="fa fa-cc-visa fa-2x" style="color:navy;"></i>
            <i class="fa fa-cc-amex fa-2x" style="color:blue;"></i>
            <i class="fa fa-cc-paypal fa-2x" style="color:deepskyblue;"></i>
            <i class="fa fa-cc-mastercard fa-2x" style="color:red;"></i>
            <i class="fa fa-cc-discover fa-2x" style="color:orange;"></i>
        </div>

        <div class="checkout__form__section checkout__form__section--wrap2">
            <input type="text" name="card_name" placeholder="<?=_CHECKOUT_CARD_NAME?>" required>
            <input type="text" name="card_number" placeholder="<?=_CHECKOUT_CARD_NUMBER?>" required>
            <input type="text" name="card_cvv" placeholder="<?=_CHECKOUT_CARD_CVV?>" required>
            <input type="text" name="card_exp" placeholder="<?=_CHECKOUT_CARD_EXPDATE?>" required>
        </div>
     
        <div class="h3__hr">
            <div class="h3__hr__line"></div>
            <div class="h3__hr__circle"></div>
            <div class="h3__hr__line"></div>
        </div>

        <button type="submit" class="checkout__form__submit"><?=_CHECKOUT_BUY?></button>

    </form>
</section>