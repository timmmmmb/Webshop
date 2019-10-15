<section class="admin">
    <h3><?=_ADMIN_USERLIST?></h3>
    <hr class="admin__hr">
    <ul class="admin_list">
        <?php foreach ($users as $user) : ?>
            <li><?= $user->Name . " " . $user->email . " " . $user->Type ?></li>
        <?php endforeach; ?>
    </ul>
    <ul class="admin__nav__ul">
        <li class="admin__nav_item">
            <a href="/admin">
                <div class="admin__nav__back__icon">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </div>
            </a>
        </li>
    </ul>
</section>
