
<?php

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../config/sesion.php';

iniciar_sesion_segura();

if (isset($_SESSION['usuario_id'])) {
    header('Location: perfil.php');
    exit;
}

$error = '';

if (($_GET['error'] ?? '') === 'acceso_denegado') {
    $error = 'Tenés que iniciar sesión para acceder a esa página.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Completá el correo electrónico y la contraseña.';
    } else {
        try {
            $pdo = conexion();

            $consulta = $pdo->prepare(
                'SELECT u.id_usuario, u.nombre, u.email, u.password_hash, u.activo, r.nombre AS rol
                 FROM usuarios u
                 INNER JOIN roles r ON r.id_rol = u.id_rol
                 WHERE u.email = :email
                 LIMIT 1'
            );

            $consulta->execute(['email' => $email]);
            $usuario = $consulta->fetch();

            if (
                !$usuario ||
                !$usuario['activo'] ||
                !password_verify($password, $usuario['password_hash'])
            ) {
                $error = 'El correo electrónico o la contraseña son incorrectos.';
            } else {
                session_regenerate_id(true);

                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['rol'] = strtolower($usuario['rol']);

                header('Location: perfil.php');
                exit;
            }
        } catch (Throwable $e) {
            error_log('Error en inicio de sesión: ' . $e->getMessage());
            $error = 'No se pudo iniciar sesión. Intentá nuevamente.';
        }
    }
}

$titulo_pagina = 'Iniciar sesión | ' . APP_NAME;
$descripcion_pagina = 'Iniciá sesión en tu cuenta de BUYDIMA.';
$ruta_base = '..';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main id="contenido-principal">
    <div class="container my-4">
        <h1 class="titulo-pagina">Iniciar sesión</h1>
        <p class="texto-suave">Ingresá a tu cuenta de BUYDIMA.</p>

        <?php if ($error !== '') : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <form method="post" class="panel p-4" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    autocomplete="email"
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
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="btn boton-compra">Iniciar sesión</button>

            <p class="texto-suave mt-3 mb-0">
                ¿Todavía no tenés cuenta? <a href="registro.php">Registrate</a>.
            </p>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
