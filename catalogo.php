<?php
    require 'php/Carrito.php'; 
    $carrito = new Carrito();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="cabecera">
        <div class="logo">
            <img class="logo__img" src="img/fondo-consultar.jpg" alt="logo pagina">
            <p class="logo__text">Road On Wheels</p>
        </div>
        <h1 class="cabecera__titulo">Renta de carritos de golf</h1>
        <div class="contenedor__icono-logOut">
            <a href="index.html">
                <div class="caja__icono-logOut">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path class="icono-logOut" d="M16 13L16 11 7 11 7 8 2 12 7 16 7 13z"/><path class="icono-logOut" d="M20,3h-9C9.897,3,9,3.897,9,5v4h2V5h9v14h-9v-4H9v4c0,1.103,0.897,2,2,2h9c1.103,0,2-0.897,2-2V5C22,3.897,21.103,3,20,3z"/></svg>
                </div>
            </a>
        </div>
    </header>

    <nav class="navegacion">
        <ul class="navegacion__enlaces contenedor">
            <li>
                <a class="navegacion__enlace navegacion__enlace--activo" href="catalogo.html">Catalogo</a>
            </li>
            <li>
                <a class="navegacion__enlace" href="consultar.html">Consultar</a>
            </li>
            <li>
                <a class="navegacion__enlace" href="modificar.html">Modificar</a>
            </li>
            <li>
                <a class="navegacion__enlace" href="eliminar.html">Eliminar</a>
            </li>
        </ul>    
    </nav>
    
    <main class="contenedor">
        <div class="consultar-agregar__carrito">
            <form class="consultar-carrito__form" action="" method="POST">
                <div>
                    <label class="consultar-carrito__form__label" for="placa">Consultar Carrito:</label>
                    <input class="consultar-carrito__form__input" type="text" name="placa" id="placa" placeholder="Ingrese la placa">
                </div>
                <div>
                    <input class="buscar__boton" type="submit" name="buscar" id="buscar" value="Buscar">
                </div>
            </form>
            <a class="agregar__carrito" href="agregar-carrito.php">Agregar Carrito<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"><path class="icono-agregar" d="M16,2H8C4.691,2,2,4.691,2,8v13c0,0.553,0.447,1,1,1h13c3.309,0,6-2.691,6-6V8C22,4.691,19.309,2,16,2z M20,16 c0,2.206-1.794,4-4,4H4V8c0-2.206,1.794-4,4-4h8c2.206,0,4,1.794,4,4V16z"/><path class="icono-agregar" d="M13 7L11 7 11 11 7 11 7 13 11 13 11 17 13 17 13 13 17 13 17 11 13 11z"/></svg></a>
        </div>
        <div class="carritos">
    <?php if (isset($_POST['buscar']) && !empty($_POST['placa'])) { 
            $placa = $_POST['placa'];
            $datosCarrito = $carrito->consultarPorPlaca($placa);

            if ($datosCarrito) { ?>
                <div class="carrito">
                    <a href="alquilar-carrito.html">
                        <img src="img/carrito2.png" alt="carrito golf">
                    </a>
                    <div class="info-carrito">
                        <p class="info-carrito__text">placa: <?php echo $datosCarrito["Placa"] ?></php></p>
                        <p class="info-carrito__text">Kilometraje: <?php echo $datosCarrito["Kilometraje"] ?></p>
                        <p class="info-carrito__text">Costo: <?php echo $datosCarrito["costoAlquiler"] ?></p>
                        <p class="info-carrito__text">Modelo: 2020</p>
                        <p class="info-carrito__text">Ver mas</p>
                    </div>  
                </div> <!-- .carrito -->
        <?php } else { ?>
                <p>El carrito con la placa <?php echo $placa ?> no existe</p>     
        <?php } ?>            
    <?php } else { 
            $datosCarrito = $carrito->consultarTodo();
            while ($carro = $datosCarrito->fetch(PDO::FETCH_ASSOC)) { 
                $carro["Disponibilidad"] = strtolower($carro["Disponibilidad"]); 
                if($carro["Disponibilidad"]=="si") {?>
            <div class="carrito">
                <a href="alquilar-carrito.html">
                    <img src="img/carrito.png" alt="carrito golf">
                </a>
                <div class="info-carrito">
                    <p class="info-carrito__text">placa: <?php echo $carro["Placa"] ?></php></p>
                    <p class="info-carrito__text">Kilometraje: <?php echo $carro["Kilometraje"] ?></p>
                    <p class="info-carrito__text">Costo: <?php echo $carro["costoAlquiler"] ?></p>
                    <p class="info-carrito__text">Modelo: 2020</p>
                    <p class="info-carrito__text">Ver mas</p>
                </div>  
            </div> <!-- .carrito -->         
    <?php       }
            }
        } ?>
        </div> <!-- .carritos -->
    </main>
</body>
</html>
