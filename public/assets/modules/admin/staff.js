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

    initNewStaffForm();
    initStaffTable();

    function initNewStaffForm() {
        buttons.init("show_new_staff_form", function() {
            resetNewStaffForm();
            $('#modal_new_staff').modal('show');
        });

        if ($('#new_staff_form').length) {
            initNewStaffFormValidate(function() {
                let data = {
                    name: utils.trim("#staff_name"),
                    email: utils.trim("#staff_email"),
                    password: utils.trim("#staff_password"),
                    _method: 'POST'
                };

                event.post('/api_v1/staff', data, function(r) {
                    proccessNewStaffResponse(r);
                }, function(rf) {
                    buttons.removeLoadingButton(null, "new_staff_button");
                    alerts.fire(rf || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                });

            });
        }

    }

    function resetNewStaffForm() {
        utils.reset("#staff_name");
        utils.reset("#staff_email");
        utils.reset("#staff_password");
        buttons.removeLoadingButton(null, "new_staff_button");
    }

    function initNewStaffFormValidate(callback = () => {}) {
        fv.validate("new_staff_form", "new_staff_button", {}, callback);
    }

    function proccessNewStaffResponse(r) {
        if (r.code == 200) {
            $('#modal_new_staff').modal('hide');
            alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                window.location.reload();
            });
        } else {
            alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
            buttons.removeLoadingButton(null, "new_staff_button");
        }
    }

    function initStaffTable() {
        table.initTableCR("#staff_table", {
            scrollX: true,
            order: [
                [1, 'asc']
            ],
        }, () => {

        }, true, "Staff", "#export-buttons-hiden");

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