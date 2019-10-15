<section class="form form--register">
    <div class="form__container">

        <h3><?=_REGISTER_TITLE?></h3>
        <form id="formRegister" method="post">

            <input type="text" class="form__container__input" placeholder="<?=_REGISTER_USERNAME?>" name="name" required>
            <input type="email" class="form__container__input" placeholder="<?=_REGISTER_EMAIL?>" name="email" required>
            <input type="password" class="form__container__input" placeholder="<?=_REGISTER_PASSWORD?>" name="psw" required>
            <input type="password" class="form__container__input" placeholder="<?=_REGISTER_REPEAT_PASSWORD?>" name="psw-repeat" required>
            <div class="form__container__error" hidden><?=_REGISTER_ERROR?></div>

            <span class="form__container__buttons">
                <button type="reset" class="form__container__buttons__reset"><?=_REGISTER_RESET?></button>
                <button type="submit" class="form__container__buttons__submit"><?=_REGISTER_REGISTER?></button>
            </span>

            <p class="form__container__hint"><?=_REGISTER_ALLREADY_ACCOUNT?><a href="/user/login"><?=_REGISTER_LOGIN?></a>.</p>
        
        </form>
    </div>
</section>