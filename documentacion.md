# Documentación técnica — BUYDIMA

TP N.º 3 — Desarrollo Front-End y **TP N.º 4 — Programación Web (migración a PHP con SSI,
SSR y variables de entorno)**. Este documento explica cómo está construido el sitio,
qué criterios se aplicaron y qué problemas se detectaron durante el desarrollo.

---

## 1. Tecnologías utilizadas

| Tecnología      | Uso en el proyecto                                                                              |
| --------------- | ----------------------------------------------------------------------------------------------- |
| PHP 8.x         | Renderizado del lado del servidor (SSR), includes (SSI), título dinámico y variables de entorno |
| HTML5           | Estructura de las 10 vistas, con etiquetas semánticas                                           |
| CSS3            | Estilos personalizados en `css/estilos.css` (variables, componentes propios)                    |
| Bootstrap 5.3   | Grilla, offcanvas (menú hamburguesa), toasts, validación de formularios, `data-bs-theme="dark"` |
| Bootstrap Icons | Iconos (búsqueda, usuario, carrito, menú, redes sociales)                                       |
| JavaScript puro | Interacciones y validaciones en `js/main.js` (sin frameworks)                                   |
| XAMPP / Laragon | Servidor local Apache + PHP para ejecutar el sitio                                              |
| Prettier        | Formateo uniforme del código                                                                    |
| Git             | Control de versiones                                                                            |

**No se usó** React, Angular, Vue, TypeScript, Vite ni frameworks adicionales.
**No hay backend real** (sin base de datos ni autenticación): PHP se usa para el
renderizado y la reutilización de componentes; las interacciones siguen funcionando
en el navegador.

---

## 2. Estructura del proyecto

```
BUYDIMA/
├── index.php                      → Vista 1: Inicio
├── config/
│   └── env.php                    → Cargador de variables de entorno (.env)
├── includes/                      → Componentes comunes (SSI)
│   ├── header.php                 → <head>, título dinámico y apertura del documento
│   ├── nav.php                    → Navegación, buscador y menú hamburguesa
│   └── footer.php                 → Pie de página y scripts
├── paginas/
│   ├── juegos.php                 → Vista 2: Todos los juegos (catálogo)
│   ├── ofertas.php                → Vista 3: Ofertas especiales
│   ├── metodos-pago.php           → Vista 4: Métodos de pago
│   ├── contacto.php               → Vista 5: Contacto y soporte
│   ├── carrito.php                → Vista 6: Mi carrito
│   ├── perfil.php                 → Vista 7: Mi perfil
│   ├── historial-compras.php      → Vista 8: Historial de compras
│   ├── favoritos.php              → Vista 9 (nueva): Mis favoritos (localStorage)
│   └── detalle-juego.php          → Vista 10 (nueva): Recarga con ID de usuario y paquetes
├── css/
│   └── estilos.css                → Estilos personalizados
├── js/
│   └── main.js                    → Interacciones (un bloque por página, según data-pagina)
├── img/                           → Imágenes (placeholders SVG exportables desde Figma)
├── mockups/                       → Mockups originales del diseño en Figma (sin modificar)
├── .env                           → Configuración local (no se sube a GitHub)
├── .env.example                   → Ejemplo de configuración (versionado)
├── .gitignore                     → Ignora .env
├── README.md
├── documentacion.md
└── .prettierrc
```

### Relación mockups ↔ vistas

| Mockup (Figma)  | Vista                                                        | Archivo                         |
| --------------- | ------------------------------------------------------------ | ------------------------------- |
| Wireframe 1     | Inicio                                                       | `index.php`                     |
| Wireframe 2     | Todos los juegos                                             | `paginas/juegos.php`            |
| Wireframe 3     | Ofertas especiales                                           | `paginas/ofertas.php`           |
| Wireframe 4     | Métodos de pago                                              | `paginas/metodos-pago.php`      |
| Wireframe 5     | Contacto y soporte                                           | `paginas/contacto.php`          |
| Wireframe 6     | Mi carrito                                                   | `paginas/carrito.php`           |
| Wireframe 7     | Mi perfil                                                    | `paginas/perfil.php`            |
| Wireframe 8     | Historial de compras                                         | `paginas/historial-compras.php` |
| Wireframe 9     | Menú hamburguesa (componente, presente en todas las páginas) | offcanvas de Bootstrap          |
| **Nueva vista** | **Detalle de juego / recarga**                               | `paginas/detalle-juego.php`     |
| **Nueva vista** | **Mis favoritos**                                            | `paginas/favoritos.php`         |

> **Nota:** las vistas de _detalle de juego_ y _mis favoritos_ no estaban en el diseño
> de Figma original. Se crearon para completar las 10 vistas y para que los botones
> "Recargar >" de las tarjetas y el ítem "Mis favoritos" del menú tuvieran destino real.
> **Pendiente:** agregar estas pantallas al proyecto de Figma.

---

## 3. Uso de Bootstrap 5

Se carga por **CDN** desde `includes/header.php` (una sola vez para todo el sitio). Componentes usados:

- **Grilla responsiva:** `container`, `row`, `col-*` con breakpoints `md` y `lg` para computadoras, tablets y celulares.
- **Offcanvas:** implementación del menú hamburguesa que se desliza desde la derecha, como en el Wireframe 9.
- **Collapse:** submenú "Categorías" dentro del menú hamburguesa.
- **Toasts:** avisos de confirmación (producto agregado, consulta enviada, etc.).
- **Validación de formularios:** clases `is-invalid`, `invalid-feedback` y `was-validated` de Bootstrap, combinadas con la API de validación de HTML5.
- **Modo oscuro:** `data-bs-theme="dark"` en `<html>` para que los formularios y tablas hereden colores oscuros.
- **Utilidades:** `visually-hidden` (accesibilidad), `position-relative`, `gap-*`, `d-flex`, entre otras.

Los colores y componentes propios (tarjetas de juego, chips de filtro, banner de ofertas, resumen del carrito) se definen en `css/estilos.css` con variables CSS.

---

## 4. HTML semántico

En todas las páginas:

- `<header>` con `<nav aria-label="Navegación principal">` para la barra superior.
- `<main id="contenido-principal">` con un solo bloque de contenido principal.
- `<section>` para cada bloque con `aria-labelledby` apuntando a su título.
- `<article>` en las tarjetas de juegos y métodos de pago.
- `<aside>` para contenidos secundarios (resumen de compra, datos del perfil).
- `<footer>` con las columnas de redes, información y ayuda.
- `<form>`, `<label>`, `<fieldset>` implícitos y `<caption>` en tablas.
- **Un único `<h1>` por página** y jerarquía ordenada de `h2`/`h3`.
- `<nav>` con `aria-label` para cada rol de navegación (principal, menú, filtros, ruta).
- Breadcrumb (`<ol class="breadcrumb">`) en la página de detalle de juego.

Se evitó el uso de `div` para estructura: los `div` que quedan son solo contenedores de grilla de Bootstrap.

---

## 5. Criterios SEO aplicados

- `<title>` **específico y distinto** en cada página (ej: "Ofertas especiales | BUYDIMA").
- `<meta name="description">` **única por página**, descriptiva (150-160 caracteres).
- `<meta charset="utf-8">` y `<meta name="viewport">` en todas las páginas.
- Un solo `<h1>` por página con la palabra clave de la vista.
- Textos descriptivos en lugar de solo imágenes.
- `alt` en todas las imágenes con contenido significativo; `alt=""` en las decorativas (logo repetido del pie).
- Enlaces con texto comprensible ("Recargar diamantes de Free Fire" mediante `visually-hidden` complementario).
- `rel="noopener"` en enlaces externos, favicon propio, Open Graph en todas las páginas (desde `includes/header.php`).
- Títulos y descripciones **generados por PHP** a partir de variables definidas en cada página.

---

## 6. Mejoras de accesibilidad

- **Enlace "Saltar al contenido principal"** como primer elemento enfocable.
- **Foco visible** en todo el sitio: `:focus-visible { outline: 2px solid }`.
- **Navegación por teclado**: el menú hamburguesa, el acordeón de categorías, los chips de filtro y todos los formularios son operables con Tab / Enter / Esc (componentes nativos de Bootstrap).
- **Etiquetas asociadas** a todos los campos de formulario (`for` + `id`); los que no muestran texto usan `label class="visually-hidden"`.
- **Botones con nombre accesible**: los botones de icono (buscar, usuario, carrito, cerrar, eliminar, +/−) tienen `aria-label`.
- **aria-current="page"** en el enlace activo del menú.
- **aria-live**: el contador de cantidad del carrito y los avisos (toast con `role="alert"`).
- **aria-expanded / aria-controls** en el acordeón del menú.
- **Estado de la cuenta por color y texto**: los estados del historial usan texto ("Completado", "En proceso") además del color.
- **Contraste**: textos secundarios en lila claro (`#c084fc`) sobre fondo violeta oscuro, con contraste suficiente.
- **Imágenes SVG con `role="img"` y `aria-label`** descriptivo.
- Radio buttons reales (`input type="radio"` visualmente integrado con la tarjeta) para los paquetes, navegables con flechas.

---

## 7. Configuración y uso de Prettier

El archivo `.prettierrc` del proyecto:

```json
{
  "printWidth": 100,
  "tabWidth": 2,
  "useTabs": false,
  "semi": true,
  "singleQuote": true,
  "trailingComma": "es5",
  "endOfLine": "auto"
}
```

- `endOfLine: "auto"` evita problemas de saltos de línea entre Windows y GitHub.
- Para formatear: clic derecho → _Format document with..._ → Prettier (VS Code), o por terminal:

```bash
npx prettier --write .
```

---

## 8. Auditoría con Google Lighthouse

**Instrucciones para ejecutarla** (Chrome o Edge):

1. Abrir el sitio desde el servidor local (`http://localhost/BUYDIMA/` con XAMPP o Laragon).
2. Abrir DevTools (F12) → pestaña **Lighthouse**.
3. Marcar las 4 categorías: _Performance, Accessibility, Best Practices, SEO_.
4. Seleccionar **Mobile** y hacer clic en _Analyze page load_.
5. Repetir en **Desktop** y en las páginas principales (inicio, catálogo, carrito, detalle de juego).

**Resultados reales (auditoría ejecutada el 14/11/2026 sobre servidor local `http://localhost:8377`):**

La auditoría se ejecutó con Lighthouse (motor axe-core) sobre las **9 páginas del sitio**. Los valores de _Performance_ quedan pendientes porque la herramienta utilizada no emula dispositivos ni mide rendimiento; se completarán con la auditoría de Chrome DevTools.

| Página               | Performance | Accesibilidad | Best Practices | SEO     |
| -------------------- | ----------- | ------------- | -------------- | ------- |
| Inicio               | —           | **100**       | **100**        | **100** |
| Catálogo (juegos)    | —           | **100**       | **100**        | **100** |
| Ofertas              | —           | **100**       | **100**        | **100** |
| Métodos de pago      | —           | **100**       | **100**        | **100** |
| Contacto             | —           | **100**       | **100**        | **100** |
| Carrito              | —           | **100**       | **100**        | **100** |
| Perfil               | —           | **100**       | **100**        | **100** |
| Historial de compras | —           | **100**       | **100**        | **100** |
| Mis favoritos        | —           | **100**       | **100**        | **100** |
| Detalle de juego     | —           | **100**       | **100**        | **100** |

**Problemas detectados por la auditoría y correcciones aplicadas:**

| Problema detectado (regla axe)                                                                                                        | Corrección aplicada                                                                                                                   |
| ------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- |
| `color-contrast`: texto blanco sobre violeta claro `#a855f7` en `.boton-compra`                                                       | Se oscureció el fondo del botón a `--violeta-oscuro` `#7c3aed` (contraste 5,6:1, cumple WCAG AA 4,5:1) y el hover a `#6d28d9` (7,1:1) |
| `color-contrast`: mismo problema en el chip de filtro activo `.chip-filtro.activo`                                                    | Fondo cambiado a `--violeta-oscuro` `#7c3aed` (5,6:1)                                                                                 |
| `label-content-name-mismatch`: el enlace del carrito tenía `aria-label="Ver carrito de compras"` pero mostraba el número de productos | `main.js` actualiza el nombre accesible junto con el contador: `Ver carrito de compras (3)` — visible y accesible coinciden           |

**Posibles advertencias esperables y su justificación:**

- Imágenes SVG placeholder: se reemplazarán por las exportadas de Figma.
- CDN de Google Fonts puede sugerir `font-display` (ya configurado con `display=swap`).
- Al tratarse de una demostración académica, algunas métricas de performance dependen del CDN de Bootstrap.

---

## 9. Problemas detectados y correcciones realizadas

| Problema detectado                                                          | Corrección aplicada                                                                                                                                  |
| --------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------- |
| El menú hamburguesa del mockup es una vista (Wireframe 9), no una página    | Se implementó como componente **offcanvas** reutilizado en las 10 páginas                                                                            |
| El menú tenía "Seguimiento del pedido" apuntando a `historial-compras.html` | Se reemplazó por **"Mis favoritos"** (`favoritos.html`): juegos guardados con `localStorage`, corazón para agregar/quitar y estado vacío             |
| Faltaba una vista para llegar a 10                                          | Se creó `detalle-juego.html` (ID de usuario + paquetes + carrito); queda pendiente agregarla a Figma                                                 |
| Las imágenes de los juegos no podían descargarse de internet (copyright)    | Se crearon **placeholders SVG** con los nombres finales en `img/`; se reemplazan por las exportaciones de Figma sin tocar el código                  |
| Riesgo de desbordamiento horizontal en la grilla del héroe y tarjetas       | Uso de `row-cols-*` de Bootstrap, `img-fluid`, `object-fit: cover` y `overflow` controlado en las tarjetas                                           |
| El buscador del encabezado debía funcionar desde cualquier carpeta          | `main.js` detecta si la página está en `/paginas/` y ajusta el `action` y las rutas de imágenes                                                      |
| `alert()` de JavaScript no es accesible ni estético                         | Se reemplazó por **toasts de Bootstrap** con `role="alert"`                                                                                          |
| El botón "Cerrar sesión" no hacía nada y no existía inicio de sesión        | **Sesión simulada** en `perfil.html`: clave `buydima-sesion` en `localStorage`; iniciar/cerrar sesión funcionan e informan que no hay seguridad real |
| El carrito debía persistir entre páginas                                    | Se usa `localStorage` con la clave `buydima-carrito`; si está vacío se muestra el estado del mockup                                                  |
| Riesgo de contraste insuficiente en textos secundarios                      | Se usó lila claro `#c084fc` para textos pequeños sobre fondo oscuro en lugar de violeta medio                                                        |
| Encabezado, menú y pie repetidos en los 10 archivos HTML                    | Migración a PHP: **includes** `header.php`, `nav.php` y `footer.php` reutilizados con `require_once` en las 10 páginas (TP N.º 4)                    |
| El título y la sección activa del menú se repetían a mano en cada HTML      | **SSR**: cada página define `$titulo_pagina` y `$pagina_activa`; PHP los imprime y marca el enlace activo con `aria-current="page"`                  |
| El correo de soporte estaba escrito a mano en el HTML                       | Se reemplazó por la **variable de entorno** `SUPPORT_EMAIL`, cargada desde `.env` por `config/env.php`                                               |
| Cambiar el nombre de la app obligaba a editar todas las páginas             | `APP_NAME` se define en `.env` y se usa en los títulos (`<title>`) y en el pie de página                                                             |
| Los archivos `.html` dejaron de existir tras la migración                   | Se convirtieron a `.php` y se actualizaron **todos los enlaces internos** (HTML y `main.js`); verificación con búsqueda de `.html` = 0               |

---

## 10. TP N.º 4: migración a PHP (SSI, SSR y variables de entorno)

### 10.1 Modularización con includes (SSI)

Los elementos comunes del sitio viven en `includes/` y se insertan en las 10 páginas:

```php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
// ... contenido propio de la página ...
require_once __DIR__ . '/../includes/footer.php';
```

- **`header.php`**: `<head>` completo (charset, viewport, título dinámico, meta
  descripción, Open Graph, favicon, Bootstrap, tipografía Inter y `estilos.css`),
  apertura del `<body>` con `data-pagina` y enlace "Saltar al contenido principal".
- **`nav.php`**: navbar con logo, buscador, accesos al perfil y carrito, y el menú
  hamburguesa (offcanvas). Recorre un array `$items_menu` y marca el enlace activo.
- **`footer.php`**: pie con las 4 columnas, copyright dinámico y scripts
  (Bootstrap CDN + `main.js`).

### 10.2 Resolución de rutas

Las páginas de la raíz y de `paginas/` tienen niveles de profundidad distintos:

- **Rutas del servidor (includes):** `require_once __DIR__ . '/config/env.php'`
  en la raíz y `require_once __DIR__ . '/../config/env.php'` en `paginas/`.
  `__DIR__` apunta siempre a la carpeta del archivo, sin ambigüedad.
- **Rutas públicas (CSS, JS, imágenes, enlaces):** cada página define
  `$ruta_base = '.'` (raíz) o `$ruta_base = '..'` (subcarpeta), y los includes
  generan rutas como `<?php echo $ruta_base ?>/css/estilos.css`.
- Los includes usan `$ruta_base ?? '.'` para no romperse si falta la variable.

### 10.3 Renderizado del lado del servidor (SSR)

Cada página define, **antes de incluir el header**:

```php
<?php
require_once __DIR__ . '/../config/env.php';

$titulo_pagina = 'Mi carrito | ' . APP_NAME;
$descripcion_pagina = 'Revisá los productos de tu carrito en BUYDIMA...';
$pagina_activa = 'carrito';
$ruta_base = '..';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
```

- `header.php` imprime `<title>`, `meta description` y `og:title` usando
  `htmlspecialchars($titulo_pagina)` (escapado de HTML para valores dinámicos).
- `nav.php` compara `$pagina_activa` con el `id` de cada ítem del menú; si coinciden,
  imprime `class="activo" aria-current="page"`. Las páginas sin ítem en el menú
  (detalle de juego, historial) no marcan ninguno, igual que en el TP 3.
- El `<body>` recibe `data-pagina="<?php echo htmlspecialchars($pagina_activa) ?>"`
  para que `main.js` siga identificando la página.

### 10.4 Variables de entorno

- **`config/env.php`**: cargador con PHP nativo (sin Composer). Lee `.env` línea por
  línea, ignora comentarios y comillas, carga los valores en `$_ENV` y define las
  constantes `APP_NAME`, `SUPPORT_EMAIL` y `APP_ENV` (con valores por defecto si el
  archivo no existe).
- **`.env`**: configuración local, **ignorado por Git** vía `.gitignore`.
- **`.env.example`**: ejemplo versionado que sirve de plantilla.
- **Uso real de las variables:**
  - `APP_NAME` → `<title>` de todas las páginas (ej. `Mi carrito | BUYDIMA`) y
    copyright del pie.
  - `SUPPORT_EMAIL` → correo mostrado en la página de contacto.
  - `APP_ENV` → disponible para distinguir entorno local de producción.

```php
// Ejemplo de uso en contacto.php
<?php echo htmlspecialchars(SUPPORT_EMAIL); ?>
```

### 10.5 Ejecución local

- **XAMPP:** copiar el proyecto en `C:\xampp\htdocs\BUYDIMA`, iniciar Apache y abrir
  `http://localhost/BUYDIMA/`.
- **Laragon:** copiar en `C:\laragon\www\BUYDIMA`, iniciar y abrir `http://localhost/BUYDIMA/`.
- **Solo PHP:** `php -S localhost:8000` desde la carpeta del proyecto.
- Verificación de sintaxis de los archivos PHP: `php -l archivo.php` en cada uno.

---

## 11. Qué queda pendiente

1. Reemplazar los SVG de `img/` por las imágenes finales exportadas de Figma (mismos nombres de archivo).
2. Agregar la vista de _detalle de juego_ al diseño de Figma.
3. Completar la columna _Performance_ de la tabla de la sección 8 (requiere Chrome DevTools, con emulación Mobile y Desktop).
4. Re-auditar el sitio con Lighthouse **sobre el servidor PHP** (`http://localhost/BUYDIMA/`), ya que los resultados de la sección 8 corresponden a la versión HTML del TP 3.
5. Verificar manualmente el sitio en XAMPP/Laragon y correr `php -l` sobre los archivos PHP (esta máquina no tenía PHP instalado al momento de la migración).
6. Verificar que las capturas pedidas por el profesor se visualicen correctamente en `README.md` (sitio en localhost, código de los includes, título dinámico/navegación activa y `.env.example`), ya vinculadas desde `capturas/`.

> **Nota sobre GitHub Pages:** desde el TP N.º 4 el sitio necesita un servidor con PHP,
> por lo que **ya no puede publicarse en GitHub Pages** (solo sirve archivos estáticos).
> Para publicarlo se puede usar un hosting con PHP o mantener la versión HTML del TP 3
> en GitHub Pages como demostración estática.
