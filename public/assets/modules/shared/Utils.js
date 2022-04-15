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
}

export default Utilities;