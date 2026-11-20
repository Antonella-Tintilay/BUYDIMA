<?php

function cargar_env(string $ruta_archivo): void
{
  if (!is_readable($ruta_archivo)) {
    return;
  }

  $lineas = file($ruta_archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  foreach ($lineas as $linea) {
    $linea = trim($linea);

    if ($linea === '' || str_starts_with($linea, '#')) {
      continue;
    }

    [$clave, $valor] = array_pad(explode('=', $linea, 2), 2, '');
    $clave = trim($clave);
    $valor = trim($valor);

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

define('APP_NAME', $_ENV['APP_NAME'] ?? 'BUYDIMA');
define('SUPPORT_EMAIL', $_ENV['SUPPORT_EMAIL'] ?? 'soporte@buydima.com');
define('APP_ENV', $_ENV['APP_ENV'] ?? 'local');
