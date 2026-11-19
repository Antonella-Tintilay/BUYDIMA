<?php

require_once __DIR__ . '/../config/env.php';

$titulo_pagina = 'Recargar diamantes | Detalle de juego | ' . APP_NAME;
$descripcion_pagina = 'Recargá diamantes y monedas en BUYDIMA: ingresá tu ID de usuario, elegí el paquete que quieras (diamantes, Pase Semanal o Pase Mensual) y agregalo al carrito.';
$pagina_activa = 'detalle-juego';
$ruta_base = '..';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main id="contenido-principal">
      <div class="container my-4">
        <button class="boton-volver" type="button" data-volver-atras>
          <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver
        </button>

        <nav aria-label="Ruta de navegación">
          <ol class="breadcrumb small">
            <li class="breadcrumb-item">
              <a class="enlace-recargar" href="../index.php">Inicio</a>
            </li>
            <li class="breadcrumb-item">
              <a class="enlace-recargar" href="juegos.php">Juegos</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" id="miga-juego">
              Detalle de juego
            </li>
          </ol>
        </nav>

        <header class="row g-3 align-items-center">
          <div class="col-auto">
            <img
              src="../img/mobilelegends.jpg"
              alt="Logo del juego Mobile Legends"
              class="rounded-3"
              id="imagen-juego"
              width="110"
              height="82"
              style="object-fit: contain; background-color: var(--panel)"
            />
          </div>
          <div class="col">
            <p class="etiqueta-catalogo mb-1">Catálogo BUYDIMA</p>
            <h1 class="titulo-pagina mb-0" id="titulo-juego">Mobile Legends</h1>
            <p class="texto-suave mb-0 mt-1">
              Ingresá tu ID de usuario, elegí un paquete de
              <span class="texto-moneda">diamantes</span> y recibilo en tu cuenta al instante.
            </p>
          </div>
        </header>

        <form id="form-detalle" class="row g-4 mt-3" novalidate>
          <!-- Paso 1: ID de usuario -->
          <section class="col-lg-5" aria-labelledby="titulo-id">
            <div class="panel p-4 h-100">
              <h2 class="h5 mb-3" id="titulo-id">
                <span class="paso-numero me-2">01</span>Ingresá tu ID de usuario
              </h2>
              <div class="mb-2">
                <label class="form-label" for="id-usuario">ID de usuario</label>
                <input
                  type="text"
                  class="form-control"
                  id="id-usuario"
                  name="id-usuario"
                  inputmode="numeric"
                  placeholder="Ej: 123456789"
                  pattern="[A-Za-z0-9.\-]{5,20}"
                  required
                  autocomplete="off"
                />
                <div class="invalid-feedback">
                  Ingresá un ID válido (entre 5 y 20 caracteres, números o letras).
                </div>
              </div>
              <p class="texto-suave small mb-0">
                <i class="bi bi-info-circle" aria-hidden="true"></i>
                Tu ID aparece en el perfil del juego. La recarga se acredita en esa cuenta.
              </p>
            </div>
          </section>

          <!-- Paso 2: selección de paquete -->
          <section class="col-lg-7" aria-labelledby="titulo-paquete">
            <div class="panel p-4 h-100">
              <h2 class="h5 mb-3" id="titulo-paquete">
                <span class="paso-numero me-2">02</span>Elegí tu paquete
              </h2>

              <h3 class="h6 texto-suave text-uppercase mb-2">
                Paquetes de <span class="texto-moneda">diamantes</span>
              </h3>
              <div class="row row-cols-1 row-cols-md-2 g-2">
                <div class="col">
                  <input
                    class="entrada-paquete"
                    type="radio"
                    name="paquete"
                    id="paquete-86"
                    value="86 diamantes"
                    data-precio="1690"
                  />
                  <label class="paquete w-100" for="paquete-86"
                    ><strong>86 <span class="texto-moneda">diamantes</span></strong
                    ><span>$ 1.690</span></label
                  >
                </div>
                <div class="col">
                  <input
                    class="entrada-paquete"
                    type="radio"
                    name="paquete"
                    id="paquete-172"
                    value="172 diamantes"
                    data-precio="3290"
                  />
                  <label class="paquete w-100" for="paquete-172"
                    ><strong>172 <span class="texto-moneda">diamantes</span></strong
                    ><span>$ 3.290</span></label
                  >
                </div>
                <div class="col">
                  <input
                    class="entrada-paquete"
                    type="radio"
                    name="paquete"
                    id="paquete-257"
                    value="257 diamantes"
                    data-precio="4890"
                  />
                  <label class="paquete w-100" for="paquete-257"
                    ><strong>257 <span class="texto-moneda">diamantes</span></strong
                    ><span>$ 4.890</span></label
                  >
                </div>
                <div class="col">
                  <input
                    class="entrada-paquete"
                    type="radio"
                    name="paquete"
                    id="paquete-706"
                    value="706 diamantes"
                    data-precio="12490"
                  />
                  <label class="paquete w-100" for="paquete-706"
                    ><strong>706 <span class="texto-moneda">diamantes</span></strong
                    ><span>$ 12.490</span></label
                  >
                </div>
              </div>

              <h3 class="h6 texto-suave text-uppercase mb-2 mt-4">Pases y beneficios</h3>
              <div class="row row-cols-1 row-cols-md-2 g-2">
                <div class="col">
                  <input
                    class="entrada-paquete"
                    type="radio"
                    name="paquete"
                    id="paquete-pase-semanal"
                    value="Pase semanal"
                    data-precio="2990"
                  />
                  <label class="paquete w-100" for="paquete-pase-semanal"
                    ><strong>Pase semanal</strong><span>$ 2.990</span></label
                  >
                </div>
                <div class="col">
                  <input
                    class="entrada-paquete"
                    type="radio"
                    name="paquete"
                    id="paquete-pase-mensual"
                    value="Pase mensual (Elite)"
                    data-precio="7990"
                  />
                  <label class="paquete w-100" for="paquete-pase-mensual"
                    ><strong>Pase mensual (Elite)</strong><span>$ 7.990</span></label
                  >
                </div>
              </div>

              <p class="text-danger small mb-2 mt-2" id="error-paquete" hidden>
                <i class="bi bi-exclamation-circle" aria-hidden="true"></i>
                Elegí un paquete para continuar.
              </p>

              <div class="d-flex flex-wrap gap-2 mt-3">
                <button class="btn boton-compra" type="submit">
                  <i class="bi bi-cart-plus" aria-hidden="true"></i> Agregar al carrito
                </button>
                <a class="btn btn-outline-light" href="carrito.php">Ir al carrito</a>
              </div>
              <p class="texto-suave small mt-3 mb-0">
                Demostración académica: el producto se suma solo al carrito visual del sitio.
              </p>
            </div>
          </section>
        </form>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

