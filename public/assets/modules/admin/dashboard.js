import Events from '../shared/Events.js';
import Utils from '../shared/Utils.js';
import Tables from '../shared/Tables.js';

$(function() {
    const event = new Events();
    const utils = new Utils();
    const tables = new Tables();


    initDateRangePicker();
    initDateRangeChange();

    function initDateRangePicker() {
        let start = moment().subtract(29, "days");
        let end = moment();

        $("#daterange_report").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Hoy": [moment(), moment()],
                "Ayer": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Últimos 7 días": [moment().subtract(6, "days"), moment()],
                "Últimos 30 días": [moment().subtract(29, "days"), moment()],
                "Este mes": [moment().startOf("month"), moment().endOf("month")],
                "Mes pasado": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            },
            locale: {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "Desde",
                "toLabel": "Hasta",
                "customRangeLabel": "Personalizado",
                "weekLabel": "W",
                "firstDay": 0,
                "daysOfWeek": ["Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
                "monthNames": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre",
                ]
            }
        }, cb);

        cb(start, end);
    }

    function initDateRangeChange() {
        $('#daterange_report').on('apply.daterangepicker', function(ev, picker) {
            cb(picker.startDate, picker.endDate, true);
        });
    }

    function cb(start, end, destroy = false) {
        $("#daterange_report").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));

        event.post('/api_v1/dashboard/sales', {
            start: start.format('YYYY-MM-DD'),
            end: end.format('YYYY-MM-DD'),
            _method: "GET"
        }, function(r) {
            setValues(r.body.sales, destroy);
        });
    }

    function setValues(v, destroy = false) {
        $("#sales_total").empty().append(v.total);
        initTotalSalesGraphic(v.totals_by_branch, destroy);
        initTotalSalesTable(v.totals_by_branch_table, destroy);
        initTotalSalesProductGraphic(v.totals_by_product, destroy);
        initTotalSalesProductTable(v.totals_by_product, destroy);
        initTotalSalesDepartmentGraphic(v.totals_by_department, destroy);
        initTotalSalesDepartmentTable(v.totals_by_department, destroy);
    }

    function initTotalSalesGraphic(data, destroy) {
        var options = {
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [],
            xaxis: {
                categories: data.days
            }
        };

        $.each(data.values, function(k, v) {
            options.series.push({
                name: k,
                data: v
            });
        });

        if (destroy) {
            sales_chart.destroy();
        }

        sales_chart = new ApexCharts(document.querySelector("#total_sales_g"), options);

        sales_chart.render();
    }

    function initTotalSalesTable(data, destroy) {

        if (destroy) {
            sales_table.destroy();
        }

        let columns = [{
            data: 'Day',
            title: 'Día',
            className: 'text-center'
        }];

        $.each(data.branches, function(k, v) {
            columns.push({
                data: v,
                render: function(data, type, row) {
                    return utils.formatMoney(data);
                },
                className: 'text-center'
            });
        });

        sales_table = $('#total_sales_table').DataTable({
            data: data.values,
            columns: columns,
            buttons: [
                'copy', 'excel'
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
            },
            dom: 'lrtip'
        });

        tables.exportButtons(sales_table, 'Ventas por Sucursal', "#export-buttons-hiden", "#export_menu", "Ventas por Sucursal");
    }

    function initTotalSalesProductGraphic(data, destroy) {
        var options = {
            chart: {
                fontFamily: 'inherit',
                type: 'treemap',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                treemap: {
                    distributed: true,
                    enableShades: false
                }
            },
            series: [{
                data: data
            }]
        };

        if (destroy) {
            sales_products_chart.destroy();
        }

        sales_products_chart = new ApexCharts(document.querySelector("#total_sales_products_g"), options);

        sales_products_chart.render();
    }

    function initTotalSalesProductTable(data, destroy) {

        if (destroy) {
            sales_products_table.destroy();
        }

        let columns = [{
            data: 'x',
            title: 'Producto',
            className: 'text-start px-3'
        }, {
            data: 'y',
            title: 'Ventas',
            className: 'text-center',
            render: function(data, type, row) {
                return utils.formatMoney(data);
            },
        }];

        sales_products_table = $('#total_sales_product_table').DataTable({
            pageLenght: 5,
            lengthMenu: [5, 10, 25, 50],
            data: data,
            columns: columns,
            buttons: [
                'copy', 'excel'
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
            },
            dom: 'lrtip'
        });

        tables.exportButtons(sales_products_table, 'Ventas por Producto', "#sales-by-product-export-buttons", "#sbp_export_menu", "Ventas por Producto");
    }

    function initTotalSalesDepartmentGraphic(data, destroy) {
        var options = {
            chart: {
                fontFamily: 'inherit',
                type: 'treemap',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                treemap: {
                    distributed: true,
                    enableShades: false
                }
            },
            series: [{
                data: data
            }]
        };

        if (destroy) {
            sales_department_chart.destroy();
        }

        sales_department_chart = new ApexCharts(document.querySelector("#total_sales_department_g"), options);

        sales_department_chart.render();
    }

    function initTotalSalesDepartmentTable(data, destroy) {

        if (destroy) {
            sales_department_table.destroy();
        }

        let columns = [{
            data: 'x',
            title: 'Producto',
            className: 'text-start px-3'
        }, {
            data: 'y',
            title: 'Ventas',
            className: 'text-center',
            render: function(data, type, row) {
                return utils.formatMoney(data);
            },
        }];

        sales_department_table = $('#total_sales_department_table').DataTable({
            pageLenght: 5,
            lengthMenu: [5, 10, 25, 50],
            data: data,
            columns: columns,
            buttons: [
                'copy', 'excel'
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
            },
            dom: 'lrtip'
        });

        tables.exportButtons(sales_department_table, 'Ventas por Departamento', "#sales-by-department-export-buttons", "#sbd_export_menu", "Ventas por Departamento");
    }

    let sales_chart;
    let sales_table;
    let sales_products_chart;
    let sales_products_table;
    let sales_department_chart;
    let sales_department_table;


});
