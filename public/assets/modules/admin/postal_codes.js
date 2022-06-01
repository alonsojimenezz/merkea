import Events from '../shared/Events.js';
import DTables from '../shared/Tables.js';
import ValidateForm from '../shared/ValidateForm.js';
import Alerts from '../shared/Alerts.js';
import Utils from '../shared/Utils.js';
import Buttons from '../shared/Buttons.js';
import Selects from '../shared/Selects.js';

$(function() {
    const event = new Events();
    const table = new DTables();
    const fv = new ValidateForm();
    const alerts = new Alerts();
    const utils = new Utils();
    const buttons = new Buttons();
    const selects = new Selects();

    initNewPostalCodeForm();
    initPostalCodesTable();

    function initNewPostalCodeForm() {
        Inputmask("99999", {
            "numericInput": true
        }).mask("#postal_code");

        buttons.init("show_new_postal_code_form", function() {
            $("#modal_titles").removeClass("d-none");
            $("#modal_alt_titles").addClass("d-none");
            $("#postal_code_status").prop("checked", true);
            $("#postal_code_status_section").addClass("d-none");
            $("#postal_code_id").val(0);
            resetNewPostalCodeForm();
            $('#modal_new_postal_code').modal('show');
        });

        if ($('#new_postal_code_form').length) {
            fv.validate("new_postal_code_form", "new_postal_code_button", {}, function() {
                let data = {
                    state: $("#postal_code_state").val(),
                    city: utils.trim('#postal_code_city'),
                    colony: utils.trim('#postal_code_colony'),
                    postal_code: utils.trim('#postal_code'),
                    branch: $("#postal_code_branch").val(),
                    id: utils.trim("#postal_code_id"),
                    active: $("#postal_code_status").is(":checked") ? 1 : 0,
                    _method: utils.trim("#postal_code_id") > 0 ? 'PUT' : 'POST'
                };

                const uri = (data.id == 0 && data._method == 'POST') ? '/api_v1/postal_codes' : '/api_v1/postal_codes/' + data.id;
                event.post(uri, data, function(r) {
                    proccessNewPostalCodeResponse(r);
                });

            });
        }

    }

    function resetNewPostalCodeForm() {
        selects.reset("#postal_code_state");
        utils.reset("#postal_code_city");
        utils.reset("#postal_code_colony");
        utils.reset("#postal_code");
        buttons.removeLoadingButton(null, "new_postal_code_button");
    }

    function proccessNewPostalCodeResponse(r) {
        if (r.code == 200) {
            $('#modal_new_postal_code').modal('hide');
            alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                window.location.reload();
            });
        } else {
            alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
            buttons.removeLoadingButton(null, "new_postal_code_button");
        }
    }

    function initPostalCodesTable() {
        table.initTableCR("#postal_codes_table", {
            scrollX: true,
            order: [
                [1, 'asc']
            ],
        }, () => {

        }, true, "Postal_Codes_Coverage", "#export-buttons-hiden");

        initEditPostalCodeLinks();
    }

    function initEditPostalCodeLinks() {
        buttons.initClick(".postal_code-name-edit-link", function(btn) {
            $("#modal_titles").addClass("d-none");
            $("#modal_alt_titles").removeClass("d-none");
            $("#postal_code_id").val(btn.data("id"));
            $("#postal_code_status_section").removeClass("d-none");
            event.post("/api_v1/postal_codes/" + btn.attr("data-id"), {
                _method: 'GET'
            }, function(r) {
                if (r.code == 200) {
                    selects.reset("#postal_code_state", r.body.postal_code.StateId);
                    selects.reset("#postal_code_branch", r.body.postal_code.BranchId);
                    $("#postal_code_city").val(r.body.postal_code.City);
                    $("#postal_code_colony").val(r.body.postal_code.Colony);
                    $("#postal_code").val(r.body.postal_code.PostalCode);
                    $("#postal_code_status").prop("checked", r.body.postal_code.IsActive == 1);
                    $("#modal_new_postal_code").modal('show');
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }

});