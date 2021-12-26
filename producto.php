<!-- Incluimos el header que tenemos predefinido en la carpeta includes -->
<?php

// Importar la conexion db
require "includes/config/database.php";
$db = conectarDB();

// Mensaje de que se creo bien un producto
$id = $_GET['id'] ?? null;

// Escribimos el query
$query = "SELECT * FROM producto WHERE id = ${id}";

// Consultar la BD
$resultado = mysqli_query($db, $query);
$producto = mysqli_fetch_assoc($resultado);

require 'includes/funciones.php';
incluirTemplate("header");
?>
<div class="producto-envista contenedor">
    <img src="imagenes/<?php echo $producto['imagen']; ?>" alt="Producto">
    <div class="info-producto">
        <h2><?php echo $producto['titulo']; ?></h2>
        <h3>$ <?php echo $producto['precio']; ?></h3>
        <p><?php echo $producto['descripcion']; ?></p>

        <a href="#" class="boton boton-crear">comprar</a>
    </div>
</div>
</body>
</html>
