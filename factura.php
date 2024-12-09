<?php
// Configuración de productos con precios
$productos = [
    "jabon_liquido" => ["precio" => 10],
    "jabon_barra" => ["precio" => 8],
    "jabon_organico" => ["precio" => 12],
    "detergente_liquido" => ["precio" => 15],
    "detergente_polvo" => ["precio" => 12],
    "detergente_bio" => ["precio" => 14],
    "limpiador_multisuperficie" => ["precio" => 11],
    "limpiador_vidrio" => ["precio" => 9],
    "limpiador_ambiental" => ["precio" => 13]
];

// Conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos (deja vacío si no hay)
$dbname = "proyecto"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos enviados por el formulario
    $cantidades = [];
    $subtotal = 0;

    foreach ($productos as $producto => $info) {
        $cantidad = isset($_POST[$producto]) ? (int) $_POST[$producto] : 0;
        $cantidades[$producto] = $cantidad;
        $subtotal += $cantidad * $info['precio'];
    }

    $impuestos = $subtotal * 0.20;
    $total = $subtotal + $impuestos;

    $cliente = $_POST['name'] ?? '';
    $direccion = $_POST['address'] ?? '';
    $fecha = date('Y-m-d');
    $numero_recibo = 'RC-' . date('YmdHis');

    // Guardar la factura en la base de datos
    $stmt = $conn->prepare("INSERT INTO facturas (numero_recibo, cliente, direccion, fecha, subtotal, impuestos, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssddd", $numero_recibo, $cliente, $direccion, $fecha, $subtotal, $impuestos, $total);

    if ($stmt->execute()) {
        echo "Factura registrada correctamente";
    } else {
        echo "Error al registrar la factura: " . $stmt->error;
    }

    $stmt->close();

    // Generar contenido HTML de la factura
    $factura_html = "<!DOCTYPE html>
    <html lang=\"es\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>Factura de Compra</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #009688; color: #333; }
            .container { width: 80%; margin: auto; padding: 20px; background-color: white; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
            h1 { text-align: center; color: #2C3E50; }
            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
            table, th, td { border: 1px solid #ddd; }
            th { background-color: #f2f2f2; padding: 10px; text-align: left; }
            td { padding: 8px; text-align: right; }
            td:first-child { text-align: left; }
            .totales { font-size: 18px; font-weight: bold; text-align: right; }
            .button { display: block; margin: 20px auto; padding: 10px; background-color: #3498db; color: white; text-decoration: none; text-align: center; border-radius: 5px; }
            @media print {
                .no-imprimir {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class=\"container\">
            <h1>Factura de Compra</h1>
            <p><strong>Cliente:</strong> $cliente</p>
            <p><strong>Dirección:</strong> $direccion</p>
            <p><strong>Fecha:</strong> $fecha</p>
            <p><strong>Número de Recibo:</strong> $numero_recibo</p>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($cantidades as $producto => $cantidad) {
        if ($cantidad > 0) {
            $precio = $productos[$producto]['precio'];
            $total_producto = $cantidad * $precio;
            $factura_html .= "<tr>
                <td>" . ucfirst(str_replace('_', ' ', $producto)) . "</td>
                <td>$cantidad</td>
                <td>\$$precio</td>
                <td>\$$total_producto</td>
            </tr>";
        }
    }

    $factura_html .= "</tbody>
            </table>
            <div class=\"totales\">
                <p>Subtotal: \$$subtotal</p>
                <p>Impuestos (20%): \$$impuestos</p>
                <p>Total: \$$total</p>
            </div>
            <div class=\"no-imprimir\">
                <button onclick=\"window.print()\">Imprimir</button>
                <button onclick=\"window.location.href='inicio.php'\">Regresar a la página principal</button>
                <a href=\"facturas/$numero_recibo.html\" download=\"$numero_recibo.html\"><button>Descargar</button></a>
            </div>
        </div>
    </body>
    </html>";

    // Guardar factura como archivo HTML
    if (!is_dir('facturas')) {
        mkdir('facturas', 0777, true);
    }
    $ruta_factura = "facturas/$numero_recibo.html";
    file_put_contents($ruta_factura, $factura_html);

    // Mostrar la factura al cliente
    echo $factura_html;
} else {
    echo "<form method='POST' action=''>
        <h2>Formulario de Compra</h2>";
    foreach ($productos as $producto => $info) {
        echo "<label for='$producto'>" . ucfirst(str_replace('_', ' ', $producto)) . " (\$${info['precio']}):</label>
              <input type='number' id='$producto' name='$producto' value='0' min='0'><br><br>";
    }
    echo "<label for='name'>Nombre:</label>
          <input type='text' id='name' name='name' required><br><br>
          <label for='address'>Dirección:</label>
          <input type='text' id='address' name='address' required><br><br>
          <button type='submit'>Generar Factura</button>
          </form>";
}

// Cerrar la conexión
$conn->close();
?>
