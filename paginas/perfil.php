
<?php

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/auth_guard.php';

requiere_login();

$titulo_pagina = 'Mi perfil | ' . APP_NAME;
$descripcion_pagina = 'Administrá tu cuenta de BUYDIMA.';
$pagina_activa = 'perfil';
$ruta_base = '..';

$nombre = $_SESSION['usuario_nombre'];
$rol = $_SESSION['rol'];

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main id="contenido-principal">
    <div class="container my-4">
        <header>
            <p class="etiqueta-catalogo">Mi cuenta</p>
            <h1 class="titulo-pagina">Mi perfil</h1>
            <p class="texto-suave">Bienvenido/a, <?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>.</p>
        </header>

        <section class="panel p-4 mt-4">
            <div class="d-flex align-items-center gap-3 mb-4">
                <img
                    src="../img/avatar.svg"
                    alt="Avatar de BUYDIMA"
                    width="72"
                    height="72"
                >
                <div>
                    <h2 class="h5 mb-1">
                        <?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>
                    </h2>
                    <p class="texto-suave mb-0">
                        Rol: <?php echo htmlspecialchars($rol, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                </div>
            </div>

            <nav aria-label="Opciones de la cuenta">
                <ul class="lista-perfil">
                    <li>
                        <a href="historial-compras.php">
                            <i class="bi bi-clock-history" aria-hidden="true"></i>
                            Historial de compras
                        </a>
                    </li>
                    <?php if ($rol === 'administrador') : ?>
                        <li>
                            <a href="../admin/index.php">
                                <i class="bi bi-gear" aria-hidden="true"></i>
                                Administración de productos
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="logout.php">
                            <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
