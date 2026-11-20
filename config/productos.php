<?php

function listar_juegos(PDO $pdo): array
{
  $consulta = $pdo->prepare(
    'SELECT id_juego, nombre FROM juegos WHERE activo = TRUE ORDER BY nombre ASC'
  );
  $consulta->execute();

  return $consulta->fetchAll();
}

function listar_productos(PDO $pdo): array
{
  $consulta = $pdo->prepare(
    'SELECT p.id_producto, p.nombre_producto, p.descripcion, p.precio, p.stock, j.nombre AS juego
     FROM productos AS p
     INNER JOIN juegos AS j ON j.id_juego = p.id_juego
     WHERE p.activo = TRUE AND j.activo = TRUE
     ORDER BY j.nombre ASC, p.precio ASC'
  );
  $consulta->execute();

  return $consulta->fetchAll();
}

function validar_producto(array $datos, array $juegos): array
{
  $errores = [];

  if (mb_strlen($datos['nombre_producto'], 'UTF-8') < 2 || mb_strlen($datos['nombre_producto'], 'UTF-8') > 120) {
    $errores['nombre_producto'] = 'El nombre debe tener entre 2 y 120 caracteres.';
  }

  $ids_juegos = array_map('intval', array_column($juegos, 'id_juego'));

  if (
    !preg_match('/^\d+$/', $datos['id_juego']) ||
    !in_array((int) $datos['id_juego'], $ids_juegos, true)
  ) {
    $errores['id_juego'] = 'Elegí un juego válido.';
  }

  if (mb_strlen($datos['descripcion'], 'UTF-8') > 255) {
    $errores['descripcion'] = 'La descripción no puede superar los 255 caracteres.';
  }

  if (!preg_match('/^\d{1,8}(\.\d{1,2})?$/', $datos['precio'])) {
    $errores['precio'] = 'Ingresá un precio válido, mayor o igual a 0 y con hasta dos decimales.';
  }

  if (!preg_match('/^\d{1,9}$/', $datos['stock']) || (int) $datos['stock'] > 2147483647) {
    $errores['stock'] = 'Ingresá un stock válido, mayor o igual a 0.';
  }

  return $errores;
}

function buscar_producto(PDO $pdo, int $id_producto): ?array
{
  $consulta = $pdo->prepare(
    'SELECT p.id_producto, p.id_juego, p.nombre_producto, p.descripcion, p.precio, p.stock, j.nombre AS juego
     FROM productos AS p
     INNER JOIN juegos AS j ON j.id_juego = p.id_juego
     WHERE p.id_producto = :id_producto AND p.activo = TRUE'
  );
  $consulta->execute([':id_producto' => $id_producto]);
  $producto = $consulta->fetch();

  return $producto === false ? null : $producto;
}

function insertar_producto(PDO $pdo, array $datos): void
{
  $insertar = $pdo->prepare(
    'INSERT INTO productos (id_juego, nombre_producto, descripcion, precio, stock)
     VALUES (:id_juego, :nombre_producto, :descripcion, :precio, :stock)'
  );

  $insertar->execute([
    ':id_juego' => (int) $datos['id_juego'],
    ':nombre_producto' => $datos['nombre_producto'],
    ':descripcion' => $datos['descripcion'] === '' ? null : $datos['descripcion'],
    ':precio' => number_format((float) $datos['precio'], 2, '.', ''),
    ':stock' => (int) $datos['stock'],
  ]);
}

function actualizar_producto(PDO $pdo, int $id_producto, array $datos): void
{
  $actualizar = $pdo->prepare(
    'UPDATE productos
     SET id_juego = :id_juego,
         nombre_producto = :nombre_producto,
         descripcion = :descripcion,
         precio = :precio,
         stock = :stock
     WHERE id_producto = :id_producto AND activo = TRUE'
  );

  $actualizar->execute([
    ':id_juego' => (int) $datos['id_juego'],
    ':nombre_producto' => $datos['nombre_producto'],
    ':descripcion' => $datos['descripcion'] === '' ? null : $datos['descripcion'],
    ':precio' => number_format((float) $datos['precio'], 2, '.', ''),
    ':stock' => (int) $datos['stock'],
    ':id_producto' => $id_producto,
  ]);
}

function eliminar_producto(PDO $pdo, int $id_producto): bool
{
  $eliminar = $pdo->prepare(
    'DELETE FROM productos WHERE id_producto = :id_producto AND activo = TRUE'
  );
  $eliminar->execute([':id_producto' => $id_producto]);

  return $eliminar->rowCount() > 0;
}
