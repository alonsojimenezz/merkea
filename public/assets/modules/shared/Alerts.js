class Alerts {

    constructor() {
        this.toastElement = document.getElementById('main_toast');
        this.toast = bootstrap.Toast.getOrCreateInstance(this.toastElement);
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
        $(".toast-container-main").addClass("position-fixed");
        $(".toast-container-main").removeClass("d-none");
        $('#main_toast_title').empty().append(title);
        $('#main_toast_subtitle').empty().append(subtitle);
        $('#main_toast_body').empty().append(message);
        this.toast.show();

        this.toastElement.addEventListener('hidden.bs.toast', function() {
            $(".toast-container-main").removeClass("position-fixed");
            $(".toast-container-main").addClass("d-none");
        });
    }
}

export default Alerts;
