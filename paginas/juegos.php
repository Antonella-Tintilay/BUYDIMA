<?php

require_once __DIR__ . '/../config/env.php';

$titulo_pagina = 'Todos los juegos | Catálogo ' . APP_NAME;
$descripcion_pagina = 'Explorá el catálogo completo de BUYDIMA: diamantes y monedas de Free Fire, Mobile Legends, Roblox, Genshin Impact y Battlegrounds, filtrados por categoría.';
$pagina_activa = 'juegos';
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
          <p class="etiqueta-catalogo">Catálogo BUYDIMA</p>
          <h1 class="titulo-pagina">Todos los juegos</h1>
          <p class="texto-suave">Encontrá tu juego favorito y recargá saldo en pocos minutos.</p>
        </header>

        <!-- Buscador grande del catálogo -->
        <form class="row g-2 mt-3" role="search" onsubmit="return false;">
          <div class="col-12">
            <label class="visually-hidden" for="filtro-busqueda">Buscar juego por nombre</label>
            <div class="position-relative">
              <i
                class="bi bi-search position-absolute top-50 translate-middle-y ms-3 texto-suave"
                aria-hidden="true"
              ></i>
              <input
                type="search"
                class="form-control ps-5 py-2"
                id="filtro-busqueda"
                placeholder="Buscar por nombre de juego..."
                autocomplete="off"
              />
            </div>
          </div>
        </form>

        <!-- Filtros por categoría -->
        <nav class="d-flex flex-wrap gap-2 mt-3" aria-label="Filtrar catálogo por categoría">
          <button class="chip-filtro activo" type="button" data-filtro="todos">Todos</button>
          <button class="chip-filtro" type="button" data-filtro="accion">Acción</button>
          <button class="chip-filtro" type="button" data-filtro="aventura">Aventura</button>
          <button class="chip-filtro" type="button" data-filtro="battle-royale">
            Battle Royale
          </button>
          <button class="chip-filtro" type="button" data-filtro="rpg">RPG</button>
          <button class="chip-filtro" type="button" data-filtro="deportes">Deportes</button>
        </nav>

        <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
          <h2 class="h4 mb-0" id="titulo-catalogo">Explorá el catálogo</h2>
          <button class="btn btn-outline-light btn-sm" type="button" id="boton-populares">
            Más populares <i class="bi bi-chevron-right" aria-hidden="true"></i>
          </button>
        </div>

        <!-- Grilla de juegos (cada tarjeta declara su categoría y popularidad) -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3" id="grilla-juegos">
          <div class="col">
            <article
              class="tarjeta-juego"
              data-categoria="battle-royale"
              data-nombre="Free Fire"
              data-popularidad="95"
            >
              <img src="../img/freefire.svg" alt="Logo del juego Free Fire" />
              <div class="cuerpo">
                <h3 class="h6">Free Fire</h3>
                <a class="enlace-recargar" href="detalle-juego.php?juego=freefire"
                  >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                  ><span class="visually-hidden">diamantes de Free Fire</span></a
                >
              </div>
            </article>
          </div>
          <div class="col">
            <article
              class="tarjeta-juego"
              data-categoria="accion"
              data-nombre="Mobile Legends"
              data-popularidad="90"
            >
              <img src="../img/mobilelegends.jpg" alt="Logo del juego Mobile Legends" />
              <div class="cuerpo">
                <h3 class="h6">Mobile Legends</h3>
                <a class="enlace-recargar" href="detalle-juego.php?juego=mobilelegends"
                  >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                  ><span class="visually-hidden">diamantes de Mobile Legends</span></a
                >
              </div>
            </article>
          </div>
          <div class="col">
            <article
              class="tarjeta-juego"
              data-categoria="aventura"
              data-nombre="Roblox"
              data-popularidad="88"
            >
              <img src="../img/roblox-banner.jpg" alt="Logo del juego Roblox" />
              <div class="cuerpo">
                <h3 class="h6">Roblox</h3>
                <a class="enlace-recargar" href="detalle-juego.php?juego=roblox"
                  >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                  ><span class="visually-hidden">Robux de Roblox</span></a
                >
              </div>
            </article>
          </div>
          <div class="col">
            <article
              class="tarjeta-juego"
              data-categoria="rpg"
              data-nombre="Genshin Impact"
              data-popularidad="80"
            >
              <img src="../img/genshin.png" alt="Logo del juego Genshin Impact" />
              <div class="cuerpo">
                <h3 class="h6">Genshin Impact</h3>
                <a class="enlace-recargar" href="detalle-juego.php?juego=genshin"
                  >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                  ><span class="visually-hidden">Cristales Génesis de Genshin Impact</span></a
                >
              </div>
            </article>
          </div>
          <div class="col">
            <article
              class="tarjeta-juego"
              data-categoria="accion"
              data-nombre="Battleground"
              data-popularidad="75"
            >
              <img src="../img/battleground.jpg" alt="Logo del juego Battlegrounds Mobile" />
              <div class="cuerpo">
                <h3 class="h6">Battleground</h3>
                <a class="enlace-recargar" href="detalle-juego.php?juego=battleground"
                  >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                  ><span class="visually-hidden">UC de Battlegrounds</span></a
                >
              </div>
            </article>
          </div>
        </div>
        <p class="texto-suave mt-4" id="sin-resultados" hidden>
          No se encontraron juegos con ese criterio. Probá con otra búsqueda.
        </p>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

