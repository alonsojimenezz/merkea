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
    const buttons = new Buttons();


    initPermissionsCheckboxes();
    initEditStaffForm();

    function initPermissionsCheckboxes() {
        $('.user_permissions_checkbox').on('change', function() {
            const data = {
                _method: 'PUT',
                user_id: $(this).data('user'),
                permission: $(this).data('permission'),
                value: $(this).is(':checked') ? 1 : 0
            };

            event.post('/api_v1/staff/' + data.user_id + '/permission', data, function(r) {
                if (r.code == 200) {
                    alerts.fire_toast(r.message, '', r.body.alert);
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }


    function initEditStaffForm() {
        buttons.initClick("#show_edit_staff_form", function(btn) {
            resetEditStaffForm(btn.data('id'));
        });

        if ($('#new_staff_form').length) {
            $("#staff_status_section").removeClass('d-none');
            $("#staff_password").removeAttr('data-fv-not-empty');
            $("#staff_password").removeAttr('data-fv-not-empty___message');
            $("#staff_password").removeAttr('data-fv-string-length');
            $("#staff_password").removeAttr('data-fv-string-length___min');
            $("#staff_password").removeAttr('data-fv-string-length___message');

            initEditStaffFormValidate(function() {
                let data = {
                    name: utils.trim("#staff_name"),
                    email: utils.trim("#staff_email"),
                    password: utils.trim("#staff_password"),
                    id: utils.trim("#staff_id"),
                    active: $("#staff_status").is(":checked") ? 1 : 0,
                    _method: 'PUT'
                };

                event.post('/api_v1/staff/' + data.id, data, function(r) {
                    proccessEditStaffResponse(r);
                }, function(rf) {
                    buttons.removeLoadingButton(null, "new_staff_button");
                    alerts.fire(rf || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                });

            });
        }

    }

    function resetEditStaffForm(staff_id) {
        $('#modal_edit_staff').modal('show');

        event.post("/api_v1/staff/" + staff_id, {
            _method: 'GET'
        }, function(r) {
            if (r.code == 200) {
                $("#staff_id").val(r.body.staff.id);
                $("#staff_name").val(r.body.staff.name);
                $("#staff_email").val(r.body.staff.email);
                $("#staff_status").prop("checked", r.body.staff.is_active == 1);
            } else {
                alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
            }
        });
    }

    function initEditStaffFormValidate(callback = () => {}) {
        fv.validate("new_staff_form", "new_staff_button", {}, callback);
    }


    function proccessEditStaffResponse(r) {
        if (r.code == 200) {
            $('#modal_edit_staff').modal('hide');
            alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                window.location.reload();
            });
        } else {
            alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
            buttons.removeLoadingButton(null, "new_staff_button");
        }
    }


});
