<?php

require_once __DIR__ . '/../config/env.php';

$titulo_pagina = 'Contacto y soporte | ' . APP_NAME;
$descripcion_pagina = 'Estamos para ayudarte antes, durante y después de tu compra. Escribí tu consulta al equipo de soporte de BUYDIMA y te responderemos a la brevedad.';
$pagina_activa = 'contacto';
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
          <h1 class="titulo-pagina">Contacto y soporte</h1>
          <p class="texto-suave">Estamos para ayudarte antes, durante y después de tu compra.</p>
        </header>

        <div class="row g-4 mt-1">
          <!-- Formulario de consulta -->
          <section class="col-lg-7">
            <h2 class="h4 mb-3">Escribí tu consulta</h2>
            <form id="form-contacto" class="panel p-4" novalidate>
              <div class="mb-3">
                <label class="form-label" for="campo-nombre">Nombre y apellido</label>
                <input
                  type="text"
                  class="form-control"
                  id="campo-nombre"
                  name="nombre"
                  required
                  autocomplete="name"
                />
                <div class="invalid-feedback">Ingresá tu nombre y apellido.</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="campo-correo">Correo electrónico</label>
                <input
                  type="email"
                  class="form-control"
                  id="campo-correo"
                  name="correo"
                  required
                  autocomplete="email"
                />
                <div class="invalid-feedback">Ingresá un correo electrónico válido.</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="campo-motivo">Motivo de consulta</label>
                <select class="form-select" id="campo-motivo" name="motivo" required>
                  <option value="" selected>Seleccioná un motivo...</option>
                  <option>Problema con una recarga</option>
                  <option>Pago o facturación</option>
                  <option>Consulta sobre el catálogo</option>
                  <option>Otro motivo</option>
                </select>
                <div class="invalid-feedback">Seleccioná un motivo de consulta.</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="campo-mensaje">Mensaje</label>
                <textarea
                  class="form-control"
                  id="campo-mensaje"
                  name="mensaje"
                  rows="4"
                  required
                ></textarea>
                <div class="invalid-feedback">Escribí tu consulta (mínimo 10 caracteres).</div>
              </div>
              <button class="btn boton-compra w-100" type="submit">Enviar consulta</button>
              <p class="texto-suave small mt-3 mb-0">
                Esta es una demostración académica: tu consulta no se envía a ningún servidor.
              </p>
            </form>
          </section>

          <!-- Información de soporte -->
          <aside class="col-lg-5">
            <h2 class="h4 mb-3">¿En qué podemos ayudarte?</h2>
            <p class="texto-suave">
              Respondemos consultas sobre recargas pendientes, problemas de pago, monedas no
              acreditadas y cualquier duda sobre el funcionamiento del sitio.
            </p>
            <ul class="list-unstyled d-grid gap-3">
              <li class="tarjeta-metodo d-flex align-items-center gap-3">
                <i class="bi bi-clock-history" aria-hidden="true"></i>
                <span
                  ><strong>Horario de atención</strong><br /><span class="texto-suave small"
                    >Lunes a domingo, de 9 a 23 h.</span
                  ></span
                >
              </li>
              <li class="tarjeta-metodo d-flex align-items-center gap-3">
                <i class="bi bi-envelope" aria-hidden="true"></i>
                <span
                  ><strong>Correo</strong><br /><span class="texto-suave small"
                    ><?php echo htmlspecialchars(SUPPORT_EMAIL); ?></span
                  ></span
                >
              </li>
              <li class="tarjeta-metodo d-flex align-items-center gap-3">
                <i class="bi bi-chat-dots" aria-hidden="true"></i>
                <span
                  ><strong>Respuesta promedio</strong><br /><span class="texto-suave small"
                    >Menos de 24 horas hábiles.</span
                  ></span
                >
              </li>
            </ul>
          </aside>
        </div>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

