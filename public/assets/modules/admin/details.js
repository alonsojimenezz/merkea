import Events from '../shared/Events.js';
import DTables from '../shared/Tables.js';
import ValidateForm from '../shared/ValidateForm.js';
import Alerts from '../shared/Alerts.js';
import Upload from '../shared/Upload.js';
import Utils from '../shared/Utils.js';
import Selects from '../shared/Selects.js';
import Dates from '../shared/Dates.js';
import Buttons from '../shared/Buttons.js';

$(function() {
    const event = new Events();
    const table = new DTables();
    const fv = new ValidateForm();
    const alerts = new Alerts();
    const upload = new Upload();
    const utils = new Utils();
    const selects = new Selects();
    const dates = new Dates();
    const buttons = new Buttons();


    if ($("a.nav-link[href$='/details']").hasClass("active")) {
        initDetailsTab();
    } else if ($("a.nav-link[href$='/comments']").hasClass("active")) {
        initCommentsTab();
    } else if ($("a.nav-link[href$='/files']").hasClass("active")) {
        initFilesTab();
    }



    buttons.initClick(".status_button", function(btn) {
        let data = {
            request: utils.trim("#request_id"),
            status: btn.data("status"),
        };

        event.post('/Requests/UpdateStatus', data, function(r) {
            if (r.code == 200) {
                alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                    location.reload();
                });
            } else {
                alerts.fire(r.message, "warning", "Intentar de Nuevo", "warning", function() {
                    location.reload();
                });
            }
        });
    });

    /*Details Tab*/

    function initDetailsTab() {
        dates.init("#request_due_date", "Y-m-d", "d/m/Y", new Date().fp_incr(1));
        initRequestDetailsFormValidate(function() {
            let data = {
                request: utils.trim("#request_id"),
                subject: utils.trim("#request_subject"),
                description: utils.trim("#request_description"),
                priority: $("#request_priority option:selected").val(),
                due_date: utils.trim("#request_due_date"),
                assigned: $("#request_assigned option:selected").val(),
            };

            event.post('/Requests/saveRequestsChanges', data, function(r) {
                buttons.removeLoadingButton(null, "edit_request_button");
                alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                    location.reload();
                });
            }, function() {
                alerts.fire(r.message, "warning", "Intentar de Nuevo", "warning", function() {
                    location.reload();
                });
            });
        });
    }

    function initRequestDetailsFormValidate(callback = () => {}) {
        fv.validate("details_request_form", "edit_request_button", {
            'request_subject': {
                validators: {
                    notEmpty: {
                        message: 'El asunto es requerido'
                    }
                }
            },
            'request_priority': {
                validators: {
                    notEmpty: {
                        message: 'La prioridad es requerida'
                    }
                }
            },
            'request_due_date': {
                validators: {
                    notEmpty: {
                        message: 'La fecha de vencimiento es requerida'
                    }
                }
            },
            'request_assigned': {
                validators: {
                    notEmpty: {
                        message: 'El usuario asignado es requerido'
                    }
                }
            }
        }, callback);
    }

    /*End Details Tab*/

    /*Comments Tab*/
    function initCommentsTab() {
        let uploadZone = upload.init("#conversation_attachments", "/Requests/Conversation/newConversationNote", "conversation_attachments");
        initConversationRequestFormValidate(function() {
            let data = {
                request_id: utils.trim("#request_id"),
                message: utils.trim("#conversation_message"),
            };

            if (upload.files(uploadZone).length > 0) {
                upload.addCallback(uploadZone, function(r) {
                    proccessNewConversationResponse(r);
                });

                upload.addData(uploadZone, data);
                upload.processQueue(uploadZone);
            } else {
                event.post('/Requests/Conversation/newConversationNote', data, function(r) {
                    proccessNewConversationResponse(r);
                });
            }
        });

        initCommentsAttachments();
    }

    function initConversationRequestFormValidate(callback = () => {}) {
        fv.validate("new_conversation_form", "send_request_conversation_button", {
            'conversation_message': {
                validators: {
                    notEmpty: {
                        message: 'El mensaje es requerido para guardar la conversación'
                    }
                }
            }
        }, callback);
    }

    function proccessNewConversationResponse(r) {
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

    function initCommentsAttachments() {
        buttons.initClick(".conversation_files", function(btn) {
            let url = btn.data("url") || '';
            if (url != '') {
                window.open(url, '_blank');
            }
        });
    }

    /*End Comments Tab*/

    /*Files Tab */

    function initFilesTab() {
        let uploadZone = upload.init("#request_attachments", "/Requests/Files/uploadFile", "request_attachments", true);
        upload.addCallback(uploadZone, function(r) {
            proccessRequestFileUpload(r);
        });

        upload.addData(uploadZone, {
            request_id: utils.trim("#request_id"),
        });

        buttons.initClick(".file_symbol_link", function(btn) {
            let file = {
                id: btn.data("id"),
                title: btn.data("title"),
                filename: btn.data("filename"),
                description: btn.data("description"),
                attachment: btn.data("attachment"),
                date: btn.data("date"),
                owner: btn.data("owner"),
                type: btn.data("type"),
                typeid: btn.data("typeid"),
                ownerInitials: btn.data("ownerinitials"),
                ownerName: btn.data("ownername"),
                ownerEmail: btn.data("owneremail")
            };

            setModalFileDetails(file);
        });

        buttons.initClick("#file_details_save_button", function(btn) {
            initSaveFileDetails(btn);
        });
    }

    function proccessRequestFileUpload(r) {
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

    function initSaveFileDetails(btn) {
        let data = {
            id: $("#file_details_save_button").data("id"),
            title: utils.trim("#file_form_title"),
            description: utils.trim("#file_form_description"),
            type: utils.trim("#file_details_typeid")
        };

        event.post('/Requests/Files/saveFileChanges', data, function(r) {
            buttons.removeLoadingButton(null, "file_details_save_button");
            if (r.code == 200) {
                alerts.fire(r.body.alert, "success", "Continuar", "primary", function() {
                    location.reload();
                });
            } else {
                alerts.fire(r.message, "warning", "Intentar de Nuevo", "warning", function() {
                    location.reload();
                });
            }

        });
    }

    function setModalFileDetails(file) {
        $("#file_details_type").val(file.type);
        $("#file_details_typeid").val(file.typeid);
        $("#file_details_date").empty().append(file.date);
        $(".file_details_link").attr("href", file.attachment);
        $("#file_details_title").empty().append(file.title);
        $("#file_details_filename").empty().append(file.filename);
        $("#file_details_description").empty().append(file.description);
        $("#file_details_attachment").css("background-image", "url('" + file.attachment + "')");

        $("#file_form_title").val(file.title);
        $("#file_form_description").val(file.description);
        $("#file_details_save_button").data("id", file.id);

        $("#file_owner").empty().append(file.ownerName);
        $("#file_owner_email").empty().append(file.ownerEmail);
        $("#file_owner_initials").empty().append(file.ownerInitials);


        if (file.owner != 1) {
            $("#file_form_title").val(file.title).attr("disabled", "disabled");
            $("#file_form_description").val(file.description).attr("disabled", "disabled");
            $("#file_details_save_button").hide();
        } else {
            $("#file_form_title").removeAttr("disabled");
            $("#file_form_description").removeAttr("disabled");
            $("#file_details_save_button").show();
        }


        $("#file_details_modal").modal("show");
    }

    /*End Files Tab*/

});