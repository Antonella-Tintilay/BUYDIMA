
<?php

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../config/sesion.php';

iniciar_sesion_segura();

if (isset($_SESSION['usuario_id'])) {
    header('Location: perfil.php');
    exit;
}

$errores = [];
$nombre = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmar_password = $_POST['confirmar_password'] ?? '';

    if ($nombre === '' || strlen($nombre) > 100) {
        $errores[] = 'Ingresá un nombre válido.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) {
        $errores[] = 'Ingresá un correo electrónico válido.';
    }

    if (strlen($password) < 8) {
        $errores[] = 'La contraseña debe tener al menos 8 caracteres.';
    }

    if ($password !== $confirmar_password) {
        $errores[] = 'Las contraseñas no coinciden.';
    }

    if ($errores === []) {
        try {
            $pdo = conexion();

            $consulta = $pdo->prepare(
                'SELECT id_usuario FROM usuarios WHERE email = :email LIMIT 1'
            );
            $consulta->execute(['email' => $email]);

            if ($consulta->fetch()) {
                $errores[] = 'Ya existe una cuenta con ese correo electrónico.';
            } else {
                $consulta_rol = $pdo->prepare(
                    "SELECT id_rol FROM roles WHERE nombre = 'cliente' LIMIT 1"
                );
                $consulta_rol->execute();
                $rol = $consulta_rol->fetch();

                if (!$rol) {
                    throw new RuntimeException('No se encontró el rol cliente.');
                }

                $hash = password_hash($password, PASSWORD_BCRYPT);

                $insertar = $pdo->prepare(
                    'INSERT INTO usuarios (id_rol, nombre, email, password_hash)
                     VALUES (:id_rol, :nombre, :email, :password_hash)'
                );

                $insertar->execute([
                    'id_rol' => $rol['id_rol'],
                    'nombre' => $nombre,
                    'email' => $email,
                    'password_hash' => $hash,
                ]);

                header('Location: perfil.php?registro=exitoso');
                exit;
            }
        } catch (Throwable $e) {
            error_log('Error en registro: ' . $e->getMessage());
            $errores[] = 'No se pudo completar el registro. Intentá nuevamente.';
        }
    }
}

$titulo_pagina = 'Crear cuenta | ' . APP_NAME;
$descripcion_pagina = 'Creá tu cuenta en BUYDIMA.';
$ruta_base = '..';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main id="contenido-principal">
    <div class="container my-4">
        <h1 class="titulo-pagina">Crear cuenta</h1>
        <p class="texto-suave">Registrate para comenzar a comprar en BUYDIMA.</p>

        <?php if ($errores !== []) : ?>
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errores as $error) : ?>
                        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" class="panel p-4" novalidate>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input
                    type="text"
                    class="form-control"
                    id="nombre"
                    name="nombre"
                    maxlength="100"
                    value="<?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    maxlength="150"
                    value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    minlength="8"
                    autocomplete="new-password"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="confirmar_password" class="form-label">Confirmar contraseña</label>
                <input
                    type="password"
                    class="form-control"
                    id="confirmar_password"
                    name="confirmar_password"
                    minlength="8"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" class="btn boton-compra">Crear cuenta</button>
            <p class="texto-suave mt-3 mb-0">
                ¿Ya tenés cuenta? <a href="perfil.php">Iniciá sesión</a>.
            </p>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
