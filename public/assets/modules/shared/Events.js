import Alerts from "./Alerts.js";

class Events {

    constructor() {
        this.hideLoading();
    }

    hideLoading() {
        $("#loading").addClass("d-none");
    }

    showLoading() {
        $("#loading").removeClass("d-none");
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

    postFile(url, data, doneCallback = null, failCallback = null) {
        let _this = this;
        const alerts = new Alerts();

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            contentType: false,
            dataType: "json",
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                _this.showLoading();
            },
            success: function(r) {
                _this.hideLoading();
                doneCallback(r);
            },
            error: function(xhr, textStatus, errorThrown) {
                _this.hideLoading();
                if (failCallback !== null) {
                    failCallback(textStatus);
                } else {
                    alerts.fire("Ocurrió un error al procesar su solicitud. Recargue e intente de nuevo", "warning", "Continuar", "primary");
                }
            }
        });
    }
}

export default Events;