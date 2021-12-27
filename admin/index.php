 <!-- Incluimos el header que tenemos predefinido en la carpeta includes -->
<?php

require '../includes/funciones.php';

if (!estaAutenticado()) {
    header('Location: /');
}

// Importar la conexion db
require "../includes/config/database.php";
$db = conectarDB();

// Escribimos el query
$query = "SELECT * FROM producto";

// Consultar la BD
$resultado = mysqli_query($db, $query);

// Mensaje de que se creo bien un producto
$accion = $_GET['accion'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        // Eliminar el archivo
        $query = "SELECT imagen FROM producto WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
        $resultado = mysqli_fetch_assoc($resultado);
        $nombreImagen = $resultado['imagen'];

        unlink('../imagenes/' . $nombreImagen);

        // Eliminar la propiedad
        $query = "DELETE FROM producto WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header("Location: /admin");
        }
    }
}

incluirTemplate("header");
?>
    <main class="contenedor">
        <h1 class="titulo">Administrador de la tienda</h1>
        <?php if (intval($accion) === 1): ?>
            <div class="alerta exito">
                <?php echo 'producto creado correctamente'; ?>
            </div>
        <?php elseif (intval($accion) === 2): ?>
            <div class="alerta exito">
                <?php echo 'producto actualizado correctamente'; ?>
            </div>
        <?php endif;?>
        <diSv class="lista-botones">

            <a class="boton boton-claro" href="/admin/propiedades/crear.php" >Nuevo Producto</a>
            <a class="boton boton-claro" href="../cerrar_sesion.php" >Cerrar Sesión</a>
        </diSv>

        <table class="tabla-productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>titulo</th>
                    <th>precio</th>
                    <th>imagen</th>
                    <th>acciones</th>
                </tr>
            </thead>
            <tbody> <!-- Mostrar Los Resultados -->
            <?php while ($item = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['titulo']; ?></td>
                    <td>$<?php echo round($item['precio'], 0); ?></td>

                    <td> <img class="imagen-tabla" src="/imagenes/<?php echo $item['imagen']; ?>" alt=""> </td>
                    <td class="acciones-crud">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $item['id'] ?>">

                            <input type="submit" value="Eliminar">
                        </form>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $item['id']; ?>">Editar</a>
                    </td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </main>
<?php
mysqli_close($db);
incluirTemplate("footer");

?>
