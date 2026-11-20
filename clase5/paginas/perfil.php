<?php

require_once __DIR__ . '/../config/env.php';

$titulo_pagina = 'Mi perfil | ' . APP_NAME;
$descripcion_pagina = 'Administrá tus datos personales y revisá tu actividad en BUYDIMA: editá tu perfil y consultá tu historial de compras.';
$pagina_activa = 'perfil';
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
          <h1 class="titulo-pagina">Mi perfil</h1>
          <p class="texto-suave">Administrá tus datos personales y revisá tu actividad.</p>
        </header>

        <div class="row g-4 mt-1">

          <aside class="col-lg-4">
            <div class="panel p-4 text-center">
              <img
                class="avatar mb-2"
                src="../img/avatar.svg"
                alt="Avatar del perfil con el logo diamante de BUYDIMA"
                width="84"
                height="84"
              />
              <h2 class="h5 mb-1">Mi perfil</h2>
              <p class="small mb-3" style="color: #4ade80" id="estado-sesion">
                <i class="bi bi-circle-fill" style="font-size: 0.5rem" aria-hidden="true"></i>
                Conectado/a
              </p>
              <nav aria-label="Opciones de la cuenta">
                <ul class="lista-perfil text-start">
                  <li id="item-editar-perfil">
                    <a href="#form-perfil" aria-current="page"
                      ><i class="bi bi-pencil-square" aria-hidden="true"></i> Editar perfil
                      <i class="bi bi-chevron-right ms-auto" aria-hidden="true"></i
                    ></a>
                  </li>
                  <li>
                    <a href="historial-compras.php"
                      ><i class="bi bi-clock-history" aria-hidden="true"></i> Historial de compras
                      <i class="bi bi-chevron-right ms-auto" aria-hidden="true"></i
                    ></a>
                  </li>
                  <li id="item-iniciar-sesion" hidden>
                    <a href="#form-login"
                      ><i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> Iniciar sesión
                      <i class="bi bi-chevron-right ms-auto" aria-hidden="true"></i
                    ></a>
                  </li>
                  <li id="item-cerrar-sesion" hidden>
                    <button type="button" class="peligro" data-cerrar-sesion>
                      <i class="bi bi-box-arrow-right" aria-hidden="true"></i> Cerrar sesión
                      <i class="bi bi-chevron-right ms-auto" aria-hidden="true"></i>
                    </button>
                  </li>
                </ul>
              </nav>
            </div>
          </aside>

          <section class="col-lg-8" id="seccion-login" hidden>
            <h2 class="h4 mb-3">Iniciar sesión</h2>
            <form id="form-login" class="panel p-4" novalidate>
              <p class="texto-suave small mb-4">
                Simulación para el proyecto: no hay cuentas ni contraseñas reales ni seguridad de
                sesión. Los datos se guardan solo en este navegador.
              </p>

              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label" for="campo-login-nombre">Nombre de jugador</label>
                  <input
                    type="text"
                    class="form-control"
                    id="campo-login-nombre"
                    placeholder="Ej: Jugador BUYDIMA"
                    required
                    minlength="2"
                    autocomplete="off"
                  />
                  <div class="invalid-feedback">Ingresá un nombre de al menos 2 caracteres.</div>
                </div>
                <div class="col-12">
                  <label class="form-label" for="campo-login-correo">Correo electrónico</label>
                  <input
                    type="email"
                    class="form-control"
                    id="campo-login-correo"
                    placeholder="Ej: jugador@correo.com"
                    required
                    autocomplete="off"
                  />
                  <div class="invalid-feedback">Ingresá un correo electrónico válido.</div>
                </div>
              </div>

              <div class="mt-4">
                <button class="btn boton-compra" type="submit">
                  <i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i> Iniciar sesión
                </button>
              </div>
            </form>
          </section>

          <section class="col-lg-8" id="seccion-perfil">
            <h2 class="h4 mb-3">Editar perfil</h2>
            <form id="form-perfil" class="panel p-4" novalidate>
              <p class="texto-suave small">Modificá tu información personal y de contacto.</p>

              <div class="d-flex align-items-center gap-3 mb-4">
                <img
                  src="../img/avatar.svg"
                  alt="Foto de perfil actual con el logo diamante de BUYDIMA"
                  width="64"
                  height="64"
                  class="rounded-circle"
                />
                <button class="btn btn-outline-light btn-sm" type="button">
                  <i class="bi bi-camera" aria-hidden="true"></i> Cambiar foto
                </button>
              </div>

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label" for="campo-nombre-perfil">Nombre</label>
                  <input
                    type="text"
                    class="form-control"
                    id="campo-nombre-perfil"
                    required
                    autocomplete="given-name"
                  />
                  <div class="invalid-feedback">El nombre es obligatorio.</div>
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="campo-apellido-perfil">Apellido</label>
                  <input
                    type="text"
                    class="form-control"
                    id="campo-apellido-perfil"
                    required
                    autocomplete="family-name"
                  />
                  <div class="invalid-feedback">El apellido es obligatorio.</div>
                </div>
                <div class="col-12">
                  <label class="form-label" for="campo-correo-perfil">Correo electrónico</label>
                  <input
                    type="email"
                    class="form-control"
                    id="campo-correo-perfil"
                    required
                    autocomplete="email"
                  />
                  <div class="invalid-feedback">Ingresá un correo electrónico válido.</div>
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="campo-pais-perfil">País</label>
                  <select class="form-select" id="campo-pais-perfil" required>
                    <option selected>Argentina</option>
                    <option>Chile</option>
                    <option>Uruguay</option>
                    <option>Paraguay</option>
                    <option>Bolivia</option>
                  </select>
                </div>
              </div>

              <div class="d-flex gap-2 mt-4">
                <button class="btn btn-outline-light" type="reset">Cancelar</button>
                <button class="btn boton-compra" type="submit">Guardar cambios</button>
              </div>
              <p class="texto-suave small mt-3 mb-0">
                Demostración: los datos se guardan solo en esta página, no se envían a un servidor.
              </p>
            </form>
          </section>
        </div>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
