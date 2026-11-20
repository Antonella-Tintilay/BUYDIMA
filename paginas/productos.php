
<?php

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../app/Controllers/ProductoController.php';

$titulo_pagina = 'Productos disponibles | ' . APP_NAME;
$descripcion_pagina = 'Consultá los productos de BUYDIMA con su juego, precio y stock actualizado desde la base de datos.';
$pagina_activa = 'productos';
$ruta_base = '..';

$datos = (new ProductoController())->index();

$productos = $datos['productos'];
$error_conexion = $datos['error_conexion'];

require __DIR__ . '/../app/Views/productos/index.php';

