<section class="admin">

    <h3><?=_ADMIN_USERLIST?></h3>

    <div class="basket__hr">
        <div class="basket__hr__line"></div>
        <div class="basket__hr__circle"></div>
        <div class="basket__hr__line"></div>
    </div>

    <ul class="admin__list">
        <?php foreach ($users as $user) : ?>
            <li><?= $user->Name . " " . $user->email . " " . $user->Type ?></li>
        <?php endforeach; ?>
    </ul>
      
    <a href="/admin">
        <div class="admin__return">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </div>
    </a>
        
</section>
