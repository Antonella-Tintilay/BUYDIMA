<?php

require_once __DIR__ . '/sesion.php';

iniciar_sesion_segura();

function requiere_login(): void
{
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../paginas/login.php?error=acceso_denegado');
        exit;
    }
}

function requiere_administrador(): void
{
    requiere_login();

    if (($_SESSION['rol'] ?? '') !== 'administrador') {
        http_response_code(403);
        exit('No tenés permisos para acceder a esta página.');
    }
}