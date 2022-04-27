import Events from '../shared/Events.js';
import DTables from '../shared/Tables.js';
import ValidateForm from '../shared/ValidateForm.js';
import Alerts from '../shared/Alerts.js';
import Upload from '../shared/Upload.js';
import Utils from '../shared/Utils.js';
import Selects from '../shared/Selects.js';
import Dates from '../shared/Dates.js';
import Buttons from '../shared/Buttons.js';

$(function() {
    const event = new Events();
    const table = new DTables();
    const fv = new ValidateForm();
    const alerts = new Alerts();
    const upload = new Upload();
    const utils = new Utils();
    const selects = new Selects();
    const dates = new Dates();
    const buttons = new Buttons();

    initNewProductForm();
    initProductsTable();

    function initNewProductForm() {
        buttons.init("show_new_product_form", function() {
            resetNewProductForm();
            $('#modal_new_product').modal('show');
        });

        if ($('#new_product_form').length) {
            initNewProductFormValidate(function() {
                let data = {
                    key: utils.trim("#product_key"),
                    name: utils.trim("#product_name"),
                    active: 1,
                    _method: 'POST'
                };

                event.post('/api_v1/products', data, function(r) {
                    proccessNewProductResponse(r);
                });

            });
        }

    }

    function resetNewProductForm() {
        utils.reset("#product_key");
        utils.reset("#product_name");
        buttons.removeLoadingButton(null, "new_product_button");
    }

    function initNewProductFormValidate(callback = () => {}) {
        fv.validate("new_product_form", "new_product_button", {
            'product_key': {
                validators: {
                    notEmpty: {
                        message: 'La clave del producto es requerida'
                    }
                }
            },
            'product_name': {
                validators: {
                    notEmpty: {
                        message: 'El nombre del producto es requerido'
                    }
                }
            }
        }, callback);
    }

    function proccessNewProductResponse(r) {
        if (r.code == 200) {
            $('#modal_new_product').modal('hide');
            alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                window.location.reload();
            });
        } else {
            alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
            buttons.removeLoadingButton(null, "new_product_button");
        }
    }

    function initProductsTable() {
        table.initTableCR("#products_table", {
            scrollX: true,
            order: [
                [1, 'asc']
            ],
        }, () => {

        }, true, "Products", "#export-buttons-hiden");

        // initEditCategoryLinks();
    }

    function initEditCategoryLinks() {
        buttons.initClick(".category-name-edit-link", function(btn) {
            $("#modal_titles").addClass("d-none");
            $("#modal_alt_titles").removeClass("d-none");
            $("#category_id").val(btn.data("id"));
            $("#category_status_section").removeClass("d-none");
            reloadParentCategories(function() {
                event.post("/api_v1/categories/" + btn.attr("data-id"), {
                    _method: 'GET'
                }, function(r) {
                    if (r.code == 200) {
                        $("#category_name").val(r.body.category.Name);
                        $("#category_description").val(r.body.category.Description);
                        selects.reset("#parent_category", r.body.category.ParentId);
                        $("#category_status").prop("checked", r.body.category.Active == 1);
                        $("#modal_new_category").modal('show');
                    } else {
                        alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                    }
                });
            });
        });
    }

});