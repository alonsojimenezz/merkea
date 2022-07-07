import Events from '../shared/Events.js';
import DTables from '../shared/Tables.js';

$(function() {
    const event = new Events();
    const table = new DTables();

    initOrdersTable();

    function initOrdersTable() {
        table.initTableCR("#orders_table", {
            scrollX: true,
            order: [
                [1, 'asc']
            ],
        }, () => {

        }, true, "Orders", "#export-buttons-hiden");
    }

});