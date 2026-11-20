<?php

require_once __DIR__ . '/env.php';

function conexion(): PDO
{
  $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
  $puerto = $_ENV['DB_PORT'] ?? '3306';
  $base = $_ENV['DB_NAME'] ?? 'buydima';
  $usuario = $_ENV['DB_USER'] ?? '';
  $contrasena = $_ENV['DB_PASSWORD'] ?? '';

  if ($usuario === '') {
    throw new RuntimeException('Falta configurar DB_USER en el archivo .env.');
  }

  $dsn = "mysql:host={$host};port={$puerto};dbname={$base};charset=utf8mb4";

  try {
    return new PDO($dsn, $usuario, $contrasena, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ]);
  } catch (PDOException $e) {
    error_log('Error de conexión a MySQL: ' . $e->getMessage());
    throw new RuntimeException('No se pudo conectar con la base de datos.', 0, $e);
  }
}
