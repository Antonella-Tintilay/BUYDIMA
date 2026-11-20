<?php

require_once __DIR__ . '/../config/env.php';

$titulo_pagina = 'Mis favoritos | ' . APP_NAME;
$descripcion_pagina = 'Guardá tus juegos favoritos en BUYDIMA y encontralos fácilmente cuando quieras: accedé rápido a tus recargas preferidas.';
$pagina_activa = 'favoritos';
$ruta_base = '..';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main id="contenido-principal">
      <div class="container my-4">
        <button class="boton-volver" type="button" data-volver-atras>
          <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver
        </button>

        <header>
          <p class="etiqueta-catalogo">Tu colección</p>
          <h1 class="titulo-pagina">Mis favoritos</h1>
          <p class="texto-suave">
            Guardá tus juegos favoritos y encontralos fácilmente cuando quieras.
          </p>
        </header>

        <section
          class="panel estado-vacio-favoritos mt-4"
          id="estado-vacio-favoritos"
          aria-labelledby="titulo-vacio"
          hidden
        >
          <span class="icono-vacio" aria-hidden="true"><i class="bi bi-heart"></i></span>
          <h2 id="titulo-vacio" tabindex="-1">Todavía no tenés favoritos</h2>
          <p class="texto-suave">
            Explorá el catálogo y tocá el corazón de los juegos que más te gustan para tenerlos
            siempre a mano.
          </p>
          <a class="boton-compra" href="juegos.php"
            ><i class="bi bi-controller me-1" aria-hidden="true"></i> Explorar juegos</a
          >
        </section>

        <section class="mt-4" aria-labelledby="titulo-favoritos">
          <h2 class="visually-hidden" id="titulo-favoritos">Juegos guardados como favoritos</h2>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3" id="grilla-favoritos"></div>
        </section>

        <section
          class="panel p-4 mt-4"
          id="seccion-agregar-favoritos"
          aria-labelledby="titulo-agregar"
        >
          <h2 class="h5 mb-1" id="titulo-agregar">
            <i class="bi bi-plus-circle me-2" aria-hidden="true"></i>¿Querés sumar más juegos?
          </h2>
          <p class="texto-suave small mb-3">Tocá el corazón para agregarlos a tu colección.</p>
          <div class="row row-cols-2 row-cols-md-3 g-3" id="lista-agregar-favoritos"></div>
        </section>

        <p class="texto-suave small mt-3 mb-0">
          <i class="bi bi-shield-check me-1" aria-hidden="true"></i>
          Tus favoritos se guardan localmente en este navegador: es una demostración sin base de
          datos.
        </p>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
