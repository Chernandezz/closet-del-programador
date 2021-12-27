<!-- Incluimos el header que tenemos predefinido en la carpeta includes -->
<?php

// Importar la conexion db
require "includes/config/database.php";
$db = conectarDB();

// Escribimos el query
$query = "SELECT * FROM producto";

// Consultar la BD
$resultado = mysqli_query($db, $query);

require 'includes/funciones.php';
incluirTemplate("header");
?>
    <div class="catalogo contenedor">
      <?php while ($item = mysqli_fetch_assoc($resultado)): ?>
      <div class="producto">
        <a href="producto.php?id=<?php echo $item['id']; ?>">
          <img src="imagenes/<?php echo $item['imagen']; ?>" alt="Camiseta" />
          <div class="informacion">
            <h3 class="nombre"><?php echo $item['titulo']; ?></h3>
            <p class="precio">$<?php echo $item['precio']; ?></p>
          </div>
        </a>
      </div>
      <?php endwhile;?>
    </div>

<?php incluirTemplate("footer");?>