function validarFormulario() {
    const nombre = document.getElementById('nombre').value;
    const apellidos = document.getElementById('apellidos').value;
    const telefono = document.getElementById('telefono').value;
    const email = document.getElementById('email').value;
    const contrasena = document.getElementById('contrasena').value;

    if (nombre.trim() === '') {
        alert('Por favor, ingresa tu nombre.');
        return false;
    }

    if (apellidos.trim() === '') {
        alert('Por favor, ingresa tus apellidos.');
        return false;
    }
    if (telefono.trim() === '') {
        alert('Por favor, ingresa tus telefono.');
        return false;
    }
    if (email.trim() === '') {
        alert('Por favor, ingresa tu email.');
        return false;
    }
    if (contrasena.trim() === '') {
        alert('Por favor, ingresa tu contraseña.');
        return false;
    }

    return true;
}

document.querySelector('.formulario').addEventListener('submit', function(event) {
    if (!validarFormulario()) {
        event.preventDefault();
    }
});
