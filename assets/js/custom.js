//GLOBAL VARIABLES
var CONTROLLER_PATH = "controller/";
var VIEW_PATH = "view/";
var STR_ASK_DELETE = "¿Estás seguro de eliminar este registro?";
var STR_TRANSACTION_SUCCESS = "Transacción exitosa.";
var STR_NO_SE_ENCONTRARON_REGISTROS = "No se encontraron registros.";

var STR_CAMPO_REQUERIDO = "Este campo es requerido.";
var STR_POR_FAVOR_INGRESE_UN_NUMERO_VALIDO = "Por favor ingrese un número válido.";
var STR_POR_FAVOR_INGRESE_SOLO_NUMEROS_ENTEROS = "Por favor ingrese sólo números enteros.";
var STR_POR_FAVOR_INGRESE_EL_MISMO_VALOR = "Por favor ingrese el mismo valor.";
var STR_POR_FAVOR_INGRESE_UN_VALOR_DISTINTO = "Por favor ingrese un valor distinto.";
var STR_SOLO_SE_PERMITEN = "Sólo se permiten ";
var STR_CARACTERES_COMO_MAXIMO = " caracteres como máximo.";
var STR_CARACTERES_COMO_MINIMO = " caracteres como mínimo.";
var STR_POR_FAVOR_INGRESE_UN_NUMERO_MENOR_O_IGUAL_A = "Por favor ingrese un número menor o igual a ";
var STR_POR_FAVOR_INGRESE_UN_NUMERO_MAYOR_O_IGUAL_A = "Por favor ingrese un número mayor o igual a ";
var STR_POR_FAVOR_INGRESE_UN_EMAIL_VALIDO = "Por favor ingrese un email válido.";
var STR_POR_FAVOR_INGRESE_UNA_FECHA_VALIDA = "Por favor ingrese una fecha válida.";
var STR_POR_FAVOR_INICIE_CON = "Por favor inicie con ";
var STR_POR_FAVOR_INGRESE_UNA_FECHA_MENOR_O_IGUAL_A = "Por favor ingrese una fecha menor o igual a ";
var STR_POR_FAVOR_INGRESE_UNA_FECHA_MAYOR_O_IGUAL_A = "Por favor ingrese una fecha mayor o igual a ";

//VALIDATIONS
jQuery.extend(jQuery.validator.messages, {
    required: STR_CAMPO_REQUERIDO,
    //remote: "Please fix this field.",
    email: STR_POR_FAVOR_INGRESE_UN_EMAIL_VALIDO,
    //url: "Please enter a valid URL.",
    //date: "Please enter a valid date.",
    //dateISO: "Please enter a valid date (ISO).",
    number: STR_POR_FAVOR_INGRESE_UN_NUMERO_VALIDO,
    digits: STR_POR_FAVOR_INGRESE_SOLO_NUMEROS_ENTEROS,
    //creditcard: "Please enter a valid credit card number.",
    equalTo: STR_POR_FAVOR_INGRESE_EL_MISMO_VALOR,
    notEqualTo: STR_POR_FAVOR_INGRESE_UN_VALOR_DISTINTO,
    //accept: "Please enter a value with a valid extension.",
    maxlength: STR_SOLO_SE_PERMITEN + "{0}" + STR_CARACTERES_COMO_MAXIMO,
    minlength: STR_SOLO_SE_PERMITEN + "{0}" + STR_CARACTERES_COMO_MINIMO,
    //rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    //range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: STR_POR_FAVOR_INGRESE_UN_NUMERO_MENOR_O_IGUAL_A + "{0}",
    min: STR_POR_FAVOR_INGRESE_UN_NUMERO_MAYOR_O_IGUAL_A + "{0}",
    email: STR_POR_FAVOR_INGRESE_UN_EMAIL_VALIDO,
    dateITA: STR_POR_FAVOR_INGRESE_UNA_FECHA_VALIDA
});
jQuery.validator.addMethod("startWithValue", function (value, element, startValue) {
    startValueLength = startValue.length;
    newStartValue = value.substring(0, startValueLength);
    return newStartValue === startValue ? true : false;
}, STR_POR_FAVOR_INICIE_CON + "{0}");
jQuery.validator.addMethod("maxDate", function (value, element, maxDateString) {
    var maxDate = stringToDate(maxDateString);
    var validaDate = stringToDate(value);
    return this.optional(element) || (validaDate <= maxDate ? true : false) || (maxDateString == "" ? true : false);
}, STR_POR_FAVOR_INGRESE_UNA_FECHA_MENOR_O_IGUAL_A + "{0}");
jQuery.validator.addMethod("minDate", function (value, element, minDateString) {
    var minDate = stringToDate(minDateString);
    var validaDate = stringToDate(value);
    return this.optional(element) || (validaDate >= minDate ? true : false) || (minDateString == "" ? true : false);
}, STR_POR_FAVOR_INGRESE_UNA_FECHA_MAYOR_O_IGUAL_A + "{0}");
function stringToDate(dateString) {
    dateArray = dateString.split("/");
    return new Date(dateArray[2], dateArray[1] - 1, dateArray[0]);
}
//DATA
function askDelete(success) {
    bootbox.confirm({
        message: STR_ASK_DELETE,
        className: "fourth-modal",
        callback: success
    }).promise().done(function () {
        $(".modal-backdrop").last().addClass("fourth-modal-backdrop");
    });
}

function customAlert(data, callback) {
    bootbox.alert({
        message: data,
        className: "fourth-modal",
        callback: callback
    }).promise().done(function () {
        $(".modal-backdrop").last().addClass("fourth-modal-backdrop");
    });
}

function getModal(url) {
    $.post(VIEW_PATH + url, function (data) {
        bootbox.dialog({
            message: data,
            closeButton: true,
            onEscape: true
        });
    });
}

function getModalWithCallBack(url, success) {
    $.post(VIEW_PATH + url, function (data) {
        bootbox.dialog({
            message: data,
            closeButton: true,
            onEscape: true
        }).promise().done(success);
    });
}

function getModalWithCallBackSecond(url, success) {
    $.post(VIEW_PATH + url, function (data) {
        bootbox.dialog({
            message: data,
            closeButton: true,
            onEscape: true,
            className: "second-modal"
        }).promise().done(function () {
            $(".modal-backdrop").last().addClass("second-modal-backdrop");
        }).promise().done(success);
    });
}

function getModalLargeWithCallBack(url, success) {
    $.post(VIEW_PATH + url, function (data) {
        bootbox.dialog({
            message: data,
            closeButton: true,
            onEscape: true,
            size: 'large'
        }).promise().done(success);
    });
}

function getModalExtraLargeWithCallBack(url, success) {
    $.post(VIEW_PATH + url, function (data) {
        bootbox.dialog({
            message: data,
            closeButton: true,
            onEscape: true,
            size: 'extra-large'
        }).promise().done(success);
    });
}

function closeLastModal() {
    $(".bootbox-close-button.close").last().click()
}

function getHTMLContainer(url) {
    $.post(VIEW_PATH + url, function (data) {
        $("#container").html(data);
    });
}

function getHTMLContainerWithCallBack(url, success) {
    $.post(VIEW_PATH + url, function (data) {
        $("#container").html(data).promise().done(success);
    });
}

function getHTMLIntoDOM(url, element) {
    $.post(VIEW_PATH + url, function (data) {
        $(element).html(data);
    });
}

function getHTMLIntoDOMWithCallBack(url, element, success) {
    $.post(VIEW_PATH + url, function (data) {
        $(element).html(data).promise().done(success);
    });
}

function postJSON(url, data, success) {
    $.ajax({
        url: CONTROLLER_PATH + url,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(data),
        success: success
    });
}

function postJSONForm(url, formId, success) {
    data = getFormData($("#" + formId));
    $.ajax({
        url: CONTROLLER_PATH + url,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(data),
        success: success
    });
}

function getFormData(form) {
    var disabledElements = form.find(':input:disabled').removeAttr('disabled');
    var unindexed_array = form.serializeArray();
    disabledElements.attr('disabled', 'disabled');
    var indexed_array = {};
    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });
    //Add files
    /* var inputFiles = form.find("input[type=file]");
    jQuery.each(inputFiles, function (index, object) {
        indexed_array[object["name"]] = object['value'];
    }); */
    return indexed_array;
}

//EFECTS
function startTooltip() {
    $(".tooltip ").remove();
    $('[data-toggle="tooltip"]').tooltip();
}

function notifySuccess() {
    $.notify({
        icon: 'fa fa-check',
        message: STR_TRANSACTION_SUCCESS
    }, {
        type: 'success',
        z_index: 2000
    });
}

$.fn.datepicker.dates['es'] = {
    days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
    daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
    today: "Hoy",
    clear: "Limpiar",
    format: "dd/mm/yyyy",
    titleFormat: "MM yyyy", // Leverages same syntax as 'format' 
    weekStart: 0
};

function startSelect2ById(id) {
    $('#' + id).select2();
    $("#select2-" + id + "-container").addClass("form-control-sm");
}

function startDatePicker() {
    $(".form-control-date").datepicker({
        language: "es",
        todayBtn: "linked",
        clearBtn: !0,
        autoclose: true
    });
    $(".form-control-date").inputmask("datetime", {
        inputFormat: "dd/mm/yyyy"
    });
}

function startDecimalNumbers(integer, decimal) {
    $(".form-control-decimal").inputmask("9{1," + integer + "}[.9{1," + decimal + "}]");
}

function startNumbers(integer) {
    $(".form-control-number").inputmask("9{1," + integer + "}");
}

//UTILS

function formatArraySelect2(array, nameId, nameText) {
    var arrayModified = new Array();
    array.forEach(function (object, index) {
        objectModified = { id: object[nameId], text: object[nameText] }
        arrayModified.push(objectModified);

    });
    return arrayModified;
}

function destroyDataTableIfExists(nameTable) {
    if ($.fn.DataTable.isDataTable('#' + nameTable)) {
        $('#' + nameTable).DataTable().destroy();
    }
}

function getIntegerFromNumber(number) {
    if (number != null) {
        a = number.split(".");
        return a[0];
    } else {
        return "";
    }
}

function getDecimalFromNumber(number) {
    if (number != null) {
        a = number.split(".");
        return "." + a[1];
    } else {
        return "";
    }
}

function validErrorResponse(data) {
    try {
        c = JSON.parse(data);
    }
    catch (err) {
        bootbox.alert({
            message: data,
            size: 'extra-large',
            className: "fourth-modal"
        }).promise().done(function () {
            $(".modal-backdrop").last().addClass("fourth-modal-backdrop");
        });
        return true;
    }
    var responseData = JSON.parse(data);
    if (responseData.error) {
        var errorHTML =
            '<div class="alert alert-light fade show alert-bootbox-error" role="alert">' +
            '<div class="alert-icon"><i class="flaticon-warning kt-font-danger"></i></div>' +
            '<div class="alert-text">' +
            '<span class="error-bold">Code: </span>' +
            '<span class="text-muted">' + responseData.error_code + '</span><br>' +
            '<span class="error-bold">Error: </span>' +
            '<span class="text-muted">' + responseData.error + '</span><br>' +
            '<span class="error-bold">Script: </span>' +
            '<span class="text-muted">' + responseData.script + '</span>' +
            '</div>' +
            '</div>';
        customAlert(errorHTML);
        return true;
    } else if (responseData.error_message) {
        var errorHTML =
            '<div class="alert alert-light fade show alert-bootbox-error" role="alert">' +
            '<div class="alert-icon"><i class="flaticon-warning kt-font-danger"></i></div>' +
            '<div class="alert-text">' +
            '<span class="error-bold">Error: </span>' +
            '<span class="text-muted">' + responseData.error_message + '</span>' +
            '</div>' +
            '</div>';
        customAlert(errorHTML);
        return true;
    } else { return false };
}

//BlockUI
// override these in your code to change the default behavior and style 
$.blockUI.defaults = {
    // message displayed when blocking (use null for no message) 
    message: '<div class="kt-spinner  kt-spinner--brand "></div>',

    title: null,        // title string; only used when theme == true 
    draggable: true,    // only used when theme == true (requires jquery-ui.js to be loaded) 

    theme: false, // set to true to use with jQuery UI themes 

    // styles for the message when blocking; if you wish to disable 
    // these and use an external stylesheet then do this in your code: 
    // $.blockUI.defaults.css = {}; 
    css: {
        padding: 0,
        margin: 0,
        width: 'auto',
        top: '40%',
        left: '50%',
        textAlign: 'center',
        color: '#000',
        //border:         '3px solid #aaa', 
        backgroundColor: '#fff',
        cursor: 'wait'
    },

    // minimal style set used when themes are used 
    themedCSS: {
        width: '30%',
        top: '40%',
        left: '35%'
    },

    // styles for the overlay 
    overlayCSS: {
        backgroundColor: '#000',
        opacity: 0.6,
        cursor: 'wait'
    },

    // style to replace wait cursor before unblocking to correct issue 
    // of lingering wait cursor 
    cursorReset: 'default',

    // styles applied when using $.growlUI 
    growlCSS: {
        width: '350px',
        top: '10px',
        left: '',
        right: '10px',
        border: 'none',
        padding: '5px',
        opacity: 0.6,
        cursor: null,
        color: '#fff',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px'
    },

    // IE issues: 'about:blank' fails on HTTPS and javascript:false is s-l-o-w 
    // (hat tip to Jorge H. N. de Vasconcelos) 
    iframeSrc: /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank',

    // force usage of iframe in non-IE browsers (handy for blocking applets) 
    forceIframe: false,

    // z-index for the blocking overlay 
    baseZ: 1000,

    // set these to true to have the message automatically centered 
    centerX: !0, // <-- only effects element blocking (page block controlled via css above) 
    centerY: !0,

    // allow body element to be stetched in ie6; this makes blocking look better 
    // on "short" pages.  disable if you wish to prevent changes to the body height 
    allowBodyStretch: true,

    // enable if you want key and mouse events to be disabled for content that is blocked 
    bindEvents: true,

    // be default blockUI will supress tab navigation from leaving blocking content 
    // (if bindEvents is true) 
    constrainTabKey: true,

    // fadeIn time in millis; set to 0 to disable fadeIn on block 
    fadeIn: 200,

    // fadeOut time in millis; set to 0 to disable fadeOut on unblock 
    fadeOut: 400,

    // time in millis to wait before auto-unblocking; set to 0 to disable auto-unblock 
    timeout: 0,

    // disable if you don't want to show the overlay 
    showOverlay: true,

    // if true, focus will be placed in the first available input field when 
    // page blocking 
    focusInput: true,

    // suppresses the use of overlay styles on FF/Linux (due to performance issues with opacity) 
    // no longer needed in 2012 
    // applyPlatformOpacityRules: true, 

    // callback method invoked when fadeIn has completed and blocking message is visible 
    onBlock: null,

    // callback method invoked when unblocking has completed; the callback is 
    // passed the element that has been unblocked (which is the window object for page 
    // blocks) and the options that were passed to the unblock call: 
    //   onUnblock(element, options) 
    onUnblock: null,

    // don't ask; if you really must know: http://groups.google.com/group/jquery-en/browse_thread/thread/36640a8730503595/2f6a79a77a78e493#2f6a79a77a78e493 
    quirksmodeOffsetHack: 4,

    // class name of the message block 
    blockMsgClass: 'blockMsg',

    // if it is already blocked, then ignore it (don't unblock and reblock) 
    ignoreIfBlocked: false
};

$(document).ajaxStart(function () {
    //$.blockUI();
    startTooltip();
}).ajaxStop(function () {
    //$.unblockUI();
    startTooltip();
}
);

//Change URL
/* $(window).on("hashchange",function(){
    getHTMLContainer(location.hash.slice(1));
});
 */
var pages =
    [{
        name: "kardex",
        id: "menu-kardex",
        url: "kardex/list.html"
    }, {
        name: "proyecto",
        id: "menu-proyecto",
        url: "proyecto/list.html"
    }, {
        name: "ordenCompra",
        id: "menu-ordenCompra",
        url: "orden_compra/list.html"
    }, {
        name: "persona",
        id: "menu-persona",
        url: "persona/list.html"
    }, {
        name: "producto",
        id: "menu-producto",
        url: "producto/list.html"
    }, {
        name: "almacen",
        id: "menu-almacen",
        url: "almacen/list.html"
    }, {
        name: "unidadMedida",
        id: "menu-unidadMedida",
        url: "unidad_medida/list.html"
    }, {
        name: "emailTipo",
        id: "menu-emailTipo",
        url: "email_tipo/list.html"
    }, {
        name: "telefonoTipo",
        id: "menu-telefonoTipo",
        url: "telefono_tipo/list.html"
    }, {
        name: "estadoCivil",
        id: "menu-estadoCivil",
        url: "estado_civil/list.html"
    }, {
        name: "comprobantePagoTipo",
        id: "menu-comprobantePagoTipo",
        url: "comprobante_pago_tipo/list.html"
    }, {
        name: "formaPago",
        id: "menu-formaPago",
        url: "forma_pago/list.html"
    }, {
        name: "rol",
        id: "menu-rol",
        url: "rol/list.html"
    }, {
        name: "personaTipo",
        id: "menu-personaTipo",
        url: "persona_tipo/list.html"
    }, {
        name: "documentoIdentidad",
        id: "menu-documentoIdentidad",
        url: "documento_identidad/list.html"
    }, {
        name: "genero",
        id: "menu-genero",
        url: "genero/list.html"
    }, {
        name: "pago_contratista",
        id: "menu-pagoContratista",
        url: "pago_contratista/list.html"
    }, {
        name: "requerimiento",
        id: "menu-proyectoRequerimiento",
        url: "proyecto_requerimiento/list.html"
    }, {
        name: "avanceProyecto",
        id: "menu-avanceProyecto",
        url: "reporte/avance_proyecto.html"
    }];
//set the methods
$.map(pages, function (object, index) {
    $("#" + object.id).click(function () {
        changePage(object.name);
    });
});

function changePage(pageName) {
    classActiveMenu = "kt-menu__item--active";
    $("." + classActiveMenu).removeClass(classActiveMenu);
    $.map(pages, function (object, index) {
        if (object.name === pageName) {
            getHTMLContainer(object.url);
            $("#" + object.id).addClass(classActiveMenu);
            return;
        }
    });
}

//Alerts
function showAlerts() {
    postJSON("ProductoStockMinimo_C.php", { action: "alertByStockMinimo" }, function (dataAlertByStockMinimo) {
        var count = 0;
        var flagNotification = '<span class="kt-badge kt-badge--dot kt-badge--notify kt-badge--sm kt-badge--brand"></span>';
        if (!validErrorResponse(dataAlertByStockMinimo)) {
            listStock = JSON.parse(dataAlertByStockMinimo);
            if (typeof listStock !== 'undefined') {
                $.map(listStock, function (object, index) {
                    count++;
                    var html = `<a href="#" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="fa fa-cubes"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Stock (` + object.stock_minimo + `) por agotarse
                                        </div>
                                        <div class="kt-notification__item-time">
                                            ` + object.nombre + `
                                        </div>
                                    </div>
                                </a>`;

                    flagNotification = '<span class="kt-badge kt-badge--dot kt-badge--notify kt-badge--sm kt-badge--brand"></span>';
                    $("#notificationsList").append(html);
                });
            }
        }

        postJSON("ProyectoTrabajoPartida_C.php", { action: "alertBy90PercentFromPresupuesto" }, function (dataAlertBy90PercentFromPresupuesto) {
            if (!validErrorResponse(dataAlertBy90PercentFromPresupuesto)) {
                list90PercentFromPresupuesto = JSON.parse(dataAlertBy90PercentFromPresupuesto);
                if (typeof list90PercentFromPresupuesto !== 'undefined') {
                    $.map(list90PercentFromPresupuesto, function (object, index) {
                        count++;
                        var html = `<a href="#" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="fa fa-search-dollar"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title">
                                                Partida <strong>` + object.codigo + `</strong> sobrepasa el 90% del presupuesto
                                            </div>
                                            <div class="kt-notification__item-time">
                                                <strong>` + object.partida + `</strong> (` + object.unidad_medida_id + `)<br>
                                                <span>` + object.trabajo + `</span><br>
                                                <span>` + object.proyecto + `</span>
                                            </div>
                                        </div>
                                    </a>`;
                        $("#notificationsList").append(html);
                    });
                    if (count > 0) {
                        $("#notificationsCount").html(count + " Notificaciones.");
                        $("#flagNotification").append(flagNotification);
                    }
                }
            }
        });

    });
}

showAlerts();