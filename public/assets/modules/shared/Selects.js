class Selects {

    constructor() {}

    init(obj) {
        $(obj).select2();
    }

    initDropdown(obj, dropdown) {
        $(obj).select2({
            dropdownParent: $(dropdown)
        });
    }

    reset(obj, value = null) {
        $(obj).val(value).trigger('change');
    }

    reloadData(obj, data, schema, nullableOption = true) {
        $(obj).select2('destroy');
        if (nullableOption)
            $(obj).empty().append('<option></option>');

        $.each(data, function(k, v) {
            $(obj).append('<option value="' + v[schema.value] + '">' + v[schema.text] + '</option>');
        });
        $(obj).select2();
    }
}

export default Selects;