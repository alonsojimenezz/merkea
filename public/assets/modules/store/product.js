import Events from '../shared/Events.js';
import Buttons from '../shared/Buttons.js';
import Utils from '../shared/Utils.js';

$(function() {
    const event = new Events();
    const button = new Buttons();
    const utils = new Utils();

    button.initClick(".qtybutton", function(btn) {
        const q = $("#product_quantity");
        let v = (q.data("granel") == 1) ? 0.05 : 1;
        const base = v;
        v = (btn.hasClass("inc")) ? v : -v;
        let newval = parseFloat(q.val()) + v;
        newval = (newval > parseFloat(q.data("max"))) ? parseFloat(q.data("max")) : ((newval < base) ? base : newval);
        q.val(newval.toFixed(2));
    });

    $("#product_quantity").on("blur", function(e) {
        const q = $("#product_quantity");
        const base = (q.data("granel") == 1) ? 0.05 : 1;
        let newval = parseFloat(q.val());
        newval = (newval > parseFloat(q.data("max"))) ? parseFloat(q.data("max")) : ((newval < base) ? base : newval);
        q.val(newval.toFixed(2));
    });

    // $(".qtybutton").on("click", function() {
    //     let $button = $(this);
    //     let element = $button.parent().find("input");
    //     let oldValue = $button.parent().find("input").val();
    //     let newVal = 1;
    //     if ($button.text() == "+") {
    //         newVal = parseFloat(oldValue) + 1;
    //         newVal = (newVal > element.data("max")) ? element.data("max") : newVal;
    //     } else {
    //         newVal = parseFloat(oldValue) - 1;
    //         newVal = (newVal < 1) ? 1 : newVal;
    //     }
    //     $button.parent().find("input").val(newVal);
    // });

});