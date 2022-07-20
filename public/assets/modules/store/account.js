import Events from '../shared/Events.js';
import Buttons from '../shared/Buttons.js';
import Utils from '../shared/Utils.js';
import Alerts from '../shared/Alerts.js';

$(function() {
    const event = new Events();
    const button = new Buttons();
    const utils = new Utils();
    const alerts = new Alerts();

    button.initClick("#save_personal_info_button", function(btn) {
        let data = {
            name: utils.trim("#full_name_input"),
            phone: utils.trim("#phone_input"),
            birthday: utils.trim("#birthday_input"),
        };

        if (data.name == "") {
            alerts.fire("No puedes omitir el nombre para guardar tu información personal", "error", "OK", "warning");
        } else {
            event.post('/api_v1/store/update_personal_info', data, function(r) {
                if (r.code == 200) {
                    alerts.fire("Gracias por actualizar tus datos", "success", "OK", "warning");
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        }
    });

});
