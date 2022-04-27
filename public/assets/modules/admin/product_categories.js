import Events from '../shared/Events.js';
import DTables from '../shared/Tables.js';
import ValidateForm from '../shared/ValidateForm.js';
import Alerts from '../shared/Alerts.js';
import Utils from '../shared/Utils.js';
import Selects from '../shared/Selects.js';
import Buttons from '../shared/Buttons.js';

$(function() {
    const event = new Events();
    const table = new DTables();
    const fv = new ValidateForm();
    const alerts = new Alerts();
    const utils = new Utils();
    const selects = new Selects();
    const buttons = new Buttons();

    initNewCategoryForm();
    initCategoriesTable();

    function reloadParentCategories(callback = () => {}) {
        event.post('/api_v1/categories', {
                '_method': 'GET'
            }, function(r) {
                selects.reloadData("#parent_category", r.body.categories, {
                    value: 'Id',
                    text: 'NameStatus'
                });
                callback();
            },
            function() {
                console.log('Error');
            });
    }

    function initNewCategoryForm() {
        selects.initDropdown("#parent_category", "#parent_category_dropdown");

        buttons.init("show_new_category_form", function() {
            $("#modal_titles").removeClass("d-none");
            $("#modal_alt_titles").addClass("d-none");
            $("#category_status").prop("checked", true);
            $("#category_status_section").addClass("d-none");
            $("#category_id").val(0);
            resetNewCategoryForm();
            $('#modal_new_category').modal('show');
            reloadParentCategories();
        });

        if ($('#new_category_form').length) {
            initNewCategoryFormValidate(function() {
                let data = {
                    name: utils.trim("#category_name"),
                    description: utils.trim("#category_description"),
                    parent: $("#parent_category option:selected").val(),
                    id: utils.trim("#category_id"),
                    active: $("#category_status").is(":checked") ? 1 : 0,
                    _method: utils.trim("#category_id") > 0 ? 'PUT' : 'POST'
                };

                const uri = (data.id == 0 && data._method == 'POST') ? '/api_v1/categories' : '/api_v1/categories/' + data.id;
                event.post(uri, data, function(r) {
                    proccessNewCategoryResponse(r);
                });

            });
        }

    }

    function resetNewCategoryForm() {
        utils.reset("#category_name");
        utils.reset("#category_description");
        selects.reset("#parent_category");
        buttons.removeLoadingButton(null, "new_category_button");
    }

    function initNewCategoryFormValidate(callback = () => {}) {
        fv.validate("new_category_form", "new_category_button", {
            'category_name': {
                validators: {
                    notEmpty: {
                        message: 'El nombre de la categoría es requerido'
                    }
                }
            }
        }, callback);
    }

    function proccessNewCategoryResponse(r) {
        if (r.code == 200) {
            $('#modal_new_category').modal('hide');
            alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                window.location.reload();
            });
        } else {
            alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
            buttons.removeLoadingButton(null, "new_category_button");
        }
    }

    function initCategoriesTable() {
        table.initTableCR("#product_categories_table", {
            scrollX: true,
            order: [
                [1, 'asc']
            ],
        }, () => {

        }, true, "Product_categories", "#export-buttons-hiden");

        initEditCategoryLinks();
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