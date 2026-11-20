<?php
require_once __DIR__ . '/../config/auth_guard.php';
requiere_administrador();

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../config/productos.php';

$titulo_pagina = 'Editar producto | Administración | ' . APP_NAME;
$descripcion_pagina = 'Edición de productos del catálogo de BUYDIMA desde el panel de administración.';
$pagina_activa = 'productos';
$ruta_base = '..';

$juegos = [];
$errores = [];
$error_conexion = null;
$producto = null;
$valores = [
  'nombre_producto' => '',
  'id_juego' => '',
  'descripcion' => '',
  'precio' => '',
  'stock' => '0',
];

$id_producto_get = $_GET['id_producto'] ?? '';
$id_producto = 0;

if (is_string($id_producto_get) && preg_match('/^\d+$/', $id_producto_get)) {
  $id_producto = (int) $id_producto_get;
}

try {
  $pdo = conexion();
  $juegos = listar_juegos($pdo);

  if ($id_producto > 0) {
    $producto = buscar_producto($pdo, $id_producto);
  }
} catch (Throwable $e) {
  $error_conexion = 'No se pudo conectar con la base de datos. Intentá nuevamente más tarde.';
  error_log('Error de conexión en edición de productos: ' . $e->getMessage());
}

if ($error_conexion === null && $producto !== null) {
  if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $valores = datos_producto_post();
    $errores = validar_producto($valores, $juegos);

    if ($errores === []) {
      try {
        actualizar_producto($pdo, $id_producto, $valores);

        header('Location: index.php?actualizado=1');
        exit;
      } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
          $errores['nombre_producto'] = 'Ya existe otro producto con ese nombre para el juego elegido.';
        } else {
          $errores['general'] = 'No se pudo actualizar el producto. Intentá nuevamente más tarde.';
          error_log('Error al actualizar producto: ' . $e->getMessage());
        }
      }
    }
  } else {
    $valores = [
      'nombre_producto' => (string) $producto['nombre_producto'],
      'id_juego' => (string) $producto['id_juego'],
      'descripcion' => (string) ($producto['descripcion'] ?? ''),
      'precio' => (string) $producto['precio'],
      'stock' => (string) $producto['stock'],
    ];
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
            <li class="breadcrumb-item active" aria-current="page">Editar producto</li>
          </ol>
        </nav>

        <header>
          <p class="etiqueta-catalogo">Panel de administración</p>
          <h1 class="titulo-pagina">Editar producto</h1>
          <?php if ($producto !== null) : ?>
            <p class="texto-suave">
              Modificá los datos de
              <strong><?php echo escapar($valores['nombre_producto']); ?></strong> y guardá los
              cambios.
            </p>
          <?php endif; ?>
        </header>

        <?php if ($error_conexion !== null) : ?>
          <div class="alert alert-danger mt-4" role="alert">
            <?php echo escapar($error_conexion); ?>
          </div>
        <?php elseif ($id_producto === 0) : ?>
          <div class="alert alert-warning mt-4" role="alert">
            <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>
            No se indicó un producto válido para editar.
          </div>
          <a class="btn btn-outline-light" href="index.php">Volver al listado</a>
        <?php elseif ($producto === null) : ?>
          <div class="alert alert-warning mt-4" role="alert">
            <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>
            El producto solicitado no existe o no está activo.
          </div>
          <a class="btn btn-outline-light" href="index.php">Volver al listado</a>
        <?php elseif ($juegos === []) : ?>
          <div class="alert alert-danger mt-4" role="alert">
            No hay juegos activos para asociar al producto.
          </div>
          <a class="btn btn-outline-light" href="index.php">Volver al listado</a>
        <?php else : ?>
          <section class="mt-4" aria-labelledby="titulo-formulario">
            <div class="panel p-4">
              <h2 class="h4 mb-3" id="titulo-formulario">Datos del producto</h2>

              <?php if ($errores !== []) : ?>
                <div class="alert alert-danger" role="alert">
                  <p class="mb-2"><strong>Revisá los datos del producto:</strong></p>
                  <ul class="mb-0">
                    <?php foreach ($errores as $error) : ?>
                      <li><?php echo escapar($error); ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

              <form method="post" action="editar.php?id_producto=<?php echo (int) $producto['id_producto']; ?>" novalidate>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label" for="campo-nombre">Nombre del producto</label>
                    <input
                      type="text"
                      class="form-control<?php echo isset($errores['nombre_producto']) ? ' is-invalid' : ''; ?>"
                      id="campo-nombre"
                      name="nombre_producto"
                      value="<?php echo escapar($valores['nombre_producto']); ?>"
                      maxlength="120"
                      required
                    />
                    <?php if (isset($errores['nombre_producto'])) : ?>
                      <div class="invalid-feedback">
                        <?php echo escapar($errores['nombre_producto']); ?>
                      </div>
                    <?php endif; ?>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label" for="campo-juego">Juego</label>
                    <select
                      class="form-select<?php echo isset($errores['id_juego']) ? ' is-invalid' : ''; ?>"
                      id="campo-juego"
                      name="id_juego"
                      required
                    >
                      <option value="">Elegí un juego</option>
                      <?php foreach ($juegos as $juego) : ?>
                        <option
                          value="<?php echo (int) $juego['id_juego']; ?>"
                          <?php if ((string) $juego['id_juego'] === $valores['id_juego']) : ?>selected<?php endif; ?>
                        >
                          <?php echo escapar($juego['nombre']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <?php if (isset($errores['id_juego'])) : ?>
                      <div class="invalid-feedback">
                        <?php echo escapar($errores['id_juego']); ?>
                      </div>
                    <?php endif; ?>
                  </div>

                  <div class="col-12">
                    <label class="form-label" for="campo-descripcion">Descripción</label>
                    <textarea
                      class="form-control<?php echo isset($errores['descripcion']) ? ' is-invalid' : ''; ?>"
                      id="campo-descripcion"
                      name="descripcion"
                      rows="2"
                      maxlength="255"
                    ><?php echo escapar($valores['descripcion']); ?></textarea>
                    <?php if (isset($errores['descripcion'])) : ?>
                      <div class="invalid-feedback">
                        <?php echo escapar($errores['descripcion']); ?>
                      </div>
                    <?php endif; ?>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label" for="campo-precio">Precio</label>
                    <input
                      type="number"
                      class="form-control<?php echo isset($errores['precio']) ? ' is-invalid' : ''; ?>"
                      id="campo-precio"
                      name="precio"
                      value="<?php echo escapar($valores['precio']); ?>"
                      min="0"
                      step="0.01"
                      required
                    />
                    <?php if (isset($errores['precio'])) : ?>
                      <div class="invalid-feedback">
                        <?php echo escapar($errores['precio']); ?>
                      </div>
                    <?php endif; ?>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label" for="campo-stock">Stock</label>
                    <input
                      type="number"
                      class="form-control<?php echo isset($errores['stock']) ? ' is-invalid' : ''; ?>"
                      id="campo-stock"
                      name="stock"
                      value="<?php echo escapar($valores['stock']); ?>"
                      min="0"
                      step="1"
                      required
                    />
                    <?php if (isset($errores['stock'])) : ?>
                      <div class="invalid-feedback">
                        <?php echo escapar($errores['stock']); ?>
                      </div>
                    <?php endif; ?>
                  </div>

                  <div class="col-12 d-flex flex-wrap gap-2">
                    <button class="btn boton-compra" type="submit">
                      <i class="bi bi-check-lg" aria-hidden="true"></i> Guardar cambios
                    </button>
                    <a class="btn btn-outline-light" href="index.php">Cancelar</a>
                  </div>
                </div>
              </form>
            </div>
          </section>
        <?php endif; ?>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
