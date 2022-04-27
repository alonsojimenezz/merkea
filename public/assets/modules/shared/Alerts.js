class Alerts {

    constructor() {
        const toastElement = document.getElementById('main_toast');
        this.toast = bootstrap.Toast.getOrCreateInstance(toastElement);
    }

    fire(html, icon = "success", confirmText = "OK", confirmBtnClass = "primary", callback = () => {}) {
        Swal.fire({
            html: html,
            icon: icon,
            buttonsStyling: false,
            confirmButtonText: confirmText,
            customClass: {
                confirmButton: "btn btn-" + confirmBtnClass
            }
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        });
    }

    fire_toast(title, subtitle = '', message = '') {
        $('#main_toast_title').empty().append(title);
        $('#main_toast_subtitle').empty().append(subtitle);
        $('#main_toast_body').empty().append(message);
        this.toast.show();
    }
}

export default Alerts;
