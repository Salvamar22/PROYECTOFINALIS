/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

$(document).ready(function () {

    /*
    FUNCION DEL CONTADOR GENERAL / TOTAL DE VISITAS
    */

    // Función para cargar Contador
    function loadCount() {

        $.ajax({
            type: "POST",
            url: "/public_html/controllers/UserController.php",
            data: { action: 'count' },
            success: function (count) {
                //console.log("Ingresa en el AJAX para mostrar contador en count.php");
                //console.log(count);

                var visit_count = JSON.parse(count);
                //console.log(visit_count.total_visitas);
                $('#text-3d').html(visit_count.total_visitas);
            },
            error: function (error) {
                console.error("Error al cargar el Contador General.", error);
            }
        });
    }

    // Cargar el Contador General al mostrar count.php
    if (window.location.pathname.endsWith('count.php')) {
        // Actualiza el contador cada 5 segundos (5000 milisegundos)
        setInterval(loadCount, 5000);
    }

    /*
    FUNCION PARA INGRESAR
    */

    // Manejar clic en el botón "Panel Administrador" utilizando AJAX
    $("#enterBtn").on("click", function () {
        // Redireccionar a admin.php para mostrar los datos en la página
        window.location.href = "/public_html/views/admin.php";
    });

    /*
    FUNCIONES GENERALES PARA MOSTRAR MENSAJE DE ERROR O MENSAJE CORRECTO
    */

    function validateError(inputMsg, msgAlert) {
        inputMsg.removeClass('hide-element').removeClass('success-message').addClass('error-message');
        inputMsg.text(msgAlert);

        setTimeout(function () {
            //inputMsg.fadeOut();
            inputMsg.removeClass('error-message').addClass('hide-element');
        }, 3000);

    }

    function validateOk(inputMsg, msgAlert) {
        inputMsg.removeClass('hide-element').removeClass('error-message').addClass('success-message');
        inputMsg.text(msgAlert);

        setTimeout(function () {
            //inputMsg.fadeOut();
            inputMsg.removeClass('success-message').addClass('hide-element');
        }, 3000);

    }

    /*
    FUNCIONES PARA INICIAR/CERRAR SESION
    */

    // Manejar validación para Login o para Iniciar sesion
    function validateLoginInputs() {
        var form = $('#loginForm');

        // Input de Texto
        var user = $('#usernameLoginInput');
        var pass = $('#passwordLoginInput');

        // Párrafo de cada Input
        var userMsg = $('#userLoginMsg');
        var passMsg = $('#passLoginMsg');

        // Variables Booleanas (Falso - Veredadero)
        var userState = false;
        var passState = false;

        // Capturar los valores ingresados por el usuario
        var usuarioValor = user.val().trim();
        var contraValor = pass.val().trim();
        /*
        if (!usuarioValor && !contraValor) {
            validateError(pass, passMsg, 'Usuario y Contraseña vacios');
            restartClass(passMsg, 'error-message');
        } else if (usuarioValor && !contraValor) {
            validateOk(userMsg, "Correcto");
            restartClass(userMsg, 'success-message');
            validateError(pass, passMsg, 'Campo de Contraseña vacía');
            restartClass(passMsg, 'error-message');
        } else {
            */
        // Validando campo Usuario / Nombre de Usuario
        if (!usuarioValor) {
            validateError(userMsg, 'Campo de usuario vacío');
        } else if (usuarioValor.length < 4) {
            validateError(userMsg, 'Usuario incorrecto');
        } else {
            validateOk(userMsg, "Correcto");
            //restartClass(userMsg, 'success-message');
            userState = true;
        }

        // Validando campo Contraseña
        var er = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,18}$/;
        if (!contraValor) {
            validateError(passMsg, 'Campo de Contraseña vacío');
        } else if (contraValor.length < 6) {
            validateError(passMsg, 'Contraseña incorrecta'); //Debe tener 6 caracteres cómo mínimo.
        } else if (!contraValor.match(er)) {
            validateError(passMsg, 'Contraseña incorrecta'); //Debe tener al menos una may., una min. y un núm.
        } else {
            validateOk(passMsg, "Correcto");
            //restartClass(passMsg, 'success-message');
            passState = true;
        }
        //}

        if (userState == true && passState == true) {
            return true;
        } else {
            return false;
        }
    }

    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        let username = $('#usernameLoginInput').val();
        let password = $('#passwordLoginInput').val();

        $.ajax({
            url: "/public_html/controllers/LoginController.php",
            type: 'POST',
            data: { action: 'login', username: username, password: password },
            success: function (response) {
                let data = JSON.parse(response);
                if (data.status === 'administrador') {
                    window.location.href = 'admin.php';
                } else if (data.status === 'colaborador') {
                    window.location.href = 'partner.php';
                } else {
                    // Mostrar mensaje de éxito
                    $("#errorMessage").text("Usuario o contraseña incorrectos.").fadeIn();

                    // Limpiar el formulario después de 3 segundos
                    setTimeout(function () {
                        $("#errorMessage").fadeOut();
                    }, 3000);
                }
            }
        });
    });

    $('#redirectToLogin').on('click', function () {
        window.location.href = "/public_html/views/login.php";
        $('#sessionExpiredModal').modal('hide');
    });

    /*
    FUNCIONES DEL PANEL ADMINISTRADOR
    */

    // Manejar clic en el botón "Panel Administrador" utilizando AJAX
    $("#adminPanel").on("click", function () {
        // Redireccionar a admin.php para mostrar los datos en la página
        window.location.href = "/public_html/views/admin.php";
    });

    // Cargar datos al mostrar admin.php
    if (window.location.pathname.endsWith('admin.php')) {
        loadAdminDashboard();
    }

    // Función para cargar dashboard para Administrador
    function loadAdminDashboard() {

        $.ajax({
            type: "POST",
            url: "/public_html/controllers/UserController.php",
            data: { action: 'admin' },
            success: function (admin_dashboard) {
                //console.log("Ingresa en el AJAX para mostrar dashboard de Administrador");
                //console.log(admin_dashboard);

                //var admin = JSON.parse(admin_dashboard);
                $('#adminDashboard').html(admin_dashboard);
            },
            error: function (error) {
                console.error("Error al cargar los dashboard para Administrador.", error);
            }
        });
    }

    /*
    FUNCIONES DE COLABORADORES PARA ADMINISTRADOR
    */

    // Manejar clic en el botón "Restablecer" de partnerForm.php
    $("#resetPartnerForm").on("click", function () {
        $("#partnerForm")[0].reset();
    });

    // Manejar clic en el botón "Registrar Colaboradores" utilizando AJAX
    $("#formPartner").on("click", function () {
        // Redireccionar a partnerForm.php para registrar los datos del Colaborador
        window.location.href = "/public_html/views/partner/partnerForm.php";
    });

    // Cargar función al mostrar partnerForm.php
    if (window.location.pathname.endsWith('partnerForm.php')) {
        validationDate();
    }

    // Manejar fecha mínima y máxima del Input tipo date
    function validationDate() {
        var today = new Date();
        var minDate = '1900-01-01';
        var maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate()).toISOString().split('T')[0];

        $('#inputDateBirthPartner').attr('min', minDate);
        $('#inputDateBirthPartner').attr('max', maxDate);
    }

    // Manejar validación para Ingresar o Registrar y Actualizar Colaboradores
    function validatePartnerInputs(name, nameMsg, lastName, lastNameMsg, dui, duiMsg, address, addressMsg, email, emailMsg, phone, phoneMsg, date, dateMsg) {

        // Variables Booleanas (Falso - Veredadero)
        var nameState = false;
        var lastNameState = false;
        var duiState = false;
        var addressState = false;
        var emailState = false;
        var phoneState = false;
        var dateState = false;

        // Capturar los valores ingresados
        var nombreValor = name.val().trim();
        var apellidoValor = lastName.val().trim();
        var duiValor = dui.val().trim();
        var direccionValor = address.val().trim();
        var correoValor = email.val().trim();
        var celularValor = phone.val().trim();
        var fechaValor = date.val().trim();

        // Expresiones regulares
        var namePattern = /^[a-zA-ZÁÉÍÓÚáéíóúñÑ]+(?:[\s'-][a-zA-ZÁÉÍÓÚáéíóúñÑ]+)*$/;
        var duiPattern = /^\d{9}$|^\d{8}-\d{1}$/;
        var addressPattern = /^[a-zA-Z0-9ÁÉÍÓÚáéíóúñÑ,.#\-\s]+$/;
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var phonePattern = /^\d{8}$|^\d{4}-\d{4}$/;
        var datePattern = /^\d{4}-\d{2}-\d{2}$/; ///^\d{2}-(ene|feb|mar|abr|may|jun|jul|ago|sep|oct|nov|dic)-\d{4}$/;

        // Validando campo Nombre de Colaborador
        if (!nombreValor) {
            validateError(nameMsg, 'Campo de Nombre vacío.');
        } else if (nombreValor.length < 3) {
            validateError(nameMsg, 'Debe tener 3 caracteres mínimo.');
        } else if (!nombreValor.match(namePattern)) {
            validateError(nameMsg, 'No debe tener ciertos caracteres especiales o numeros.');
        } else {
            validateOk(nameMsg, "¡Correcto!");
            nameState = true;
        }

        // Validando campo Apellido de Colaborador
        if (!apellidoValor) {
            validateError(lastNameMsg, 'Campo de Apellido vacío.');
        } else if (apellidoValor.length < 4) {
            validateError(lastNameMsg, 'Debe tener 4 caracteres mínimo.');
        } else if (!apellidoValor.match(namePattern)) {
            validateError(lastNameMsg, 'No debe tener ciertos caracteres especiales o numeros.');
        } else {
            validateOk(lastNameMsg, "¡Correcto!");
            lastNameState = true;
        }

        // Validando campo DUI de Colaborador
        if (!duiValor) {
            validateError(duiMsg, 'Campo de DUI vacío.');
        } else if (duiValor.length < 9) {
            validateError(duiMsg, 'Debe tener 9 digitos o formato XXXXXXXX-X.');
        } else if (!duiValor.match(duiPattern)) {
            validateError(duiMsg, 'Debe tener numeros en formato XXXXXXXXX o XXXXXXXX-X.');
        } else {
            validateOk(duiMsg, "¡Correcto!");
            duiState = true;
        }

        // Validando campo Dirección de Colaborador
        if (!direccionValor) {
            validateError(addressMsg, 'Campo de Dirección vacío.');
        } else if (!direccionValor.match(addressPattern)) {
            validateError(addressMsg, 'Escribe una dirección correcta.');
        } else {
            validateOk(addressMsg, "¡Correcto!");
            addressState = true;
        }

        // Validando campo Correo/Email de Colaborador
        if (!correoValor) {
            validateError(emailMsg, 'Campo de Correo vacío.');
        } else if (!correoValor.match(emailPattern)) {
            validateError(emailMsg, 'Escribe un correo correcto, ej. usuario@correo.com.');
        } else {
            validateOk(emailMsg, "¡Correcto!");
            emailState = true;
        }

        // Validando campo Celular de Colaborador
        if (!celularValor) {
            validateError(phoneMsg, 'Campo de Celular vacío.');
        } else if (celularValor.length < 8) {
            validateError(phoneMsg, 'Debe tener 8 digitos o formato XXXX-XXXX.');
        } else if (!celularValor.match(phonePattern)) {
            validateError(phoneMsg, 'Escribe un celular correcto, ej. formato XXXX-XXXX.');
        } else {
            validateOk(phoneMsg, "¡Correcto!");
            phoneState = true;
        }

        // Validando campo Fecha de Colaborador
        var today = new Date();
        var minDate = '1900-01-01';
        var maxDateObj = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
        var maxDate = maxDateObj.toISOString().split('T')[0];
        // Convertir maxDate al formato día-mes-año
        var day = String(maxDateObj.getDate()).padStart(2, '0');
        var month = maxDateObj.toLocaleString('es-ES', { month: 'short' });
        var year = maxDateObj.getFullYear();
        var maxDateFormatted = `${day}-${month}-${year}`;

        if (!fechaValor) {
            validateError(dateMsg, 'Campo de Fecha vacío.');
        } else if (!fechaValor.match(datePattern)) {
            validateError(dateMsg, 'Escribe una fecha correcta, ej. formato día-mes-año.');
        } else if (fechaValor < minDate || fechaValor > maxDate) {
            validateError(dateMsg, 'La fecha debe estar entre 01-ene-1900 y ' + maxDateFormatted);
        } else {
            validateOk(dateMsg, "¡Correcto!");
            dateState = true;
        }

        // Validar el estado de todos los Input del Formulario de Colaboradores y retornar True o False
        if (nameState == true && lastNameState == true && duiState == true && addressState == true && emailState == true && phoneState == true && dateState == true) {
            return true;
        } else {
            return false;
        }
    }

    // Manejar clic en el botón "Guardar" utilizando AJAX
    $("#savePartner").on("click", function () {

        // Input de Texto
        var name = $('#inputNamePartner');
        var lastName = $('#inputLastNamePartner');
        var dui = $('#inputDuiPartner');
        var address = $('#inputAddressPartner');
        var email = $('#inputEmailPartner');
        var phone = $('#inputPhonePartner');
        var date = $('#inputDateBirthPartner');

        // Párrafo de cada Input
        var nameMsg = $('#partnerNameMsg');
        var lastNameMsg = $('#partnerLastNameMsg');
        var duiMsg = $('#partnerDuiMsg');
        var addressMsg = $('#partnerAddressMsg');
        var emailMsg = $('#partnerEmailMsg');
        var phoneMsg = $('#partnerPhoneMsg');
        var dateMsg = $('#partnerDateMsg');

        estado = validatePartnerInputs(name, nameMsg, lastName, lastNameMsg, dui, duiMsg, address, addressMsg, email, emailMsg, phone, phoneMsg, date, dateMsg);

        if (estado) {
            // Obtener los datos del formulario
            var formData = $("#partnerForm").serialize();

            // Realizar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: "/public_html/controllers/PartnerController.php",
                data: formData,
                success: function (response) {
                    // Mostrar mensaje de éxito
                    $("#mensajeExito").text("¡El colaborador se ha registrado exitosamente!").fadeIn();

                    // Limpiar el formulario después de 3 segundos
                    setTimeout(function () {
                        $("#partnerForm")[0].reset();
                        $("#mensajeExito").fadeOut();
                        $('#partnerNameMsg').removeClass('success-message').addClass('hide-element');
                        $('#partnerLastNameMsg').removeClass('success-message').addClass('hide-element');
                        $('#partnerDuiMsg').removeClass('success-message').addClass('hide-element');
                        $('#partnerAddressMsg').removeClass('success-message').addClass('hide-element');
                        $('#partnerEmailMsg').removeClass('success-message').addClass('hide-element');
                        $('#partnerPhoneMsg').removeClass('success-message').addClass('hide-element');
                        $('#partnerDateMsg').removeClass('success-message').addClass('hide-element');
                    }, 3000);
                },
                error: function (error) {
                    console.error("Error en la solicitud AJAX", error);
                }
            });

        } else {
            console.log("Los campos de Colaborador no se llenaron correctamente.");
        }

    });

    // Manejar clic en el botón "Listar Colaboradores" utilizando AJAX
    $("#listPartner").on("click", function () {
        // Redireccionar a partnerList.php para mostrar los datos en la página
        window.location.href = "/public_html/views/partner/partnerList.php";
    });

    // Cargar datos al mostrar partnerList.php
    if (window.location.pathname.endsWith('partnerList.php')) {
        loadPartners();
    }

    // Función para cargar la lista de colaboradores
    function loadPartners() {
        $("#inputPartnerSearch").focus();
        $.ajax({
            type: "POST",
            url: "/public_html/controllers/PartnerController.php",
            data: { action: 'list_partners' },
            success: function (list_partner) {
                //console.log("Ingresa en el AJAX para mostrar los colaboradores");
                //console.log(list_partner);

                var partners = JSON.parse(list_partner);
                var html = '';
                partners.forEach(function (partner) {
                    html += '<tr>';
                    html += '<td class="d-none" data-title="Codigo">' + partner.idColaborador + '</td>'; //Se ha ocultado esta columna
                    html += '<td class="text-truncate" style="max-width: 100px;" data-title="Nombres:">' + partner.nombres + '</td>'; //Se ha dado formato con clase text-truncate y max-width
                    html += '<td class="text-truncate" style="max-width: 100px;" data-title="Apellidos:">' + partner.apellidos + '</td>'; //Se ha dado formato con clase text-truncate y max-width
                    html += '<td class="text-truncate" style="max-width: 110px;" data-title="DUI:">' + partner.dui + '</td>'; //Se ha dado formato con clase text-truncate y max-width
                    html += '<td class="text-truncate" style="max-width: 325px;" data-title="Direccion:">' + partner.direccion + '</td>'; //Se ha dado formato con clase text-truncate y max-width
                    html += '<td class="text-truncate" style="max-width: 250px;" data-title="Correo:">' + partner.correo + '</td>'; //Se ha dado formato con clase text-truncate y max-width
                    html += '<td class="text-truncate" style="max-width: 100px;" data-title="Celular:">' + partner.celular + '</td>'; //Se ha dado formato con clase text-truncate y max-width
                    html += '<td data-title="Fecha Nac.:">' + partner.fechaNacimiento + '</td>';
                    html += '<td class="d-none" data-title="Fecha Cont.:">' + partner.fechaContratacion + '</td>'; //Se ha ocultado esta columna
                    // Agregar botones de acciones (Editar y Eliminar)
                    html += '<td class="text-center">';
                    if (partner.idColaborador == 1) {
                        html += '<button class="btn btn-primary btn-editPartner" data-bs-toggle="modal" data-bs-target="#editPartnerModal"><i class="bi bi-pencil"></i></button>';
                    } else {
                        html += '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
                        html += '<button type="button" class="btn btn-primary btn-editPartner" data-bs-toggle="modal" data-bs-target="#editPartnerModal"><i class="bi bi-pencil"></i></button>';
                        html += '<button type="button" class="btn btn-danger btn-deletePartner" data-bs-toggle="modal" data-bs-target="#deletePartnerModal" data-id="' + partner.idColaborador + '"><i class="bi bi-trash3"></i></button>';
                        html += '</div>';
                    }
                    html += '</td>';
                    html += '</tr>';
                });
                $('#partnerTable tbody').html(html);
            },
            error: function (error) {
                console.error("Error al cargar la lista de colaboradores", error);
            }
        });
    }

    // Evento/s al cambiar/seleccionar Radio Button Diferente
    $('input[name="partner-options"]').on("change", function () {
        $("#inputPartnerSearch").val('');
        loadPartners();
    });

    /*
    // Evento de búsqueda de Colaborador General
    $("#inputPartnerSearch").on("keyup", function() {
        var searchValue = $(this).val().toLowerCase();
        $("#partnerTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1)
        });
    });
    */

    // Evento de búsqueda de Colaborador según criterio de Radio Button
    $("#inputPartnerSearch").on("keyup", function () {
        var searchTerm = $(this).val().toLowerCase();
        var column = $('input[name="partner-options"]:checked').data('column');
        $('#partnerTable tbody tr').filter(function () {
            $(this).toggle($(this).find('td').eq(column).text().toLowerCase().indexOf(searchTerm) > -1)
        });
    });

    /*
    FUNCIONES PARA DESCARGAR EXCEL DE COLABORADORES
    */

    // Función para generar Arreglo de Colaboradores
    function generatePartnerData() {
        var data = [];
        var headers = ['Código', 'Nombre', 'Apellido', 'DUI', 'Dirección', 'Correo', 'Celular', 'Fecha de Nacimiento', 'Fecha de Contratación'];

        data.push(headers);

        $('table tbody tr').each(function () {
            var row = [];
            $(this).find('td').each(function (index) {
                if (index !== 9) { // Se excluye la columna "Acciones"
                    row.push($(this).text());
                }
            });
            data.push(row);
        });
        return data;
    }

    // Función para manejar el clic del botón "Exportar Excel" de Colaboradores
    $('#btnPartnerExport').click(function () {
        var data = generatePartnerData();
        var ws = XLSX.utils.aoa_to_sheet(data);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Colaboradores");
        XLSX.writeFile(wb, "colaboradores.xlsx");
        $('#partnerExportConfirm').modal('hide');
    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", ".btn-editPartner", function () {

        // Obtener la fila a la que pertenece el botón
        var row = $(this).closest('tr');

        // Obtener los datos de cada columna en la fila usando jQuery
        var id = row.find('td:eq(0)').text();
        var nombres = row.find('td:eq(1)').text();
        var apellidos = row.find('td:eq(2)').text();
        var dui = row.find('td:eq(3)').text();
        var direccion = row.find('td:eq(4)').text();
        var correo = row.find('td:eq(5)').text();
        var celular = row.find('td:eq(6)').text();
        var fechaNacimiento = row.find('td:eq(7)').text();
        //var fechaContratacion = row.find('td:eq(8)').text();

        // Llenar los campos del modal con los datos obtenidos
        $('#inputEditIdPartner').val(id);
        $('#inputEditNamePartner').val(nombres);
        $('#inputEditLastNamePartner').val(apellidos);
        $('#inputEditDuiPartner').val(dui);
        $('#inputEditAddressPartner').val(direccion);
        $('#inputEditEmailPartner').val(correo);
        $('#inputEditPhonePartner').val(celular);
        $('#inputEditDateBirthPartner').val(fechaNacimiento);

    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", "#btnUpdatePartner", function () {

        // Input de Texto
        var id = $("#inputEditIdPartner");
        var name = $('#inputEditNamePartner');
        var lastName = $('#inputEditLastNamePartner');
        var dui = $('#inputEditDuiPartner');
        var address = $('#inputEditAddressPartner');
        var email = $('#inputEditEmailPartner');
        var phone = $('#inputEditPhonePartner');
        var date = $('#inputEditDateBirthPartner');

        // Párrafo de cada Input
        var nameMsg = $('#editNamePartnerMsg');
        var lastNameMsg = $('#editLastNamePartnerMsg');
        var duiMsg = $('#editDuiPartnerMsg');
        var addressMsg = $('#editAddressPartnerMsg');
        var emailMsg = $('#editEmailPartnerMsg');
        var phoneMsg = $('#editPhonePartnerMsg');
        var dateMsg = $('#editDateBirthPartnerMsg');

        estado = validatePartnerInputs(name, nameMsg, lastName, lastNameMsg, dui, duiMsg, address, addressMsg, email, emailMsg, phone, phoneMsg, date, dateMsg);

        if (estado) {

            // Obtener los valores de los campos del formulario
            var idPartner = id.val();
            var namePartner = name.val();
            var lastNamePartner = lastName.val();
            var duiPartner = dui.val();
            var addressPartner = address.val();
            var emailPartner = email.val();
            var phonePartner = phone.val();
            var dateBirthPartner = date.val();

            // Crear un objeto con los datos del formulario
            var datos = {
                id: idPartner,
                name: namePartner,
                lastName: lastNamePartner,
                dui: duiPartner,
                address: addressPartner,
                email: emailPartner,
                phone: phonePartner,
                dateBirth: dateBirthPartner
            };

            $.ajax({
                url: "/public_html/controllers/PartnerController.php",
                method: "POST",
                data: { action: "edit_partner", data: datos },
                success: function (update_partner) {
                    loadPartners();
                    //console.log(update_partner);
                    $("#inputPartnerSearch").val('');
                    $('#editNamePartnerMsg').removeClass('success-message').addClass('hide-element');
                    $('#editLastNamePartnerMsg').removeClass('success-message').addClass('hide-element');
                    $('#editDuiPartnerMsg').removeClass('success-message').addClass('hide-element');
                    $('#editAddressPartnerMsg').removeClass('success-message').addClass('hide-element');
                    $('#editEmailPartnerMsg').removeClass('success-message').addClass('hide-element');
                    $('#editPhonePartnerMsg').removeClass('success-message').addClass('hide-element');
                    $('#editDateBirthPartnerMsg').removeClass('success-message').addClass('hide-element');
                    $('#editPartnerModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    // Manejo de errores en caso de que la solicitud falle
                    console.error("Error en la solicitud AJAX", error);
                    alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
                },
            });

        } else {
            console.log("Los campos para actualizar Colaborador no se llenaron correctamente.");
        }

    });

    // Función para manejar clic en el botón "Eliminar" al abrir modal y llenarlo con los datos del Colaborador
    $(document).on("click", ".btn-deletePartner", function () {
        // Obtener la fila a la que pertenece el botón
        var row = $(this).closest('tr');

        // Obtener los datos de cada columna en la fila usando jQuery
        var id = row.find('td:eq(0)').text();
        var nombres = row.find('td:eq(1)').text();
        var apellidos = row.find('td:eq(2)').text();
        var nombreCompleto = nombres + " " + apellidos;
        var dui = row.find('td:eq(3)').text();
        var direccion = row.find('td:eq(4)').text();
        var correo = row.find('td:eq(5)').text();
        var celular = row.find('td:eq(6)').text();
        var fechaNacimiento = row.find('td:eq(7)').text();

        // Llenar los campos del modal con los datos obtenidos
        $('#deletePartnerID').val(id);
        $('#deletePartnerName').val(nombreCompleto);
        $('#deletePartnerDUI').val(dui);
        $('#deletePartnerAddress').val(direccion);
        $('#deletePartnerMail').val(correo);
        $('#deletePartnerPhone').val(celular);
        $('#deletePartnerDate').val(fechaNacimiento);

    });

    // Función para manejar clic en el botón "Eliminar" utilizando AJAX
    $('#btnDeletePartner').click(function () {
        var partnerId = $('#deletePartnerID').val();
        //console.log(partnerId);

        // Realizar la solicitud AJAX para eliminar el colaborador
        $.ajax({
            type: "POST",
            url: "/public_html/controllers/PartnerController.php",
            data: { action: 'delete_partner', id: partnerId },
            success: function (delete_partner) {
                $("#inputPartnerSearch").val('');
                // Recargar la lista de colaboradores después de eliminar
                loadPartners();
            },
            error: function (xhr, status, error) {
                // Manejo de errores en caso de que la solicitud falle
                console.error("Error en la solicitud AJAX", error);
                alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
            },
        });

        $('#deletePartnerModal').modal('hide');
    });

    /*
    FUNCIONES DE USUARIOS
    */

    // Manejar clic en el botón "Restablecer" de userForm.php
    $("#resetUserForm").on("click", function () {
        $("#userForm")[0].reset();
    });

    // Manejar clic en el botón "Registrar Usuarios" utilizando AJAX
    $("#formUser").on("click", function () {
        // Redirecciona a userForm.php para registrar los datos del Usuario
        window.location.href = "/public_html/views/user/userForm.php";
    });

    // Cargar datos al mostrar userForm.php
    if (window.location.pathname.endsWith('userForm.php')) {
        // Función para llenar el Combobox/Selec con la lista de colaboradores al cargar la página
        loadPartnersWhitoutUser();
    }

    // Función para llenar Combobox/Select con la lista de colaboradores que no poseen usuario
    function loadPartnersWhitoutUser() {

        $.ajax({
            type: "POST",
            url: "/public_html/controllers/UserController.php",
            data: { action: 'list_partners_wo_user' },
            success: function (list_partners_wo_user) {
                //console.log("Ingresa en el AJAX para mostrar lista de colaboradores en select");
                //console.log(list_partners_wo_user);
                $('#userPartnerInput').html(list_partners_wo_user);
            },
            error: function (error) {
                console.error("Error al cargar la lista de colaboradores en select", error);
            }
        });
    }

    function validaCampos() {

        var form = document.querySelector('#userForm');

        // Input de Texto
        var partner = document.getElementById('userPartnerInput');
        var name = document.getElementById('userNameInput');
        var pass = document.getElementById('userPassInput');
        var type = document.getElementById('userTypeInput');

        // Párrafo de cada Input
        var nameMsg = document.getElementById('userNameMsg');
        var passMsg = document.getElementById('userPassMsg');

        var nameState = false;
        var passState = false;

        // Capturar los valores ingresados por el usuario
        //var colaboradorValor = partner.value.trim();
        var nombreValor = name.value.trim();
        var contraValor = pass.value.trim();
        //var tipoValor = type.value.trim();

        // Validando campo Usuario / Nombre de Usuario
        if (!nombreValor) {
            validaFalla(name, nameMsg, 'Campo de usuario vacío');
        } else if (nombreValor.length < 4) {
            validaFalla(name, nameMsg, 'Debe tener 4 caracteres como mínimo.');
        } else {
            validaOk(name, nameMsg);
            nameState = true;
        }

        // Validando campo Contraseña
        var er = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,18}$/;
        if (!contraValor) {
            validaFalla(pass, passMsg, 'Campo de Contraseña vacío');
        } else if (contraValor.length < 6) {
            validaFalla(pass, passMsg, 'Debe tener 6 caracteres como mínimo.');
        } else if (!contraValor.match(er)) {
            validaFalla(pass, passMsg, 'Debe tener al menos una may., una min. y un núm.');
        } else {
            validaOk(pass, passMsg);
            passState = true;
        }

        if (nameState == true && passState == true) {
            return true;
        } else {
            return false;
        }

    }

    function validaFalla(inputText, inputMsg, msgAlert) {
        inputMsg.innerText = msgAlert;
        inputMsg.style.display = "block";
        inputText.className = 'form-control falla';
    }

    const validaOk = (inputText, inputMsg) => {
        inputMsg.style.display = "none";
        inputText.className = 'form-control ok';
    }

    // Manejar clic en el botón "Guardar" utilizando AJAX
    $("#saveUser").on("click", function () {
        //console.log("Ingresa en el botón saveUser.");

        // Obtener los datos del formulario
        var formData = $("#userForm").serialize();

        estado = validaCampos();

        if (estado) {
            //console.log("Todos los campos llenados correctamente");
            // Realizar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: "/public_html/controllers/UserController.php",
                data: formData,
                success: function (response) {
                    // Manejar la respuesta del servidor
                    //console.log("Ingresa en el AJAX para Guardar el usuario");
                    //console.log(response);

                    // Mostrar mensaje de éxito
                    $("#userSuccessMessage").text("¡El usuario se ha registrado exitosamente!").fadeIn();

                    // Limpiar el formulario después de 3 segundos
                    setTimeout(function () {
                        $("#userForm")[0].reset();
                        loadPartnersWhitoutUser();
                        $("#userSuccessMessage").fadeOut();
                    }, 3000);
                },
                error: function (error) {
                    console.error("Error en la solicitud AJAX", error);
                }
            });
        } else {
            console.log("Los campos no estan llenados correctamente");
        }

    });

    // Manejar clic en el botón "Listar Usuarios" utilizando AJAX
    $("#listUser").on("click", function () {
        // Redireccionar a userList.php para mostrar los datos en la página
        window.location.href = "/public_html/views/user/userList.php";
    });

    // Cargar datos al mostrar userList.php
    if (window.location.pathname.endsWith('userList.php')) {
        // Función para cargar la lista de usuarios al cargar la página
        loadUsers();
    }

    // Función para cargar la lista de usuarios
    function loadUsers() {
        $("#inputUserSearch").focus();
        $.ajax({
            type: "POST",
            url: "/public_html/controllers/UserController.php",
            data: { action: 'list_users' },
            success: function (list_users) {
                //console.log("Ingresa en el AJAX para mostrar los usuarios");
                //console.log(list_users);

                var users = JSON.parse(list_users);
                var userHtml = '';
                users.forEach(function (user) {

                    userHtml += '<tr>';
                    userHtml += '<td class="d-none" data-title="ID Usuario:">' + user.idUsuario + '</td>';
                    userHtml += '<td class="d-none" data-title="ID Colab.:">' + user.idColaborador + '</td>';
                    userHtml += '<td data-title="Nombre:">' + user.nombre + '</td>';
                    userHtml += '<td data-title="Correo:">' + user.correo + '</td>';
                    userHtml += '<td data-title="Usuario:">' + user.username + '</td>';
                    userHtml += '<td data-title="Tipo:">' + user.tipoColaborador + '</td>';
                    userHtml += '<td data-title="Fecha Cont.:">' + user.fechaContratacion + '</td>';
                    // Agregar botones de acciones (Editar y Eliminar)
                    userHtml += '<td class="text-center">';
                    if (user.idUsuario == 1) {
                        userHtml += '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
                        userHtml += '<button class="btn btn-primary btn-editUser" data-bs-toggle="modal" data-bs-target="#userEditModal"><i class="bi bi-person-lines-fill"></i></button>';
                        userHtml += '<button type="button" class="btn btn-secondary btn-editPass" data-bs-toggle="modal" data-bs-target="#userPassEditModal"><i class="bi bi-person-fill-lock"></i></button>';
                        userHtml += '</div>';
                    } else {
                        userHtml += '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
                        userHtml += '<button type="button" class="btn btn-primary btn-editUser" data-bs-toggle="modal" data-bs-target="#userEditModal"><i class="bi bi-person-lines-fill"></i></button>';
                        userHtml += '<button type="button" class="btn btn-secondary btn-editPass" data-bs-toggle="modal" data-bs-target="#userPassEditModal"><i class="bi bi-person-fill-lock"></i></button>';
                        userHtml += '<button type="button" class="btn btn-danger btn-deleteUser" data-id="' + user.idUsuario + '"><i class="bi bi-trash3"></i></button>';
                        userHtml += '</div>';
                    }
                    userHtml += '</td>';
                    userHtml += '</tr>';
                });
                $('#userTable tbody').html(userHtml);
                //$('#userTable td:nth-child(6)').hide(); //Password
            },
            error: function (error) {
                console.error("Error al cargar la lista de usuarios", error);
            }
        });
    }

    // Evento/s al cambiar/seleccionar Radio Button Diferente
    $('input[name="user-options"]').on("change", function () {
        $("#inputUserSearch").val('');
        loadUsers();
    });

    // Evento de búsqueda de Colaborador según criterio de Radio Button
    $("#inputUserSearch").on("keyup", function () {
        var searchTerm = $(this).val().toLowerCase();
        var column = $('input[name="user-options"]:checked').data('column');
        $('#userTable tbody tr').filter(function () {
            $(this).toggle($(this).find('td').eq(column).text().toLowerCase().indexOf(searchTerm) > -1)
        });
    });

    /*
    FUNCIONES PARA DESCARGAR EXCEL DE USUARIOS
    */

    // Función para generar Arreglo de Usuarios
    function generateUserData() {
        var data = [];
        var headers = ['Código Usuario', 'Código Colaborador', 'Nombre', 'Correo', 'Usuario', 'Tipo', 'Fecha de Contratación'];

        data.push(headers);

        $('table tbody tr').each(function () {
            var row = [];
            $(this).find('td').each(function (index) {
                if (index !== 9) { // Excluir columna "Acciones"
                    row.push($(this).text());
                }
            });
            data.push(row);
        });
        return data;
    }

    // Función para manejar el clic del botón "Exportar Excel" de Usuarios
    $('#btnUserExport').click(function () {
        var data = generateUserData();
        var ws = XLSX.utils.aoa_to_sheet(data);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Usuarios");
        XLSX.writeFile(wb, "usuarios.xlsx");
        $('#userExportConfirm').modal('hide');
    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", ".btn-editUser", function () {

        // Obtener la fila a la que pertenece el botón
        var row = $(this).closest('tr');

        // Obtener los datos de cada columna en la fila usando jQuery
        var idUser = row.find('td:eq(0)').text();
        //var idPartner = row.find('td:eq(1)').text();
        var user = row.find('td:eq(4)').text();
        //var pass = row.find('td:eq(4)').text();
        var type = row.find('td:eq(5)').text();
        //console.log(idUser);
        // Llenar los campos del modal con los datos obtenidos
        $('#userIdInput').val(idUser);
        $('#userNameInput').val(user);
        //$('#userPassInput').val(pass);

        // Llenar el campo select con los tipos de usuario
        var currentType = type;
        var otherType = (currentType === 'Administrador') ? 'Colaborador' : 'Administrador';

        // Limpiar el select
        $('#userTypeInput').empty();

        // Condición para el valor de idUser
        if (idUser === '1') {

            // Agrega las opcion de Administrador al Select
            $('#userTypeInput').append($('<option>', {
                value: currentType,
                text: currentType,
                selected: true
            }));

        } else {

            // Agregar las opciones al Select
            $('#userTypeInput').append($('<option>', {
                value: currentType,
                text: currentType,
                selected: true
            }));

            $('#userTypeInput').append($('<option>', {
                value: otherType,
                text: otherType
            }));
        }

    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", "#btnUpdateUser", function () {

        // Obtener los valores de los campos del formulario
        var idUser = $("#userIdInput").val();
        var userName = $("#userNameInput").val();
        //var userMail = $("#userMailInput").val();
        var userType = $("#userTypeInput").val();

        // Crear un objeto con los datos del formulario
        var datos = {
            id: idUser,
            user: userName,
            //mail: userMail,
            type: userType
        };

        //console.log(datos);

        $.ajax({
            url: "/public_html/controllers/UserController.php",
            method: "POST",
            data: { action: "edit_user", data: datos },
            success: function (update_user) {
                console.log(update_user);
                loadUsers();
                $('#userEditModal').modal('hide');
            },
            error: function (xhr, status, error) {
                // Manejo de errores en caso de que la solicitud falle
                console.error("Error en la solicitud AJAX", error);
                alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
            },
        });

    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", ".btn-editPass", function () {

        // Obtener la fila a la que pertenece el botón
        var row = $(this).closest('tr');

        // Obtener los datos de cada columna en la fila usando jQuery
        var idUser = row.find('td:eq(0)').text();

        // Llenar los campos del modal con los datos obtenidos
        $('#editUserPassIdInput').val(idUser);

    });

    // Manejar validación para Actualizar contraseña de Usuarios
    function validateUserPassInput(pass, passMsg) {

        // Variables Booleanas (Falso - Veredadero)
        var passState = false;

        // Capturar los valores ingresados
        var contraValor = pass.val().trim();

        // Expresiones regulares
        var passPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,18}$/;

        // Validando campo Contraseña
        if (!contraValor) {
            validateError(passMsg, 'Campo de Contraseña vacío');
        } else if (contraValor.length < 6) {
            validateError(passMsg, 'Debe tener 6 caracteres como mínimo.');
        } else if (!contraValor.match(passPattern)) {
            validateError(passMsg, 'Debe tener al menos una may., una min. y un núm.');
        } else {
            validateOk(passMsg, "¡Correcto!");
            passState = true;
        }

        // Validar el estado del Input del Formulario para actualizar contraseña de Usuario y retornar True o False
        if (passState == true) {
            return true;
        } else {
            return false;
        }
    }

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", "#btnUpdatePass", function () {

        // Input de Texto
        var userPassInput = $('#editUserPassInput');

        // Párrafo de cada Input
        var userPassMsg = $('#editUserPassMsg');

        estado = validateUserPassInput(userPassInput, userPassMsg);

        if (estado) {

            // Obtener los valores de los campos del formulario
            var idUser = $("#editUserPassIdInput").val();
            var userPass = $("#editUserPassInput").val();

            // Crear un objeto con los datos del formulario
            var datos = {
                id: idUser,
                pass: userPass
            };

            console.log(datos);

            $.ajax({
                url: "/public_html/controllers/UserController.php",
                method: "POST",
                data: { action: "edit_user_pass", data: datos },
                success: function (update_user_pass) {
                    console.log(update_user_pass);
                    loadUsers();
                    $('#userPassEditModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    // Manejo de errores en caso de que la solicitud falle
                    console.error("Error en la solicitud AJAX", error);
                    alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
                },
            });

        } else {
            console.log("El campo de la contra no está llenado correctamente.");
        }

    });

    // Función para manejar clic en el botón "Eliminar" utilizando AJAX
    $(document).on("click", ".btn-deleteUser", function () {
        var userId = $(this).data('id');
        //console.log(userId);

        // Confirmar antes de eliminar
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            // Realizar la solicitud AJAX para eliminar el usuario
            $.ajax({
                type: "POST",
                url: "/public_html/controllers/UserController.php",
                data: { action: 'delete_user', id: userId },
                success: function (delete_user) {
                    //console.log(delete_user);
                    // Recargar la lista de usuarios después de eliminar
                    loadUsers();
                },
                error: function (xhr, status, error) {
                    // Manejo de errores en caso de que la solicitud falle
                    console.error("Error en la solicitud AJAX", error);
                    alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
                },
            });
        }

    });

    /*
    FUNCIONES DE VISITANTES
    */

    // Manejar clic en el botón "Restablecer" de guestForm.php
    $("#resetGuestForm").on("click", function () {
        $("#guestForm")[0].reset();
    });

    // Manejar clic en el botón "Registrar Visitantes" utilizando AJAX
    $("#formGuest").on("click", function () {
        // Redireccionar a guestForm.php para registrar los datos del Visitante
        window.location.href = "/public_html/views/guest/guestForm.php";
    });

    // Manejar validación para Ingresar o Registrar y Actualizar Visitantes
    function validateGuestInputs(name, nameMsg, email, emailMsg, subject, subjectMsg) {

        // Variables Booleanas (Falso - Veredadero)
        var nameState = false;
        var emailState = false;
        var subjectState = false;

        // Capturar los valores ingresados
        var nombreValor = name.val().trim();
        var correoValor = email.val().trim();
        var asuntoValor = subject.val().trim();

        // Expresiones regulares
        var namePattern = /^[a-zA-ZÁÉÍÓÚáéíóúñÑ]+(?:[\s'-][a-zA-ZÁÉÍÓÚáéíóúñÑ]+)*$/;
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var subjectPattern = /^[a-zA-Z0-9ÁÉÍÓÚáéíóúñÑ,.#\-\s]+$/;

        // Validando campo Nombre de Visitante
        if (!nombreValor) {
            validateError(nameMsg, 'Campo de Nombre vacío.');
        } else if (nombreValor.length < 3) {
            validateError(nameMsg, 'Debe tener 3 caracteres mínimo.');
        } else if (!nombreValor.match(namePattern)) {
            validateError(nameMsg, 'No debe tener ciertos caracteres especiales o numeros.');
        } else {
            validateOk(nameMsg, "¡Correcto!");
            nameState = true;
        }

        // Validando campo Correo/Email de Visitante
        if (!correoValor) {
            validateError(emailMsg, 'Campo de Correo vacío.');
        } else if (!correoValor.match(emailPattern)) {
            validateError(emailMsg, 'Escribe un correo correcto, ej. usuario@correo.com.');
        } else {
            validateOk(emailMsg, "¡Correcto!");
            emailState = true;
        }

        // Validando campo Asunto de Visitante
        if (!asuntoValor) {
            validateError(subjectMsg, 'Campo de Asunto vacío.');
        } else if (!asuntoValor.match(subjectPattern)) {
            validateError(subjectMsg, 'Escribe un asunto correcto.');
        } else {
            validateOk(subjectMsg, "¡Correcto!");
            subjectState = true;
        }

        // Validar el estado de todos los Input del Formulario de Visitantes y retornar True o False
        if (nameState == true && emailState == true && subjectState == true) {
            return true;
        } else {
            return false;
        }
    }

    // Manejar clic en el botón "Guardar" utilizando AJAX
    $("#saveGuest").on("click", function () {

        // Input de Texto
        var name = $('#guestNameInput');
        var email = $('#guestEmailInput');
        var subject = $('#guestSubjectInput');

        // Párrafo de cada Input
        var nameMsg = $('#guestNameMsg');
        var emailMsg = $('#guestEmailMsg');
        var subjectMsg = $('#guestSubjectMsg');

        estado = validateGuestInputs(name, nameMsg, email, emailMsg, subject, subjectMsg);

        if (estado) {
            //console.log("Los campos de Visitante se llenaron correctamente.");

            // Obtener los datos del formulario
            var formData = $("#guestForm").serialize();

            // Realizar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: "/public_html/controllers/GuestController.php",
                data: formData,
                success: function (saveGuest) {
                    // Manejar la respuesta del servidor
                    console.log("Ingresa en el AJAX para Guardar Visitante");
                    //console.log(saveGuest);

                    // Mostrar mensaje de éxito
                    $("#guestSuccessMessage").text("¡El Visitante se ha registrado exitosamente!").fadeIn();

                    // Limpiar el formulario después de 3 segundos
                    setTimeout(function () {
                        $("#guestForm")[0].reset();
                        $("#guestSuccessMessage").fadeOut();
                        $('#guestNameMsg').removeClass('success-message').addClass('hide-element');
                        $('#guestEmailMsg').removeClass('success-message').addClass('hide-element');
                        $('#guestSubjectMsg').removeClass('success-message').addClass('hide-element');
                    }, 3000);
                },
                error: function (error) {
                    console.error("Error en la solicitud AJAX", error);
                }
            });

        } else {
            console.log("Los campos de Visitante no se llenaron correctamente.");
        }

    });

    // Manejar clic en el botón "Listar Invitados" utilizando AJAX
    $("#listGuest").on("click", function () {
        // Redireccionar a guestList.php para mostrar los datos en la página
        window.location.href = "/public_html/views/guest/guestList.php";
    });

    // Cargar datos al mostrar guestList.php
    if (window.location.pathname.endsWith('guestList.php')) {
        // Función para cargar la lista de Invitados al cargar la página
        loadGuests();
    }

    // Función para cargar la lista de Invitados
    function loadGuests() {
        $("#inputGuestSearch").focus();
        $.ajax({
            type: "POST",
            url: "/public_html/controllers/GuestController.php",
            data: { action: 'list_guests' },
            success: function (list_guest) {
                //console.log("Ingresa en el AJAX para mostrar los Invitados");
                //console.log(list_guest);

                var guests = JSON.parse(list_guest);
                var html = '';
                guests.forEach(function (guest) {
                    html += '<tr>';
                    html += '<td class="d-none" data-title="Codigo:">' + guest.idVisitante + '</td>';
                    html += '<td data-title="Nombre:">' + guest.nombre + '</td>';
                    html += '<td data-title="Correo:">' + guest.correo + '</td>';
                    html += '<td data-title="Asunto:">' + guest.asunto + '</td>';
                    html += '<td data-title="Comentario:">' + guest.comentario + '</td>';
                    html += '<td data-title="Fecha:">' + guest.fechaVisita + '</td>';
                    // Agregar botones de acciones (Editar y Eliminar)
                    html += '<td class="text-center">';
                    html += '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
                    html += '<button type="button" class="btn btn-primary btn-editGuest" data-bs-toggle="modal" data-bs-target="#editGuestModal"><i class="bi bi-pencil"></i></button>';
                    html += '<button type="button" class="btn btn-danger btn-deleteGuest" data-bs-toggle="modal" data-bs-target="#deleteGuestModal" data-id="' + guest.idVisitante + '"><i class="bi bi-trash3"></i></button>';
                    html += '</div>';
                    html += '</td>';
                    html += '</tr>';
                });
                $('#guestTable tbody').html(html);
            },
            error: function (error) {
                console.error("Error al cargar la lista de visitantes", error);
            }
        });
    }

    // Evento/s al cambiar/seleccionar Radio Button Diferente
    $('input[name="guest-options"]').on("change", function () {
        $("#inputGuestSearch").val('');
        loadGuests();
    });

    // Evento de búsqueda de Visitante según criterio de Radio Button
    $("#inputGuestSearch").on("keyup", function () {
        var searchTerm = $(this).val().toLowerCase();
        var column = $('input[name="guest-options"]:checked').data('column');
        $('#guestTable tbody tr').filter(function () {
            $(this).toggle($(this).find('td').eq(column).text().toLowerCase().indexOf(searchTerm) > -1)
        });
    });

    /*
    FUNCIONES PARA DESCARGAR EXCEL DE VISITANTES
    */

    // Función para generar Arreglo de Visitantes
    function generateGuestData() {
        var data = [];
        var headers = ['Código Visitante', 'Nombre', 'Correo', 'Asunto', 'Comentario', 'Fecha registro'];

        data.push(headers);

        $('table tbody tr').each(function () {
            var row = [];
            $(this).find('td').each(function (index) {
                if (index !== 7) { // Excluir columna "Acciones"
                    row.push($(this).text());
                }
            });
            data.push(row);
        });
        return data;
    }

    // Función para manejar el clic del botón "Exportar Excel" de Visitantes
    $('#btnGuestExport').click(function () {
        var data = generateGuestData();
        var ws = XLSX.utils.aoa_to_sheet(data);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Visitantes");
        XLSX.writeFile(wb, "visitantes.xlsx");
        $('#guestExportConfirm').modal('hide');
    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", ".btn-editGuest", function () {

        // Obtener la fila a la que pertenece el botón
        var row = $(this).closest('tr');

        // Obtener los datos de cada columna en la fila usando jQuery
        var id = row.find('td:eq(0)').text();
        var nombre = row.find('td:eq(1)').text();
        var correo = row.find('td:eq(2)').text();
        var asunto = row.find('td:eq(3)').text();
        var comentario = row.find('td:eq(4)').text();
        //var fecha = row.find('td:eq(6)').text();

        // Llenar los campos del modal con los datos obtenidos
        $('#inputEditIdGuest').val(id);
        $('#inputEditNameGuest').val(nombre);
        $('#inputEditEmailGuest').val(correo);
        $('#inputEditSubjectGuest').val(asunto);
        $('#inputEditNoteGuest').val(comentario);
    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", "#btnUpdateGuest", function () {

        // Input de Texto
        var id = $("#inputEditIdGuest");
        var name = $('#inputEditNameGuest');
        var email = $('#inputEditEmailGuest');
        var subject = $('#inputEditSubjectGuest');
        var note = $('#inputEditNoteGuest');

        // Párrafo de cada Input
        var nameMsg = $('#editNameGuestMsg');
        var emailMsg = $('#editEmailGuestMsg');
        var subjectMsg = $('#editSubjectGuestMsg');

        estado = validateGuestInputs(name, nameMsg, email, emailMsg, subject, subjectMsg);

        if (estado) {
            //console.log("Todos los campos están escritos correctamente");

            // Obtener los valores de los campos del formulario
            var idGuest = id.val();
            var nameGuest = name.val();
            var emailGuest = email.val();
            var subjectGuest = subject.val();
            var noteGuest = note.val();

            // Crear un objeto con los datos del formulario
            var datos = {
                id: idGuest,
                name: nameGuest,
                email: emailGuest,
                subject: subjectGuest,
                note: noteGuest,
            };

            //console.log(datos);

            $.ajax({
                url: "/public_html/controllers/GuestController.php",
                method: "POST",
                data: { action: "edit_guest", data: datos },
                success: function (update_guest) {
                    loadGuests();
                    console.log(update_guest);
                    $('#editGuestModal').modal('hide');
                    $('#editNameGuestMsg').removeClass('success-message').addClass('hide-element');
                    $('#editEmailGuestMsg').removeClass('success-message').addClass('hide-element');
                    $('#editSubjectGuestMsg').removeClass('success-message').addClass('hide-element');
                },
                error: function (xhr, status, error) {
                    // Manejo de errores en caso de que la solicitud falle
                    console.error("Error en la solicitud AJAX", error);
                    alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
                },
            });

        } else {
            console.log("Los campos para actualizar Visitante no se llenaron correctamente.");
        }
    });

    // Función para manejar clic en el botón "Eliminar" al abrir modal y llenarlo con los datos del Colaborador
    $(document).on("click", ".btn-deleteGuest", function () {
        // Obtener la fila a la que pertenece el botón
        var row = $(this).closest('tr');

        // Obtener los datos de cada columna en la fila usando jQuery
        var id = row.find('td:eq(0)').text();
        var nombre = row.find('td:eq(1)').text();
        var correo = row.find('td:eq(2)').text();
        var asunto = row.find('td:eq(3)').text();
        var comentario = row.find('td:eq(4)').text();
        var fecha = row.find('td:eq(5)').text();

        // Llenar los campos del modal con los datos obtenidos
        $('#deleteGuestID').val(id);
        $('#deleteGuestName').val(nombre);
        $('#deleteGuestEmail').val(correo);
        $('#deleteGuestSubject').val(asunto);
        $('#deleteGuestNote').val(comentario);
        $('#deleteGuestDate').val(fecha);

    });

    // Función para manejar clic en el botón "Eliminar" utilizando AJAX
    $('#btnDeleteGuest').click(function () {
        var guestId = $('#deleteGuestID').val();
        //var guestId = $(this).data('id');
        //console.log(guestId);

        // Realizar la solicitud AJAX para eliminar el visitante
        $.ajax({
            type: "POST",
            url: "/public_html/controllers/GuestController.php",
            data: { action: 'delete_guest', id: guestId },
            success: function (delete_guest) {
                console.log(delete_guest);
                // Recargar la lista de visitantes después de eliminar
                loadGuests();
                $('#deleteGuestModal').modal('hide');
            },
            error: function (xhr, status, error) {
                // Manejo de errores en caso de que la solicitud falle
                console.error("Error en la solicitud AJAX", error);
                alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
            },
        });

    });

    /*
    FUNCIONES DE VISITAS
    */

    // Manejar clic en el botón "Restablecer" de visitForm.php
    $("#resetVisitForm").on("click", function () {
        $("#visitForm")[0].reset();
        loadGuestsForVisit();
    });

    // Manejar clic en el botón "Registrar Visitantes" utilizando AJAX
    $("#formVisit").on("click", function () {
        // Redireccionar a visitForm.php para registrar los datos del Visitante
        window.location.href = "/public_html/views/visit/visitForm.php";
    });

    // Cargar datos al mostrar visitForm.php
    if (window.location.pathname.endsWith('visitForm.php')) {
        // Función para llenar el Combobox/Selec con la lista de visitantes al cargar la página
        loadGuestsForVisit();
    }

    // Función para llenar Combobox/Select con la lista de visitantes que no poseen usuario
    function loadGuestsForVisit() {

        $.ajax({
            type: "POST",
            url: "/public_html/controllers/VisitController.php",
            data: { action: 'list_guests_for_visit' },
            success: function (list_guests_for_visit) {
                //console.log("Ingresa en el AJAX para mostrar lista de visitantes en select");
                //console.log(list_guests_for_visit);
                $('#visitGuestInput').html(list_guests_for_visit);
            },
            error: function (error) {
                console.error("Error al cargar la lista de colaboradores en select", error);
            }
        });
    }

    // Manejar validación para Ingresar o Registrar y Actualizar Visitantes
    function validateVisitInputs(subject, subjectMsg, number, numberMsg) {

        // Variables Booleanas (Falso - Veredadero)
        var subjectState = false;
        var noteState = false;
        var numberState = false;

        // Capturar los valores ingresados
        var asuntoValor = subject.val().trim();
        //var comentarioValor = note.val().trim();
        var cantidadValor = number.val().trim();

        // Expresiones regulares
        var subjectPattern = /^[a-zA-Z0-9ÁÉÍÓÚáéíóúñÑ,.#\-\s]+$/;
        //var notePattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; //Expresión actual es para "emailPattern"
        //var numberPattern = /^[a-zA-Z0-9ÁÉÍÓÚáéíóúñÑ,.#\-\s]+$/;

        // Validando campo Asunto para Visita
        if (!asuntoValor) {
            validateError(subjectMsg, 'Campo de Asunto vacío.');
        } else if (!asuntoValor.match(subjectPattern)) {
            validateError(subjectMsg, 'Escribe un asunto correcto.');
        } else {
            validateOk(subjectMsg, "¡Correcto!");
            subjectState = true;
        }

        if (!cantidadValor) {
            validateError(numberMsg, 'Campo de Cantidad vacío.');
        } else if (cantidadValor <= 0) {
            validateError(numberMsg, 'No puedes registrar una cantidad Menor o igual a 0.');
        } else if (cantidadValor > 200) {
            validateError(numberMsg, 'No puedes registrar una cantidad Mayor a 200.');
        } else {
            validateOk(numberMsg, "¡Correcto!");
            numberState = true;
        }

        // Validar el estado de Input del Formulario de Visita y retornar True o False
        if (subjectState == true && numberState == true) {
            return true;
        } else {
            return false;
        }
    }

    // Manejar clic en el botón "Guardar" utilizando AJAX
    $("#saveVisit").on("click", function () {

        // Input de Texto
        var guest = $('#visitGuestInput');
        var subject = $('#visitSubjectInput');
        var note = $('#visitNoteInput');
        var number = $('#visitNumberInput');

        // Párrafo de cada Input
        var guestMsg = $('#visitGuestMsg');
        var subjectMsg = $('#visitSubjectMsg');
        var noteMsg = $('#visitNoteMsg');
        var numberMsg = $('#visitNumberMsg');

        estado = validateVisitInputs(subject, subjectMsg, number, numberMsg);

        if (estado) {
            //console.log("Los campos de Visita para actualizar se llenaron correctamente.");

            // Obtener los datos del formulario
            var formData = $("#visitForm").serialize();
            console.log(formData);

            // Realizar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: "/public_html/controllers/VisitController.php",
                data: formData,
                success: function (response) {

                    // Manejar la respuesta del servidor
                    //console.log("Ingresa en el AJAX para Guardar Visita");
                    //console.log(response);

                    // Mostrar mensaje de éxito
                    $("#visitSuccessMessage").text("¡La Visita se ha registrado exitosamente!").fadeIn();

                    // Limpiar el formulario después de 3 segundos
                    setTimeout(function () {
                        $("#visitForm")[0].reset();
                        $("#visitSuccessMessage").fadeOut();
                        loadGuestsForVisit();
                    }, 3000);

                },
                error: function (error) {
                    console.error("Error en la solicitud AJAX", error);
                }
            });

        }
    });

    // Manejar clic en el botón "Listar Visitantes" utilizando AJAX
    $("#listVisit").on("click", function () {
        // Redireccionar a visitList.php para mostrar los datos en la página
        window.location.href = "/public_html/views/visit/visitList.php";
    });

    // Cargar datos al mostrar visitList.php
    if (window.location.pathname.endsWith('visitList.php')) {
        // Función para cargar la lista de Visitas al cargar la página
        loadVisits();
    }

    // Función para cargar la lista de Visitas
    function loadVisits() {
        $("#inputVisitSearch").focus();
        $.ajax({
            type: "POST",
            url: "/public_html/controllers/VisitController.php",
            data: { action: 'list_visits' },
            success: function (list_visits) {
                //console.log("Ingresa en el AJAX para mostrar los Visitas");
                //console.log(list_visits);

                var visits = JSON.parse(list_visits);
                var html = '';
                visits.forEach(function (visit) {
                    html += '<tr>';
                    html += '<td class="d-none" data-title="Codigo:">' + visit.idVisita + '</td>';
                    html += '<td class="d-none" data-title="Colaborador:">' + visit.colaborador + '</td>';
                    html += '<td data-title="Visitante:">' + visit.visitante + '</td>';
                    html += '<td data-title="Asunto:">' + visit.asunto + '</td>';
                    html += '<td data-title="Comentario:">' + visit.comentario + '</td>';
                    html += '<td data-title="Cantidad:">' + visit.cantidad + '</td>';
                    html += '<td data-title="Fecha:">' + visit.fechaVisita + '</td>';
                    // Agregar botones de acciones (Editar y Eliminar)
                    html += '<td class="text-center">';
                    html += '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
                    html += '<button type="button" class="btn btn-primary btn-editVisit" data-bs-toggle="modal" data-bs-target="#editVisitModal"><i class="bi bi-pencil"></i></button>';
                    html += '<button type="button" class="btn btn-danger btn-deleteVisit" data-bs-toggle="modal" data-bs-target="#deleteVisitModal" data-id="' + visit.idVisita + '"><i class="bi bi-trash3"></i></button>';
                    html += '</div>';
                    html += '</td>';
                    html += '</tr>';
                });
                $('#visitTable tbody').html(html);

            },
            error: function (error) {
                console.error("Error al cargar la lista de visitas", error);
            }
        });
    }

    // Evento/s al cambiar/seleccionar Radio Button Diferente
    $('input[name="visit-options"]').on("change", function () {
        $("#inputVisitSearch").val('');
        loadVisits();
    });

    // Evento de búsqueda de Visitante según criterio de Radio Button
    $("#inputVisitSearch").on("keyup", function () {
        var searchTerm = $(this).val().toLowerCase();
        var column = $('input[name="visit-options"]:checked').data('column');
        $('#visitTable tbody tr').filter(function () {
            $(this).toggle($(this).find('td').eq(column).text().toLowerCase().indexOf(searchTerm) > -1)
        });
    });

    /*
    FUNCIONES PARA DESCARGAR EXCEL DE VISITANTES
    */

    // Función para generar Arreglo de Visitantes
    function generateVisitData() {
        var data = [];
        var headers = ['Código Visita', 'Visitante', 'Asunto', 'Comentario', 'Cantidad', 'Fecha visita'];

        data.push(headers);

        $('table tbody tr').each(function () {
            var row = [];
            $(this).find('td').each(function (index) {
                if (index !== 7) { // Excluir columna "Acciones"
                    row.push($(this).text());
                }
            });
            data.push(row);
        });
        return data;
    }

    // Función para manejar el clic del botón "Exportar Excel" de Visitantes
    $('#btnVisitExport').click(function () {
        var data = generateVisitData();
        var ws = XLSX.utils.aoa_to_sheet(data);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Visitas");
        XLSX.writeFile(wb, "visitas.xlsx");
        $('#visitExportConfirm').modal('hide');
    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", ".btn-editVisit", function () {

        // Obtener la fila a la que pertenece el botón
        var row = $(this).closest('tr');

        // Obtener los datos de cada columna en la fila usando jQuery
        var id = row.find('td:eq(0)').text();
        var idColaborador = row.find('td:eq(1)').text();
        var idVisitante = row.find('td:eq(2)').text();
        var asunto = row.find('td:eq(3)').text();
        var comentario = row.find('td:eq(4)').text();
        var cantidad = row.find('td:eq(5)').text();
        //var fecha = row.find('td:eq(6)').text();

        // Llenar los campos del modal con los datos obtenidos
        $('#inputEditIdVisit').val(id);
        //console.log(id);
        $('#inputEditVisitPartnerName').val(idColaborador);
        $('#inputEditVisitGuestName').val(idVisitante);
        $('#inputEditVisitSubject').val(asunto);
        $('#inputEditVisitNote').val(comentario);
        $('#inputEditVisitNumber').val(cantidad);
    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", "#btnUpdateVisit", function () {

        // Input de Texto
        var idVisit = $('#inputEditIdVisit').val();
        //var namePartner = $('#inputEditVisitPartnerName').val();
        //var nameGuest = $('#inputEditVisitGuestName').val();
        var subjectVisit = $('#inputEditVisitSubject').val();
        var noteVisit = $('#inputEditVisitNote').val();
        var numberVisit = $('#inputEditVisitNumber').val();

        // Input de Texto
        var partner = $('#inputEditVisitPartnerName');
        var guest = $('#inputEditVisitGuestName');
        var subject = $('#inputEditVisitSubject');
        var note = $('#inputEditVisitNote');
        var number = $('#inputEditVisitNumber');

        // Párrafo de cada Input
        var partnerMsg = $('#visitPartnerNameMsg');
        var guestMsg = $('#visitGuestNameMsg');
        var subjectMsg = $('#visitSubjectMsg');
        var noteMsg = $('#visitNoteMsg');
        var numberMsg = $('#visitNumberMsg');

        estado = validateVisitInputs(subject, subjectMsg, number, numberMsg);

        if (estado) {
            //console.log("Los campos de Visita para actualizar se llenaron correctamente.");

            // Crear un objeto con los datos del formulario
            var datos = {
                id: idVisit,
                //partner: namePartner,
                //guest: nameGuest,
                subject: subjectVisit,
                note: noteVisit,
                number: numberVisit
            };

            //console.log(datos);

            $.ajax({
                url: "/public_html/controllers/VisitController.php",
                method: "POST",
                data: { action: "edit_visit", data: datos },
                success: function (update_visit) {
                    console.log(update_visit);
                    loadVisits();
                    $('#editVisitModal').modal('hide');
                    $('#visitSubjectMsg').removeClass('success-message').addClass('hide-element');
                    $('#visitNumberMsg').removeClass('success-message').addClass('hide-element');
                },
                error: function (xhr, status, error) {
                    // Manejo de errores en caso de que la solicitud falle
                    console.error("Error en la solicitud AJAX", error);
                    alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
                },
            });

        } else {
            console.log("Los campos de Visita para actualizar NO se llenaron correctamente.");
        }
    });

    // Función para manejar clic en el botón "Eliminar" al abrir modal y llenarlo con los datos de la Visita
    $(document).on("click", ".btn-deleteVisit", function () {
        // Obtener la fila a la que pertenece el botón
        var row = $(this).closest('tr');

        // Obtener los datos de cada columna en la fila usando jQuery
        var id = row.find('td:eq(0)').text();
        var colaborador = row.find('td:eq(1)').text();
        var visitante = row.find('td:eq(2)').text();
        var asunto = row.find('td:eq(3)').text();
        var comentario = row.find('td:eq(4)').text();
        var cantidad = row.find('td:eq(5)').text();
        var fecha = row.find('td:eq(6)').text();

        // Llenar los campos del modal con los datos obtenidos
        $('#deleteVisitID').val(id);
        $('#deleteVisitPartner').val(colaborador);
        $('#deleteVisitGuest').val(visitante);
        $('#deleteVisitSubject').val(asunto);
        $('#deleteVisitNote').val(comentario);
        $('#deleteVisitNumber').val(cantidad);
        $('#deleteVisitDate').val(fecha);

    });

    // Función para manejar clic en el botón "Eliminar" utilizando AJAX
    $('#btnDeleteVisit').click(function () {
        var visitId = $('#deleteVisitID').val();
        //var visitId = $(this).data('id');
        //console.log(visitId);

        // Realizar la solicitud AJAX para eliminar el visita
        $.ajax({
            type: "POST",
            url: "/public_html/controllers/VisitController.php",
            data: { action: 'delete_visit', id: visitId },
            success: function (delete_visit) {
                console.log(delete_visit);
                // Recargar la lista de visitas después de eliminar
                loadVisits();
                $('#deleteVisitModal').modal('hide');
            },
            error: function (xhr, status, error) {
                // Manejo de errores en caso de que la solicitud falle
                console.error("Error en la solicitud AJAX", error);
                alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
            },
        });

    });

    /*
    / FUNCIONES PARA COLABORADORES
   */

    /*
    / FUNCION DE DASHBOARD PARA COLABORADOR
    */

    // Manejar clic en el botón "Panel Colaborador" utilizando AJAX
    $("#partnerPanel").on("click", function () {
        // Redireccionar a partner.php para mostrar los datos en la página
        window.location.href = "/public_html/views/partner.php";
    });

    // Cargar datos al mostrar partner.php
    if (window.location.pathname.endsWith('partner.php')) {
        // Función para cargar el Dashboard para un Colaborador
        loadPartnerDashboard();
    }

    // Función para cargar dashboard para Colaborador
    function loadPartnerDashboard() {

        $.ajax({
            type: "POST",
            url: "/public_html/controllers/UserController.php",
            data: { action: 'partner' },
            success: function (partner_dashboard) {
                //console.log("Ingresa en el AJAX para mostrar dashboard de Partner");
                //console.log(partner_dashboard);

                //var partner = JSON.parse(partner_dashboard);
                $('#partnerDashboard').html(partner_dashboard);
            },
            error: function (error) {
                console.error("Error al cargar dashboard para Colaborador.", error);
            }
        });
    }

    /*
    FUNCIONES DE VISITANTES PARA COLABORADOR
    */

    // Manejar clic en el botón "Restablecer" de guestForm.php
    $("#resetGuestForm").on("click", function () {
        $("#guestPartnerForm")[0].reset();
    });

    // Manejar clic en el botón "Registrar Visitantes" utilizando AJAX
    $("#formPartnerGuest").on("click", function () {
        // Redireccionar a guestForm.php para registrar los datos del Visitante
        window.location.href = "/public_html/views/guest/guestPartnerForm.php";
    });

    // Manejar clic en el botón "Guardar" utilizando AJAX
    $("#savePartnerGuest").on("click", function () {

        // Input de Texto
        var name = $('#guestNameInput');
        var email = $('#guestEmailInput');
        var subject = $('#guestSubjectInput');

        // Párrafo de cada Input
        var nameMsg = $('#guestNameMsg');
        var emailMsg = $('#guestEmailMsg');
        var subjectMsg = $('#guestSubjectMsg');

        estado = validateGuestInputs(name, nameMsg, email, emailMsg, subject, subjectMsg);

        if (estado) {
            console.log("Los campos de Visitante se llenaron correctamente.");
            
            // Obtener los datos del formulario
            var formData = $("#guestPartnerForm").serialize();
            
            // Realizar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: "/public_html/controllers/GuestController.php",
                data: formData,
                success: function (register_partner_guest) {
                    // Manejar la respuesta del servidor
                    console.log("Ingresa en el AJAX para Guardar Visitante");
                    //console.log(register_partner_guest);

                    // Mostrar mensaje de éxito
                    $("#guestSuccessMessage").text("¡El Visitante se ha registrado exitosamente!").fadeIn();

                    // Limpiar el formulario después de 3 segundos
                    setTimeout(function () {
                        $("#guestPartnerForm")[0].reset();
                        $("#guestSuccessMessage").fadeOut();
                        $('#guestNameMsg').removeClass('success-message').addClass('hide-element');
                        $('#guestEmailMsg').removeClass('success-message').addClass('hide-element');
                        $('#guestSubjectMsg').removeClass('success-message').addClass('hide-element');
                    }, 3000);
                },
                error: function (error) {
                    console.error("Error en la solicitud AJAX", error);
                }
            });
            
        } else {
            console.log("Los campos de Visitante no se llenaron correctamente.");
        }

    });

    // Manejar clic en el botón "Listar Invitados" utilizando AJAX
    $("#listPartnerGuest").on("click", function () {
        // Redireccionar a guestPartnerList.php para mostrar los datos en la página
        window.location.href = "/public_html/views/guest/guestPartnerList.php";
    });

    // Cargar datos al mostrar guestPartnerList.php
    if (window.location.pathname.endsWith('guestPartnerList.php')) {
        // Función para cargar la lista de Invitados al cargar la página
        loadPartnerGuests();
    }

    // Función para cargar la lista de Invitados
    function loadPartnerGuests() {
        $("#inputPartnerGuestSearch").focus();
        $.ajax({
            type: "POST",
            url: "/public_html/controllers/GuestController.php",
            data: { action: 'list_partner_guest' },
            success: function (list_partner_guest) {
                //console.log("Ingresa en el AJAX para mostrar los Invitados");
                //console.log(list_guest);

                var guests = JSON.parse(list_partner_guest);
                var html = '';
                guests.forEach(function (guest) {
                    html += '<tr>';
                    html += '<td class="d-none" data-title="Codigo:">' + guest.idVisitante + '</td>';
                    html += '<td data-title="Nombre:">' + guest.nombre + '</td>';
                    html += '<td data-title="Correo:">' + guest.correo + '</td>';
                    html += '<td data-title="Asunto:">' + guest.asunto + '</td>';
                    html += '<td data-title="Comentario:">' + guest.comentario + '</td>';
                    html += '<td data-title="Fecha:">' + guest.fechaVisita + '</td>';
                    // Agregar botones de acciones (Editar y Eliminar)
                    html += '<td class="text-center">';
                    html += '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
                    html += '<button type="button" class="btn btn-primary btn-editGuest" data-bs-toggle="modal" data-bs-target="#editGuestModal"><i class="bi bi-pencil"></i></button>';
                    html += '</div>';
                    html += '</td>';
                    html += '</tr>';
                });
                $('#guestTable tbody').html(html);
            },
            error: function (error) {
                console.error("Error al cargar la lista de visitantes", error);
            }
        });
    }

    // Evento/s al cambiar/seleccionar Radio Button Diferente
    $('input[name="guest-options"]').on("change", function () {
        $("#inputPartnerGuestSearch").val('');
        loadPartnerGuests();
    });

    // Evento de búsqueda de Visitante según criterio de Radio Button
    $("#inputPartnerGuestSearch").on("keyup", function () {
        var searchTerm = $(this).val().toLowerCase();
        var column = $('input[name="guest-options"]:checked').data('column');
        $('#guestTable tbody tr').filter(function () {
            $(this).toggle($(this).find('td').eq(column).text().toLowerCase().indexOf(searchTerm) > -1)
        });
    });

    /*
    FUNCIONES PARA DESCARGAR EXCEL DE VISITANTES COMO COLABORADOR
    */

    // Función para generar Arreglo de Visitantes
    function generatePartnerGuestData() {
        var data = [];
        var headers = ['Código Visitante', 'Nombre', 'Correo', 'Asunto', 'Comentario', 'Fecha registro'];

        data.push(headers);

        $('table tbody tr').each(function () {
            var row = [];
            $(this).find('td').each(function (index) {
                if (index !== 7) { // Excluir columna "Acciones"
                    row.push($(this).text());
                }
            });
            data.push(row);
        });
        return data;
    }

    // Función para manejar el clic del botón "Exportar Excel" de Visitantes
    $('#btnPartnerGuestExport').click(function () {
        var data = generatePartnerGuestData();
        var ws = XLSX.utils.aoa_to_sheet(data);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Visitantes");
        XLSX.writeFile(wb, "visitantes.xlsx");
        $('#guestExportConfirm').modal('hide');
    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", ".btn-editGuest", function () {

        // Obtener la fila a la que pertenece el botón
        var row = $(this).closest('tr');

        // Obtener los datos de cada columna en la fila usando jQuery
        var id = row.find('td:eq(0)').text();
        var nombre = row.find('td:eq(1)').text();
        var correo = row.find('td:eq(2)').text();
        var asunto = row.find('td:eq(3)').text();
        var comentario = row.find('td:eq(4)').text();
        //var fecha = row.find('td:eq(6)').text();

        // Llenar los campos del modal con los datos obtenidos
        $('#inputEditIdGuest').val(id);
        $('#inputEditNameGuest').val(nombre);
        $('#inputEditEmailGuest').val(correo);
        $('#inputEditSubjectGuest').val(asunto);
        $('#inputEditNoteGuest').val(comentario);
    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", "#btnUpdateGuest", function () {

        // Input de Texto
        var id = $("#inputEditIdGuest");
        var name = $('#inputEditNameGuest');
        var email = $('#inputEditEmailGuest');
        var subject = $('#inputEditSubjectGuest');
        var note = $('#inputEditNoteGuest');

        // Párrafo de cada Input
        var nameMsg = $('#editNameGuestMsg');
        var emailMsg = $('#editEmailGuestMsg');
        var subjectMsg = $('#editSubjectGuestMsg');

        estado = validateGuestInputs(name, nameMsg, email, emailMsg, subject, subjectMsg);

        if (estado) {
            //console.log("Todos los campos están escritos correctamente");

            // Obtener los valores de los campos del formulario
            var idGuest = id.val();
            var nameGuest = name.val();
            var emailGuest = email.val();
            var subjectGuest = subject.val();
            var noteGuest = note.val();

            // Crear un objeto con los datos del formulario
            var datos = {
                id: idGuest,
                name: nameGuest,
                email: emailGuest,
                subject: subjectGuest,
                note: noteGuest,
            };

            //console.log(datos);

            $.ajax({
                url: "/public_html/controllers/GuestController.php",
                method: "POST",
                data: { action: "edit_guest", data: datos },
                success: function (update_guest) {
                    loadPartnerGuests();
                    console.log(update_guest);
                    $('#editGuestModal').modal('hide');
                    $('#editNameGuestMsg').removeClass('success-message').addClass('hide-element');
                    $('#editEmailGuestMsg').removeClass('success-message').addClass('hide-element');
                    $('#editSubjectGuestMsg').removeClass('success-message').addClass('hide-element');
                },
                error: function (xhr, status, error) {
                    // Manejo de errores en caso de que la solicitud falle
                    console.error("Error en la solicitud AJAX", error);
                    alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
                },
            });

        } else {
            console.log("Los campos para actualizar Visitante no se llenaron correctamente.");
        }
    });

    /*
    FUNCIONES DE VISITAS COMO COLABORADOR
    */

    // Manejar clic en el botón "Restablecer" de visitPartnerForm.php
    $("#resetPartnerVisitForm").on("click", function () {
        $("#visitPartnerForm")[0].reset();
        loadPartnerGuestsForVisit();
    });

    // Manejar clic en el botón "Registrar Visitantes" utilizando AJAX
    $("#formPartnerVisit").on("click", function () {
        // Redireccionar a visitPartnerForm.php para registrar los datos del Visitante
        window.location.href = "/public_html/views/visit/visitPartnerForm2.php";
    });

    // Cargar datos al mostrar visitPartnerForm2.php
    if (window.location.pathname.endsWith('visitPartnerForm2.php')) {
        // Función para llenar el Combobox/Selec con la lista de visitantes al cargar la página
        loadPartnerGuestsForVisit();
    }

    // Función para llenar Combobox/Select con la lista de visitantes que no poseen usuario
    function loadPartnerGuestsForVisit() {

        $.ajax({
            type: "POST",
            url: "/public_html/controllers/VisitController.php",
            data: { action: 'list_guests_for_visit' },
            success: function (list_guests_for_visit) {
                //console.log("Ingresa en el AJAX para mostrar lista de visitantes en select");
                //console.log(list_guests_for_visit);
                $('#visitGuestInput').html(list_guests_for_visit);
            },
            error: function (error) {
                console.error("Error al cargar la lista de colaboradores en select", error);
            }
        });
    }

    // Manejar validación para Ingresar o Registrar y Actualizar Visitantes
    function validateVisitInputs(subject, subjectMsg, number, numberMsg) {

        // Variables Booleanas (Falso - Veredadero)
        var subjectState = false;
        var noteState = false;
        var numberState = false;

        // Capturar los valores ingresados
        var asuntoValor = subject.val().trim();
        //var comentarioValor = note.val().trim();
        var cantidadValor = number.val().trim();

        // Expresiones regulares
        var subjectPattern = /^[a-zA-Z0-9ÁÉÍÓÚáéíóúñÑ,.#\-\s]+$/;
        //var notePattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; //Expresión actual es para "emailPattern"
        //var numberPattern = /^[a-zA-Z0-9ÁÉÍÓÚáéíóúñÑ,.#\-\s]+$/;

        // Validando campo Asunto para Visita
        if (!asuntoValor) {
            validateError(subjectMsg, 'Campo de Asunto vacío.');
        } else if (!asuntoValor.match(subjectPattern)) {
            validateError(subjectMsg, 'Escribe un asunto correcto.');
        } else {
            validateOk(subjectMsg, "¡Correcto!");
            subjectState = true;
        }

        if (!cantidadValor) {
            validateError(numberMsg, 'Campo de Cantidad vacío.');
        } else if (cantidadValor <= 0) {
            validateError(numberMsg, 'No puedes registrar una cantidad Menor o igual a 0.');
        } else if (cantidadValor > 200) {
            validateError(numberMsg, 'No puedes registrar una cantidad Mayor a 200.');
        } else {
            validateOk(numberMsg, "¡Correcto!");
            numberState = true;
        }

        // Validar el estado de Input del Formulario de Visita y retornar True o False
        if (subjectState == true && numberState == true) {
            return true;
        } else {
            return false;
        }
    }

    // Manejar clic en el botón "Guardar" utilizando AJAX
    $("#savePartnerVisit").on("click", function () {

        // Input de Texto
        var guest = $('#visitGuestInput');
        var subject = $('#visitSubjectInput');
        var note = $('#visitNoteInput');
        var number = $('#visitNumberInput');

        // Párrafo de cada Input
        var guestMsg = $('#visitGuestMsg');
        var subjectMsg = $('#visitSubjectMsg');
        var noteMsg = $('#visitNoteMsg');
        var numberMsg = $('#visitNumberMsg');

        estado = validateVisitInputs(subject, subjectMsg, number, numberMsg);

        if (estado) {
            //console.log("Los campos de Visita para actualizar se llenaron correctamente.");

            // Obtener los datos del formulario
            var visitPartnerForm = $("#visitPartnerForm").serialize();
            //console.log(visitPartnerForm);
            
            // Realizar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: "/public_html/controllers/VisitController.php",
                data: visitPartnerForm,
                success: function (visitPartnerForm) {

                    // Manejar la respuesta del servidor
                    console.log("Ingresa en el AJAX para Guardar Visita");
                    console.log(visitPartnerForm);
                    
                    // Mostrar mensaje de éxito
                    $("#visitSuccessMessage").text("¡La Visita se ha registrado exitosamente!").fadeIn();

                    // Limpiar el formulario después de 3 segundos
                    setTimeout(function () {
                        $("#visitPartnerForm")[0].reset();
                        $("#visitSuccessMessage").fadeOut();
                        loadPartnerGuestsForVisit();
                    }, 3000);
                    
                },
                error: function (error) {
                    console.error("Error en la solicitud AJAX", error);
                }
            });
            
        }
    });

    // Manejar clic en el botón "Listar Visitantes" utilizando AJAX
    $("#listPartnerVisit").on("click", function () {
        // Redireccionar a visitPartnerList2.php para mostrar los datos en la página
        window.location.href = "/public_html/views/visit/visitPartnerList2.php";
    });

    // Cargar datos al mostrar visitPartnerList2.php
    if (window.location.pathname.endsWith('visitPartnerList2.php')) {
        // Función para cargar la lista de Visitas al cargar la página
        loadPartnerVisits();
    }

    // Función para cargar la lista de Visitas
    function loadPartnerVisits() {
        $("#inputVisitSearch").focus();
        $.ajax({
            type: "POST",
            url: "/public_html/controllers/VisitController.php",
            data: { action: 'list_visits' },
            success: function (list_visits) {
                //console.log("Ingresa en el AJAX para mostrar los Visitas");
                //console.log(list_visits);

                var visits = JSON.parse(list_visits);
                var html = '';
                visits.forEach(function (visit) {
                    html += '<tr>';
                    html += '<td class="d-none" data-title="Codigo:">' + visit.idVisita + '</td>';
                    html += '<td class="d-none" data-title="Colaborador:">' + visit.colaborador + '</td>';
                    html += '<td data-title="Visitante:">' + visit.visitante + '</td>';
                    html += '<td data-title="Asunto:">' + visit.asunto + '</td>';
                    html += '<td data-title="Comentario:">' + visit.comentario + '</td>';
                    html += '<td data-title="Cantidad:">' + visit.cantidad + '</td>';
                    html += '<td data-title="Fecha:">' + visit.fechaVisita + '</td>';
                    // Agregar botones de acciones (Editar y Eliminar)
                    html += '<td class="text-center">';
                    html += '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
                    html += '<button type="button" class="btn btn-primary btn-editVisit" data-bs-toggle="modal" data-bs-target="#editVisitModal"><i class="bi bi-pencil"></i></button>';
                    html += '</div>';
                    html += '</td>';
                    html += '</tr>';
                });
                $('#visitTable tbody').html(html);

            },
            error: function (error) {
                console.error("Error al cargar la lista de visitas", error);
            }
        });
    }

    // Evento/s al cambiar/seleccionar Radio Button Diferente
    $('input[name="visit-options"]').on("change", function () {
        $("#inputVisitSearch").val('');
        loadPartnerVisits();
    });

    // Evento de búsqueda de Visitante según criterio de Radio Button
    $("#inputVisitSearch").on("keyup", function () {
        var searchTerm = $(this).val().toLowerCase();
        var column = $('input[name="visit-options"]:checked').data('column');
        $('#visitTable tbody tr').filter(function () {
            $(this).toggle($(this).find('td').eq(column).text().toLowerCase().indexOf(searchTerm) > -1)
        });
    });

    /*
    FUNCIONES PARA DESCARGAR EXCEL DE VISITANTES COMO COLABORADOR
    */

    // Función para generar Arreglo de Visitantes
    function generateVisitData() {
        var data = [];
        var headers = ['Código Visita', 'Visitante', 'Asunto', 'Comentario', 'Cantidad', 'Fecha visita'];

        data.push(headers);

        $('table tbody tr').each(function () {
            var row = [];
            $(this).find('td').each(function (index) {
                if (index !== 7) { // Excluir columna "Acciones"
                    row.push($(this).text());
                }
            });
            data.push(row);
        });
        return data;
    }

    // Función para manejar el clic del botón "Exportar Excel" de Visitantes
    $('#btnVisitExport').click(function () {
        var data = generateVisitData();
        var ws = XLSX.utils.aoa_to_sheet(data);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Visitas");
        XLSX.writeFile(wb, "visitas.xlsx");
        $('#visitExportConfirm').modal('hide');
    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", ".btn-editVisit", function () {

        // Obtener la fila a la que pertenece el botón
        var row = $(this).closest('tr');

        // Obtener los datos de cada columna en la fila usando jQuery
        var id = row.find('td:eq(0)').text();
        var idColaborador = row.find('td:eq(1)').text();
        var idVisitante = row.find('td:eq(2)').text();
        var asunto = row.find('td:eq(3)').text();
        var comentario = row.find('td:eq(4)').text();
        var cantidad = row.find('td:eq(5)').text();
        //var fecha = row.find('td:eq(6)').text();

        // Llenar los campos del modal con los datos obtenidos
        $('#inputEditIdVisit').val(id);
        //console.log(id);
        $('#inputEditVisitPartnerName').val(idColaborador);
        $('#inputEditVisitGuestName').val(idVisitante);
        $('#inputEditVisitSubject').val(asunto);
        $('#inputEditVisitNote').val(comentario);
        $('#inputEditVisitNumber').val(cantidad);
    });

    // Función para manejar clic en el botón "Actualizar" utilizando AJAX
    $(document).on("click", "#btnUpdateVisit", function () {

        // Input de Texto
        var idVisit = $('#inputEditIdVisit').val();
        //var namePartner = $('#inputEditVisitPartnerName').val();
        //var nameGuest = $('#inputEditVisitGuestName').val();
        var subjectVisit = $('#inputEditVisitSubject').val();
        var noteVisit = $('#inputEditVisitNote').val();
        var numberVisit = $('#inputEditVisitNumber').val();

        // Input de Texto
        var partner = $('#inputEditVisitPartnerName');
        var guest = $('#inputEditVisitGuestName');
        var subject = $('#inputEditVisitSubject');
        var note = $('#inputEditVisitNote');
        var number = $('#inputEditVisitNumber');

        // Párrafo de cada Input
        var partnerMsg = $('#visitPartnerNameMsg');
        var guestMsg = $('#visitGuestNameMsg');
        var subjectMsg = $('#visitSubjectMsg');
        var noteMsg = $('#visitNoteMsg');
        var numberMsg = $('#visitNumberMsg');

        estado = validateVisitInputs(subject, subjectMsg, number, numberMsg);

        if (estado) {
            //console.log("Los campos de Visita para actualizar se llenaron correctamente.");

            // Crear un objeto con los datos del formulario
            var datos = {
                id: idVisit,
                //partner: namePartner,
                //guest: nameGuest,
                subject: subjectVisit,
                note: noteVisit,
                number: numberVisit
            };

            //console.log(datos);

            $.ajax({
                url: "/public_html/controllers/VisitController.php",
                method: "POST",
                data: { action: "edit_visit", data: datos },
                success: function (update_visit) {
                    console.log(update_visit);
                    loadPartnerVisits();
                    $('#editVisitModal').modal('hide');
                    $('#visitSubjectMsg').removeClass('success-message').addClass('hide-element');
                    $('#visitNumberMsg').removeClass('success-message').addClass('hide-element');
                },
                error: function (xhr, status, error) {
                    // Manejo de errores en caso de que la solicitud falle
                    console.error("Error en la solicitud AJAX", error);
                    alert('Error en la solicitud AJAX. Por favor, inténtelo de nuevo más tarde.');
                },
            });

        } else {
            console.log("Los campos de Visita para actualizar NO se llenaron correctamente.");
        }
    });

    /*
    / FUNCIONES DE SELECT CON BUSQUEDA
    */

    $("#visitGuestInput").select2({
        placeholder: 'Buscar al visitante por su nombre',
        tags: true,
        width: '100%' // Ajusta el ancho según tus necesidades
    });

    $("#visitPartnerGuestInput").select2({
        placeholder: 'Buscar al visitante por su nombre',
        tags: true,
        width: '100%' // Ajusta el ancho según tus necesidades
    });


});

/*
MENU SUPERIOR (OCULTAR / MOSTRAR)
*/
window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
