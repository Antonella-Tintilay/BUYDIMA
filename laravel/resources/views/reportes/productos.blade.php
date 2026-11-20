
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de productos | BUYDIMA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f5f7;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        .contenedor {
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            margin-bottom: 25px;
        }

        .estadisticas {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .tarjeta {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px #00000010;
        }

        .tarjeta h3 {
            color: #666;
            font-size: 15px;
        }

        .tarjeta p {
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #252525;
            color: white;
        }

        .sin-datos {
            background: white;
            padding: 25px;
            text-align: center;
        }

        @media (max-width: 700px) {
            .estadisticas {
                grid-template-columns: 1fr;
            }

            .tabla-contenedor {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <main class="contenedor">
        <h1>Reporte de productos</h1>

        <section class="estadisticas">
            <article class="tarjeta">
                <h3>Total de productos activos</h3>
                <p>{{ $totalProductos }}</p>
            </article>

            <article class="tarjeta">
                <h3>Stock total</h3>
                <p>{{ $stockTotal }}</p>
            </article>

            <article class="tarjeta">
                <h3>Precio promedio</h3>
                <p>${{ number_format($precioPromedio, 2, ',', '.') }}</p>
            </article>
        </section>

        <h2>Listado de productos</h2>

        @if ($productos->isEmpty())
            <div class="sin-datos">
                No hay productos activos para mostrar.
            </div>
        @else
            <div class="tabla-contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Juego</th>
                            <th>Precio</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->nombre_producto }}</td>
                                <td>{{ $producto->juego->nombre }}</td>
                                <td>${{ number_format($producto->precio, 2, ',', '.') }}</td>
                                <td>{{ $producto->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>
</body>
</html>
