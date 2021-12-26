<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Closet Del Programador</title>
    <!-- Link Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />

    <!-- Link Css -->
    <link rel="stylesheet" href="/style/style.css" />
  </head>
  <body>
    <header class="header">
      <a href="/index.php" class="logo"
        ><i class="fab fa-jsfiddle"></i> <span> Closet Del Programador</span></a
      >

      <nav class="navegacion">
        <a class="tienda" href="index.php">tienda</a>
        <span>|</span>
        <a class="nosotros" href="#">nosotros</a>
      </nav>

      <div class="iconos">
        <div id="btn-buscar" class="fas fa-search"></div>
        <a href="/admin" class="fas fa-user"></a>
        <a href="#" class="fas fa-shopping-cart"></a>
        <div id="btn-menu" class="fas fa-bars"></div>
      </div>

      <form action="" class="buscador">
        <input
          type="search"
          name=""
          placeholder="buscar aqui..."
          id="caja-buscador"
        />
        <label for="caja-buscador" class="fas fa-search"></label>
      </form>
    </header>
