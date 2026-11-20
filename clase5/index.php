<?php

require_once __DIR__ . '/config/env.php';

$titulo_pagina = APP_NAME . ' | Recargá tus juegos al mejor precio';
$descripcion_pagina = 'BUYDIMA es tu tienda de confianza para comprar diamantes y monedas virtuales de Free Fire, Mobile Legends, Roblox, Genshin Impact y más, con entrega inmediata.';
$pagina_activa = 'inicio';
$ruta_base = '.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

<main id="contenido-principal">
      <div class="container my-4">

        <section class="heroe row g-0 align-items-stretch" aria-labelledby="titulo-hero">
          <div class="col-md-6 p-4 p-lg-5">
            <p class="mb-1" style="color: var(--lila)">Tu partida no se detiene</p>
            <h1 id="titulo-hero">
              Recargá tus juegos <span class="resaltado">al mejor precio</span>
            </h1>
            <a class="btn boton-compra mt-3" href="paginas/juegos.php"
              >Comprar ahora <i class="bi bi-chevron-right" aria-hidden="true"></i
            ></a>
            <ul class="insignias-confianza mt-4">
              <li><i class="bi bi-shield-check" aria-hidden="true"></i>Pago seguro</li>
              <li><i class="bi bi-lightning-charge" aria-hidden="true"></i>Entrega inmediata</li>
              <li><i class="bi bi-headset" aria-hidden="true"></i>Soporte</li>
            </ul>
          </div>
          <div class="col-md-6">

            <div
              id="carrusel-principal"
              class="carousel slide h-100 carrusel-principal"
              data-bs-ride="carousel"
              aria-roledescription="carrusel"
              aria-label="Promociones destacadas de BUYDIMA"
            >
              <div class="carousel-indicators">
                <button
                  type="button"
                  data-bs-target="#carrusel-principal"
                  data-bs-slide-to="0"
                  class="active"
                  aria-current="true"
                  aria-label="Ir a la promoción 1: LAST CHANCE"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carrusel-principal"
                  data-bs-slide-to="1"
                  aria-label="Ir a la promoción 2: Semana de ofertas"
                ></button>
              </div>
              <div class="carousel-inner h-100">
                <div class="carousel-item h-100 active" data-bs-interval="5000">
                  <img
                    src="img/banner-hero.jpg"
                    class="d-block w-100 h-100 object-fit-contain"
                    alt="Banner LAST CHANCE: skins de Mobile Legends x Jujutsu Kaisen"
                  />
                </div>
                <div class="carousel-item h-100" data-bs-interval="5000">
                  <img
                    src="img/banner-ofertas.svg?v=2"
                    class="d-block w-100 h-100 object-fit-contain"
                    alt="Banner de ofertas: hasta 25% de descuento en recargas seleccionadas"
                  />
                </div>
              </div>
              <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carrusel-principal"
                data-bs-slide="prev"
              >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Promoción anterior</span>
              </button>
              <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carrusel-principal"
                data-bs-slide="next"
              >
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Promoción siguiente</span>
              </button>
            </div>
          </div>
        </section>

        <section class="mt-5" aria-labelledby="titulo-destacados">
          <h2 id="titulo-destacados" class="h4 mb-3">Juegos destacados</h2>
          <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">
            <div class="col">
              <article class="tarjeta-juego">
                <img src="img/freefire.svg" alt="Logo del juego Free Fire" />
                <div class="cuerpo">
                  <h3>Free Fire</h3>
                  <a class="enlace-recargar" href="paginas/detalle-juego.php?juego=freefire"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden">diamantes de Free Fire</span></a
                  >
                </div>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-juego">
                <img src="img/mobilelegends.jpg" alt="Logo del juego Mobile Legends" />
                <div class="cuerpo">
                  <h3>Mobile Legends</h3>
                  <a class="enlace-recargar" href="paginas/detalle-juego.php?juego=mobilelegends"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden">diamantes de Mobile Legends</span></a
                  >
                </div>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-juego">
                <img src="img/roblox-banner.jpg" alt="Logo del juego Roblox" />
                <div class="cuerpo">
                  <h3>Roblox</h3>
                  <a class="enlace-recargar" href="paginas/detalle-juego.php?juego=roblox"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden">Robux de Roblox</span></a
                  >
                </div>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-juego">
                <img src="img/genshin.png" alt="Logo del juego Genshin Impact" />
                <div class="cuerpo">
                  <h3>Genshin Impact</h3>
                  <a class="enlace-recargar" href="paginas/detalle-juego.php?juego=genshin"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden">Cristales Génesis de Genshin Impact</span></a
                  >
                </div>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-juego">
                <img src="img/battleground.jpg" alt="Logo del juego Battlegrounds Mobile" />
                <div class="cuerpo">
                  <h3>Battleground</h3>
                  <a class="enlace-recargar" href="paginas/detalle-juego.php?juego=battleground"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden">UC de Battlegrounds</span></a
                  >
                </div>
              </article>
            </div>
          </div>
        </section>
      </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
