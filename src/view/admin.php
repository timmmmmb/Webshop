<section class="admin">
    <div class="admin__box">
        <h3><?=_ADMIN_TITLE?></h3>
        <hr class="admin__hr">

        <div class="admin__nav">
            <nav>
                <ul class="admin__nav__ul">
                    <li class="admin__nav_item">
                        <a href="/admin/user">
                        <div class="basket__empty__icon">
                            <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
                        </div>
                        <?=_ADMIN_USERLIST?>></a>
                    </li>
                    <li class="admin__nav_item">
                        <a href="/admin/product">
                        <div class="basket__empty__icon">
                            <i class="fa fa-list fa-2x" aria-hidden="true"></i>
                        </div>
                            <?=_ADMIN_PRODUCTLIST?></a>
                    </li>
                    <li class="admin__nav_item">
                        <a href="/admin/order">
                        <div class="basket__empty__icon">
                            <i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i>
                        </div>
                            <?=_ADMIN_ORDERLIST?></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>