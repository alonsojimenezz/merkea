import Events from '../shared/Events.js';
import Buttons from '../shared/Buttons.js';
import Utils from '../shared/Utils.js';

$(function() {
    const event = new Events();
    const button = new Buttons();
    const utils = new Utils();

    button.initClick(".remove_from_cart_c", function(btn) {
        let data = {
            'pid': btn.data("pid")
        };

        event.post('/api_v1/store/remove_from_cart', data, function(r) {
            if (r.code == 200) {
                window.location.reload();
            } else {
                alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                event.hideLoading();
            }
        }, null, false);
    });

    button.initClick(".qtybutton", function(btn) {
        const q = btn.parent().find(".product_quantity");
        let v = (q.data("granel") == 1) ? 0.05 : 1;
        const base = v;
        v = (btn.hasClass("inc")) ? v : -v;
        let newval = parseFloat(q.val()) + v;
        newval = (newval > parseFloat(q.data("max"))) ? parseFloat(q.data("max")) : ((newval < base) ? base : newval);

        $(".product_quantity_" + q.data('pid')).val(newval.toFixed(q.data('granel') == 1 ? 2 : 0));

        let subtotal = parseFloat(q.val()) * parseFloat(q.data('unitprice'));
        $(".product-subtotal-" + q.data('pid')).empty().append(utils.formatMoney(subtotal));
        updateCartTotals();
    });

    $(".product_quantity").on("blur", function(e) {
        const q = $(this);
        const base = (q.data("granel") == 1) ? 0.05 : 1;
        let newval = parseFloat(q.val());
        newval = (newval > parseFloat(q.data("max"))) ? parseFloat(q.data("max")) : ((newval < base) ? base : newval);
        q.val(newval);

        let subtotal = parseFloat(newval) * parseFloat(q.data('unitprice'));
        $(".product-subtotal-" + q.data('pid')).empty().append(utils.formatMoney(subtotal));
        updateCartTotals();
    });


    // $(".inc.qtybutton, .dec.qtybutton").on("click", function() {
    //     const btn = $(this);
    //     const inputControl = btn.parent('.cart-plus-minus').find('.product_quantity');
    //     let subtotal = parseFloat(inputControl.val()) * parseFloat(inputControl.data('unitprice'));
    //     $(".product-subtotal-" + inputControl.data('pid')).empty().append(utils.formatMoney(subtotal));

    //     updateCartTotals();
    // });

    function updateCartTotals() {
        let subtotal = 0;
        let needUpdate = false;
        $(".product_quantity").not(".product_quantity_small_screen").each(function() {
            let q = $(this);
            subtotal += parseFloat(q.val()) * parseFloat(q.data('unitprice'));
            if (q.data('original') != q.val()) {
                needUpdate = true;
            }
        });

        $(".subtotal_cart, .total_cart").empty().append(utils.formatMoney(subtotal));

        if (needUpdate) {
            $("#update_cart").removeClass("d-none");
            $("#order_now_button").addClass("d-none");
        } else {
            $("#update_cart").addClass("d-none");
            $("#order_now_button").removeClass("d-none");
        }
    }

    button.initClick("#update_cart", function(btn) {
        let data = {
            'items': []
        };
        $(".product_quantity").not(".product_quantity_small_screen").each(function() {
            let q = $(this);
            data.items.push({
                'pid': q.data('pid'),
                'quantity': q.val()
            });
        });

        event.post('/api_v1/store/update_cart', data, function(r) {
            if (r.code == 200) {
                window.location.reload();
            } else {
                alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                event.hideLoading();
            }
        }, null, false);
    });


});