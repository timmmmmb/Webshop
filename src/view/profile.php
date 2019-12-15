<section class="profile">
    <div class="profile__name"><?= $user->Name ?></div>
    <div class="h3__hr">
        <div class="h3__hr__line"></div>
        <div class="h3__hr__circle"></div>
        <div class="h3__hr__line"></div>
    </div>
    <h3 class="profile__h3">Email</h3>
    <div class="profile__section">
        <form id="formEditEmail" method="POST" data-url="<?=_ROOT.$_SESSION['lang']['name']?>/user/doEdit">
            <input type="text" class="profile__section__email" name="email" value="<?= $user->EMail ?>"/>
            <i class="fa fa-pencil" aria-hidden="true"></i><br>
            <button type="submit" class="profile__section__submit" disabled><?=_SAVE?></button>
        </form>
    </div>
</section>