<?php

function escapar(?string $texto): string
{
  return htmlspecialchars($texto ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function formatear_precio(float $precio): string
{
  $decimales = fmod($precio, 1.0) === 0.0 ? 0 : 2;

  return '$ ' . number_format($precio, $decimales, ',', '.');
}

function valor_post(string $clave): string
{
  $valor = $_POST[$clave] ?? '';

  return is_string($valor) ? trim($valor) : '';
}

function datos_producto_post(): array
{
  return [
    'nombre_producto' => valor_post('nombre_producto'),
    'id_juego' => valor_post('id_juego'),
    'descripcion' => valor_post('descripcion'),
    'precio' => str_replace(',', '.', valor_post('precio')),
    'stock' => valor_post('stock'),
  ];
}
