class Utilities {
    trim(obj) {
        return $(obj).val().trim();
    }

    trimObj(obj) {
        return obj.val().trim();
    }

    reset(obj) {
        $(obj).val('');
    }

    initPhoneField(fieldId) {

        let inputPhone = window.intlTelInput(document.querySelector(fieldId), {
            initialCountry: "mx",
            utilsScript: _base_url + "assets/plugins/iti/utils.js",
        });

        $(fieldId).inputmask({
            mask: '99 9999 9999',
            placeholder: ' ',
            showMaskOnHover: false,
            showMaskOnFocus: false,
            onBeforePaste: function(pastedValue, opts) {
                var processedValue = pastedValue;
                return processedValue;
            }
        });

        return inputPhone;
    }

    getItiNumber(instance, objectId) {
        const _this = this;
        let countryCode = instance.getSelectedCountryData().dialCode;
        let phone = _this.trim(objectId).replace(/\s/g, '');
        if (phone !== "") {
            return '+' + countryCode + phone;
        }
        return '';
    }

    maskEmail(fieldId) {
        $(fieldId).inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            showMaskOnHover: true,
            greedy: false,
            onBeforePaste: function(pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("mailto:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    casing: "lower"
                }
            }
        });
    }

    timeout(ms, callback) {
        setTimeout(function() {
            callback();
        }, ms);
    }

    formatMoney(amount) {
        var formatter = new Intl.NumberFormat('es-MX', {
            style: 'currency',
            currency: 'MXN',

            // These options are needed to round to whole numbers if that's what you want.
            //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
            //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
        });
        return formatter.format(amount);
    }

    validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

}

export default Utilities;