<section class="form form--login">
    <div class="form__container">

        <h3>Login</h3>
        <form id="formLogin" method="post">

            <input type="text" class="form__container__input" placeholder="Username" maxlength="250" name="name" required>
            <input type="password" class="form__container__input" placeholder="Password" maxlength="250" name="psw" required>
            <div class="form__container__error" hidden>Login incorrect</div>

            <span class="form__container__buttons">
                <button type="reset" class="form__container__buttons__reset">Reset</button>
                <button type="submit" class="form__container__buttons__submit">Login</button>
            </span>

            <p class="form__container__hint">Don't have an account? <a href="/user/register">Register here</a>.</p>

        </form>
    </div>
</section>