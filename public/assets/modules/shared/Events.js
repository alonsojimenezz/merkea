import Alerts from "./Alerts.js";

class Events {

    constructor() {}

    hideLoading() {
        $(".loading").addClass("d-none");
        $(".loading").removeClass("position-absolute");
    }

    showLoading() {
        $(".loading").removeClass("d-none");
        $(".loading").addClass("position-absolute");
    }

    post(url, data, doneCallback = null, failCallback = null) {
        let _this = this;
        const alerts = new Alerts();

        $.ajax({
                url: url,
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                dataType: "json",
                beforeSend: function() {
                    _this.showLoading();
                },
            }).done(function(r) {
                _this.hideLoading();
                doneCallback(r);
            })
            .fail(function(xhr, textStatus, errorThrown) {
                _this.hideLoading();
                if (failCallback !== null) {
                    failCallback(textStatus);
                } else {
                    alerts.fire("Ocurrió un error al procesar su solicitud. Recargue e intente de nuevo", "warning", "Continuar", "primary");
                }
            });
    }
}

export default Events;