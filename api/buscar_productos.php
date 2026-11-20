
<?php

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/conexion.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $pdo = conexion();

    $busqueda = trim($_GET['q'] ?? '');

    if (strlen($busqueda) > 100) {
        http_response_code(400);

        echo json_encode([
            'status' => 'error',
            'mensaje' => 'La búsqueda no puede superar los 100 caracteres.'
        ], JSON_UNESCAPED_UNICODE);

        exit;
    }

    $consulta = $pdo->prepare(
        'SELECT
            p.id_producto,
            p.nombre_producto,
            p.descripcion,
            p.precio,
            p.stock,
            j.nombre AS juego
         FROM productos AS p
         INNER JOIN juegos AS j ON j.id_juego = p.id_juego
         WHERE p.activo = TRUE
           AND j.activo = TRUE
           AND (
                p.nombre_producto LIKE :busqueda_producto
                OR j.nombre LIKE :busqueda_juego
           )
         ORDER BY j.nombre ASC, p.precio ASC'
    );

    $termino = '%' . $busqueda . '%';

    $consulta->execute([
        'busqueda_producto' => $termino,
        'busqueda_juego' => $termino
    ]);

    $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'data' => $productos
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

} catch (Throwable $e) {
    error_log('Error al buscar productos: ' . $e->getMessage());

    http_response_code(500);

    echo json_encode([
        'status' => 'error',
        'mensaje' => 'No se pudieron obtener los productos.'
    ], JSON_UNESCAPED_UNICODE);
}
