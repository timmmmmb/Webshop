<section class="form form--register">
    <div class="form__container">
        <h3>Register</h3>
        <form method="post" action="/user/registerSubmit">

            <input type="text" class="form__container__input form__container__input--text" placeholder="Username" name="name" required>
            <input type="email" class="form__container__input form__container__input--text" placeholder="Email" name="email" required>
            <input type="password" class="form__container__input form__container__input--text" placeholder="Password" name="psw" required>
            <input type="password" class="form__container__input form__container__input--text" placeholder="Repeat Password" name="psw-repeat" required>

            <span class="form__buttons">
                <button class="button--back">Back</button>
                <button type="submit" class="button--submit">Register</button>
            </span>
            <p>Already have an account? <a href="#">Sign in</a>.</p>
        
        </form>
    </div>
</section>