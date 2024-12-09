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

    // Verificar si el nombre ya está registrado
    $sqlCheck = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
    $resultCheck = $conn->query($sqlCheck);

    if ($resultCheck->num_rows > 0) {
        echo "<p class='error'>El nombre de usuario ya está registrado. Por favor, elige otro.</p>";
    } else {
        // Insertar los datos en la base de datos
        $sqlInsert = "INSERT INTO usuarios (nombre, contrasena) VALUES ('$nombre', '$contrasena')";

        if ($conn->query($sqlInsert) === TRUE) {
            echo "<p class='success'>Usuario registrado exitosamente. Redirigiendo a inicio de sesión...</p>";
            echo "<script>setTimeout(() => { window.location.href = 'Login.php'; }, 2000);</script>";
        } else {
            echo "<p class='error'>Error: " . $sqlInsert . "<br>" . $conn->error . "</p>";
        }
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
    <title>Registro de Usuarios</title>
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
        .success {
            color: #03dac5;
        }
        .error {
            color: #cf6679;
        }
    </style>
</head>
<body>
    <div class="title-container">
        <div class="title">Cleaning Products</div>
    </div>
    <form method="POST" action="">
        <h1>Registro de Usuarios</h1>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
        <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
        <button type="submit">Registrar</button>
        <p>¿Ya tienes una cuenta? 
            <a href="Login.php" class="link-button">Inicia Sesión</a>
        </p>
    </form>

    
    <div id="particles-js" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>

    
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        // Configuración de partículas
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
                    "value": "#FF4500" 
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    }
                },
                "opacity": {
                    "value": 0.8,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 4,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 5,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#00BFFF", 
                    "opacity": 0.5,
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
                },
                "modes": {
                    "grab": {
                        "distance": 400,
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
