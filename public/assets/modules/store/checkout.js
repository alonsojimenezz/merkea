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
            'address': $("#checkout-address").val()
        };

        if (data.name == "" || typeof data.name == "undefined") {
            alert.fire("Debes ingresar tu nombre", "warning", "OK", "warning");
        } else if (data.email == "" || typeof data.email == "undefined" || !utils.validateEmail(data.email)) {
            alert.fire("Debes ingresar un email válido", "warning", "OK", "warning");
        } else if (data.phone == "" || typeof data.phone == "undefined") {
            alert.fire("Debes ingresar tu teléfono", "warning", "OK", "warning");
        } else if (data.postalcode == "" || typeof data.postalcode == "undefined") {
            alert.fire("Debes seleccionar un código postal", "warning", "OK", "warning");
        } else if (data.address == "" || typeof data.address == "undefined") {
            alert.fire("Debes ingresar la dirección donde recibirás tu pedido", "warning", "OK", "warning");
        } else {
            event.post('/api_v1/store/checkout', data, function(r) {
                if (r.code == 200) {
                    console.log(r);
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                    event.hideLoading();
                }
            });
        }
    });
});
