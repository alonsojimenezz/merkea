class Dates {

    constructor() {}

    init(obj, format = 'Y-m-d', altFormat = null, minDate = new Date()) {
        $(obj).flatpickr({
            altInput: (format != altFormat && altFormat != null),
            altFormat: (altFormat != null) ? altFormat : format,
            dateFormat: format,
            minDate: minDate
        });
    }

    reset(obj) {
        $(obj).flatpickr().clear();
    }
}

export default Dates;