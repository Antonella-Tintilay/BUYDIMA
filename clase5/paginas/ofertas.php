<?php

require_once __DIR__ . '/../config/env.php';

$titulo_pagina = 'Ofertas especiales | ' . APP_NAME;
$descripcion_pagina = 'Aprovechá las ofertas especiales de BUYDIMA: hasta 25% de descuento en recargas seleccionadas de tus juegos favoritos, por tiempo limitado.';
$pagina_activa = 'ofertas';
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
          <h1 class="titulo-pagina">Ofertas especiales</h1>
          <p class="texto-suave">
            Aprovechá precios únicos por tiempo limitado en tus juegos favoritos.
          </p>
        </header>

        <section
          class="banner-oferta d-flex flex-wrap align-items-center justify-content-between gap-4 mt-4"
          aria-labelledby="titulo-promo"
        >
          <div>
            <p class="etiqueta-catalogo mb-1">Catálogo BUYDIMA</p>
            <h2 class="h2 fw-bold mb-1" id="titulo-promo">
              Hasta 25% OFF en recargas seleccionadas
            </h2>
            <p class="mb-2" style="color: rgba(255, 255, 255, 0.85)">
              Usá el código <strong>BUYDIMA10</strong> al finalizar tu compra y aprovechá el
              descuento mientras termina el tiempo.
            </p>
            <a class="btn btn-light" href="#lista-ofertas">Ver promocionales</a>
          </div>
          <div class="d-flex gap-2" role="timer" aria-label="Tiempo restante de la promoción">
            <div class="cuenta-caja"><strong id="cuenta-dias">00</strong><small>Días</small></div>
            <div class="cuenta-caja"><strong id="cuenta-horas">00</strong><small>Horas</small></div>
            <div class="cuenta-caja"><strong id="cuenta-minutos">00</strong><small>Min</small></div>
          </div>
        </section>

        <nav class="d-flex flex-wrap gap-2 mt-4" aria-label="Filtrar ofertas">
          <button class="chip-filtro activo" type="button">Todos</button>
          <button class="chip-filtro" type="button">Hasta 15% OFF</button>
          <button class="chip-filtro" type="button">20% OFF o más</button>
          <button class="chip-filtro" type="button">Finalizan pronto</button>
        </nav>

        <section id="lista-ofertas" class="mt-4">
          <h2 class="visually-hidden">Promocionales vigentes</h2>
          <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">
            <div class="col">
              <article class="tarjeta-juego">
                <img src="../img/freefire.svg" alt="Logo del juego Free Fire" />
                <div class="cuerpo">
                  <h3 class="h6">Free Fire</h3>
                  <p class="mb-1">
                    <span class="precio-anterior">$ 5.990</span><br />
                    <span class="precio-oferta">$ 4.490</span>
                  </p>
                  <a class="enlace-recargar" href="detalle-juego.php?juego=freefire"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden">diamantes de Free Fire con descuento</span></a
                  >
                </div>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-juego">
                <img src="../img/mobilelegends.jpg" alt="Logo del juego Mobile Legends" />
                <div class="cuerpo">
                  <h3 class="h6">Mobile Legends</h3>
                  <p class="mb-1">
                    <span class="precio-anterior">$ 6.790</span><br />
                    <span class="precio-oferta">$ 3.500</span>
                  </p>
                  <a class="enlace-recargar" href="detalle-juego.php?juego=mobilelegends"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden"
                      >diamantes de Mobile Legends con descuento</span
                    ></a
                  >
                </div>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-juego">
                <img src="../img/roblox-banner.jpg" alt="Logo del juego Roblox" />
                <div class="cuerpo">
                  <h3 class="h6">Roblox</h3>
                  <p class="mb-1">
                    <span class="precio-oferta">$ 2.890</span>
                  </p>
                  <a class="enlace-recargar" href="detalle-juego.php?juego=roblox"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden">Robux de Roblox con descuento</span></a
                  >
                </div>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-juego">
                <img src="../img/genshin.png" alt="Logo del juego Genshin Impact" />
                <div class="cuerpo">
                  <h3 class="h6">Genshin Impact</h3>
                  <p class="mb-1">
                    <span class="precio-oferta">$ 6.790</span>
                  </p>
                  <a class="enlace-recargar" href="detalle-juego.php?juego=genshin"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden">Cristales Génesis con descuento</span></a
                  >
                </div>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-juego">
                <img src="../img/battleground.jpg" alt="Logo del juego Battlegrounds Mobile" />
                <div class="cuerpo">
                  <h3 class="h6">Battleground</h3>
                  <p class="mb-1">
                    <span class="precio-oferta">$ 1.990</span>
                  </p>
                  <a class="enlace-recargar" href="detalle-juego.php?juego=battleground"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden">UC de Battlegrounds con descuento</span></a
                  >
                </div>
              </article>
            </div>
          </div>
        </section>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
