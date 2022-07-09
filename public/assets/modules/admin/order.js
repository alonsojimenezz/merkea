import Events from '../shared/Events.js';
import DTables from '../shared/Tables.js';
import Buttons from '../shared/Buttons.js';
import Alerts from '../shared/Alerts.js';
import Selects from '../shared/Selects.js';
import Utils from '../shared/Utils.js';

$(function() {
    const event = new Events();
    const table = new DTables();
    const button = new Buttons();
    const alerts = new Alerts();
    const select = new Selects();
    const utils = new Utils();

    initOrderStatus();
    initSearchProduct();

    button.initClick(".order_product", function(btn) {
        const id = $(btn).data("id");
        event.post("/api_v1/order_items/" + id, {
            _method: "GET"
        }, function(r) {
            setEditProduct(r.body.item);
            initDeleteProduct(r.body.item);
            initModifyProductQuantity(r.body.item);
            $("#modal_edit_product").modal("show");
        });
    });

    function setEditProduct(item) {
        let price = "$" + (parseFloat(item.BasePrice) - parseFloat(item.Discount)).toFixed(2);
        price += " x " + item.UnitName.toLowerCase();

        $("#edit_product_image").attr("src", item.Image);
        $("#edit_product_name").empty().append(item.ProductName);
        $("#edit_product_key").empty().append(item.Key);
        $("#edit_product_quantity").val(item.Quantity);
        $("#edit_product_price").empty().append(price);

        changeQuantityControls(item);

    }

    function changeQuantityControls(item) {
        let q = $("#edit_product_quantity");
        let v = (item.Granel == 1) ? 0.05 : 1;
        const base = v;
        let newval = 0;

        $("#plus_button").off("click");
        $("#plus_button").on("click", function() {
            newval = parseFloat(q.val()) + v;
            newval = (newval > parseFloat(item.Stock.Quantity)) ? parseFloat(item.Stock.Quantity) : ((newval < base) ? base : newval);
            q.val((item.Granel == 1) ? newval.toFixed(2) : newval);
        });

        $("#minus_button").off("click");
        $("#minus_button").on("click", function() {
            newval = parseFloat(q.val()) - v;
            newval = (newval > parseFloat(item.Stock.Quantity)) ? parseFloat(item.Stock.Quantity) : ((newval < base) ? base : newval);
            q.val((item.Granel == 1) ? newval.toFixed(2) : newval);
        });

        q.off("blur");
        q.on("blur", function(e) {
            newval = parseFloat(q.val());
            newval = (newval > parseFloat(item.Stock.Quantity)) ? parseFloat(item.Stock.Quantity) : ((newval < base) ? base : newval);
            q.val((item.Granel == 1) ? newval.toFixed(2) : newval);
        });

        $("#edit_product_quantity").off('input');
        $("#edit_product_quantity").on('input', function(e) {
            if (item.Granel == 1) {
                $(this).val($(this).val().replace(/[^0-9.]/g, ''));
            } else {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            }
        });
    }

    function initDeleteProduct(item) {
        $("#delete_product_order").off("click");
        $("#delete_product_order").on("click", function() {
            event.post("/api_v1/order_items/" + item.Id, {
                _method: "DELETE"
            }, function(r) {
                if (r.code == 200) {
                    window.location.reload();
                } else {
                    console.log(r);
                }
            }, null, false);
        });
    }

    function initModifyProductQuantity(item) {
        $("#save_product_changes").off("click");
        $("#save_product_changes").on("click", function() {

            let quantity = $("#edit_product_quantity").val();

            event.post("/api_v1/order_items/" + item.Id, {
                quantity: quantity,
                _method: "PUT"
            }, function(r) {
                if (r.code == 200) {
                    window.location.reload();
                } else {
                    event.hideLoading();
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            }, null, false);
        });
    }

    function initOrderStatus() {
        button.initClick(".status_order_change", function(btn) {
            let data = {
                id: $(btn).data("order"),
                status: $(btn).data("status")
            };
            event.post("/api_v1/order/status", data, function(r) {
                if (r.code == 200) {
                    window.location.reload();
                } else {
                    event.hideLoading();
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            }, null, false);
        });
    }

    function initSearchProduct() {
        $("#search_product_text").on('keypress', function(e) {
            if (e.which == 13) {
                searchProduct();
            }
        });

        button.initClick("#search_product_button", function(btn) {
            searchProduct();
        });
    }

    function searchProduct() {

        let search = utils.trim("#search_product_text");
        let branch = $("#search_product_text").data("branch");
        if (search == '') {
            $("#empty_search_alert").removeClass("d-none");
            setTimeout(function() {
                $("#empty_search_alert").addClass("d-none");
            }, 3000);

            $("#search_product_result_table").empty().addClass("d-none");
        } else {
            event.post("/api_v1/order_items/search", {
                search: search,
                branch: branch,
                _method: "GET"
            }, function(r) {
                if (r.code == 200) {
                    if (r.body.html == "") {
                        $("#no_results").removeClass("d-none");
                        setTimeout(function() {
                            $("#no_results").addClass("d-none");
                        }, 3000);
                        $("#search_product_result_table").empty().addClass("d-none");
                    } else {
                        $("#search_product_result_table").empty().append(r.body.html).removeClass("d-none");
                        initAddProduct();
                    }
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        }
    }

    function initAddProduct() {
        button.initClick(".order_product_search", function(btn) {
            $("#add_product_image").attr("src", btn.data('image'));
            $("#add_product_name").empty().append(btn.data('name'));
            $("#add_product_key").empty().append(btn.data('key'));
            $("#add_product_price").empty().append("$" + btn.data('price'));
            $("#add_product_search_modal").addClass("d-none");
            $("#search_product_result").addClass("d-none");
            $("#add_product_details_modal").removeClass("d-none");

            changeQuantityControlsAdd({
                Granel: btn.data('granel'),
                Stock: btn.data('max')
            });
            initAddProductToOrder({
                pid: btn.data('id'),
                price: btn.data('baseprice'),
                discount: btn.data('discount')
            });
        });

        button.initClick("#back_to_search", function(btn) {
            backToSearch();
        });

    }

    function backToSearch() {
        $("#add_product_search_modal").removeClass("d-none");
        $("#search_product_result").removeClass("d-none");
        $("#add_product_details_modal").addClass("d-none");
    }

    function changeQuantityControlsAdd(item) {
        let q = $("#add_product_quantity");
        let v = (item.Granel == 1) ? 0.05 : 1;
        const base = v;
        let newval = 0;

        q.val(base);

        $("#plus_button_add").off("click");
        $("#plus_button_add").on("click", function() {
            newval = parseFloat(q.val()) + v;
            newval = (newval > parseFloat(item.Stock)) ? parseFloat(item.Stock) : ((newval < base) ? base : newval);
            q.val((item.Granel == 1) ? newval.toFixed(2) : newval);
        });

        $("#minus_button_add").off("click");
        $("#minus_button_add").on("click", function() {
            newval = parseFloat(q.val()) - v;
            newval = (newval > parseFloat(item.Stock)) ? parseFloat(item.Stock) : ((newval < base) ? base : newval);
            q.val((item.Granel == 1) ? newval.toFixed(2) : newval);
        });

        q.off("blur");
        q.on("blur", function(e) {
            newval = parseFloat(q.val());
            newval = (newval > parseFloat(item.Stock)) ? parseFloat(item.Stock) : ((newval < base) ? base : newval);
            q.val((item.Granel == 1) ? newval.toFixed(2) : newval);
        });

        q.off('input');
        q.on('input', function(e) {
            if (item.Granel == 1) {
                $(this).val($(this).val().replace(/[^0-9.]/g, ''));
            } else {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            }
        });
    }

    function initAddProductToOrder(data) {
        $("#add_product_to_order").off("click");
        $("#add_product_to_order").on("click", function() {

            data.quantity = $("#add_product_quantity").val();
            data.order = $("#add_product_quantity").data('order');
            data._method = "POST";

            event.post("/api_v1/order_items", data, function(r) {
                if (r.code == 200) {
                    window.location.reload();
                } else {
                    event.hideLoading();
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            }, null, false);
        });
    }

});