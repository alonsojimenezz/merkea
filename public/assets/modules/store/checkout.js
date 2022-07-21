import Events from '../shared/Events.js';
import Buttons from '../shared/Buttons.js';
import Utils from '../shared/Utils.js';
import Selects from '../shared/Selects.js';
import Alerts from '../shared/Alerts.js';

$(function() {
    const event = new Events();
    const button = new Buttons();
    const utils = new Utils();
    const select = new Selects();
    const alert = new Alerts();

    $("input[type=radio][name=delivery_method]").on('change', function() {
        const deliveryMethod = $(this).val();
        switch (deliveryMethod) {
            case '1':
            case 1:
                $("#delivery_direction, #title-shipping").removeClass('d-none');
                $("#title-no-shipping").addClass('d-none');
                break;
            case '2':
            case 2:
                $("#delivery_direction, #title-shipping").addClass('d-none');
                $("#title-no-shipping").removeClass('d-none');
                break;
        }
    });

    $("input[type=radio][name=btntodaytomorrow]").on('change', function() {
        const classTT = $(this).val();
        $("#schedule_time option").attr('disabled', true).addClass('d-none');
        $("#schedule_time option." + classTT).removeAttr('disabled').removeClass('d-none');
        $("#schedule_time").val($('#schedule_time option:not([disabled]):first').val());
    });

    $("input[type=radio][name=schedule_delivery_option]").on('change', function() {
        const scheduleDeliveryOption = $(this).val();
        switch (scheduleDeliveryOption) {
            case '1':
            case 1:
                $("#schedule_section").addClass('d-none');
                break;
            case '2':
            case 2:
                $("#schedule_section").removeClass('d-none');
                break;
        }
    });

    select.change("#checkout-postalcode", function(s) {
        if (s.val() == "") {
            $(".coverageByPostal").addClass("d-none");
            $(".coverageByPostal input[type=text]").val("");
        } else {
            let opt = $("#checkout-postalcode option:selected");
            $(".coverageByPostal").removeClass("d-none");
            $("#checkout-city").val(opt.data("city"));
            $("#checkout-state").val(opt.data("state"));
        }
    });

    button.initClick("#checkout-button", function(btn) {
        let data = {
            "name": $("#checkout-fullname").val(),
            "email": $("#checkout-email").val(),
            "phone": $("#checkout-phone").val(),
            "postalcode": $("#checkout-postalcode").val(),
            'address': $("#checkout-address").val(),
            'delivery_method': $("input[type=radio][name=delivery_method]:checked").val(),
            'delivery_schedule': $("input[type=radio][name=schedule_delivery_option]:checked").val(),
            'delivery_date_day': $("input[type=radio][name=btntodaytomorrow]:checked").val(),
            'delivery_date_time': $("#schedule_time").val(),
            'payment_method': $("input[type=radio][name=payment_method]:checked").val(),
        };

        if (data.name == "" || typeof data.name == "undefined") {
            alert.fire("Debes ingresar tu nombre", "warning", "OK", "warning");
        } else if (data.email == "" || typeof data.email == "undefined" || !utils.validateEmail(data.email)) {
            alert.fire("Debes ingresar un email válido", "warning", "OK", "warning");
        } else if (data.phone == "" || typeof data.phone == "undefined") {
            alert.fire("Debes ingresar tu teléfono", "warning", "OK", "warning");
        } else if (data.delivery_method == 1) {
            if (data.postalcode == "" || typeof data.postalcode == "undefined") {
                alert.fire("Debes seleccionar un código postal", "warning", "OK", "warning");
            } else if (data.address == "" || typeof data.address == "undefined") {
                alert.fire("Debes ingresar la dirección donde recibirás tu pedido", "warning", "OK", "warning");
            } else {
                sendOrder(data);
            }
        } else {
            sendOrder(data);
        }
    });

    function sendOrder(data) {
        btn.addClass("d-none");
        event.post('/api_v1/store/checkout', data, function(r) {
            if (r.code == 200) {
                window.location.href = r.body.url;
            } else {
                alerts.fire(r.message || "Ocurrió un error al procesar la orden", "warning", "Continuar", "primary");
                event.hideLoading();
                btn.removeClass("d-none");
            }
        }, null, false);
    }
});