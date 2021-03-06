<?php

require "app.php";

function incluirTemplate(string $nombre)
{
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado(): bool
{
    session_start();

    $auth = $_SESSION['login'] ?? null;
    if ($auth) {
        return true;
    }
    return false;

}
