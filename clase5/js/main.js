'use strict';

function formatearPrecio(valor) {
  return new Intl.NumberFormat('es-AR', {
    style: 'currency',
    currency: 'ARS',
  }).format(valor);
}

function mostrarAviso(mensaje) {
  let contenedor = document.getElementById('contenedor-avisos');
  if (!contenedor) {
    contenedor = document.createElement('div');
    contenedor.id = 'contenedor-avisos';
    contenedor.className = 'toast-container position-fixed bottom-0 end-0 p-3';
    document.body.appendChild(contenedor);
  }
  const aviso = document.createElement('div');
  aviso.className = 'toast align-items-center border-0';
  aviso.setAttribute('role', 'alert');
  aviso.setAttribute('aria-live', 'assertive');
  aviso.setAttribute('aria-atomic', 'true');
  aviso.innerHTML =
    '<div class="d-flex"><div class="toast-body">' +
    mensaje +
    '</div><button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar aviso"></button></div>';
  contenedor.appendChild(aviso);
  const toast = new bootstrap.Toast(aviso, { delay: 3000 });
  toast.show();
  aviso.addEventListener('hidden.bs.toast', () => aviso.remove());
}

const CLAVE_CARRITO = 'buydima-carrito';

function leerCarrito() {
  try {
    const datos = localStorage.getItem(CLAVE_CARRITO);
    if (datos) {
      return JSON.parse(datos);
    }
  } catch (error) {
    console.error('No se pudo leer el carrito:', error);
  }

  return [];
}

function guardarCarrito(items) {
  localStorage.setItem(CLAVE_CARRITO, JSON.stringify(items));
  actualizarContadorCarrito();
}

function actualizarContadorCarrito() {
  const contador = document.getElementById('contador-carrito');
  if (!contador) return;
  const total = leerCarrito().reduce((suma, item) => suma + item.cantidad, 0);
  contador.textContent = total;
  contador.hidden = total === 0;

  const enlaceCarrito = contador.closest('a');
  if (enlaceCarrito) {
    enlaceCarrito.setAttribute(
      'aria-label',
      total > 0 ? 'Ver carrito de compras (' + total + ')' : 'Ver carrito de compras'
    );
  }
}

function agregarAlCarrito(item) {
  const carrito = leerCarrito();
  carrito.push(item);
  guardarCarrito(carrito);
  mostrarAviso('<strong>' + item.producto + '</strong> se agregó al carrito.');
}

function configurarBuscador() {
  const formularios = document.querySelectorAll('form[role="search"]');
  formularios.forEach((form) => {
    form.addEventListener('submit', (evento) => {
      const campo = form.querySelector('input[type="search"]');
      const texto = campo.value.trim();
      if (texto.length === 1) {
        evento.preventDefault();
        campo.classList.add('is-invalid');
        campo.setAttribute('aria-invalid', 'true');
        campo.focus();
      } else {
        campo.classList.remove('is-invalid');
        campo.removeAttribute('aria-invalid');

        const destino = window.location.pathname.includes('/paginas/')
          ? 'juegos.php'
          : 'paginas/juegos.php';
        form.setAttribute('action', destino);
        form.setAttribute('method', 'get');
      }
    });
  });
}

function configurarBotonVolver() {
  document.querySelectorAll('[data-volver-atras]').forEach((boton) => {
    boton.addEventListener('click', () => {
      const vieneDelSitio =
        document.referrer && document.referrer.startsWith(window.location.origin);
      if (vieneDelSitio) {
        history.back();
      } else {
        window.location.href = '../index.php';
      }
    });
  });
}

const CLAVE_FAVORITOS = 'buydima-favoritos';

const CATALOGO_FAVORITOS = {
  freefire: { nombre: 'Free Fire', categoria: 'Battle Royale', imagen: 'freefire.svg' },
  mobilelegends: { nombre: 'Mobile Legends', categoria: 'MOBA · RPG', imagen: 'mobilelegends.jpg' },
  roblox: { nombre: 'Roblox', categoria: 'Sandbox · Aventura', imagen: 'roblox-banner.jpg' },
  genshin: { nombre: 'Genshin Impact', categoria: 'Aventura · RPG', imagen: 'genshin.png' },
  battleground: { nombre: 'Battlegrounds', categoria: 'Battle Royale', imagen: 'battleground.jpg' },
};

function leerFavoritos() {
  try {
    const datos = localStorage.getItem(CLAVE_FAVORITOS);
    if (datos) {
      return JSON.parse(datos).filter((clave) => clave in CATALOGO_FAVORITOS);
    }
  } catch (error) {
    console.error('No se pudieron leer los favoritos:', error);
  }

  return [];
}

function guardarFavoritos(lista) {
  localStorage.setItem(CLAVE_FAVORITOS, JSON.stringify(lista));
}

function configurarFavoritos() {
  const grilla = document.getElementById('grilla-favoritos');
  if (!grilla) return;
  const vacio = document.getElementById('estado-vacio-favoritos');
  const seccionAgregar = document.getElementById('seccion-agregar-favoritos');
  const listaAgregar = document.getElementById('lista-agregar-favoritos');

  function tarjetaFavorito(clave) {
    const juego = CATALOGO_FAVORITOS[clave];
    const articulo = document.createElement('article');
    articulo.className = 'col';
    articulo.innerHTML =
      '<div class="tarjeta-juego tarjeta-favorito">' +
      '<img src="../img/' +
      juego.imagen +
      '" alt="Logo del juego ' +
      juego.nombre +
      '">' +
      '<button type="button" class="boton-corazon activo" data-quitar="' +
      clave +
      '" aria-pressed="true" aria-label="Quitar ' +
      juego.nombre +
      ' de favoritos">' +
      '<i class="bi bi-heart-fill" aria-hidden="true"></i>' +
      '</button>' +
      '<div class="cuerpo">' +
      '<h3>' +
      juego.nombre +
      '</h3>' +
      '<p class="texto-suave small mb-2">' +
      juego.categoria +
      '</p>' +
      '<div class="acciones-favorito">' +
      '<a class="boton-compra boton-chico" href="detalle-juego.php?juego=' +
      clave +
      '">Ver productos</a>' +
      '<button type="button" class="boton-quitar" data-quitar="' +
      clave +
      '" aria-label="Quitar de favoritos: ' +
      juego.nombre +
      '">Quitar de favoritos</button>' +
      '</div>' +
      '</div>' +
      '</div>';
    return articulo;
  }

  function tarjetaParaAgregar(clave) {
    const juego = CATALOGO_FAVORITOS[clave];
    const articulo = document.createElement('article');
    articulo.className = 'col';
    articulo.innerHTML =
      '<div class="tarjeta-juego tarjeta-agregar">' +
      '<img src="../img/' +
      juego.imagen +
      '" alt="Logo del juego ' +
      juego.nombre +
      '">' +
      '<button type="button" class="boton-corazon" data-agregar="' +
      clave +
      '" aria-pressed="false" aria-label="Agregar ' +
      juego.nombre +
      ' a favoritos">' +
      '<i class="bi bi-heart" aria-hidden="true"></i>' +
      '</button>' +
      '<div class="cuerpo">' +
      '<h3>' +
      juego.nombre +
      '</h3>' +
      '<p class="texto-suave small mb-0">' +
      juego.categoria +
      '</p>' +
      '</div>' +
      '</div>';
    return articulo;
  }

  function dibujar() {
    const favoritos = leerFavoritos();

    grilla.innerHTML = '';
    favoritos.forEach((clave) => grilla.appendChild(tarjetaFavorito(clave)));
    vacio.hidden = favoritos.length > 0;
    grilla.hidden = favoritos.length === 0;

    const disponibles = Object.keys(CATALOGO_FAVORITOS).filter(
      (clave) => !favoritos.includes(clave)
    );
    listaAgregar.innerHTML = '';
    disponibles.forEach((clave) => listaAgregar.appendChild(tarjetaParaAgregar(clave)));
    seccionAgregar.hidden = disponibles.length === 0;
  }

  document.getElementById('contenido-principal').addEventListener('click', (evento) => {
    const boton = evento.target.closest('[data-agregar], [data-quitar]');
    if (!boton) return;
    const clave = boton.dataset.agregar || boton.dataset.quitar;
    const nombre = CATALOGO_FAVORITOS[clave].nombre;
    let favoritos = leerFavoritos();

    if (boton.dataset.agregar) {
      favoritos.push(clave);
      guardarFavoritos(favoritos);
      mostrarAviso('<strong>' + nombre + '</strong> se agregó a favoritos.');
    } else {
      favoritos = favoritos.filter((otra) => otra !== clave);
      guardarFavoritos(favoritos);
      mostrarAviso('<strong>' + nombre + '</strong> se quitó de favoritos.');
    }
    dibujar();
  });

  dibujar();
}

document.addEventListener('DOMContentLoaded', () => {
  configurarBuscador();
  configurarBotonVolver();
  actualizarContadorCarrito();

  const pagina = document.body.dataset.pagina;
  switch (pagina) {
    case 'inicio':
      configurarInicio();
      break;
    case 'juegos':
      configurarJuegos();
      break;
    case 'ofertas':
      configurarOfertas();
      break;
    case 'carrito':
      configurarCarrito();
      break;
    case 'contacto':
      configurarContacto();
      break;
    case 'perfil':
      configurarPerfil();
      break;
    case 'detalle-juego':
      configurarDetalleJuego();
      break;
    case 'historial':
      configurarHistorial();
      break;
    case 'favoritos':
      configurarFavoritos();
      break;
  }
});

function configurarInicio() {}

function configurarJuegos() {
  const botonPopulares = document.getElementById('boton-populares');
  if (botonPopulares) {
    botonPopulares.addEventListener('click', () => {
      const grilla = document.getElementById('grilla-juegos');
      if (!grilla) return;
      const columnas = Array.from(grilla.children);
      columnas.sort((a, b) => {
        const pa = Number(a.querySelector('[data-popularidad]')?.dataset.popularidad || 0);
        const pb = Number(b.querySelector('[data-popularidad]')?.dataset.popularidad || 0);
        return pb - pa;
      });
      columnas.forEach((col) => grilla.appendChild(col));
      mostrarAviso('Catálogo ordenado por <strong>más populares</strong>.');
    });
  }
}

function configurarOfertas() {
  const final = new Date();
  final.setDate(final.getDate() + 2);
  final.setHours(final.getHours() + 14);
  final.setMinutes(final.getMinutes() + 37);

  const dias = document.getElementById('cuenta-dias');
  const horas = document.getElementById('cuenta-horas');
  const minutos = document.getElementById('cuenta-minutos');
  if (!dias || !horas || !minutos) return;

  function actualizar() {
    const restante = Math.max(0, final.getTime() - Date.now());
    dias.textContent = String(Math.floor(restante / 86400000)).padStart(2, '0');
    horas.textContent = String(Math.floor((restante / 3600000) % 24)).padStart(2, '0');
    minutos.textContent = String(Math.floor((restante / 60000) % 60)).padStart(2, '0');
  }
  actualizar();
  setInterval(actualizar, 1000);
}

function configurarCarrito() {
  const lista = document.getElementById('lista-carrito');
  if (!lista) return;

  const RESUMEN = {
    subtotal: document.getElementById('resumen-subtotal'),
    descuento: document.getElementById('resumen-descuento'),
    total: document.getElementById('resumen-total'),
    filas: document.getElementById('filas-resumen'),
  };
  let codigoUsado = false;

  function dibujar() {
    const carrito = leerCarrito();
    lista.innerHTML = '';
    carrito.forEach((item, indice) => {
      const rutaImg = window.location.pathname.includes('/paginas/') ? '../img/' : 'img/';
      const fila = document.createElement('tr');
      fila.innerHTML =
        '<td><div class="d-flex align-items-center gap-2"><img src="' +
        rutaImg +
        item.imagen +
        '" alt="Logo de ' +
        item.juego +
        '" width="64" height="48"><div><strong>' +
        item.juego +
        '</strong><br><small class="texto-suave">' +
        item.producto +
        '</small></div></div></td>' +
        '<td><div class="control-cantidad">' +
        '<button type="button" data-accion="menos" data-indice="' +
        indice +
        '" aria-label="Quitar una unidad de ' +
        item.juego +
        '">−</button>' +
        '<span aria-live="polite">' +
        item.cantidad +
        '</span>' +
        '<button type="button" data-accion="mas" data-indice="' +
        indice +
        '" aria-label="Agregar una unidad de ' +
        item.juego +
        '">+</button>' +
        '</div></td>' +
        '<td>' +
        formatearPrecio(item.precio * item.cantidad) +
        '</td>' +
        '<td><button type="button" class="btn btn-link text-danger p-0" data-accion="eliminar" data-indice="' +
        indice +
        '" aria-label="Eliminar ' +
        item.juego +
        ' del carrito"><i class="bi bi-trash" aria-hidden="true"></i></button></td>';
      lista.appendChild(fila);
    });
    calcularTotales(carrito);
  }

  function calcularTotales(carrito) {
    const subtotal = carrito.reduce((suma, item) => suma + item.precio * item.cantidad, 0);
    const descuento = codigoUsado ? subtotal * 0.1 : 0;
    const total = subtotal - descuento;
    RESUMEN.subtotal.textContent = formatearPrecio(subtotal);
    RESUMEN.descuento.textContent = '− ' + formatearPrecio(descuento);
    RESUMEN.total.textContent = formatearPrecio(total);
    RESUMEN.filas.hidden = false;
    document.getElementById('carrito-vacio').hidden = carrito.length > 0;
  }

  lista.addEventListener('click', (evento) => {
    const boton = evento.target.closest('[data-accion]');
    if (!boton) return;
    const carrito = leerCarrito();
    const indice = Number(boton.dataset.indice);
    if (boton.dataset.accion === 'mas') carrito[indice].cantidad += 1;
    if (boton.dataset.accion === 'menos')
      carrito[indice].cantidad = Math.max(1, carrito[indice].cantidad - 1);
    if (boton.dataset.accion === 'eliminar') {
      carrito.splice(indice, 1);
      mostrarAviso('Producto eliminado del carrito.');
    }
    guardarCarrito(carrito);
    dibujar();
  });

  const formCodigo = document.getElementById('form-codigo');
  formCodigo?.addEventListener('submit', (evento) => {
    evento.preventDefault();
    const campo = document.getElementById('codigo-descuento');
    if (campo.value.trim().toUpperCase() === 'BUYDIMA10') {
      codigoUsado = true;
      campo.classList.remove('is-invalid');
      mostrarAviso('Código <strong>BUYDIMA10</strong> aplicado: 10% de descuento.');
      dibujar();
    } else {
      campo.classList.add('is-invalid');
      campo.focus();
    }
  });

  document.getElementById('boton-continuar')?.addEventListener('click', () => {
    mostrarAviso('Esta es una demostración: no se realiza ningún pago real.');
  });

  dibujar();
}

function configurarContacto() {
  const form = document.getElementById('form-contacto');
  if (!form) return;
  form.addEventListener('submit', (evento) => {
    if (!form.checkValidity()) {
      evento.preventDefault();
      evento.stopPropagation();
      form.classList.add('was-validated');
    }
  });
}

const CLAVE_SESION = 'buydima-sesion';

function leerSesion() {
  try {
    const datos = localStorage.getItem(CLAVE_SESION);
    return datos ? JSON.parse(datos) : null;
  } catch (error) {
    console.error('No se pudo leer la sesión:', error);
    return null;
  }
}

function guardarSesion(sesion) {
  localStorage.setItem(CLAVE_SESION, JSON.stringify(sesion));
}

function borrarSesion() {
  localStorage.removeItem(CLAVE_SESION);
}

function configurarPerfil() {
  const seccionPerfil = document.getElementById('seccion-perfil');
  if (!seccionPerfil) return;

  const seccionLogin = document.getElementById('seccion-login');
  const formPerfil = document.getElementById('form-perfil');
  const formLogin = document.getElementById('form-login');
  const estado = document.getElementById('estado-sesion');

  function actualizarVista() {
    const sesion = leerSesion();
    const conectado = Boolean(sesion);

    seccionPerfil.hidden = !conectado;
    seccionLogin.hidden = conectado;
    document.getElementById('item-cerrar-sesion').hidden = !conectado;
    document.getElementById('item-iniciar-sesion').hidden = conectado;
    document.getElementById('item-editar-perfil').hidden = !conectado;

    if (conectado) {
      estado.style.color = '#4ade80';
      estado.innerHTML =
        '<i class="bi bi-circle-fill" style="font-size: 0.5rem" aria-hidden="true"></i> Conectado/a como ' +
        sesion.nombre;

      document.getElementById('campo-nombre-perfil').value = sesion.nombre;
      document.getElementById('campo-correo-perfil').value = sesion.correo;
    } else {
      estado.style.color = 'var(--texto-suave)';
      estado.innerHTML =
        '<i class="bi bi-circle" style="font-size: 0.5rem" aria-hidden="true"></i> Sesión no iniciada';
    }
  }

  formLogin.addEventListener('submit', (evento) => {
    evento.preventDefault();
    if (!formLogin.checkValidity()) {
      evento.stopPropagation();
      formLogin.classList.add('was-validated');
      return;
    }
    formLogin.classList.remove('was-validated');
    guardarSesion({
      nombre: document.getElementById('campo-login-nombre').value.trim(),
      correo: document.getElementById('campo-login-correo').value.trim(),
    });
    mostrarAviso('Sesión iniciada <em>(simulación: no hay cuentas ni seguridad reales)</em>.');
    actualizarVista();
  });

  document.querySelector('[data-cerrar-sesion]').addEventListener('click', () => {
    borrarSesion();
    mostrarAviso('Sesión cerrada.');
    actualizarVista();
    setTimeout(() => {
      window.location.href = '../index.php';
    }, 900);
  });

  formPerfil.addEventListener('submit', (evento) => {
    evento.preventDefault();
    if (!formPerfil.checkValidity()) {
      evento.stopPropagation();
      formPerfil.classList.add('was-validated');
      return;
    }
    formPerfil.classList.remove('was-validated');
    const sesion = leerSesion();
    if (sesion) {
      sesion.nombre = document.getElementById('campo-nombre-perfil').value.trim();
      sesion.correo = document.getElementById('campo-correo-perfil').value.trim();
      guardarSesion(sesion);
    }
    mostrarAviso(
      'Cambios guardados <em>(demostración: los datos no se envían a un servidor)</em>.'
    );
    actualizarVista();
  });

  actualizarVista();
}

function configurarDetalleJuego() {
  const JUEGOS = {
    freefire: { nombre: 'Free Fire', imagen: 'freefire.svg', moneda: 'diamantes' },
    mobilelegends: { nombre: 'Mobile Legends', imagen: 'mobilelegends.jpg', moneda: 'diamantes' },
    roblox: { nombre: 'Roblox', imagen: 'roblox-banner.jpg', moneda: 'Robux' },
    genshin: { nombre: 'Genshin Impact', imagen: 'genshin.png', moneda: 'Génesis' },
    battleground: { nombre: 'Battlegrounds', imagen: 'battleground.jpg', moneda: 'UC' },
  };

  const parametros = new URLSearchParams(window.location.search);
  const clave = parametros.get('juego') in JUEGOS ? parametros.get('juego') : 'mobilelegends';
  const juego = JUEGOS[clave];

  const titulo = document.getElementById('titulo-juego');
  const imagen = document.getElementById('imagen-juego');
  const campoId = document.getElementById('id-usuario');
  if (titulo) titulo.textContent = juego.nombre;
  if (imagen) {
    imagen.src = '../img/' + juego.imagen;
    imagen.alt = 'Logo del juego ' + juego.nombre;
  }

  if (clave === 'freefire') {
    campoId.pattern = '[0-9]{6,12}';
  } else {
    campoId.pattern = '[A-Za-z0-9.\\-]{5,20}';
  }
  document.querySelectorAll('.texto-moneda').forEach((el) => (el.textContent = juego.moneda));

  const form = document.getElementById('form-detalle');
  form.addEventListener('submit', (evento) => {
    evento.preventDefault();
    const paquete = form.querySelector('input[name="paquete"]:checked');
    if (!form.checkValidity() || !paquete) {
      evento.stopPropagation();
      form.classList.add('was-validated');
      if (!paquete) {
        document.getElementById('error-paquete').hidden = false;
      }
      return;
    }
    document.getElementById('error-paquete').hidden = true;
    agregarAlCarrito({
      juego: juego.nombre,
      producto: paquete.value,
      precio: Number(paquete.dataset.precio),
      cantidad: 1,
      imagen: juego.imagen,
    });
    form.reset();
    form.classList.remove('was-validated');
  });
}

function configurarHistorial() {
  const filtro = document.getElementById('filtro-estado');
  if (!filtro) return;
  filtro.addEventListener('change', () => {
    const valor = filtro.value;
    document.querySelectorAll('#tabla-pedidos tbody tr').forEach((fila) => {
      fila.hidden = valor !== 'todos' && fila.dataset.estado !== valor;
    });
  });
}
