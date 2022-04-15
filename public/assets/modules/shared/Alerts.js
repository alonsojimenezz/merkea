class Alerts {

    constructor() {}

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
}

export default Alerts;