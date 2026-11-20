<?php

require_once __DIR__ . '/../config/env.php';

$titulo_pagina = 'Métodos de pago | ' . APP_NAME;
$descripcion_pagina = 'Elegí el método de pago que más te convenga en BUYDIMA: Mercado Pago, tarjetas de crédito y débito, transferencia bancaria o pago en efectivo.';
$pagina_activa = 'metodos-pago';
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
          <h1 class="titulo-pagina">Métodos de pago</h1>
          <p class="texto-suave">
            Elegí el que más te convenga. Todas tus operaciones están protegidas.
          </p>
        </header>

        <section class="panel p-4 mt-4" aria-labelledby="titulo-preferencias">
          <h2 class="h5 mb-3" id="titulo-preferencias">Preferencias de pago</h2>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="pais">País</label>
              <select class="form-select" id="pais">
                <option selected>Argentina</option>
                <option>Chile</option>
                <option>Uruguay</option>
                <option>Paraguay</option>
                <option>Bolivia</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="moneda">Moneda</label>
              <select class="form-select" id="moneda">
                <option selected>ARS - Peso argentino</option>
                <option>CLP - Peso chileno</option>
                <option>UYU - Peso uruguayo</option>
                <option>USD - Dólar estadounidense</option>
              </select>
            </div>
          </div>
        </section>

        <section class="mt-4" aria-labelledby="titulo-metodos">
          <h2 class="visually-hidden" id="titulo-metodos">Medios de pago disponibles</h2>
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
            <div class="col">
              <article class="tarjeta-metodo">
                <i class="bi bi-wallet2 mb-2" aria-hidden="true"></i>
                <h3 class="h6 fw-bold">Mercado Pago</h3>
                <p class="texto-suave mb-0 small">
                  Pagá con saldo en cuenta o con tarjetas vinculadas.
                </p>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-metodo">
                <i class="bi bi-credit-card mb-2" aria-hidden="true"></i>
                <h3 class="h6 fw-bold">Crédito y débito</h3>
                <p class="texto-suave mb-0 small">Visa, Mastercard, American Express y Cabal.</p>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-metodo">
                <i class="bi bi-bank mb-2" aria-hidden="true"></i>
                <h3 class="h6 fw-bold">Transferencia bancaria</h3>
                <p class="texto-suave mb-0 small">
                  Transferí desde cualquier banco o billetera virtual.
                </p>
              </article>
            </div>
            <div class="col">
              <article class="tarjeta-metodo">
                <i class="bi bi-cash-coin mb-2" aria-hidden="true"></i>
                <h3 class="h6 fw-bold">Pago en efectivo</h3>
                <p class="texto-suave mb-0 small">Aprobá en Rapipago o Pago Fácil con tu código.</p>
              </article>
            </div>
          </div>
        </section>

        <section class="row g-4 mt-2 align-items-center" aria-labelledby="titulo-como-funciona">
          <div class="col-lg-7">
            <h2 class="h4 mb-2" id="titulo-como-funciona">¿Cómo funciona el pago?</h2>
            <p class="etiqueta-catalogo mb-2">Simple y seguro</p>
            <p class="texto-suave">
              Comprá como si fuera una tarjeta. Tu transacción está cifrada de extremo a extremo:
              elegí el monto, seleccioná el método de pago, confirmá y ya está. Protegemos tu compra
              con verificación en cada paso del proceso.
            </p>
            <p class="small mb-0">
              <i
                class="bi bi-shield-check text-info-emphasis"
                aria-hidden="true"
                style="color: var(--lila)"
              ></i>
              Protegido con cookie segura
            </p>
          </div>
          <div class="col-lg-5">
            <ol class="list-unstyled m-0">
              <li
                class="d-flex align-items-center gap-3 border-bottom border-secondary-subtle pb-3"
              >
                <span class="paso-numero">01</span>
                <span>Elegí el monto del paquete de diamantes o monedas.</span>
              </li>
              <li
                class="d-flex align-items-center gap-3 border-bottom border-secondary-subtle py-3"
              >
                <span class="paso-numero">02</span>
                <span>Seleccioná el método de pago que prefieras.</span>
              </li>
              <li class="d-flex align-items-center gap-3 pt-3">
                <span class="paso-numero">03</span>
                <span>Confirmá y pagá: recibís tus monedas al instante.</span>
              </li>
            </ol>
          </div>
        </section>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
