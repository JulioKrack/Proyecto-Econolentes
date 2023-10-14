<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_econolentes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $contrasena = mysqli_real_escape_string($conn, $_POST["contrasena"]);

    $emailExistsQuery = "SELECT * FROM usuarios WHERE email='$email'";
    $emailExistsResult = $conn->query($emailExistsQuery);

    if ($emailExistsResult->num_rows === 1) {
        $row = $emailExistsResult->fetch_assoc();
        if ($contrasena === $row["contrasena"]) {
            $rol_id = $row["rol_id"];
            $rolQuery = "SELECT rol FROM roles WHERE Id=$rol_id";
            $rolResult = $conn->query($rolQuery);
            if ($rolResult->num_rows === 1) {
                $rolRow = $rolResult->fetch_assoc();
                $rol = $rolRow["rol"];
                
                if ($rol === "Vendedor") {
                    $nombreUsuario = $row["nombre"];
                    header("Location: gestion-empleado.html?nombre=$nombreUsuario");
                    exit();
                } elseif ($rol === "Comprador") {
                    $nombreUsuario = $row["nombre"];
                    header("Location: inicio.html?nombre=$nombreUsuario");
                    exit();
                } else {
                    echo "Rol desconocido: $rol";
                }
            } else {
                echo "No se pudo determinar el rol del usuario.";
            }
        } else {
            echo "Credenciales incorrectas. Por favor, verifica tu contraseña.";
        }
    } else {
        echo "El correo electrónico ingresado no existe.";
    }
}

$conn->close();
?>

<script>
    // validar el formulario de registro
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let correo = document.getElementById("correo").value;   
    let telefono = document.getElementById("telefono").value;
    let mensaje = document.getElementById("mensaje").value;
    let error = document.getElementById("error");

    if(nombre == "" || apellido == "" || correo == "" || telefono == "" || mensaje == "") {
        error.innerHTML = "Todos los campos son obligatorios";
        return false;
    } else if(nombre.length > 30) {
        error.innerHTML = "El nombre es muy largo";
        return false;
    } else if(apellido.length > 80) {
        error.innerHTML = "El apellido es muy largo";
        return false;
    } else if(correo.length > 100) {
        error.innerHTML = "El correo es muy largo";
        return false;
    } else if(telefono.length > 10) {
        error.innerHTML = "El telefono es muy largo";
        return false;
    } else if(isNaN(telefono)) {
        error.innerHTML = "El telefono ingresado no es un numero";
        return false;
    } else if(mensaje.length > 500) {
        error.innerHTML = "El mensaje es muy largo";
        return false;
    } else if(!expresion.test(correo)) {
        error.innerHTML = "El correo no es valido";
        return false;
    } else if(!expresion.test(telefono)) {
        error.innerHTML = "El telefono no es valido";
        return false;
    } else if(!expresion.test(nombre)) {
        error.innerHTML = "El nombre no es valido";
        return false;
    } else if(!expresion.test(apellido)) {
        error.innerHTML = "El apellido no es valido";
        return false;
    } else if(!expresion.test(mensaje)) {
        error.innerHTML = "El mensaje no es valido";
        return false;
    } else if(!expresion.test(telefono)) {
        error.innerHTML = "El telefono no es valido";
        return false;
    } else if(!expresion.test(nombre)) {
        error.innerHTML = "El nombre no es valido";
        return false;
    } else if(!expresion.test(apellido)) {
        error.innerHTML = "El apellido no es valido";
        return false;
    } else if(!expresion.test(mensaje)) {
        error.innerHTML = "El mensaje no es valido";
        return false;
    } else if(!expresion.test(telefono)) {
        error.innerHTML = "El telefono no es valido";
        return false;
    } else if(!expresion.test(nombre)) {
        error.innerHTML = "El nombre no es valido";
        return false;
    } else if(!expresion.test(apellido)) {
        error
    }

</script>
