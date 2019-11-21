jQuery(document).ready(function($) {

    //------------------------
    //  STICKY HEADER
    //------------------------
    function stickyHeader() {
        let scrollTop = $(window).scrollTop();
        let header = $("h1");
        let headerSquare = $(".header__menu__line__square");

        if(scrollTop >= 50) {
            header.slideUp();
            headerSquare.addClass("header__menu__line__square--shrink");
        } else {
            header.slideDown();
            headerSquare.removeClass("header__menu__line__square--shrink");
        }
    };
    $(window).scroll(stickyHeader);
    stickyHeader();

    //------------------------
    //  LOGIN SUBMIT
    //------------------------
    $("#formLogin").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("data-url"),
            data: $(this).serialize(),
            success: function(data)
            {
                data = JSON.parse(data);
                if(data.status === "success") {
                    window.location = data.href;
                } else {
                    showLoginErrorMessage(data.error);
                }
            }
        });
    });

    //------------------------
    //  REGISTER SUBMIT
    //------------------------
    $("#formRegister").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("data-url"),
            data: $(this).serialize(),
            success: function(data)
            {
                data = JSON.parse(data);
                if(data.status === "success") {
                   window.location = data.href;
                } else {
                   showLoginErrorMessage(data.error);
                }
            }
        });
    });

    //------------------------
    //  DISPLAY ERROR
    //------------------------
    let showLoginErrorMessage = function(message) {
        let errorDisplayDuration = 5000;
        let loginInput = $(".form__container__input");
        let loginInputErrorClass = "form__container__input--error";
        let loginErrorMsg = $(".form__container__error");
        loginErrorMsg.text(message);
        loginErrorMsg.slideDown(); 
        loginInput.addClass(loginInputErrorClass);
        setTimeout(() => {
            loginInput.removeClass(loginInputErrorClass);
            loginErrorMsg.slideUp();
        }, errorDisplayDuration);
    };

    //--------------------------------------
    //  CHOOSE COLOR (product_detail.php)
    //--------------------------------------
    $(".product__view__colors__radio").click(function() {
        let selected = "product__view__colors__radio--selected";
        $(".product__view__colors__radio").removeClass(selected);
        $(this).addClass(selected);
        $("#productColor").val($(this).attr("data-color-id"));
    });
    $(".product__view__colors__radio:first-child").click();

    //----------------------------
    //  ADD TO BASKET SUBMIT
    //----------------------------
    $("#formAddBasket").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('data-url'),
            data: $(this).serialize(),
            success: function(data)
            {
                $("#orderCount").text(data);
                let cartIcon = ".header__icons__item--cart";
                $(cartIcon).css("animation-name", "header__icons__item--beat");
                setTimeout(function() {
                    $(cartIcon).css("animation-name", "none");
                }, 1000)
            }
        });
    });

    //---------------------------
    //  BASKET CHANGE AMOUNT
    //---------------------------
    $(".basket__item__right__number").bind('keyup mouseup', function () {
        $(this).closest("form").submit();        
    });

    //------------------------
    //  INPUT VALIDATION
    //------------------------
    $(".input--validate-me").on('input', function(e) {
        var format = /[!#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]/;
        $(this).val($(this).val().replace(format, ''));
    });

    //------------------------
    //  PAY BASKET SUBMIT
    //------------------------
    $("#formProductPay").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('data-url'),
            data: $(this).serialize(),
            success: function(data)
            {
                data = JSON.parse(data);
                if(data.status === "success") {
                   window.location = data.href;
                } else {
                    showCheckoutErrorMessage(data.error);
                }
            }
        });
    });

    let showCheckoutErrorMessage = function(message) {
        let errorDiv = $(".checkout__form__error");
        let errorDisplayDuration = 5000;
        errorDiv.text(message);
        errorDiv.slideDown();
        setTimeout(() => errorDiv.slideUp(), errorDisplayDuration);
    }

});