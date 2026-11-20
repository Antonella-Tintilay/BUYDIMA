<?php

require_once __DIR__ . '/../../config/conexion.php';

class Producto
{
    public static function listarActivos(): array
    {
        $pdo = conexion();

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
}