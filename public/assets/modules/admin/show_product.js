import Events from '../shared/Events.js';
import ValidateForm from '../shared/ValidateForm.js';
import Alerts from '../shared/Alerts.js';
import Upload from '../shared/Upload.js';
import Utils from '../shared/Utils.js';
import Selects from '../shared/Selects.js';
import Buttons from '../shared/Buttons.js';
import ImageInput from '../shared/ImageInput.js';
import Tables from '../shared/Tables.js';

$(function() {
    const event = new Events();
    const fv = new ValidateForm();
    const alerts = new Alerts();
    const upload = new Upload();
    const utils = new Utils();
    const selects = new Selects();
    const buttons = new Buttons();
    const ii = new ImageInput();
    const table = new Tables();


    initMainProductImage();
    initProductStatus();
    initProductCategory();
    initProductHightlight();
    initProductTags();
    initGeneralForm();
    initImageGallery();
    initProductUnits();
    initPricingTab();
    initInventoryTab();

    function initMainProductImage() {
        const img_control = ii.instance('main_product_image');
        img_control.on('kt.imageinput.changed', function() {
            const image = img_control.getInputElement();
            let data = new FormData();
            data.append('image', image.files[0]);
            data.append('pid', utils.trim("#product_id"));
            data.append('_method', 'POST');
            event.postFile('/api_v1/products/main_image_upload', data, function(r) {
                if (r.code == 200) {
                    alerts.fire_toast(r.message, '', r.body.alert);
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }

    function initProductStatus() {
        selects.change("#product_status", function(s) {
            if (s.val() == 1) {
                $("#product_status_color").removeClass("bg-danger").addClass("bg-success");
            } else {
                $("#product_status_color").removeClass("bg-success").addClass("bg-danger");
            }

            event.post('/api_v1/products/status', {
                pid: utils.trim("#product_id"),
                active: s.val()
            }, function(r) {
                if (r.code == 200) {
                    alerts.fire_toast(r.message, '', r.body.alert);
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }

    function initProductHightlight() {
        selects.change("#product_highlight", function(s) {
            event.post('/api_v1/products/highlight', {
                pid: utils.trim("#product_id"),
                highlight: s.val()
            }, function(r) {
                if (r.code == 200) {
                    alerts.fire_toast(r.message, '', r.body.alert);
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }

    function initProductCategory() {
        selects.change("#product_category", function(s) {
            event.post('/api_v1/products/category', {
                pid: utils.trim("#product_id"),
                category: s.val()
            }, function(r) {
                if (r.code == 200) {
                    alerts.fire_toast(r.message, '', r.body.alert);
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }

    function initProductTags() {
        new Tagify(document.querySelector("#product_tags"));
        $("#product_tags").on("change", function() {
            $("#save_tags_button").removeClass('d-none');
        });

        buttons.initClick("#save_tags_button", function(btn) {
            btn.addClass('d-none');
            event.post('/api_v1/products/tags', {
                pid: utils.trim("#product_id"),
                tags: $("#product_tags").val()
            }, function(r) {
                if (r.code == 200) {
                    alerts.fire_toast(r.message, '', r.body.alert);
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }

    function initGeneralForm() {
        const descriptionEditor = new Quill('#product_description', {
            theme: 'snow'
        });

        $("#general_product_slug").on("keyup change", function() {
            $('#general_product_slug').val(utils.trim("#general_product_slug").toLowerCase().replace(/\s/g, '-'));
        });

        if ($('#general_product_form').length) {
            fv.validate("general_product_form", "general_product_button", {}, function() {
                let data = {
                    name: utils.trim("#general_product_name"),
                    key: utils.trim("#general_product_key"),
                    barcode: utils.trim("#general_product_barcode"),
                    slug: utils.trim("#general_product_slug"),
                    description: descriptionEditor.root.innerHTML,
                    _method: 'PUT'
                };

                event.post('/api_v1/products/' + utils.trim("#product_id"), data, function(r) {
                    buttons.removeLoadingButton(null, "general_product_button");
                    if (r.code == 200) {
                        alerts.fire_toast(r.message, '', r.body.alert);
                    } else {
                        alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                    }
                });
            });
        }
    }

    function initImageGallery() {
        if ($('#general_image_gallery').length) {
            let uploadZone = upload.init("#general_image_gallery", "/api_v1/products/gallery", "gallery", true);

            upload.addCallback(uploadZone, function(r) {
                processImageGalleryUpload(r);
            });

            upload.addData(uploadZone, {
                pid: utils.trim("#product_id")
            });

            buttons.initClick(".general_gallery_delete_button", function(btn) {
                let data = {
                    gid: btn.data('gallery')
                };

                event.post('/api_v1/products/gallery/delete', data, function(r) {
                    if (r.code == 200) {
                        alerts.fire_toast(r.message, '', r.body.alert);
                        $("#gallery-" + data.gid).remove();
                    } else {
                        alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                    }
                });
            });
        }
    }

    function processImageGalleryUpload(r) {
        if (r.code == 200) {
            alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                location.reload();
            });
        } else {
            alerts.fire(r.message, "warning", "Intentar de Nuevo", "warning", function() {
                location.reload();
            });
        }
    }

    function initProductUnits() {
        $("#general_product_units").on("change", function() {
            console.log("GH");
            $("#save_units_of_measure_button").removeClass('d-none');
        });

        buttons.initClick("#save_units_of_measure_button", function(btn) {
            btn.addClass('d-none');
            event.post('/api_v1/products/units', {
                pid: utils.trim("#product_id"),
                unit: $("#general_product_units").val()
            }, function(r) {
                buttons.removeLoadingButton(null, "save_units_of_measure_button");
                if (r.code == 200) {
                    alerts.fire_toast(r.message, '', r.body.alert);
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }

    function initPricingTab() {
        selects.change("#pricing-units-list", function() {
            $(".pricing-details").addClass("d-none");
            $("#pricing-details-" + $("#pricing-units-list").val()).removeClass("d-none");
        });

        Inputmask("$ 9,999.99", {
            "numericInput": true
        }).mask("#product_price");

        Inputmask("$ 9,999.99", {
            "numericInput": true
        }).mask("#fixed_discount");

        initDiscountOption();
        initPercentageDiscount();
        initFixedDiscountMax();
        initSavePrices();
    }

    function initDiscountOption() {
        $(".discount_option").on("change", function() {
            $(".discount_type_container").addClass("d-none");
            $("#" + $(this).data('container')).removeClass("d-none");
        });
    }

    function initPercentageDiscount() {
        $(".percent_discount_slider").each(function(index, element) {
            let slider = document.querySelector("#" + $(this).attr("id"));
            let label = document.querySelector("#" + $(this).data('label'));
            noUiSlider.create(slider, {
                start: label.innerHTML,
                step: 1,
                range: {
                    min: 0,
                    max: 100
                }
            });

            slider.noUiSlider.on("update", function(values, handle) {
                label.innerHTML = values[handle];
            });
        });
    }

    function initFixedDiscountMax() {
        $("#fixed_discount").on("keyup change", function() {
            let fixedDiscountVal = removeCurrencyMask($("#fixed_discount").val());
            let productPrice = removeCurrencyMask(utils.trim("#product_price"));
            if (fixedDiscountVal >= productPrice) {
                $(this).val(productPrice - 1);
            }
        });
    }

    function initSavePrices() {
        buttons.initClick("#save_product_prices", function(btn) {
            let data = {
                pid: utils.trim("#product_id"),
                price: removeCurrencyMask(utils.trim("#product_price")),
                discount_type: $('input[name="discount_option"]:checked').val(),
                discount_percent: $("#discount_label").html(),
                discount_fixed: removeCurrencyMask($("#fixed_discount").val())
            };

            event.post('/api_v1/products/prices', data, function(r) {
                buttons.removeLoadingButton(null, "save_product_prices");
                if (r.code == 200) {
                    alerts.fire_toast(r.message, '', r.body.alert);
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });
        });
    }

    function removeCurrencyMask(value) {
        return value.replace(/[^0-9\.]+/g, "");
    }

    function initInventoryTab() {
        buttons.initClick("#product_stock_save_button", function(btn) {
            let stocks = [];
            $(".product_stock").each(function(index, element) {
                stocks.push({
                    pid: utils.trim("#product_id"),
                    branch: $(element).data('branch'),
                    stock: element.value
                });
            });

            event.post('/api_v1/products/stock', {
                stocks: stocks
            }, function(r) {
                buttons.removeLoadingButton(null, "product_stock_save_button");
                if (r.code == 200) {
                    alerts.fire_toast(r.message, '', r.body.alert);
                } else {
                    alerts.fire(r.message || "Ocurrió un error al procesar la solicitud", "warning", "Continuar", "primary");
                }
            });

        });

        initProductMovementsTable();
    }

    function initProductMovementsTable() {
        table.initTableCR("#product_movements_table", {
            scrollX: true,
            order: [
                [0, 'desc']
            ],
        }, () => {

        }, true, "Product Movements", "#export-buttons-hiden");
    }



});