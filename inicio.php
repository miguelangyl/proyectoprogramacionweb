<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar productos de la base de datos
$query = "SELECT * FROM productos";
$result = $conn->query($query);

// Agrupar productos por estante
$productosPorEstante = [];
while ($row = $result->fetch_assoc()) {
    // Verificar si la clave 'estante' está definida y no es nula
    if (isset($row['estante']) && !empty($row['estante'])) {
        $productosPorEstante[$row['estante']][] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Productos de Limpieza</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ADD8E6; /* Fondo cambiado a azul oscuro */
            color: #342c49;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1c2938;
            padding: 20px 0;
            width: 100%; 
            text-align: center;
            margin-bottom: 100px; 
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 5%;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav li {
            margin-right: 20px;
        }
        nav a {
            text-decoration: none;
            color: aqua;
            font-weight: bold;
        }
        h1 {
            font-size: 2.5em;
        }
        img.portada {
            width: 80%; 
            max-width: 600px; 
            height: auto;
            margin-bottom: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .shelf {
            background-color: #1c2938;
            border: 1px solid #1c2938;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 30%;
        }
        .shelf h2 {
            font-size: 1.5em;
            color: #0099fe;
            text-align: center;
        }
        .product {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            border-bottom: 1px solid #ddd;
        }
        .product label {
            color: aqua;
            flex-grow: 1;
        }
        .product input[type="number"] {
            background-color: #3A4555;
            width: 50px;
            margin-left: 10px;
            text-align: center;
        }
        .total {
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
            color: #003366;
            font-size: 1.5em;
        }
        .registration h2 {
            font-size: 1.5em;
            color: #0099fe;
        }
        img {
            width: 150px;
            height: auto;
            margin-right: 10px;
        }
        .button {
            display: block;
            width: 200px;
            padding: 10px;
            background-color: #D4AF37; 
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            margin: 20px auto;
            cursor: pointer;
        }
        .logo {
            text-align: center;
        }
        .logo h1 {
            font-size: 36px;
            margin: 0;
            color: aqua;
        }
        .button:hover {
            background-color: #e64a19;
        }
        nav a:hover {
            color: springgreen;
        }
        .container_separ {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .separ {
            background-color: #1c2938;
            border: 1px solid #1c2938;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 30%;
        }
        .separ label {
            color: aqua;
            flex-grow: 1;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1><a>Cleaning</a></h1>
        </div>
        <nav>
            <ul>
                <li><a href="sobre.html">Sobre nosotros</a></li>
                <li><a href="Login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="carousel-container">
        <div class="carousel" id="carousel">
            <!-- Clonamos las imágenes para crear un efecto de bucle infinito -->
            <div class="carousel-track">
                <img src="detergente_bio.jpg" alt="Imagen 1">
                <img src="detergente_liquido.jpg" alt="Imagen 2">
                <img src="detergente_polvo.jpg" alt="Imagen 3">
                <img src="jabon_barra.jpg" alt="Imagen 4">
                <img src="jabon_liquido.jpg" alt="Imagen 5">
                <img src="jabon_organico.jpg" alt="Imagen 6">
                <img src="limpiador_ambiental.jpg" alt="Imagen 7">
                <img src="limpiador_multisuperficie.jpg" alt="Imagen 8">
                <img src="limpiador_vidrio.jpg" alt="Imagen 9">
                
                <!-- Clones de las imágenes para crear el efecto de bucle -->
                <img src="detergente_bio.jpg" alt="Imagen 1">
                <img src="detergente_liquido.jpg" alt="Imagen 2">
                <img src="detergente_polvo.jpg" alt="Imagen 3">
                <img src="jabon_barra.jpg" alt="Imagen 4">
                <img src="jabon_liquido.jpg" alt="Imagen 5">
                <img src="jabon_organico.jpg" alt="Imagen 6">
                <img src="limpiador_ambiental.jpg" alt="Imagen 7">
                <img src="limpiador_multisuperficie.jpg" alt="Imagen 8">
                <img src="limpiador_vidrio.jpg" alt="Imagen 9">
            </div>
        </div>
        <div class="carousel-controls">
            <div class="control" id="prev">&lt;</div>
            <div class="control" id="next">&gt;</div>
        </div>
    </div>

    <style>
        .carousel-container {
            width: 80%;
            margin: 20px auto;
            overflow: hidden;
            position: relative;
            border: 2px solid #ddd;
            border-radius: 10px;
        }
        .carousel {
            display: flex;
            overflow: hidden;
            position: relative;
        }
        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel img {
            width: 100%;
            height: auto;
            max-height: 300px;
        }
        .carousel-controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }
        .control {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.5em;
        }
        .control:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>

    <script>
        let currentIndex = 0;
        const carouselTrack = document.querySelector('.carousel-track');
        const images = document.querySelectorAll('.carousel img');
        const totalImages = images.length / 2; // Contamos solo las imágenes originales
        const imageWidth = images[0].clientWidth;

        document.getElementById('next').addEventListener('click', () => {
            if (currentIndex >= totalImages) return; // Evita avanzar más allá de la segunda mitad

            currentIndex++;
            updateCarousel();
        });

        document.getElementById('prev').addEventListener('click', () => {
            if (currentIndex <= 0) return; // Evita retroceder más allá del principio

            currentIndex--;
            updateCarousel();
        });

        function updateCarousel() {
            const offset = -currentIndex * imageWidth;
            carouselTrack.style.transform = `translateX(${offset}px)`;

            // Reiniciar al principio al llegar al final
            if (currentIndex === totalImages) {
                setTimeout(() => {
                    carouselTrack.style.transition = 'none';
                    carouselTrack.style.transform = `translateX(0px)`;
                    currentIndex = 0;
                }, 500); // Tiempo de espera para mantener la animación
                setTimeout(() => {
                    carouselTrack.style.transition = 'transform 0.5s ease-in-out';
                }, 600);
            }
        }

        // Movimiento automático
        setInterval(() => {
            if (currentIndex >= totalImages) {
                currentIndex = 0;
                carouselTrack.style.transition = 'none';
                carouselTrack.style.transform = `translateX(0px)`;
                setTimeout(() => {
                    carouselTrack.style.transition = 'transform 0.5s ease-in-out';
                }, 100);
            } else {
                currentIndex++;
            }
            updateCarousel();
        }, 3000);
    </script>

    <form action="proceso_compra.php">
        <div class="container">
            <div class="shelf">
                <h2>Estante 1: Jabones</h2>
                <div class="product">
                    <img src="jabon_liquido.jpg" alt="Jabón Líquido">
                    <label>
                        Jabón Líquido - $10
                        <input type="number" class="product-quantity" data-price="10"  data-shelf="1" min="0" value="0">
                    </label>
                </div>
                <div class="product">
                    <img src="jabon_barra.jpg" alt="Jabón en Barra">
                    <label>
                        Jabón en Barra - $8
                        <input type="number" class="product-quantity" data-price="8"  data-shelf="1" min="0" value="0">
                    </label>
                </div>
                <div class="product">
                    <img src="jabon_organico.jpg" alt="Jabón Orgánico">
                    <label>
                        Jabón Orgánico - $12
                        <input type="number" class="product-quantity" data-price="12"  data-shelf="1" min="0" value="0">
                    </label>
                </div>
            </div>
            
            <div class="shelf">
                <h2>Estante 2: Detergentes</h2>
                <div class="product">
                    <img src="detergente_liquido.jpg" alt="Detergente Líquido">
                    <label>
                        Detergente Líquido - $15
                        <input type="number" class="product-quantity" data-price="15"  data-shelf="2" min="0" value="0">
                    </label>
                </div>
                <div class="product">
                    <img src="detergente_polvo.jpg" alt="Detergente en Polvo">
                    <label>
                        Detergente en Polvo - $12
                        <input type="number" class="product-quantity" data-price="12"  data-shelf="2" min="0" value="0">
                    </label>
                </div>
                <div class="product">
                    <img src="detergente_bio.jpg" alt="Detergente Bio">
                    <label>
                        Detergente Bio - $14
                        <input type="number" class="product-quantity" data-price="14"  data-shelf="2" min="0" value="0">
                    </label>
                </div>
            </div>
            
            <div class="shelf">
                <h2>Estante 3: Limpiadores</h2>
                <div class="product">
                    <img src="limpiador_multisuperficie.jpg" alt="Limpiador Multi-Superficie">
                    <label>
                        Limpiador Multi-Superficie - $11
                        <input type="number" class="product-quantity" data-price="11"  data-shelf="3" min="0" value="0">
                    </label>
                </div>
                <div class="product">
                    <img src="limpiador_vidrio.jpg" alt="Limpiador de Vidrio">
                    <label>
                        Limpiador de Vidrio - $9
                        <input type="number" class="product-quantity" data-price="9"  data-shelf="3" min="0" value="0">
                    </label>
                </div>
                <div class="product">
                    <img src="limpiador_ambiental.jpg" alt="Limpiador Ambiental">
                    <label>
                        Limpiador Ambiental - $13
                        <input type="number" class="product-quantity" data-price="13"  data-shelf="3" min="0" value="0">
                    </label>
                </div>
            </div>
        </div>
        <div class="container_separ">
            <div class="shelf">
                <div class="separ"><label> Costo total 1: $<span id="costo-total-1">0.00</span></label></div>
                <div class="separ"><label>Impuesto 1: $<span id="impuesto-1">0.00</span></label></div>
                <div class="separ"><label> Subtotal 1: $<span id="subtotal-1">0.00</span></label></div>
            </div>
            <div class="shelf">
                <div class="separ"><label> Costo total 2: $<span id="costo-total-2">0.00</span></label></div>
                <div class="separ"><label>Impuesto 2: $<span id="impuesto-2">0.00</span></label></div>
                <div class="separ"><label> Subtotal 2: $<span id="subtotal-2">0.00</span></label></div>
            </div>
            <div class="shelf">
                <div class="separ"><label> Costo total 3: $<span id="costo-total-3">0.00</span></label></div>
                <div class="separ"><label>Impuestos 3: $<span id="impuesto-3">0.00</span></label></div>
                <div class="separ"><label> Subtotal 3: $<span id="subtotal-3">0.00</span></label></div>
            </div>
        </div>

        <div class="total">
            <p>Total de sus compras: $<span id="total">0.00</span></p>
        </div>  
        <button type="submit" class="button" id="checkout-button">Finalizar Compra</button>

    </form>

    <script>
        const quantities = document.querySelectorAll('.product-quantity');
        const totalDisplay = document.getElementById('total');
        const taxRate = 0.20;

        const shelfElements = {
            1: {
                total: document.getElementById('costo-total-1'),
                tax: document.getElementById('impuesto-1'),
                subtotal: document.getElementById('subtotal-1')
            },
            2: {
                total: document.getElementById('costo-total-2'),
                tax: document.getElementById('impuesto-2'),
                subtotal: document.getElementById('subtotal-2')
            },
            3: {
                total: document.getElementById('costo-total-3'),
                tax: document.getElementById('impuesto-3'),
                subtotal: document.getElementById('subtotal-3')
            }
        };

        quantities.forEach(quantity => {
            quantity.addEventListener('input', updateTotals);
        });

        function updateTotals() {
            let totalGeneral = 0;
            const shelfSums = { 1: 0, 2: 0, 3: 0 };

            quantities.forEach(quantity => {
                const price = parseFloat(quantity.getAttribute('data-price'));
                const shelf = parseInt(quantity.getAttribute('data-shelf'));
                const quantityValue = parseInt(quantity.value) || 0;
                const productTotal = price * quantityValue;

                shelfSums[shelf] += productTotal;
            });

            Object.keys(shelfSums).forEach(shelf => {
                const subtotal = shelfSums[shelf];
                const tax = subtotal * taxRate;
                const totalWithTax = subtotal + tax;

                shelfElements[shelf].subtotal.textContent = subtotal.toFixed(2);
                shelfElements[shelf].tax.textContent = tax.toFixed(2);
                shelfElements[shelf].total.textContent = totalWithTax.toFixed(2);


            totalGeneral += totalWithTax;
        });

        totalDisplay.textContent = totalGeneral.toFixed(2);
    }

    document.getElementById('checkout-button').addEventListener('click', function(event) {
        const total = parseFloat(totalDisplay.textContent);
        if (total <= 0) {
            event.preventDefault(); // Evita que el formulario se envíe
            alert('Por favor, seleccione al menos un producto.');
        }
    });
</script>
</body>
</html>