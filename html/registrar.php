<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_econolentes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $contrasena = mysqli_real_escape_string($conn, $_POST["contrasena"]);
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $apellidos = mysqli_real_escape_string($conn, $_POST["apellidos"]);
    $telefono = mysqli_real_escape_string($conn, $_POST["telefono"]);
    
    $email_check_query = "SELECT * FROM usuarios WHERE email='$email' LIMIT 1";
    $email_result = $conn->query($email_check_query);

    if ($email_result !== false) {
        if ($email_result->num_rows > 0) {
            echo '<script>alert("Este nombre ya está registrado.");</script>';
            echo '<script>window.location.href = "registro.html";</script>';
            exit();
        }
    } else {
        echo "Error en la consulta: " . $conn->error;
        exit();
    }

    $sql = "INSERT INTO usuarios (email, contrasena, nombre, apellidos, telefono, rol_id) VALUES ('$email', '$contrasena', '$nombre','$apellidos','$telefono', 1)";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert(" Registrado cone exito");</script>';
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
