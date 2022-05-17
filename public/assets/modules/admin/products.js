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
    initSlugCreator();

    function initNewProductForm() {
        buttons.init("show_new_product_form", function() {
            resetNewProductForm();
            $('#modal_new_product').modal('show');
        });

        if ($('#new_product_form').length) {
            initNewProductFormValidate(function() {
                let data = {
                    slug: utils.trim("#product_slug"),
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

    function initSlugCreator() {
        $('#product_name').on('keyup change', function() {
            $('#product_slug').val(utils.trim("#product_name").toLowerCase().replace(/\s/g, '-'));
        });

        $('#product_slug').on('keyup change', function() {
            $('#product_slug').val(utils.trim("#product_slug").toLowerCase().replace(/\s/g, '-'));
        });
    }

    function resetNewProductForm() {
        utils.reset("#product_slug");
        utils.reset("#product_name");
        buttons.removeLoadingButton(null, "new_product_button");
    }

    function initNewProductFormValidate(callback = () => {}) {
        fv.validate("new_product_form", "new_product_button", {
            'product_name': {
                validators: {
                    notEmpty: {
                        message: 'El nombre del producto es requerido'
                    }
                }
            },
            'product_slug': {
                validators: {
                    notEmpty: {
                        message: 'El slug del producto es requerido'
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
    }

});
