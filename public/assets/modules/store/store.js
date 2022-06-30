import Events from '../shared/Events.js';
import Buttons from '../shared/Buttons.js';
import Utils from '../shared/Utils.js';
import Alerts from '../shared/Alerts.js';

$(function() {
    const event = new Events();
    const button = new Buttons();
    const utils = new Utils();
    const alerts = new Alerts();

    adjustHeight();
    initRemoveFromCart();
    initEmptyCart();

    button.initClick("#search_button", function(btn) {
        let search = utils.trim("#search_text");
        let department = $("#search_department option:selected").val();
        event.showLoading();
        window.location.href = '/search?query=' + search + '&department=' + department;
    });

    button.initClick("#search_button_m", function(btn) {
        let search = utils.trim("#search_text_m");
        event.showLoading();
        window.location.href = '/search?query=' + search;
    });

    button.initClick(".header_branch_select", function(btn) {
        event.post('/api_v1/store/change_branch', {
            branch: btn.data("branch")
        }, function(r) {
            if (r.code == 200) {
                window.location.reload();
            } else {
                alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                event.hideLoading();
            }
        }, null, false);
    });

    function adjustHeight() {
        let bottom = $('.footer__copyright').offset().top + $('.footer__copyright').height();
        $(".body-overlay").height(bottom);
    }

    button.initClick(".add_to_cart", function(btn) {
        let data = {
            'pid': btn.data("pid"),
            'quantity': $("#product_quantity").length ? $("#product_quantity").val() : 1
        };

        event.post('/api_v1/store/add_to_cart', data, function(r) {
            if (r.code == 200) {
                if ($("#product_quantity").length) {
                    window.location.reload();
                } else {
                    $(".cart__mini-wrapper").empty().append(r.body.view);
                    initCartToggle();
                    btn.parent(".product__add-btn").empty().append(r.body.button);
                }
            } else {
                alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                event.hideLoading();
            }
        }, null, false);

    });

    function initRemoveFromCart() {
        button.initClick(".remove_from_cart", function(btn) {
            let data = {
                'pid': btn.data("pid")
            };

            event.post('/api_v1/store/remove_from_cart', data, function(r) {
                if (r.code == 200) {
                    if ($("#product_quantity").length) {
                        window.location.reload();
                    } else {
                        $(".cart__mini-wrapper").empty().append(r.body.view);
                        initCartToggle(false);
                    }
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                    event.hideLoading();
                }
            }, null, false);

        });
    }

    function initCartToggle(add = true) {
        $(".cart__toggle").on("click", function() {
            $(".cart__mini").addClass("cart__opened");
            if (cartToggleStatus === false) {
                $(".cart__toggle").addClass("cart__toggle-open");

                cartToggleStatus = true;
            } else if (cartToggleStatus === true) {
                $(".cart__toggle").removeClass("cart__toggle-open");
                $(".cart__mini").removeClass("cart__opened");

                cartToggleStatus = false;
            }
        });
        $(".cart__close-btn").on("click", function() {
            $(".cart__mini").removeClass("cart__opened");
            $(".cart__toggle").removeClass("cart__toggle-open");
            cartToggleStatus = false;
        });

        initRemoveFromCart();
        initEmptyCart();
        event.hideLoading();

        if (add) {
            alerts.fire_toast("Producto agregado", "", "Ahora puedes ver tu producto en el carrito de compra");
        } else {
            alerts.fire_toast("Producto eliminado", "", "Tu producto ha sido eliminado del carrito de compra");
        }
    }

    function initEmptyCart() {
        button.initClick(".empty_cart_button", function(btn) {
            event.post('/api_v1/store/empty_cart', {}, function(r) {
                if (r.code == 200) {
                    window.location.reload();
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                    event.hideLoading();
                }
            }, null, false);
        });
    }


});