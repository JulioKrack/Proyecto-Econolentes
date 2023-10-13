<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cuentas(1)";

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
                    header("Location: gestion-empleado.html");
                    exit();
                } elseif ($rol === "Comprador") {
                    header("Location: productos.html");
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
