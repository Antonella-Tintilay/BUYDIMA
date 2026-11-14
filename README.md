# BUYDIMA — Tienda de recargas de juegos y monedas virtuales

Proyecto de diseño y desarrollo de una tienda online de diamantes y monedas virtuales
(Free Fire, Mobile Legends, Roblox, Genshin Impact, Battlegrounds), realizado como
**TP N.º 3 de Desarrollo Front-End**.

El sitio fue maquetado a partir de los mockups diseñados en Figma y desarrollado con
HTML5, CSS3, Bootstrap 5 y JavaScript puro, como sitio estático.

## Diseños en Figma

[Ver proyecto BUYDIMA en Figma](https://www.figma.com/design/FG1K8az0lhOJ4UW6jQHqwA/BUYDIMA?node-id=0-1&t=SuZde1xKh9fQQfyJ-1)

En la carpeta `mockups/` se encuentran las imágenes de las pantallas diseñadas.
Las vistas **detalle de juego** (ID de usuario + selección de paquetes de diamantes y pases) y
**mis favoritos** (juegos guardados en el navegador) se agregaron sobre el diseño
de Figma; queda pendiente incorporarlas al diseño.

## Tecnologías

- HTML5 semántico
- CSS3 (estilos personalizados con variables)
- Bootstrap 5 (CDN) + Bootstrap Icons
- JavaScript puro (interacciones, validaciones y carrito de demostración)
- Prettier (formato de código)
- Git Workflow + GitHub Pages

## Estructura del proyecto

```
BUYDIMA/
├── index.html                # Inicio
├── paginas/                  # Las otras 9 vistas (juegos, ofertas, carrito, etc.)
├── css/estilos.css           # Estilos personalizados
├── js/main.js                # Interacciones de todo el sitio
├── img/                      # Imágenes y logos de los juegos
├── mockups/                  # Mockups originales del diseño
├── README.md
├── documentacion.md          # Documentación técnica del TP
└── .prettierrc
```

## Cómo visualizarlo

**Opción 1 — local:**

1. Clonar el repositorio o descargar la carpeta.
2. Abrir `index.html` en el navegador, o mejor, usar la extensión _Live Server_ de VS Code.

**Opción 2 — sitio publicado (GitHub Pages):**

> 🔗 **[Sitio publicado en GitHub Pages](https://antonella-tintilay.github.io/BUYDIMA/)** — _(actualizar este enlace cuando se publique el sitio)_

## Vistas incluidas (11)

1. Inicio
2. Todos los juegos (catálogo con búsqueda y filtros por categoría)
3. Ofertas especiales (con cuenta regresiva)
4. Métodos de pago
5. Contacto y soporte (formulario validado)
6. Mi carrito (cantidades, código de descuento y resumen)
7. Mi perfil (edición de datos)
8. Historial de compras
9. Mis favoritos (juegos guardados, persisten en el navegador)
10. Menú hamburguesa (componente global en todas las páginas)
11. Detalle de juego (ID de usuario + paquetes de diamantes y pases)

> Todas las interacciones son de **demostración**: no hay pagos, registros ni envíos reales.

## Documentación

La explicación técnica completa (tecnologías, estructura, SEO, accesibilidad, Prettier,
Lighthouse y problemas corregidos) está en [`documentacion.md`](documentacion.md).

---

_Proyecto académico. Todos los juegos y marcas mencionados pertenecen a sus respectivos dueños._
