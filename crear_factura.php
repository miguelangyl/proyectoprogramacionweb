<?php
$servername = "localhost";
$username = "root"; // Cambia esto si usas otro usuario
$password = ""; // Cambia esto si tienes una contraseña
$dbname = "proyecto"; // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $nombre_cliente = $conn->real_escape_string($_POST['name']);
    $direccion = $conn->real_escape_string($_POST['address']);
    $jabon_liquido = (int)$_POST['jabon_liquido'];
    $jabon_barra = (int)$_POST['jabon_barra'];
    $jabon_organico = (int)$_POST['jabon_organico'];
    $detergente_liquido = (int)$_POST['detergente_liquido'];
    $detergente_polvo = (int)$_POST['detergente_polvo'];
    $detergente_bio = (int)$_POST['detergente_bio'];
    $limpiador_multisuperficie = (int)$_POST['limpiador_multisuperficie'];
    $limpiador_vidrio = (int)$_POST['limpiador_vidrio'];
    $limpiador_ambiental = (int)$_POST['limpiador_ambiental'];

    // Calcular el subtotal
    $precio_jabon_liquido = 5.00;
    $precio_jabon_barra = 3.00;
    $precio_jabon_organico = 7.00;
    $precio_detergente_liquido = 4.00;
    $precio_detergente_polvo = 3.50;
    $precio_detergente_bio = 6.00;
    $precio_limpiador_multisuperficie = 4.50;
    $precio_limpiador_vidrio = 4.00;
    $precio_limpiador_ambiental = 5.50;

    $subtotal = (
        $jabon_liquido * $precio_jabon_liquido +
        $jabon_barra * $precio_jabon_barra +
        $jabon_organico * $precio_jabon_organico +
        $detergente_liquido * $precio_detergente_liquido +
        $detergente_polvo * $precio_detergente_polvo +
        $detergente_bio * $precio_detergente_bio +
        $limpiador_multisuperficie * $precio_limpiador_multisuperficie +
        $limpiador_vidrio * $precio_limpiador_vidrio +
        $limpiador_ambiental * $precio_limpiador_ambiental
    );

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO compras (nombre_cliente, direccion, jabon_liquido, jabon_barra, jabon_organico, detergente_liquido, detergente_polvo, detergente_bio, limpiador_multisuperficie, limpiador_vidrio, limpiador_ambiental, subtotal)
    VALUES ('$nombre_cliente', '$direccion', $jabon_liquido, $jabon_barra, $jabon_organico, $detergente_liquido, $detergente_polvo, $detergente_bio, $limpiador_multisuperficie, $limpiador_vidrio, $limpiador_ambiental, $subtotal)";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Factura generada exitosamente. El subtotal de su compra es: $" . number_format($subtotal, 2) . "</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Cerrar la conexión
$conn->close();
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Exitosa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            overflow: auto;
            text-align: center;
            background-color: #1a1a2e; /* Fondo elegante */
            color: #f8f8f2; /* Texto claro */
        }
        h1 {
            color: #c0c0e0;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
        }
        .button:hover {
            background-color: #e64a19;
        }
        header {
            background-color: #1c2938;
            padding: 20px 0;
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            text-align: center;
        }
        .logo h1 {
            font-size: 36px;
            margin: 0;
            color: aqua;
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: #000000; /* Fondo negro para el formulario */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin: 0 auto;
            width: 90%;
            max-width: 600px;
        }
        form {
            width: 100%;
        }
        form input[type="text"], form input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #333; /* Fondo de los inputs */
            color: #f8f8f2; /* Texto claro en los inputs */
        }
        form p {
            margin: 5px 0;
            font-weight: bold;
        }
        .footer-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            width: 100%;
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
    <header>
        <div class="logo">
            <h1>Cleaning</h1>
        </div>
    </header>

    <h1>¡Compra realizada con éxito!</h1>
    <p>Gracias por su compra. Si necesita facturación, agregue los productos comprados.</p>

    <div class="form-container">
    <form action="factura.php" method="POST">
            <input type="text" name="name" placeholder="Nombre del Cliente" required><br>
            <input type="text" name="address" placeholder="Dirección" required><br>
            <p>Cantidad de Jabón Líquido</p>
            <input type="number" name="jabon_liquido" min="0" value="0"><br>
            <p>Cantidad de Jabón Barra</p>
            <input type="number" name="jabon_barra" min="0" value="0"><br>
            <p>Cantidad de Jabón Orgánico</p>
            <input type="number" name="jabon_organico" min="0" value="0"><br>
            <p>Cantidad de Detergente Líquido</p>
            <input type="number" name="detergente_liquido" min="0" value="0"><br>
            <p>Cantidad de Detergente Polvo</p>
            <input type="number" name="detergente_polvo" min="0" value="0"><br>
            <p>Cantidad de Detergente Bio</p>
            <input type="number" name="detergente_bio" min="0" value="0"><br>
            <p>Cantidad de Limpiador Multisuperficie</p>
            <input type="number" name="limpiador_multisuperficie" min="0" value="0"><br>
            <p>Cantidad de Limpiador Vidrio</p>
            <input type="number" name="limpiador_vidrio" min="0" value="0"><br>
            <p>Cantidad de Limpiador Ambiental</p>
            <input type="number" name="limpiador_ambiental" min="0" value="0"><br><br>

            <button type="submit" class="button">Generar Factura</button>
        </form>
        <div class="footer-buttons">
            <button class="button" onclick="window.location.href='inicio.php'">Regresar a la Página Principal</button>
        </div>
    </div>

    <!-- Partículas -->
    <div id="particles-js"></div>

    <!-- Incluyendo la biblioteca de partículas -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 80,
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
                    "random": true,
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
                "detect_on": "window",
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
