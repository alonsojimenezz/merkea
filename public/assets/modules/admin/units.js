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

    initNewUnitForm();
    initUnitsTable();

    function initNewUnitForm() {
        buttons.init("show_new_unit_form", function() {
            $("#modal_titles").removeClass("d-none");
            $("#modal_alt_titles").addClass("d-none");
            $("#unit_status").prop("checked", true);
            $("#unit_status_section").addClass("d-none");
            $("#unit_id").val(0);
            resetNewUnitForm();
            $('#modal_new_unit').modal('show');
        });

        if ($("#new_unit_form").length) {
            initNewUnitFormValidate(function() {
                let data = {
                    name: utils.trim("#unit_name"),
                    key: utils.trim("#unit_key"),
                    id: utils.trim("#unit_id"),
                    active: $("#unit_status").is(":checked") ? 1 : 0,
                    _method: utils.trim("#unit_id") > 0 ? 'PUT' : 'POST'
                };

                const uri = (data.id == 0 && data._method == 'POST') ? '/api_v1/units' : '/api_v1/units/' + data.id;
                event.post(uri, data, function(r) {
                    proccessNewUnitResponse(r);
                });

            });
        }

    }

    function resetNewUnitForm() {
        utils.reset("#unit_name");
        utils.reset("#unit_key");
        buttons.removeLoadingButton(null, "new_unit_button");
    }

    function initNewUnitFormValidate(callback = () => {}) {
        fv.validate("new_unit_form", "new_unit_button", {
            'unit_name': {
                validators: {
                    notEmpty: {
                        message: 'El nombre de la unidad de medida es requerido'
                    }
                }
            },
            'unit_key': {
                validators: {
                    notEmpty: {
                        message: 'El simbolo o clave de la unidad de medida es requerido'
                    }
                }
            }
        }, callback);
    }

    function proccessNewUnitResponse(r) {
        if (r.code == 200) {
            $('#modal_new_unit').modal('hide');
            alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                window.location.reload();
            });
        } else {
            alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
            buttons.removeLoadingButton(null, "new_unit_button");
        }
    }

    function initUnitsTable() {
        table.initTableCR("#product_units_table", {
            scrollX: true,
            order: [
                [1, 'asc']
            ],
        }, () => {

        }, true, "Unit of measure", "#export-buttons-hiden");

        initEditUnitLinks();
    }

    function initEditUnitLinks() {
        table.buttonClic("#product_units_table", ".unit-name-edit-link", function(btn) {
            $("#modal_titles").addClass("d-none");
            $("#modal_alt_titles").removeClass("d-none");
            $("#unit_id").val(btn.data("id"));
            $("#unit_status_section").removeClass("d-none");
            event.post("/api_v1/units/" + btn.attr("data-id"), {
                _method: 'GET'
            }, function(r) {
                if (r.code == 200) {
                    $("#unit_name").val(r.body.unit.Name);
                    $("#unit_key").val(r.body.unit.Key);
                    $("#unit_status").prop("checked", r.body.unit.Active == 1);
                    $("#modal_new_unit").modal('show');
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }

});