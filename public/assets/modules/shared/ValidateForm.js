import Buttons from "./Buttons.js";

class ValidateForm {

    validate(obj, button, fields, callback = () => {}) {
        const _this = this;
        const form = document.getElementById(obj);
        var validator = FormValidation.formValidation(
            form, {
                fields: fields,
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );
        _this.initSubmit(button, validator, callback);
    }

    initSubmit(obj, validator, callback = () => {}) {
        const buttons = new Buttons();
        buttons.init(obj, function(btn) {
            if (validator) {
                validator.validate().then(function(status) {
                    if (status == 'Valid') {
                        btn.setAttribute('data-kt-indicator', 'on');
                        btn.disabled = true;
                        callback();
                    }
                });
            }
        });
    }
}

export default ValidateForm;