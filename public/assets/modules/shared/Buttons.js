class Buttons {

    constructor() {}

    initClick(buttonObject, callback = () => {}) {
        $(buttonObject).on("click", function(e) {
            const btn = $(this);
            e.preventDefault();
            $(buttonObject).attr('data-kt-indicator', "on");
            callback(btn);
        });
    }

    init(obj, callback = () => {}) {
        if (document.getElementById(obj)) {
            const button = document.getElementById(obj);
            button.addEventListener('click', function(e) {
                e.preventDefault();
                callback(button, e);
            });
        }
    }


    removeLoadingButton(btn = null, btnId = null) {
        if (btn == null) {
            btn = document.getElementById(btnId);
        }
        btn.removeAttribute('data-kt-indicator');
        btn.disabled = false;
    }

    onEnter(btn, callback = () => {}) {
        $(btn).on("keypress", function(e) {
            let _this = $(this);
            if (e.which == 13) {
                callback(_this);
            }
        });
    }

}

export default Buttons;