<?php

// Carga las variables del archivo .env y las expone como constantes.
// Implementación con PHP nativo (sin Composer ni librerías externas).

function cargar_env(string $ruta_archivo): void
{
  if (!is_readable($ruta_archivo)) {
    return;
  }

  $lineas = file($ruta_archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  foreach ($lineas as $linea) {
    $linea = trim($linea);

    // Ignora líneas vacías y comentarios
    if ($linea === '' || str_starts_with($linea, '#')) {
      continue;
    }

    [$clave, $valor] = array_pad(explode('=', $linea, 2), 2, '');
    $clave = trim($clave);
    $valor = trim($valor);

    // Quita las comillas que envuelvan el valor, si las hay
    if (
      strlen($valor) >= 2 &&
      ($valor[0] === '"' || $valor[0] === "'") &&
      str_ends_with($valor, $valor[0])
    ) {
      $valor = substr($valor, 1, -1);
    }

    $_ENV[$clave] = $valor;
  }
}

cargar_env(__DIR__ . '/../.env');

// Constantes disponibles para toda la aplicación (con valores por defecto)
define('APP_NAME', $_ENV['APP_NAME'] ?? 'BUYDIMA');
define('SUPPORT_EMAIL', $_ENV['SUPPORT_EMAIL'] ?? 'soporte@buydima.com');
define('APP_ENV', $_ENV['APP_ENV'] ?? 'local');
