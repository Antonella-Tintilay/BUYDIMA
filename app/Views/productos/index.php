
<?php

require_once __DIR__ . '/../../../includes/header.php';
require_once __DIR__ . '/../../../includes/nav.php';
?>

<main id="contenido-principal">
    <div class="container my-4">
        <button class="boton-volver" type="button" data-volver-atras>
            <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver
        </button>

        <header>
            <p class="etiqueta-catalogo">Catálogo BUYDIMA</p>
            <h1 class="titulo-pagina">Productos disponibles</h1>
            <p class="texto-suave">
                Paquetes de recarga publicados en la tienda, con su juego, precio y stock actualizado.
            </p>
        </header>

        <?php if ($error_conexion !== null) : ?>
            <div class="alert alert-danger mt-4" role="alert">
                <?php echo escapar($error_conexion); ?>
            </div>
        <?php else : ?>

            <section class="mt-4" aria-labelledby="titulo-listado">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                    <h2 class="h4 mb-0" id="titulo-listado">Listado de productos</h2>
                    <p class="texto-suave mb-0" id="cantidad-productos">
                        <?php echo count($productos); ?> productos
                    </p>
                </div>

                <div class="mb-4">
                    <label for="buscador-productos" class="form-label">
                        Buscar productos
                    </label>
                    <input
                        type="search"
                        class="form-control"
                        id="buscador-productos"
                        placeholder="Buscá por nombre de producto o juego..."
                        autocomplete="off"
                    >
                </div>

                <div id="resultados-productos" aria-live="polite">
                    <?php require __DIR__ . '/../../../includes/tabla-productos.php'; ?>
                </div>

                <p id="mensaje-busqueda" class="texto-suave mt-3" role="status"></p>
            </section>

        <?php endif; ?>
    </div>
</main>

<?php require_once __DIR__ . '/../../../includes/footer.php'; ?>
