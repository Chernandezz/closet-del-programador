<!-- Incluimos el header que tenemos predefinido en la carpeta includes -->
<?php

require '../../includes/funciones.php';
if (!estaAutenticado()) {
    header('Location: /');
}

// Recoger ID de la URL
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

// Validamos que sea un id valido
if (!$id) {
    header("Location: /admin");
}

// Base de datos
require "../../includes/config/database.php";
$db = conectarDB();

// query para obtener los datos del producto
$query = "SELECT * FROM producto WHERE id = ${id}";
$resultado = mysqli_query($db, $query);

$item = mysqli_fetch_assoc($resultado);

// Arreglo con mensajes de errores
$errores = [];
$titulo = $item['titulo'];
$precio = $item['precio'];
$descripcion = $item['descripcion'];
$cantidad = $item['cantidad'];
$nombreImagen = $item['imagen'];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $cantidad = mysqli_real_escape_string($db, $_POST['cantidad']);

    // Asignar super globlar $_FILES a una variable
    $imagen = $_FILES['imagen'];

    if (!$titulo) {
        $errores[] = 'el titulo es requerido';
    }
    if (!$precio) {
        $errores[] = 'el precio es requerido';
    }
    if (!$cantidad) {
        $errores[] = 'la cantidad es requerida';
    }

    // Validamos el tamaño de la imagen
    $tam = 3000 * 1000; // Igual a 3MB
    if ($imagen['size'] > $tam) {
        $errores[] = 'La imagen es muy pesada';
    }

    //  Revisar que el arreglo de errores este vacio

    if (empty($errores)) {
        // Crear Carpeta

        $carpetaImagenes = '../../imagenes/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        // Subida de archivos

        if ($imagen['name']) {
            // Elimina la imagen previa
            unlink($carpetaImagenes . $nombreImagen);

            // Generar un nombre unico
            $nombreImagen = md5(uniqid('')) . '.png';

            // Subir Imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        }

        // Insertar en la base de datos
        $query = "UPDATE producto SET titulo = '${titulo}', precio = ${precio}, imagen = '${nombreImagen}', descripcion = '${descripcion}', cantidad = ${cantidad} WHERE id = ${id}";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // Redireccionar al Usuario
            header("Location: /admin?accion=2");
        }
    }

}

incluirTemplate("header");
?>

<main class="contenedor">
    <h1 class="titulo">actualizar producto</h1>
    <div class="botones-accion">
        <a href="/admin" class="boton boton-claro">Regresar</a>
    </div>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach;?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información</legend>

            <label for="titulo">titulo</label>
            <input type="text" name="titulo" id="titulo" placeholder="Nombre producto" value="<?php echo $titulo ?>">

            <label for="precio">precio</label>
            <input type="number" name="precio" id="precio" placeholder="Precio producto" min='1' value="<?php echo $precio ?>">

            <label for="descripcion">descripcion</label>
            <textarea name="descripcion" id="descripcion" placeholder="Agregue una descripcion del producto.."><?php echo $descripcion ?></textarea>

            <label for="cantidad">cantidad</label>
            <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad disponible" min='1' value="<?php echo $cantidad ?>">

            <label for="imagen">imagen</label>
            <div class="admin-imagenes">
                <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">
                <img src="../../imagenes/<?php echo $item['imagen'] ?>" alt="imagen">
            </div>
        </fieldset>
        <input type="submit" value="Actualizar Producto" class="boton boton-crear">
    </form>
</main>
</body>
</html>
