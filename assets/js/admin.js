//Get Menu Items
postJSON("RolPermiso_C.php", { action: "listByPersona" }, function (data) {
    if (!validErrorResponse(data)) {
        pages = JSON.parse(data);
        $.map(pages, function (object, index) {
            if (object.tipo === "MENU") {
                $("#" + object.accion).removeClass("-menu-");
                $("#" + object.accion).data("url", object.url);
                $("#" + object.accion).click(function () {
                    changePage(object);
                });
            } else if (object.tipo === "MODULO") {
                $("#" + object.accion).removeClass("-modulo-");
            }
        });
        $(".-menu-").remove();
        $(".-modulo-").remove();
    }
});

function changePage(object) {
    classActiveMenu = "kt-menu__item--active";
    $("." + classActiveMenu).removeClass(classActiveMenu);
    getHTMLContainer(object.url);
    $("#" + object.accion).addClass(classActiveMenu);
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
                }
            }

            postJSON("ProyectoRequerimiento_C.php", { action: "alertNew" }, function (dataAlertNew) {
                if (!validErrorResponse(dataAlertNew)) {
                    listNew = JSON.parse(dataAlertNew);
                    if (typeof listNew !== 'undefined') {
                        $.map(listNew, function (object, index) {
                            count++;
                            var html = `<a href="#" class="kt-notification__item" onclick="changePage({tipo:'MENU',accion:'menu-proyectoRequerimiento',url:'proyecto_requerimiento/list.html'})">
                                            <div class="kt-notification__item-icon">
                                                <i class="fa fa-list-ol"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    Nuevo requerimiento <strong>(` + object.codigo + `)</strong>
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    <strong>` + object.fecha_pedido + `</strong>
                                                </div>
                                            </div>
                                        </a>`;
                            $("#notificationsList").append(html);
                        });
                    }
                }

                postJSON("ProyectoCronogramaPago_C.php", { action: "alert8Days" }, function (dataAlertNew) {
                    if (!validErrorResponse(dataAlertNew)) {
                        listNew = JSON.parse(dataAlertNew);
                        if (typeof listNew !== 'undefined') {
                            $.map(listNew, function (object, index) {
                                count++;
                                var html = `<a href="#" class="kt-notification__item" onclick="changePage({tipo:'MENU',accion:'menu-ventas',url:'proyecto_venta/list.html'})">
                                                <div class="kt-notification__item-icon">
                                                    <i class="fa fa-list-ol"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        La cuota del cliente <strong>(` + object.nombre_1 + ` ` + object.nombre_2 + ` ` + object.nombre_3 + ` ` + object.apellido_paterno + ` ` + object.apellido_materno + ` ` + +`)</strong>
                                                        se vence en 8 días.
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        <strong>` + object.fecha_programada + `</strong>
                                                    </div>
                                                </div>
                                            </a>`;
                                $("#notificationsList").append(html);
                            });
                        }
                        if (count > 0) {
                            $("#notificationsCount").html(count + " Notificaciones.");
                            $("#flagNotification").append(flagNotification);
                        }
                    }
                });
            });

        });

    });
}

showAlerts();