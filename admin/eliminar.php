<?php

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../config/productos.php';

$titulo_pagina = 'Eliminar producto | Administración | ' . APP_NAME;
$descripcion_pagina = 'Eliminación de productos del catálogo de BUYDIMA desde el panel de administración.';
$pagina_activa = 'productos';
$ruta_base = '..';

$producto = null;
$error_conexion = null;
$error_eliminacion = null;

$id_producto_get = $_GET['id_producto'] ?? '';
$id_producto = 0;

if (is_string($id_producto_get) && preg_match('/^\d+$/', $id_producto_get)) {
  $id_producto = (int) $id_producto_get;
}

try {
  $pdo = conexion();

  if ($id_producto > 0) {
    $producto = buscar_producto($pdo, $id_producto);
  }
} catch (Throwable $e) {
  $error_conexion = 'No se pudo conectar con la base de datos. Intentá nuevamente más tarde.';
  error_log('Error de conexión en eliminación de productos: ' . $e->getMessage());
}

if ($error_conexion === null && $producto !== null && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
  try {
    if (eliminar_producto($pdo, $id_producto)) {
      header('Location: index.php?eliminado=1');
      exit;
    }

    $error_eliminacion = 'El producto ya no existe o fue desactivado. Volvé al listado para revisar los cambios.';
  } catch (PDOException $e) {
    if ($e->getCode() === '23000') {
      $error_eliminacion = 'No se puede eliminar el producto porque está asociado a pedidos existentes. Se conservó el historial de compras.';
    } else {
      $error_eliminacion = 'No se pudo eliminar el producto. Intentá nuevamente más tarde.';
      error_log('Error al eliminar producto: ' . $e->getMessage());
    }
  }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main id="contenido-principal">
      <div class="container my-4">
        <a class="boton-volver" href="index.php">
          <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver al listado
        </a>

        <nav aria-label="Ruta de navegación">
          <ol class="breadcrumb small">
            <li class="breadcrumb-item">
              <a class="enlace-recargar" href="../index.php">Inicio</a>
            </li>
            <li class="breadcrumb-item">
              <a class="enlace-recargar" href="index.php">Administración</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Eliminar producto</li>
          </ol>
        </nav>

        <header>
          <p class="etiqueta-catalogo">Panel de administración</p>
          <h1 class="titulo-pagina">Eliminar producto</h1>
          <p class="texto-suave">
            Revisá los datos antes de confirmar la baja del producto.
          </p>
        </header>

        <?php if ($error_conexion !== null) : ?>
          <div class="alert alert-danger mt-4" role="alert">
            <?php echo escapar($error_conexion); ?>
          </div>
        <?php elseif ($id_producto === 0) : ?>
          <div class="alert alert-warning mt-4" role="alert">
            <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>
            No se indicó un producto válido para eliminar.
          </div>
          <a class="btn btn-outline-light" href="index.php">Volver al listado</a>
        <?php elseif ($producto === null) : ?>
          <div class="alert alert-warning mt-4" role="alert">
            <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>
            El producto solicitado no existe o no está activo.
          </div>
          <a class="btn btn-outline-light" href="index.php">Volver al listado</a>
        <?php else : ?>
          <?php if ($error_eliminacion !== null) : ?>
            <div class="alert alert-danger mt-4" role="alert">
              <i class="bi bi-x-circle" aria-hidden="true"></i>
              <?php echo escapar($error_eliminacion); ?>
            </div>
          <?php endif; ?>

          <section class="mt-4" aria-labelledby="titulo-producto">
            <div class="panel p-4">
              <h2 class="h4 mb-3" id="titulo-producto">Producto seleccionado</h2>

              <dl class="row mb-0">
                <dt class="col-sm-3">Producto</dt>
                <dd class="col-sm-9"><?php echo escapar($producto['nombre_producto']); ?></dd>

                <dt class="col-sm-3">Juego</dt>
                <dd class="col-sm-9"><?php echo escapar($producto['juego']); ?></dd>

                <dt class="col-sm-3">Precio</dt>
                <dd class="col-sm-9">
                  <?php echo escapar(formatear_precio((float) $producto['precio'])); ?>
                </dd>

                <dt class="col-sm-3">Stock</dt>
                <dd class="col-sm-9">
                  <?php if ((int) $producto['stock'] > 0) : ?>
                    <?php echo (int) $producto['stock']; ?> disponibles
                  <?php else : ?>
                    Sin stock
                  <?php endif; ?>
                </dd>

                <?php if (!empty($producto['descripcion'])) : ?>
                  <dt class="col-sm-3">Descripción</dt>
                  <dd class="col-sm-9"><?php echo escapar($producto['descripcion']); ?></dd>
                <?php endif; ?>
              </dl>

              <?php if ($error_eliminacion === null) : ?>
                <div class="alert alert-warning mt-4" role="alert">
                  <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>
                  Esta acción no se puede deshacer. ¿Confirmás la eliminación?
                </div>

                <form
                  method="post"
                  action="eliminar.php?id_producto=<?php echo (int) $producto['id_producto']; ?>"
                  class="d-flex flex-wrap gap-2"
                >
                  <button class="btn btn-danger" type="submit">
                    <i class="bi bi-trash" aria-hidden="true"></i> Eliminar producto
                  </button>
                  <a class="btn btn-outline-light" href="index.php">Cancelar</a>
                </form>
              <?php else : ?>
                <a class="btn btn-outline-light mt-4" href="index.php">Volver al listado</a>
              <?php endif; ?>
            </div>
          </section>
        <?php endif; ?>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
