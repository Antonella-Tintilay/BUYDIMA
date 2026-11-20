# Documentación técnica — BUYDIMA

Documento técnico que reúne las decisiones de diseño, estructura, tecnologías, funcionamiento y correcciones realizadas durante el desarrollo de BUYDIMA.

---

## 1. Tecnologías utilizadas

| Tecnología | Uso en el proyecto |
|---|---|
| PHP 8.x | Renderizado del lado del servidor (SSR), includes, procesamiento de formularios y lógica del servidor |
| HTML5 | Estructura de las páginas con etiquetas semánticas |
| CSS3 | Estilos personalizados en `css/estilos.css` |
| Bootstrap 5.3 | Grilla responsiva, offcanvas, toasts y componentes visuales |
| Bootstrap Icons | Iconografía del sitio |
| JavaScript puro | Interacciones y validaciones del navegador en `js/main.js` |
| MySQL | Almacenamiento de usuarios, juegos, productos y pedidos |
| PDO | Conexión segura entre PHP y MySQL |
| XAMPP / PHP | Entorno de ejecución local |
| Prettier | Formateo uniforme del código |
| Git | Control de versiones |

No se utilizan React, Angular, Vue, TypeScript ni Vite.

El proyecto cuenta con persistencia de datos mediante MySQL. Algunas funcionalidades de la interfaz, como la simulación de sesión, el carrito y los favoritos, continúan utilizando `localStorage` y no representan un sistema completo de autenticación ni de procesamiento de pagos.

---

## 2. Estructura del proyecto

```text
BUYDIMA/
├── index.php
├── config/
│   ├── env.php
│   ├── conexion.php
│   └── productos.php
├── includes/
│   ├── header.php
│   ├── nav.php
│   ├── footer.php
│   ├── funciones.php
│   └── tabla-productos.php
├── admin/
│   ├── index.php
│   ├── crear.php
│   ├── editar.php
│   └── eliminar.php
├── paginas/
│   ├── juegos.php
│   ├── ofertas.php
│   ├── metodos-pago.php
│   ├── contacto.php
│   ├── carrito.php
│   ├── perfil.php
│   ├── historial-compras.php
│   ├── favoritos.php
│   ├── detalle-juego.php
│   └── productos.php
├── css/
│   └── estilos.css
├── js/
│   └── main.js
├── img/
├── mockups/
├── capturas/
├── clase5/
├── tp6/
│   ├── NORMALIZACION.md
│   ├── schema.sql
│   └── consultas.sql
├── .env
├── .env.example
├── .htaccess
├── router.php
├── .gitignore
├── README.md
└── documentacion.md
```

### Organización de las carpetas

- **`config/`**: configuración del entorno, conexión a la base de datos y funciones relacionadas con los productos.
- **`includes/`**: componentes compartidos y funciones auxiliares.
- **`admin/`**: panel de administración para gestionar productos.
- **`paginas/`**: páginas públicas del sitio.
- **`css/` y `js/`**: estilos e interacciones del navegador.
- **`img/`**: imágenes utilizadas en el sitio.
- **`mockups/`**: diseños originales realizados en Figma.
- **`tp6/`**: documentación y scripts SQL de la base de datos.

---

## 3. Uso de Bootstrap 5

Bootstrap se carga mediante CDN desde `includes/header.php`, evitando repetir su inclusión en cada página.

Componentes utilizados:

- **Grilla responsiva:** `container`, `row` y `col-*` con distintos breakpoints.
- **Offcanvas:** menú hamburguesa que se desliza desde un lateral.
- **Collapse:** submenú de categorías.
- **Toasts:** avisos de confirmación e información.
- **Validación de formularios:** clases `is-invalid`, `invalid-feedback` y `was-validated`, combinadas con la validación HTML5.
- **Modo oscuro:** atributo `data-bs-theme="dark"`.
- **Utilidades:** `visually-hidden`, `position-relative`, `gap-*`, `d-flex`, entre otras.

Los colores y componentes propios, como tarjetas de juegos, chips de filtro y resúmenes de compra, se definen en `css/estilos.css` mediante variables CSS.

---

## 4. HTML semántico

Se utilizan elementos semánticos para organizar el contenido:

- `<header>` para el encabezado.
- `<nav>` para la navegación.
- `<main>` para el contenido principal.
- `<section>` para agrupar bloques relacionados.
- `<article>` para contenidos independientes, como tarjetas.
- `<aside>` para información complementaria.
- `<footer>` para el pie de página.
- `<form>` y `<label>` para los formularios.

También se incorporan atributos ARIA cuando son necesarios para mejorar la accesibilidad, como `aria-label`, `aria-current`, `aria-expanded` y `aria-controls`.

Se procura mantener una jerarquía ordenada de encabezados y un único `<h1>` por página.

---

## 5. Criterios SEO aplicados

- Título específico para cada página mediante la variable `$titulo_pagina`.
- Meta descripción definida según el contenido de cada vista.
- Codificación UTF-8 y configuración de viewport.
- Encabezados con jerarquía ordenada.
- Textos descriptivos para acompañar las imágenes.
- Atributos `alt` en las imágenes.
- Enlaces con textos comprensibles.
- Uso de `rel="noopener"` en enlaces externos cuando corresponde.
- Favicon y metadatos Open Graph.
- Títulos y descripciones generados desde PHP mediante los componentes compartidos.

Los valores dinámicos que se imprimen en HTML se escapan para evitar que se interpreten como código.

---

## 6. Mejoras de accesibilidad

- Enlace para saltar directamente al contenido principal.
- Foco visible mediante `:focus-visible`.
- Navegación por teclado en los controles compatibles.
- Etiquetas asociadas a los campos de los formularios.
- Nombres accesibles para botones que utilizan solamente iconos.
- Uso de `aria-current="page"` para identificar la sección activa.
- Uso de `aria-live` en avisos y elementos cuyo contenido cambia dinámicamente.
- Atributos `aria-expanded` y `aria-controls` en controles desplegables.
- Información de estados acompañada por texto, no solamente por colores.
- Textos e imágenes con alternativas descriptivas cuando corresponde.

---

## 7. Configuración y uso de Prettier

El archivo `.prettierrc` establece las reglas de formato del proyecto:

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

`endOfLine: "auto"` permite mantener compatibilidad con distintos sistemas de saltos de línea.

Para formatear los archivos se puede utilizar Prettier desde VS Code o ejecutar:

```bash
npx prettier --write .
```

---

## 8. Auditoría con Google Lighthouse

La auditoría permite evaluar el sitio en cuatro categorías:

- Performance.
- Accessibility.
- Best Practices.
- SEO.

Para realizarla desde Chrome o Edge:

1. Abrir el sitio desde el servidor local.
2. Abrir las herramientas de desarrollador con F12.
3. Ingresar a la pestaña Lighthouse.
4. Seleccionar las categorías que se desean evaluar.
5. Ejecutar el análisis en Mobile y repetirlo en Desktop.

Los resultados obtenidos en auditorías anteriores corresponden a la versión estática del sitio. Para contar con resultados actualizados, es necesario volver a ejecutar las pruebas sobre la versión PHP actual.

### Correcciones de accesibilidad realizadas

| Problema detectado | Corrección aplicada |
|---|---|
| Contraste insuficiente entre texto y fondo en botones | Se oscureció el fondo para mejorar la relación de contraste |
| Contraste insuficiente en el chip de filtro activo | Se ajustó el color de fondo |
| Diferencia entre el nombre accesible y el contenido visible del carrito | JavaScript actualiza el nombre accesible junto con el contador |

Las métricas de rendimiento deben verificarse nuevamente mediante Chrome DevTools, ya que pueden variar según el entorno, la conexión y los recursos externos utilizados.

---

## 9. Problemas detectados y correcciones realizadas

| Problema detectado | Corrección aplicada |
|---|---|
| El menú hamburguesa debía estar disponible en todas las páginas | Se implementó mediante el componente offcanvas de Bootstrap y se reutiliza desde `includes/nav.php` |
| Faltaban destinos para algunas opciones de navegación | Se incorporaron las vistas de favoritos y detalle de juego |
| Las imágenes de los juegos necesitaban recursos propios | Se utilizaron imágenes SVG de reemplazo, preparadas para sustituirse por las definitivas |
| Riesgo de desbordamiento horizontal en tarjetas y grillas | Se aplicaron utilidades responsivas de Bootstrap y ajustes de CSS |
| El buscador debía funcionar desde diferentes carpetas | Se adaptaron las rutas según la ubicación de cada página |
| Los avisos de JavaScript no eran uniformes | Se utilizaron toasts de Bootstrap |
| El carrito debía conservar sus datos entre páginas | Se incorporó `localStorage` |
| El encabezado, menú y pie se repetían | Se modularizaron mediante includes de PHP |
| El título y la sección activa se repetían manualmente | Se incorporaron variables dinámicas procesadas por PHP |
| El correo de soporte estaba escrito directamente en el código | Se reemplazó por la variable de entorno `SUPPORT_EMAIL` |
| La configuración estaba mezclada con el código | Se separó mediante `.env` y `config/env.php` |
| Los productos necesitaban persistencia | Se implementó una conexión PDO con MySQL |
| Las operaciones sobre productos podían recibir datos no confiables | Se incorporaron validaciones del lado del servidor y consultas preparadas |
| Los datos dinámicos podían interpretarse como HTML | Se utiliza `htmlspecialchars()` al imprimir valores en las páginas |
| Eliminar productos podía afectar compras anteriores | La clave foránea impide eliminar productos asociados a pedidos existentes y conserva el historial |

---

## 10. Configuración del servidor y conexión a la base de datos

### 10.1 Modularización con includes

Los elementos comunes del sitio se encuentran en `includes/` y se incorporan mediante `require_once`.

Ejemplo:

```php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';

// Contenido propio de la página.

require_once __DIR__ . '/../includes/footer.php';
```

- **`header.php`**: contiene la estructura inicial del documento, metadatos, título dinámico, estilos y recursos externos.
- **`nav.php`**: contiene la barra de navegación, el buscador y el menú.
- **`footer.php`**: contiene el pie de página y los scripts.
- **`funciones.php`**: reúne funciones auxiliares, como el escape de valores HTML y el procesamiento de datos.
- **`tabla-productos.php`**: permite reutilizar la tabla de productos en las vistas correspondientes.

### 10.2 Resolución de rutas

Las páginas ubicadas en la raíz y las que se encuentran dentro de `paginas/` tienen distintos niveles de profundidad.

Para las rutas internas de PHP se utiliza `__DIR__`, que permite construir referencias a partir de la ubicación real del archivo.

Para los recursos públicos, como CSS, JavaScript e imágenes, se utiliza `$ruta_base`, que permite adaptar las rutas según la ubicación de la página.

### 10.3 Renderizado del lado del servidor (SSR)

Cada página define sus datos antes de incluir el encabezado:

```php
<?php
$titulo_pagina = 'Mi carrito | ' . APP_NAME;
$descripcion_pagina = 'Revisá los productos de tu carrito en BUYDIMA.';
$pagina_activa = 'carrito';
$ruta_base = '..';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
```

Los includes utilizan estas variables para generar el título, la descripción y el enlace activo del menú.

Los valores dinámicos se escapan antes de imprimirse en HTML.

### 10.4 Variables de entorno

El archivo `config/env.php` carga la configuración almacenada en `.env` sin necesidad de utilizar Composer.

El archivo `.env` contiene los valores de configuración local y no debe subirse a GitHub.

El archivo `.env.example` funciona como plantilla para configurar el proyecto en otro entorno.

Variables utilizadas:

| Variable | Función |
|---|---|
| `APP_NAME` | Nombre de la aplicación |
| `SUPPORT_EMAIL` | Correo de soporte |
| `APP_ENV` | Identificación del entorno |
| `DB_HOST` | Dirección del servidor MySQL |
| `DB_PORT` | Puerto de conexión |
| `DB_NAME` | Nombre de la base de datos |
| `DB_USER` | Usuario de MySQL |
| `DB_PASSWORD` | Contraseña de MySQL |

La configuración de la base de datos se mantiene fuera de los archivos versionados para evitar exponer credenciales.

### 10.5 Conexión mediante PDO

La conexión se encuentra en `config/conexion.php`.

Se utiliza PDO para conectar PHP con MySQL mediante una función reutilizable:

```php
conexion(): PDO
```

La conexión utiliza:

- Charset `utf8mb4`.
- Modo de errores mediante excepciones.
- Resultados asociativos.
- Consultas preparadas nativas mediante `PDO::ATTR_EMULATE_PREPARES => false`.

Los errores técnicos se registran en el log del servidor y se evita mostrar información sensible de la conexión al usuario.

### 10.6 Persistencia y operaciones sobre productos

La lógica relacionada con los productos se encuentra en `config/productos.php`.

Se implementaron las siguientes operaciones:

| Operación | Funcionalidad |
|---|---|
| READ | Listar productos y consultar sus datos |
| CREATE | Registrar nuevos productos |
| UPDATE | Modificar productos existentes |
| DELETE | Eliminar productos cuando las relaciones de la base de datos lo permiten |

El panel de administración se encuentra en `admin/`:

- `index.php`: listado de productos.
- `crear.php`: formulario para registrar productos.
- `editar.php`: formulario para modificar productos.
- `eliminar.php`: confirmación y procesamiento de la eliminación.

El catálogo público se encuentra separado del panel de administración y muestra los productos sin incluir los controles de gestión.

### 10.7 Validaciones y seguridad

Las operaciones de escritura utilizan consultas preparadas de PDO para evitar la inyección SQL.

También se realizan validaciones del lado del servidor para controlar:

- Campos obligatorios.
- Longitud de los nombres.
- Existencia del juego seleccionado.
- Valores numéricos de precios y stock.
- Formato y rango de los valores ingresados.
- Duplicados de productos para un mismo juego.

Para evitar la ejecución de contenido HTML o JavaScript ingresado por el usuario, se utiliza `htmlspecialchars()` al mostrar datos dinámicos.

Las eliminaciones se procesan mediante solicitudes POST y requieren una confirmación previa.

La base de datos utiliza claves foráneas para mantener la integridad de los datos. Por ejemplo, un producto relacionado con un pedido no puede eliminarse si la restricción de la base de datos impide hacerlo. De esta manera, se conserva el historial de compras.

El archivo `.env` se excluye del control de versiones mediante `.gitignore`. Además, se incorporaron reglas en `.htaccess` y una comprobación en `router.php` para impedir que el archivo de configuración quede disponible mediante el servidor web utilizado.

### 10.8 Ejecución local

El proyecto puede ejecutarse con PHP y una base de datos MySQL activa.

Pasos generales:

1. Iniciar el servidor web y comprobar que PHP esté disponible.
2. Iniciar el servicio MySQL.
3. Crear la base de datos utilizando los scripts SQL ubicados en `tp6/`.
4. Crear el archivo `.env` en la carpeta principal del proyecto.
5. Completar las variables de conexión con los datos del entorno local.
6. Abrir el sitio desde el servidor PHP.

Para iniciar el servidor integrado de PHP desde la carpeta principal del proyecto:

```powershell
C:\xampp\php\php.exe -S localhost:8000 router.php
```

Luego ingresar a:

```text
http://localhost:8000
```

La terminal debe permanecer abierta mientras se utiliza el servidor. Para detenerlo, presionar `Ctrl + C`.

Para verificar la sintaxis de un archivo PHP:

```bash
php -l archivo.php
```

---

## 11. Funcionalidades y limitaciones actuales

### Funcionalidades implementadas

- Navegación por las páginas públicas.
- Catálogo de productos.
- Conexión PHP-MySQL mediante PDO.
- Listado de productos desde la base de datos.
- Alta, modificación y eliminación de productos desde el panel de administración.
- Validación de datos en el servidor.
- Consultas preparadas para las operaciones con la base de datos.
- Escape de valores dinámicos para prevenir XSS.
- Conservación del historial de pedidos mediante restricciones de claves foráneas.
- Configuración mediante variables de entorno.

### Funcionalidades que siguen siendo demostrativas o están pendientes

- El inicio de sesión y la sesión de usuario no cuentan todavía con autenticación real del lado del servidor.
- El panel de administración no tiene todavía un control de acceso por roles.
- El carrito y los favoritos utilizan `localStorage`.
- No existe integración con una pasarela de pagos.
- No se realiza la entrega automática de recargas o monedas virtuales.
- La gestión de pedidos y el proceso completo de compra no están implementados como un flujo funcional de producción.

Estas limitaciones permiten diferenciar las funcionalidades visuales de las operaciones que actualmente cuentan con persistencia en MySQL.

---

## 12. Qué queda pendiente

1. Reemplazar los SVG de reemplazo por las imágenes finales exportadas de Figma, conservando los nombres de archivo.
2. Completar el diseño de las vistas que todavía no estén representadas en Figma.
3. Ejecutar nuevamente Lighthouse sobre la versión PHP actual.
4. Completar las mediciones de Performance en Mobile y Desktop.
5. Continuar verificando el funcionamiento del sitio en el entorno local.
6. Mantener actualizados el README y esta documentación cuando se incorporen nuevas funcionalidades.

---

**Nota sobre GitHub Pages:** el proyecto utiliza PHP y MySQL, por lo que necesita un servidor que admita PHP y permita conectarse a una base de datos. GitHub Pages solamente sirve contenido estático y no puede ejecutar directamente la lógica del servidor. Para publicar el sitio funcional se necesita un servicio de alojamiento compatible con PHP y MySQL.