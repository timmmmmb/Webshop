jQuery(document).ready(function($) {

    //Sticky Header
    function stickyHeader() {
        let scrollTop = $(window).scrollTop();
        let header = $("h1");
        let headerSquare = $(".header__line__square");

        if(scrollTop >= 50) {
            header.slideUp();
            headerSquare.addClass("header__line__square--shrink");
        } else {
            header.slideDown();
            headerSquare.removeClass("header__line__square--shrink");
        }
    };
    $(window).scroll(stickyHeader);
    stickyHeader();

    //Banner scroll effect
    $('.banner').parallax({
        imageSrc: '/src/view/images/banner1.jpg',
        speed: 0.5
    });

    //Login submit
    $("#formLogin").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/user/doLogin',
            data: $(this).serialize(),
            success: function(data)
            {
               if(data === 'login__success') {
                   window.location = "/";
               } else {
                    showErrorMessage("Login incorrect");
               }
            }
        });
    });

    //Register submit
    $("#formRegister").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/user/doRegister',
            data: $(this).serialize(),
            success: function(data)
            {
               if(data === 'login__success') {
                   window.location = "/";
               } else {
                   showErrorMessage("User already exists");
               }
            }
        });
    });

    //Show error div in form
    let showErrorMessage = function(message) {

        let loginInput = $(".form__container__input");
        let loginInputErrorClass = "form__container__input--error";
        let loginErrorMsg = $(".form__container__error");
        loginErrorMsg.innerText = message;
        loginErrorMsg.slideDown(); 
        loginInput.addClass(loginInputErrorClass);
        setTimeout(() => {
            loginInput.removeClass(loginInputErrorClass);
            loginErrorMsg.slideUp();
        }, 2000);
    };

});