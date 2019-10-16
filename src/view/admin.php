<section class="admin">

    <h3><?=_ADMIN_TITLE?></h3>

    <div class="basket__hr">
        <div class="basket__hr__line"></div>
        <div class="basket__hr__circle"></div>
        <div class="basket__hr__line"></div>
    </div>
    
    <nav>
        <ul>
            <li>
                <a href="/<?=$_SESSION['lang']['name']?>/admin/user">
                    <div class="basket__empty__icon">
                        <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
                    </div>
                    <span><?=_ADMIN_USERLIST?></span>
                </a>
            </li>
            <li>
                <a href="/<?=$_SESSION['lang']['name']?>/admin/product">
                    <div class="basket__empty__icon">
                        <i class="fa fa-list fa-2x" aria-hidden="true"></i>
                    </div>
                    <span><?=_ADMIN_PRODUCTLIST?></span>
                </a>
            </li>
            <li>
                <a href="/<?=$_SESSION['lang']['name']?>/admin/order">
                    <div class="basket__empty__icon">
                        <i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i>
                    </div>
                    <span><?=_ADMIN_ORDERLIST?></span>
                </a>
            </li>
        </ul>
    </nav>
    
</section>