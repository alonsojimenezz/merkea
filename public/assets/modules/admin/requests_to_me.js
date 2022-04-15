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

    initRequestsTable();

    function initRequestsTable() {
        table.initTableCR("#my_requests_table", {
            scrollX: true,
            order: [
                [0, 'asc']
            ],
        }, () => {

        }, true, "Mis Solicitudes", "#export-buttons-hiden");
    }
});