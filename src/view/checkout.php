<section class="checkout">
    
    <h3>Checkout</h3>
    <div class="basket__hr">
        <div class="basket__hr__line"></div>
        <div class="basket__hr__circle"></div>
        <div class="basket__hr__line"></div>
    </div>

    
    <?php $total_prize = 0?>
    <?php foreach ($products as $product): ?>
        <li><?= $product->amount." ".$product->color." ".$product->name." ".$product->size." Preis: ".$product->prize." CHF total: ".$product->total_prize." CHF"?></li>
        <?php $total_prize += $product->total_prize?>
    <?php endforeach ?>
    <li>TOTAL: <?= $total_prize?></li>


    <form action="/product/pay" method="post">
              
        <h4>Shipping Address</h4>
        <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
        <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
        <label for="city"><i class="fa fa-institution"></i> City</label>
        <input type="text" id="city" name="city" placeholder="New York">

        <div>
            <div>
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
            </div>
            <div>
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
            </div>
        </div>
                
        <h4>Payment</h4>
        <label for="fname">Accepted Cards</label>
        <div class="icon-container">
            <i class="fa fa-cc-visa" style="color:navy;"></i>
            <i class="fa fa-cc-amex" style="color:blue;"></i>
            <i class="fa fa-cc-mastercard" style="color:red;"></i>
            <i class="fa fa-cc-discover" style="color:orange;"></i>
        </div>
        <label for="cname">Name on Card</label>
        <input type="text" id="cname" name="cardname" placeholder="John More Doe">
        <label for="ccnum">Credit card number</label>
        <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
        <label for="expmonth">Exp Month</label>
        <input type="text" id="expmonth" name="expmonth" placeholder="September">

        <div class="row">
            <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
            </div>
            <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
            </div>
        </div>
                    
        <button type="submit">Pay</button>

    </form>
</section>