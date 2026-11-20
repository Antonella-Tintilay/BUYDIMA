<?php

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../config/productos.php';

$titulo_pagina = 'Productos disponibles | ' . APP_NAME;
$descripcion_pagina = 'Consultá los productos de BUYDIMA con su juego, precio y stock actualizado desde la base de datos.';
$pagina_activa = 'productos';
$ruta_base = '..';

$productos = [];
$error_conexion = null;

try {
  $pdo = conexion();
  $productos = listar_productos($pdo);
} catch (Throwable $e) {
  $error_conexion = 'No se pudo cargar el listado de productos. Intentá nuevamente más tarde.';
  error_log('Error al listar productos: ' . $e->getMessage());
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main id="contenido-principal">
      <div class="container my-4">
        <button class="boton-volver" type="button" data-volver-atras>
          <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver
        </button>

        <header>
          <p class="etiqueta-catalogo">Catálogo BUYDIMA</p>
          <h1 class="titulo-pagina">Productos disponibles</h1>
          <p class="texto-suave">
            Paquetes de recarga publicados en la tienda, con su juego, precio y stock actualizado.
          </p>
        </header>

        <?php if ($error_conexion !== null) : ?>
          <div class="alert alert-danger mt-4" role="alert">
            <?php echo escapar($error_conexion); ?>
          </div>
        <?php else : ?>
          <section class="mt-4" aria-labelledby="titulo-listado">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
              <h2 class="h4 mb-0" id="titulo-listado">Listado de productos</h2>
              <p class="texto-suave mb-0"><?php echo count($productos); ?> productos</p>
            </div>

            <?php require __DIR__ . '/../includes/tabla-productos.php'; ?>
          </section>
        <?php endif; ?>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
