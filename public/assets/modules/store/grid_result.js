import Events from '../shared/Events.js';
import Buttons from '../shared/Buttons.js';
import Selects from '../shared/Selects.js';

$(function() {
    const event = new Events();
    const button = new Buttons();
    const select = new Selects();

    select.change("#result_limit", function(s) {
        event.showLoading();
        let data = {
            'order': $("#result_sort option:selected").data('sort'),
            'direction': $("#result_sort option:selected").data('direction'),
            'limit': s.val(),
            'search': utils.trim("#search_text")
        };

        window.location.href = '?page=1&order=' + data.order + '&direction=' + data.direction + '&limit=' + data.limit;
    });

    select.change("#result_sort", function(s) {
        event.showLoading();
        let data = {
            'order': $("#result_sort option:selected").data('sort'),
            'direction': $("#result_sort option:selected").data('direction'),
            'limit': $("#result_limit option:selected").val(),
            'page': $("#result_page").val()
        };

        window.location.href = '?page=' + data.page + '&order=' + data.order + '&direction=' + data.direction + '&limit=' + data.limit;
    });

    button.initClick(".pagination_button", function(btn) {
        event.showLoading();
        let data = {
            'order': $("#result_sort option:selected").data('sort'),
            'direction': $("#result_sort option:selected").data('direction'),
            'limit': $("#result_limit option:selected").val(),
            'page': btn.data('page')
        };

        window.location.href = '?page=' + data.page + '&order=' + data.order + '&direction=' + data.direction + '&limit=' + data.limit;
    });

});