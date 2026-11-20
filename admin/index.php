<?php

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../config/productos.php';

$titulo_pagina = 'Administración de productos | ' . APP_NAME;
$descripcion_pagina = 'Panel de administración de BUYDIMA para consultar y agregar productos.';
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
        <nav aria-label="Ruta de navegación">
          <ol class="breadcrumb small">
            <li class="breadcrumb-item">
              <a class="enlace-recargar" href="../index.php">Inicio</a>
            </li>
            <li class="breadcrumb-item">
              <a class="enlace-recargar" href="../paginas/productos.php">Productos</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Administración</li>
          </ol>
        </nav>

        <header>
          <p class="etiqueta-catalogo">Panel de administración</p>
          <h1 class="titulo-pagina">Productos</h1>
          <p class="texto-suave">
            Consultá los productos publicados y agregá nuevos paquetes al catálogo.
          </p>
        </header>

        <div class="d-flex flex-wrap gap-2 mt-3">
          <a class="btn boton-compra" href="crear.php">
            <i class="bi bi-plus-lg" aria-hidden="true"></i> Agregar producto
          </a>
          <a class="btn btn-outline-light" href="../paginas/productos.php">
            Ver catálogo público
          </a>
        </div>

        <?php if (($_GET['creado'] ?? '') === '1' && $error_conexion === null) : ?>
          <div class="alert alert-success mt-4" role="status">
            <i class="bi bi-check-circle" aria-hidden="true"></i> Producto agregado correctamente.
          </div>
        <?php endif; ?>

        <?php if (($_GET['actualizado'] ?? '') === '1' && $error_conexion === null) : ?>
          <div class="alert alert-success mt-4" role="status">
            <i class="bi bi-check-circle" aria-hidden="true"></i> Producto actualizado correctamente.
          </div>
        <?php endif; ?>

        <?php if (($_GET['eliminado'] ?? '') === '1' && $error_conexion === null) : ?>
          <div class="alert alert-success mt-4" role="status">
            <i class="bi bi-check-circle" aria-hidden="true"></i> Producto eliminado correctamente.
          </div>
        <?php endif; ?>

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

            <?php
            $tabla_acciones = true;
            require __DIR__ . '/../includes/tabla-productos.php';
            ?>
          </section>
        <?php endif; ?>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
