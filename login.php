<?php

require 'includes/funciones.php';
if (estaAutenticado()) {
    header('Location: /admin');
}

require 'includes/config/database.php';
$db = conectarDB();
// Autenticar el usuario

$errores = [];

$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es valido";
    }

    if (!$password) {
        $errores[] = "La contraseña es obligatoria";
    }
    if (empty($errores)) {
        // Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}';";
        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows) {
            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            // Verificar si el password es correcto o no
            $auth = password_verify($password, $usuario['password']);

            if ($auth) {
                // El usuario esta autenticado
                session_start();

                // Llenar el arreglo de la sesion
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
                header('Location: /admin');
            } else {
                // Contraseña incorrecta
                $errores = ['Contraseña Incorrecta'];
            }
        } else {
            $errores[] = "El usuario no existe";
        }
    }
}

// Incluimos el header que tenemos predefinido en la carpeta includes {

incluirTemplate("header");
?>

<main class="contenedor">
    <?php foreach ($errores as $error): ?>
        <div class="alerta error contenido-centrado">
            <?php echo $error; ?>
        </div>
    <?php endforeach;?>
    <form action="" class="formulario contenido-centrado" method="POST">
        <fieldset>
            <legend>Iniciar Sesión</legend>

            <label for="email">e-mail</label>
            <input type="email" name="email" id="email" placeholder="Tu Email" value="<?php echo $email ?>">

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Tu Contraseña">
        </fieldset>
        <input type="submit" value="Ingresar" class="boton boton-crear">
    </form>
</main>
</body>
</html>
