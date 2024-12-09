<?php
// Datos de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "proyecto";

// Conexión a la base de datos
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    // Consultar la base de datos para verificar los datos
    $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre' AND contrasena = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso, redirigir a inicio.php
        header("Location: inicio.php");
        exit(); // Asegura que el script se detenga aquí
    } else {
        // Mostrar mensaje de error si la autenticación falla
        echo "<p class='error'>Nombre de usuario o contraseña incorrectos.</p>";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .title-container {
            border: 4px solid #00BFFF;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 50px;
            text-align: center;
            background-color: rgba(30, 30, 30, 0.9);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .title {
            font-size: 48px;
            font-weight: bold;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.9);
            letter-spacing: 2px;
            color: #00BFFF;
        }

        form {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        input, button {
        width: 100%; 
        max-width: 100%; 
        padding: 12px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        box-sizing: border-box; 
        }

        input {
            background-color: #2b2b2b;
            color: #ffffff;
            font-size: 16px;
        }

        button {
            background-color: #6200ea;
            color: #ffffff;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #3700b3;
        }

        .link-button {
            background: none;
            border: none;
            color: #03a9f4;
            text-decoration: underline;
            cursor: pointer;
            padding: 0;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
</head>
<body>
    <div id="particles-js"></div>
    <div class="title-container">
        <div class="title">Cleaning Products</div>
    </div>
    <form method="POST" action="">
        <h1>Iniciar Sesión</h1>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <button type="submit">Iniciar Sesión</button>
        <p>¿No tienes una cuenta? 
            <a href="registrarUsuario.php" class="link-button">Regístrate</a>
        </p>
    </form>

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
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 5,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
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
                    "speed": 6,
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
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 140,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    </script>
</body>
</html>
