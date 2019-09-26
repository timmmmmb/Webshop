<section class="form form--register">
    <div class="form__container">

        <h3>Register</h3>
        <form action="/user/doRegister" method="post">

            <input type="text" class="form__container__input" placeholder="Username" name="name" required>
            <input type="email" class="form__container__input" placeholder="Email" name="email" required>
            <input type="password" class="form__container__input" placeholder="Password" name="psw" required>
            <input type="password" class="form__container__input" placeholder="Repeat Password" name="psw-repeat" required>

            <span class="form__container__buttons">
                <button type="reset" class="form__container__button form__container__button--reset">Reset</button>
                <button type="submit" class="form__container__button form__container__button--submit">Register</button>
            </span>

            <p class="form__container__hint">Already have an account? <a href="/user/login">Sign in</a>.</p>
        
        </form>
    </div>
</section>