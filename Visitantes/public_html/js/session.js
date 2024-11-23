$(document).ready(function () {

    console.log("Archivo session.js cargado correctamente");

    $('#enterBtn').on('click', function (e) {
        e.preventDefault();  // Evitar el comportamiento predeterminado del enlace
        console.log("Click detectado");

        $.ajax({
            url: '/public_html/controllers/LoginController.php',
            type: 'POST',
            data: { action: 'checkSession' },
            success: function (response) {
                console.log("AJAX request completada");
                let data = JSON.parse(response);
                console.log(data);

                if (data.status === 'active') {
                    // Si la sesión está activa, redirigir según el tipo de usuario
                    if (data.tipoColaborador === 'Administrador') {
                        window.location.href = '/public_html/views/admin.php';
                    } else if (data.tipoColaborador === 'Colaborador') {
                        window.location.href = '/public_html/views/partner.php';
                    }
                } else {
                    // Si no hay sesión activa, redirigir al login
                    window.location.href = '/views/login.php';
                }
            },
            error: function (xhr, status, error) {
                console.log("Error en la solicitud AJAX:", error);
            }
        });
    });

    $('#logoutButton').on('click', function () {
        $.ajax({
            url: "/public_html/controllers/LoginController.php",
            type: 'POST',
            data: { action: 'logout' },
            success: function (response) {
                let data = JSON.parse(response);
                if (data.status === 'logged_out') {
                    //window.location.href = 'login.php';
                    window.location.href = "/public_html/views/login.php";
                }
            }
        });
    });

    // Verificar si la sesión sigue activa
    setInterval(function () {
        $.ajax({
            url: "/public_html/controllers/LoginController.php",
            type: 'POST',
            data: { action: 'checkSession' },
            success: function (response) {
                let data = JSON.parse(response);
                console.log("Verificando sesion activa: ");
                console.log(data);
                if (data.status === 'inactive') {
                    //alert('La sesión ha expirado. Redirigiendo al login...');
                    //window.location.href = 'login.php';
                    //window.location.href = "/public_html/views/login.php";
                    $('#sessionExpiredModal').modal('show');
                }
            }
        });
    }, 5000); // Verifica cada 5 segundos
});
