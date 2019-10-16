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

    //Login submit
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
            url: $(this).attr("data-url"),
            data: $(this).serialize(),
            success: function(data)
            {
                data = JSON.parse(data);
                if(data.status === "success") {
                   window.location = data.href;
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

    //product_detail, choose color
    $(".product__view__colors__radio").click(function() {
        let selected = "product__view__colors__radio--selected";
        $(".product__view__colors__radio").removeClass(selected);
        $(this).addClass(selected);
        $("#productColor").val($(this).attr("data-color-id"));
    });
    $(".product__view__colors__radio:first-child").click();

    //Add to basket submit
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

    //Basket change amount of product
    $(".basket__item__right__number").bind('keyup mouseup', function () {
        $(this).closest("form").submit();        
    });

});