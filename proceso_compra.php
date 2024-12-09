<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $metodo_pago = $_POST['metodo_pago'];
    $numero_tarjeta = $_POST['numero_tarjeta'] ?? null;
    $fecha_vencimiento = $_POST['fecha_vencimiento'] ?? null;
    $cvv = $_POST['cvv'] ?? null;

    // Insertar datos en la tabla clientes
    $sql_cliente = "INSERT INTO clientes (nombre, correo, direccion) VALUES ('$nombre', '$correo', '$direccion')";
    $conn->query($sql_cliente);
    $id_cliente = $conn->insert_id;

    // Insertar datos en la tabla procesos_compra
    $sql_proceso = "INSERT INTO procesos_compra (id_cliente, fecha_proceso) VALUES ('$id_cliente', NOW())";
    $conn->query($sql_proceso);
    $id_proceso = $conn->insert_id;

    // Insertar datos en la tabla detalles_pago
    $sql_pago = "INSERT INTO detalles_pago (id_proceso, metodo_pago, numero_tarjeta, fecha_vencimiento, cvv)
                 VALUES ('$id_proceso', '$metodo_pago', '$numero_tarjeta', '$fecha_vencimiento', '$cvv')";
    $conn->query($sql_pago);

    echo "<p style='color:yellow; text-align:center;'>¡Compra realizada con éxito!</p>";
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceso de Compra</title>
    <style>
        body {
            background: linear-gradient(135deg, #1a1a8b 25%, #4a4aff 75%);
            color: #ffffff;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-size: 200% 200%;
            animation: gradientBG 5s linear infinite;
            overflow: hidden;
            position: relative;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        form {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            z-index: 1;
            position: relative;
        }

        h2 {
            color: #00BFFF;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #ffffff;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #2b2b2b;
            color: #ffffff;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background-color: #6200ea;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #3700b3;
        }

        .back-button {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #00BFFF;
            text-decoration: none;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        #credit-card-info {
            display: none;
        }

        #particles-js {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
</head>
<body>
    <!-- Contenedor de partículas -->
    <div id="particles-js"></div>

    <form action="proceso_compra.php" method="POST">
        <h2>Proceso de Compra</h2>
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="correo" required>

        <label for="address">Dirección de Envío:</label>
        <input type="text" id="address" name="direccion" required>

        <label for="payment-method">Método de Pago:</label>
        <select id="payment-method" name="metodo_pago" required onchange="toggleCardInfo()">
            <option value="">Selecciona un método</option>
            <option value="tarjeta">Tarjeta de Crédito/Débito</option>
            <option value="efectivo">Efectivo</option>
        </select>

        <div id="credit-card-info">
            <label for="card-number">Número de Tarjeta:</label>
            <input type="text" id="card-number" name="numero_tarjeta" placeholder="XXXX-XXXX-XXXX-XXXX">

            <label for="expiry-date">Fecha de Vencimiento:</label>
            <input type="text" id="expiry-date" name="fecha_vencimiento" placeholder="MM/AA">

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" placeholder="XXX">
        </div>

        <!-- Botón de "Requiere Factura" que redirige a crear_factura.php -->
        <a href="crear_factura.php">
            <button type="button">¿Requiere Factura?</button>
        </a>

        <button type="submit">Finalizar Compra</button>
        <!-- Botón para regresar a inicio.php -->
        <a href="inicio.php" class="back-button">Regresar a la Página Principal</a>
    </form>

    <!-- Script para cargar partículas -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        function toggleCardInfo() {
            var paymentMethod = document.getElementById('payment-method').value;
            var creditCardInfo = document.getElementById('credit-card-info');
            
            if (paymentMethod === 'tarjeta') {
                creditCardInfo.style.display = 'block';
            } else {
                creditCardInfo.style.display = 'none';
            }
        }

        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 100,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 4,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 2,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                }
            },
            "retina_detect": true
        });
    </script>
</body>
</html>
