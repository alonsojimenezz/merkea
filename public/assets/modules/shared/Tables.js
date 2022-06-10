class DTables {

    initTableCR(obj = "", settings = {}, callback = function() {},
        export_data = false, title = "", objButtons = "") {
        const _this = this;
        settings.language = {
            info: "Mostrando _START_ a _END_ de _TOTAL_",
        };


        if (obj != "") {
            let dt = $(obj).DataTable(settings);
            _this.handleSearch(dt);
            if (export_data)
                _this.exportButtons(obj, title, objButtons);

            callback();
        }
    }

    getDataRow(obj = "", rowObj = "") {
        if (obj != "" && rowObj != "") {
            const table = $(obj).DataTable();
            return table.row(rowObj).data();
        } else {
            return [];
        }
    }

    getTable(obj = "") {
        const _this = this;
        if (obj != "") {
            if (!$.fn.DataTable.isDataTable(obj)) {
                _this.initTable(obj);
            }
        }
        return $(obj).DataTable();
    }

    handleSearch(dt) {
        const filterSearch = document.querySelector('[dt-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            dt.search(e.target.value).draw();
        });
    }

    rowClic(obj, callback = () => {}) {
        $(obj + " tbody").on('click', 'tr', function() {
            const rowData = $(obj).DataTable().row(this).data();
            callback(rowData);
        });
    }

    buttonClic(obj, btn, callback = () => {}) {
        $(obj + " tbody").on('click', 'tr ' + btn, function() {
            callback($(this));
        });
    }


    exportButtons(obj, title, objButtons) {
        var buttons = new $.fn.dataTable.Buttons(obj, {
            buttons: [{
                    extend: 'copyHtml5',
                    title: title
                },
                {
                    extend: 'excelHtml5',
                    title: title
                },
                {
                    extend: 'csvHtml5',
                    title: title
                },
                {
                    extend: 'pdfHtml5',
                    title: title
                }
            ]
        }).container().appendTo(objButtons);

        // Hook dropdown menu click event to datatable export buttons
        const exportButtons = document.querySelectorAll('#export_menu [data-export]');
        exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
                e.preventDefault();

                // Get clicked export value
                const exportValue = e.target.getAttribute('data-export');
                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                // Trigger click event on hidden datatable export buttons
                target.click();
            });
        });
    }


}

export default DTables;