/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

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

document.addEventListener('DOMContentLoaded', function () {
    var editModals = document.querySelectorAll('.modal');

    editModals.forEach(function (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var nombre = button.getAttribute('data-bs-nombre');
            var apellido = button.getAttribute('data-bs-apellido');
            var dui = button.getAttribute('data-bs-dui');
            var direccion = button.getAttribute('data-bs-direccion');
            var correo = button.getAttribute('data-bs-correo');
            var celular = button.getAttribute('data-bs-celular');
            var fechaNacimiento = button.getAttribute('data-bs-fecha-nacimiento');
            var tipo = button.getAttribute('data-bs-tipo');

            var modalBody = modal.querySelector('.modal-body');

            modalBody.querySelector('#inputNamePartner').value = nombre;
            modalBody.querySelector('#inputLastNamePartner').value = apellido;
            modalBody.querySelector('#inputDuiPartner').value = dui;
            modalBody.querySelector('#inputAddressPartner').value = direccion;
            modalBody.querySelector('#inputEmailPartner').value = correo;
            modalBody.querySelector('#inputPhonePartner').value = celular;
            modalBody.querySelector('#inputDateBirthPartner').value = fechaNacimiento;
            modalBody.querySelector('#inputTypePartner').value = tipo;
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var editModals = document.querySelectorAll('.modal');

    editModals.forEach(function (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var nombre = button.getAttribute('data-bs-guestName');
            var correo = button.getAttribute('data-bs-guestEmail');
            var asunto = button.getAttribute('data-bs-guestSubject');
            var comentario = button.getAttribute('data-bs-guestNote');
            var cantidad = button.getAttribute('data-bs-guestNumber');

            var modalBody = modal.querySelector('.modal-body');

            modalBody.querySelector('#guestNameInput').value = nombre;
            modalBody.querySelector('#guestEmailInput').value = correo;
            modalBody.querySelector('#guestSubjectInput').value = asunto;
            modalBody.querySelector('#guestNoteInput').value = comentario;
            modalBody.querySelector('#guestNumberInput').value = cantidad;
        });
    });
});