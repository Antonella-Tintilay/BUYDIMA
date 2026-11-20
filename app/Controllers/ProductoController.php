<?php

require_once __DIR__ . '/../Models/Producto.php';

class ProductoController
{
    public function index(): array
    {
        $productos = [];
        $error_conexion = null;

        try {
            $productos = Producto::listarActivos();
        } catch (Throwable $e) {
            $error_conexion = 'No se pudo cargar el listado de productos. Intentá nuevamente más tarde.';
            error_log('Error al listar productos: ' . $e->getMessage());
        }

        return [
            'productos' => $productos,
            'error_conexion' => $error_conexion,
        ];
    }
}