import Alerts from "./Alerts.js";
import Events from "./Events.js";

class Upload {

    constructor() {
        this.events = new Events();
        this.alerts = new Alerts();
    }

    init(obj, url, name, auto = false) {
        let request_dropzone = new Dropzone(obj, {
            url: url,
            paramName: name,
            maxFiles: 10,
            maxFilesize: 10,
            parallelUploads: 10,
            addRemoveLinks: true,
            autoProcessQueue: auto,
            uploadMultiple: true,
        });

        return request_dropzone;
    }

    initDirectUpload(obj, url, name) {
        let request_dropzone = new Dropzone(obj, {
            url: url,
            paramName: name,
            maxFiles: 10,
            maxFilesize: 10,
            parallelUploads: 10,
            addRemoveLinks: true,
            autoProcessQueue: true,
            uploadMultiple: true,
        });

        return request_dropzone;
    }

    addData(request_dropzone, data) {
        const _this = this;
        request_dropzone.on("sending", function(file, xhr, formData) {
            _this.events.showLoading();
            $.each(data, function(k, v) {
                if (!(k in formData) && (formData.k = {})) {
                    formData.append(k, v);
                }
            });
        });
    }

    addCallback(request_dropzone, callback = () => {}, failCallback = () => {}) {
        const _this = this;
        request_dropzone.on("successmultiple", function(files, r) {
            _this.events.hideLoading();
            if (r.code == 200) {
                callback(r);
            } else {
                _this.alerts.fire("No pudimos subir sus archivos, recargue e intente de nuevo", "warning", "Continuar", "primary");
                failCallback(r);
            }
        });
        request_dropzone.on("errormultiple", function(files, r) {
            _this.events.hideLoading();
            _this.alerts.fire("No pudimos subir sus archivos, recargue e intente de nuevo", "warning", "Continuar", "primary");
            failCallback(r);
        });
    }

    processQueue(request_dropzone) {
        request_dropzone.processQueue();
    }

    files(request_dropzone) {
        return request_dropzone.files;
    }

    reset(request_dropzone) {
        request_dropzone.removeAllFiles(true);
    }

}

export default Upload;