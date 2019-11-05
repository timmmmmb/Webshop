<section class="form form--login">
    <div class="form__container">

        <h3><?=_LOGIN_TITLE?></h3>
        <form id="formLogin" method="post" data-url="/<?=$_SESSION['lang']['name']?>/user/doLogin">

            <input type="text" class="form__container__input input--validate-me" placeholder="<?=_LOGIN_USERNAME?>" maxlength="250" name="name" required>
            <input type="password" class="form__container__input" placeholder="<?=_LOGIN_PASSWORD?>" maxlength="250" name="psw" required>
            <div class="form__container__error" hidden><?=_LOGIN_ERROR?></div>

            <span class="form__container__buttons">
                <button type="reset" class="form__container__buttons__reset"><?=_LOGIN_RESET?></button>
                <button type="submit" class="form__container__buttons__submit"><?=_LOGIN_LOGIN?></button>
            </span>

            <p class="form__container__hint">
                <?=_LOGIN_NO_ACCOUNT?><a href="/<?=$_SESSION['lang']['name']?>/user/register"> <?=_LOGIN_REGISTER?></a>.
            </p>

        </form>
    </div>
</section>