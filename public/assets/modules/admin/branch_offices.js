import Events from '../shared/Events.js';
import DTables from '../shared/Tables.js';
import ValidateForm from '../shared/ValidateForm.js';
import Alerts from '../shared/Alerts.js';
import Utils from '../shared/Utils.js';
import Buttons from '../shared/Buttons.js';

$(function() {
    const event = new Events();
    const table = new DTables();
    const fv = new ValidateForm();
    const alerts = new Alerts();
    const utils = new Utils();
    const buttons = new Buttons();

    initNewBranchOfficeForm();
    initBranchOfficesTable();

    function initNewBranchOfficeForm() {
        buttons.init("show_new_branch_office_form", function() {
            $("#modal_titles").removeClass("d-none");
            $("#modal_alt_titles").addClass("d-none");
            $("#branch_office_status").prop("checked", true);
            $("#branch_office_status_section").addClass("d-none");
            $("#branch_office_id").val(0);
            resetNewBranchOfficeForm();
            $('#modal_new_branch_office').modal('show');
        });

        if ($('#new_branch_office_form').length) {
            fv.validate("new_branch_office_form", "new_branch_office_button", {}, function() {
                let data = {
                    name: utils.trim("#branch_office_name"),
                    address: utils.trim("#branch_office_address"),
                    frame: utils.trim("#branch_office_google_maps_code"),
                    id: utils.trim("#branch_office_id"),
                    active: $("#branch_office_status").is(":checked") ? 1 : 0,
                    _method: utils.trim("#branch_office_id") > 0 ? 'PUT' : 'POST'
                };

                const uri = (data.id == 0 && data._method == 'POST') ? '/api_v1/branch_offices' : '/api_v1/branch_offices/' + data.id;
                event.post(uri, data, function(r) {
                    proccessNewBranchOfficeResponse(r);
                });

            });
        }

    }

    function resetNewBranchOfficeForm() {
        utils.reset("#branch_office_name");
        utils.reset("#branch_office_address");
        utils.reset("#branch_office_google_maps_code");
        buttons.removeLoadingButton(null, "new_branch_office_button");
    }

    function proccessNewBranchOfficeResponse(r) {
        if (r.code == 200) {
            $('#modal_new_branch_office').modal('hide');
            alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                window.location.reload();
            });
        } else {
            alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
            buttons.removeLoadingButton(null, "new_branch_office_button");
        }
    }

    function initBranchOfficesTable() {
        table.initTableCR("#branch_offices_table", {
            scrollX: true,
            order: [
                [1, 'asc']
            ],
        }, () => {

        }, true, "Branch_Offices", "#export-buttons-hiden");

        initEditBranchOfficeLinks();
    }

    function initEditBranchOfficeLinks() {
        buttons.initClick(".branch_office-name-edit-link", function(btn) {
            $("#modal_titles").addClass("d-none");
            $("#modal_alt_titles").removeClass("d-none");
            $("#branch_office_id").val(btn.data("id"));
            $("#branch_office_status_section").removeClass("d-none");
            event.post("/api_v1/branch_offices/" + btn.attr("data-id"), {
                _method: 'GET'
            }, function(r) {
                if (r.code == 200) {
                    $("#branch_office_name").val(r.body.branch_office.Name);
                    $("#branch_office_address").val(r.body.branch_office.Address);
                    $("#branch_office_google_maps_code").val(r.body.branch_office.Frame);
                    $("#branch_office_status").prop("checked", r.body.branch_office.IsActive == 1);
                    $("#modal_new_branch_office").modal('show');
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }

});
