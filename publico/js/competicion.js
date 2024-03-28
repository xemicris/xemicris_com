$(document).ready(function(){
    //Variables
    let coches=[];
    let posicion = "";
    let pistaInicial = document.getElementById("elegir");
    let participantes = document.getElementById("participantes");
    let pista = document.getElementById("pista");
    let reiniciar = document.getElementById('reiniciar');
    let velocidad1 = Math.random();
    let velocidad2 = Math.random();
    let velocidad3 = Math.random();
    let velocidad4 = Math.random();
    let numeroCoches = 0;
    let alturaCargar = pista.clientHeight;
    

    //Valores iniciales
    pistaInicial.value = 0;
    participantes.innerHTML = "Has elegido 0 participante(s)";
    $('.ruedaCoche').addClass('ocultarRuedas');
    participantes.innerHTML = "";
    iniciar.disabled = true;

    reiniciar.addEventListener("click", reinicio, false);

    //Cuando se selecciona el select
    $('select').change(function(){
        if(pistaInicial.value != 0){
            if(screen.height < "700" && screen.width < "500"){
                $('.borde').css('margin-top',300);
            }else if(screen.height < "400" && screen.width < "700"){
                $('.borde').css('margin-top',100);
            }else if(screen.width > "1200" && screen.width < "1400"){
                window.scrollTo(0, alturaCargar, {behavior: 'smooth'});
                $('.borde').css('margin-top',100);
            }

            coches.length=0;

            for(var i=0; i<4;i++){
                $("#coche"+(i+1)).hide();
            }

            $("#pista").show();
            var seleccion = $(this).val();
            for (var i=0; i<seleccion; i++){
                coches[i] = {"posicion":i+1, "imagen":$("#coche"+(i+1)).show()};
            }

            participantes = document.getElementById("participantes");

            for (var i = 0; i < coches.length; i++) {
                participantes.innerHTML = "Has elegido " + coches[i]["posicion"] + " participante(s)";
                numeroCoches = coches[i]["posicion"];
            }

            iniciar.disabled = false;

            if(numeroCoches == 1){
                $('#ruedaCoche11').removeClass('ocultarRuedas');
                $('#ruedaCoche12').removeClass('ocultarRuedas');
                $('#ruedaCoche21').addClass('ocultarRuedas');
                $('#ruedaCoche22').addClass('ocultarRuedas');
                $('#ruedaCoche31').addClass('ocultarRuedas');
                $('#ruedaCoche32').addClass('ocultarRuedas');
                $('#ruedaCoche41').addClass('ocultarRuedas');
                $('#ruedaCoche42').addClass('ocultarRuedas');
            }else if(numeroCoches == 2){
                $('#ruedaCoche11').removeClass('ocultarRuedas');
                $('#ruedaCoche12').removeClass('ocultarRuedas');
                $('#ruedaCoche21').removeClass('ocultarRuedas');
                $('#ruedaCoche22').removeClass('ocultarRuedas');
                $('#ruedaCoche31').addClass('ocultarRuedas');
                $('#ruedaCoche32').addClass('ocultarRuedas');
                $('#ruedaCoche41').addClass('ocultarRuedas');
                $('#ruedaCoche42').addClass('ocultarRuedas');
            }else if(numeroCoches == 3){
                $('#ruedaCoche11').removeClass('ocultarRuedas');
                $('#ruedaCoche12').removeClass('ocultarRuedas');
                $('#ruedaCoche21').removeClass('ocultarRuedas');
                $('#ruedaCoche22').removeClass('ocultarRuedas');
                $('#ruedaCoche31').removeClass('ocultarRuedas');
                $('#ruedaCoche32').removeClass('ocultarRuedas');
                $('#ruedaCoche41').addClass('ocultarRuedas');
                $('#ruedaCoche42').addClass('ocultarRuedas');
            }else if (numeroCoches == 4){
                $('#ruedaCoche11').removeClass('ocultarRuedas');
                $('#ruedaCoche12').removeClass('ocultarRuedas');
                $('#ruedaCoche21').removeClass('ocultarRuedas');
                $('#ruedaCoche22').removeClass('ocultarRuedas');
                $('#ruedaCoche31').removeClass('ocultarRuedas');
                $('#ruedaCoche32').removeClass('ocultarRuedas');
                $('#ruedaCoche41').removeClass('ocultarRuedas');
                $('#ruedaCoche42').removeClass('ocultarRuedas');
            }
            
        }else{
            if(screen.height < "700" && screen.width < "500"){
                $('.borde').css('margin-top',50);
            }else if(screen.height < "400" && screen.width < "700"){
                $('.borde').css('margin-top',250);
            }else if(screen.height > "700" && screen.width < "1400"){
                $('.borde').css('margin-top',350);
            }
            
            $("#pista").hide();
            iniciar.disabled = true;
            participantes.innerHTML = "";
            reinicio();
        }
        
    });


    //Ganador de la carrera  
    function carreraCompletada(){

        var ganador = document.getElementById("ganador");

        if(numeroCoches == 1){
            velocidad2 = 1;
            velocidad3 = 1;
            velocidad4 = 1;
        }else if(numeroCoches == 2){
            velocidad3 = 1;
            velocidad4 = 1;
        }else if(numeroCoches == 3){
            velocidad4 = 1;
        }

        if(velocidad1 < velocidad2){
            if(velocidad1 < velocidad3){
                if(velocidad1 < velocidad4){
                    posicion = "coche 1";
                }else{
                    posicion = "coche 4";
                }
            }else if(velocidad3 < velocidad4){
                posicion = "coche 3";
            }else{
                posicion = "coche 4";
            }
        }else if(velocidad2 < velocidad3){
            if(velocidad2 < velocidad4){
                posicion = "coche 2";
            }else{
                posicion = "coche 4";
            }
        }else{
            posicion = "coche 3";
        }
        ganador.innerHTML = "¡Ganador: " + posicion + " !";
        posicion = "";
        ganador.classList.add("ganador");
        
    }


    //Cuando se hace clic en el botón iniciar
    $('#iniciar').click(function(){
        $('#elegir').prop('disabled', true);

          //Coche1
          if(screen.width < '1200'){
            $("#coche1").animate( {"margin-left":"700px"}, Math.floor((velocidad1*5000)+1), function(){carreraCompletada();});
            $("#ruedaCoche11").animate( {"margin-left":"700px"}, Math.floor((velocidad1*5000)+1));
            $("#ruedaCoche12").animate( {"margin-left":"700px"}, Math.floor((velocidad1*5000)+1));
            $("#ruedaCoche11").addClass("rueda__animacion__delante");
            $("#ruedaCoche12").addClass("rueda__animacion__delante");
            setInterval(
                function(){
                    if($("#ruedaCoche11").css("marginLeft") == "700px"){
                        $("#ruedaCoche11").removeClass("rueda__animacion__delante");
                        $("#ruedaCoche12").removeClass("rueda__animacion__delante");
                    }
                },0.01);
    
            //coche2
            $("#coche2").animate( {"margin-left":"700px"}, Math.floor((velocidad2*5000)+1));
            $("#ruedaCoche21").animate( {"margin-left":"700px"}, Math.floor((velocidad2*5000)+1));
            $("#ruedaCoche22").animate( {"margin-left":"700px"}, Math.floor((velocidad2*5000)+1));
            $("#ruedaCoche21").addClass("rueda__animacion__delante");
            $("#ruedaCoche22").addClass("rueda__animacion__delante");
            setInterval(
                function(){
                    if($("#ruedaCoche21").css("marginLeft") == "700px"){
                        $("#ruedaCoche21").removeClass("rueda__animacion__delante");
                        $("#ruedaCoche22").removeClass("rueda__animacion__delante");
                    }
                },0.01);
    
            //Coche3
            $("#coche3").animate( {"margin-left":"700px"}, Math.floor((velocidad3*5000)+1));
            $("#ruedaCoche31").animate( {"margin-left":"700px"}, Math.floor((velocidad3*5000)+1));
            $("#ruedaCoche32").animate( {"margin-left":"700px"}, Math.floor((velocidad3*5000)+1));
            $("#ruedaCoche31").addClass("rueda__animacion__delante");
            $("#ruedaCoche32").addClass("rueda__animacion__delante");
            setInterval(
                function(){
                    if($("#ruedaCoche31").css("marginLeft") == "700px"){
                        $("#ruedaCoche31").removeClass("rueda__animacion__delante");
                        $("#ruedaCoche32").removeClass("rueda__animacion__delante");
                    }
                },0.01);
    
            //Coche4
            $("#coche4").animate( {"margin-left":"700px"}, Math.floor((velocidad4*5000)+1));
            $("#ruedaCoche41").animate( {"margin-left":"700px"}, Math.floor((velocidad4*5000)+1));
            $("#ruedaCoche42").animate( {"margin-left":"700px"}, Math.floor((velocidad4*5000)+1));
            $("#ruedaCoche41").addClass("rueda__animacion__delante");
            $("#ruedaCoche42").addClass("rueda__animacion__delante");
            setInterval(
                function(){
                    if($("#ruedaCoche41").css("marginLeft") == "700px"){
                        $("#ruedaCoche41").removeClass("rueda__animacion__delante");
                        $("#ruedaCoche42").removeClass("rueda__animacion__delante");
                    }
                },0.01);
          }else{

            //Coche1
            $("#coche1").animate( {"margin-left":"900px"}, Math.floor((velocidad1*5000)+1), function(){carreraCompletada();});
            $("#ruedaCoche11").animate( {"margin-left":"900px"}, Math.floor((velocidad1*5000)+1));
            $("#ruedaCoche12").animate( {"margin-left":"900px"}, Math.floor((velocidad1*5000)+1));
            $("#ruedaCoche11").addClass("rueda__animacion__delante");
            $("#ruedaCoche12").addClass("rueda__animacion__delante");
            setInterval(
                function(){
                    if($("#ruedaCoche11").css("marginLeft") == "900px"){
                        $("#ruedaCoche11").removeClass("rueda__animacion__delante");
                        $("#ruedaCoche12").removeClass("rueda__animacion__delante");
                    }
                },0.01);

            //coche2
            $("#coche2").animate( {"margin-left":"900px"}, Math.floor((velocidad2*5000)+1));
            $("#ruedaCoche21").animate( {"margin-left":"900px"}, Math.floor((velocidad2*5000)+1));
            $("#ruedaCoche22").animate( {"margin-left":"900px"}, Math.floor((velocidad2*5000)+1));
            $("#ruedaCoche21").addClass("rueda__animacion__delante");
            $("#ruedaCoche22").addClass("rueda__animacion__delante");
            setInterval(
                function(){
                    if($("#ruedaCoche21").css("marginLeft") == "900px"){
                        $("#ruedaCoche21").removeClass("rueda__animacion__delante");
                        $("#ruedaCoche22").removeClass("rueda__animacion__delante");
                    }
                },0.01);

            //Coche3
            $("#coche3").animate( {"margin-left":"900px"}, Math.floor((velocidad3*5000)+1));
            $("#ruedaCoche31").animate( {"margin-left":"900px"}, Math.floor((velocidad3*5000)+1));
            $("#ruedaCoche32").animate( {"margin-left":"900px"}, Math.floor((velocidad3*5000)+1));
            $("#ruedaCoche31").addClass("rueda__animacion__delante");
            $("#ruedaCoche32").addClass("rueda__animacion__delante");
            setInterval(
                function(){
                    if($("#ruedaCoche31").css("marginLeft") == "900px"){
                        $("#ruedaCoche31").removeClass("rueda__animacion__delante");
                        $("#ruedaCoche32").removeClass("rueda__animacion__delante");
                    }
                },0.01);

            //Coche4
            $("#coche4").animate( {"margin-left":"900px"}, Math.floor((velocidad4*5000)+1));
            $("#ruedaCoche41").animate( {"margin-left":"900px"}, Math.floor((velocidad4*5000)+1));
            $("#ruedaCoche42").animate( {"margin-left":"900px"}, Math.floor((velocidad4*5000)+1));
            $("#ruedaCoche41").addClass("rueda__animacion__delante");
            $("#ruedaCoche42").addClass("rueda__animacion__delante");
            setInterval(
                function(){
                    if($("#ruedaCoche41").css("marginLeft") == "900px"){
                        $("#ruedaCoche41").removeClass("rueda__animacion__delante");
                        $("#ruedaCoche42").removeClass("rueda__animacion__delante");
                    }
                },0.01);
          }
        
        $("#reiniciar").show();
        $("#iniciar").hide();
    
    }) 

    //Cuando se hace clic en el botón Reiniciar
    function reinicio(){
        var ganador = document.getElementById("ganador");
        
        //Coche1
        $("#coche1").animate( {"margin-left":"0px"}, 4000);
        $("#ruedaCoche11").animate( {"margin-left":"0px"},4000);
        $("#ruedaCoche12").animate( {"margin-left":"0px"},4000);
        $("#ruedaCoche11").addClass("rueda__animacion__detras");
        $("#ruedaCoche12").addClass("rueda__animacion__detras");
        setInterval(
            function(){
                if($("#ruedaCoche11").css("marginLeft") == "0px"){
                    $("#ruedaCoche11").removeClass("rueda__animacion__detras");
                    $("#ruedaCoche12").removeClass("rueda__animacion__detras");
                    $('#elegir').prop('disabled', false);
                }
            },0.01);

        //Coche2
        $("#coche2").animate( {"margin-left":"0px"}, 4000);
        $("#ruedaCoche21").animate( {"margin-left":"0px"},4000);
        $("#ruedaCoche22").animate( {"margin-left":"0px"},4000);
        $("#ruedaCoche21").addClass("rueda__animacion__detras");
        $("#ruedaCoche22").addClass("rueda__animacion__detras");
        setInterval(
            function(){
                if($("#ruedaCoche21").css("marginLeft") == "0px"){
                    $("#ruedaCoche21").removeClass("rueda__animacion__detras");
                    $("#ruedaCoche22").removeClass("rueda__animacion__detras");
                    $('#elegir').prop('disabled', false);
                }
            },0.01);

        //Coche3
        $("#coche3").animate( {"margin-left":"0px"}, 4000);
        $("#ruedaCoche31").animate( {"margin-left":"0px"},4000);
        $("#ruedaCoche32").animate( {"margin-left":"0px"},4000);
        $("#ruedaCoche31").addClass("rueda__animacion__detras");
        $("#ruedaCoche32").addClass("rueda__animacion__detras");
        setInterval(
            function(){
                if($("#ruedaCoche31").css("marginLeft") == "0px"){
                    $("#ruedaCoche31").removeClass("rueda__animacion__detras");
                    $("#ruedaCoche32").removeClass("rueda__animacion__detras");
                }
            },0.01);

        //Coche4
        $("#coche4").animate( {"margin-left":"0px"}, 4000);
        $("#ruedaCoche41").animate( {"margin-left":"0px"},4000);
        $("#ruedaCoche42").animate( {"margin-left":"0px"},4000);
        $("#ruedaCoche41").addClass("rueda__animacion__detras");
        $("#ruedaCoche42").addClass("rueda__animacion__detras");
        setInterval(
            function(){
                if($("#ruedaCoche41").css("marginLeft") == "0px"){
                    $("#ruedaCoche41").removeClass("rueda__animacion__detras");
                    $("#ruedaCoche42").removeClass("rueda__animacion__detras");
                }
            },0.01);

        //Devuelven parámetros a su estado original
        $("#iniciar").show();
        $("#reiniciar").hide();
        ganador.classList.remove("ganador");
        ganador.innerHTML = "";
        completada=false;
        posicion = "";
        ganador = "";
        for(i=0; i<4;i++){
            $("#com"+(i+1)).text(posicion)
        }
        velocidad1 = Math.random();
        velocidad2 = Math.random();
        velocidad3 = Math.random();
        velocidad4 = Math.random();
      }
})

