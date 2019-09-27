<section class="form form--login">
    <div class="form__container">

        <h3>Login</h3>
        <form action="/user/doLogin" method="post">

            <input type="text" class="form__container__input" placeholder="Username" maxlength="250" name="name" required>
            <input type="password" class="form__container__input" placeholder="Password" maxlength="250" name="psw" required>

            <span class="form__container__buttons">
                <button type="reset" class="form__container__button form__container__button--reset">Reset</button>
                <button type="submit" class="form__container__button form__container__button--submit">Login</button>
            </span>

        </form>
    </div>
</section>