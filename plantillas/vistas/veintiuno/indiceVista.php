<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!--toastr-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS. "veintiuno.css"; ?>">
    <title>Veintiuna</title>
</head>
<body>
    <div class="container-xl">
        <div class="row">
            <header>
                <div class="titulo">Veintiuno</div>
                <div class="row">
                    <div id="divBotones" class="col text-center">
                        <button id="btnNuevo" class="btn btn-success">Nuevo Juego</button>
                        <button id="btnPedir" class="btn btn-primary">Pedir Carta</button>
                        <button id="btnParar" class="btn btn-danger">Detener</button>
                        <a href="<?php echo RUTABASE . "trabajos"; ?>" class="btn btn-primary d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 14l-4 -4l4 -4" />
                                    <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                            </svg>
                        </a>
                    </div>
                </div>
            </header>
        </div>
        <!-- bloque cartas jugador -->
        <div class="row row-cols-12 d-flex">
            <div class="col puntuacion__jugador">
                <h2 id="nombreJugador">Jugador -</h2><small>0</small>
            </div>
            <div id="jugador-cartas"></div>
        </div>
        <!-- bloque cartas máquina -->
        <div class="row mt-2">
            <div class="col puntuacion__maquina">
                <h2>Banca - <small>0</small></h2>
                <!-- Aquí van las cartas del jugador -->
            </div>
            <div id="maquina-cartas"></div>
        </div>
    
    </div>
     <!--jQuery-->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
     <!--toastr-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <script type="text/javascript" src="<?php echo JS . "underscore-min.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo JS . "veintiuno-min.js"; ?>"></script>
    <script>
        //Inicializar juego
        juego.empezarPartida();
    </script>
</body>
</html>