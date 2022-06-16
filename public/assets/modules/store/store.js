import Events from '../shared/Events.js';
import Buttons from '../shared/Buttons.js';
import Utils from '../shared/Utils.js';

$(function() {
    const event = new Events();
    const button = new Buttons();
    const utils = new Utils();

    button.initClick("#search_button", function(btn) {
        let search = utils.trim("#search_text");
        let department = $("#search_department option:selected").val();
        event.showLoading();
        window.location.href = '/search?query=' + search + '&department=' + department;
    });


});