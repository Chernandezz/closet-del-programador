<?php

// Importar la Conexion

require "includes/config/database.php";
$db = conectarDB();

// Crear Email y password
$email = "correo@correo.com";
$password = "123456";
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";

// echo $query;

mysqli_query($db, $query);

// Agregarlo a la base de datos
