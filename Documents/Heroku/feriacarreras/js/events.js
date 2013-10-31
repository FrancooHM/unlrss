var id = 1; 
var par = 2; 

var naturales =0;
var sociales =0;
var aplicadas =0;
var humanidades =0;

 // ------------------ Algoritmo ------------------

 // ------------------ puntos ------------------

 // Input: 
 //     Par [Area,Puntos]
 // Output:
 //     Devuelve los puntos asociados al par [Area,Puntos] recibido.

function puntos(par){
    return par[0];
}

function area(par){
    return par[1];
}

 // ------------------ hayEmpate ------------------

 // Input: -
 // Output:
 //     Si no hay empate, devuelve una lista vacia.
 //     Si hay empate, devuelve una lista de dos elementos que son los indices de las areas empatadas.

function hayEmpate(){
// Para evaluar si hay desempate, como a lo sumo el empate es entre dos:
// 1 - Armo un map
// 2 - Lo ordeno de max->min 
// 3 - Si los dos primeros son iguales, entonces hay empate

    var areasPuntuadas = new Array([naturales,1],[sociales,2],[aplicadas,3],[humanidades,4]);

//El primer for es hasta length-2 porque por un lado no hago la busqueda con todos los elementos
//ya que cuando estoy en el anteultimo, el ultimo ya esta bien ubicado.
//Y por otro lado se usa un indice menos aún ya que los arreglos son base 0.
   for (var i=0;i<=areasPuntuadas.length-2;i++){
    max = puntos(areasPuntuadas[i]);
            for (var j=i+1;j<=areasPuntuadas.length-1;j++){
                var aux = puntos(areasPuntuadas[j]);
                    //Si es mayor intercambio variables
                    if (aux>max){
                        var temp = areasPuntuadas[i];
                        areasPuntuadas[i]=areasPuntuadas[j];
                        areasPuntuadas[j] = temp;
                        max = puntos(areasPuntuadas[i]);
                }
            }
        }

    if (puntos(areasPuntuadas[0])==puntos(areasPuntuadas[1])){
    //Si los primeros dos son iguales entonces hay un empate y se desempata entre esos.
        return new Array(areasPuntuadas[0],areasPuntuadas[1]);
    }
    else{
        //Sino devuelve un arreglo con el maximo.
        return new Array(areasPuntuadas[0]);
    }

}

 // ------------------ sumaArea ------------------

 // Input: 
 //     Area que debe sumar un punto
 // Output: -
 //     (Suma puntos a la variable global correspondiente)

function sumaArea(areaDiada) {

//Naturales
if (areaDiada==1){
    naturales=naturales+1;
}
//Sociales
if (areaDiada==2){
    sociales=sociales+1;
}
//Humanidades
if (areaDiada==3){
    aplicadas=aplicadas+1;
}
//Aplicadas
if (areaDiada==4){
    humanidades=humanidades+1;
}
}

 // ------------------ Script del slider ------------------ 
		$(window).load(function() {
			$('.slider')._TMS({
				duration:1000,
				easing:'easeOutExpo',
				preset:'slideDown',
				slideshow:1000,
				banners:false,
				pauseOnHover:true,
				pagination:true,
				pagNums:false
			});
		});

// ------------------ Callbacks en diadas ------------------

    function getOnScreen (){
    var diada1 = "#diada" + id;
    var diada2 = "#diada" + par;
    $(diada1).css("display","table");
    $(diada1).animate({width: "100%"}, 1000, "easeOutBounce");
    $(diada2).css("display","table");
    $(diada2).animate({width: "100%"}, 1000, "easeOutExpo");
    $(diada1).click(getOut1);
    $(diada2).click(getOut2);
    }


    function getOut1 (){ 
    var diada1 = "#diada" + id;
    var diada2 = "#diada" + par;

    var areaDiada = "#areaDiada" + id;

    areaDiada = $(areaDiada).text();

    sumaArea(areaDiada);

    $(diada1).remove();
    $(diada2).remove();

    id = id + 2;
    par = par + 2;

//Cuando ya clickie todas las diadas corroboro si estoy en empate

    if (par >= 14){

        var empate = hayEmpate();
        
        if (empate.length == 1){
            
            // ------------------ Hago la peticion al servidor ------------------
            var par_ = empate[0];
            var area_ind = par_[1];

            var dataPost = $.post("cargarResultado.php", {area: area_ind});
            // ------------------ Tomo el echo que vuelve por POST ------------------
            dataPost.done(
            function (data){
                // ------------------ Remuevo el contenedor viejo ------------------ 
                $("#contenedorPares").remove();
                // ------------------ Modifico el estilo ------------------ 
                if (screen.width < 1280 ) {
                            $("#estilo").attr("href", "cssTest/orientateResultadoStyle.css");
                        }
                            else if (screen.width >=1280 && screen.width <1920 ) {
                                $("#estilo").attr("href", "css1280/orientateResultadoStyle.css");
                            }
                            else if (screen.width >= 1920 ) {
                                $("#estilo").attr("href", "css1920/orientateResultadoStyle.css");
                            }

                $("body").css("background-image",'url("css1920/imagenes/'+area_ind+'.jpg")');
                // ------------------ Appendeo el bloque de preguntas ------------------ 
                $( data ).appendTo( $( ".main" ) );
                //Acá puedo agregar un efecto para la aparicion de un texto que indica que se termino el juego y que me toco;
            });
        
        }
        else{
            var par_1 = empate[0];
            var par_2 = empate[1];
            var area_ind1 = par_1[1];
            var area_ind2 = par_2[1];

            var dataPost = $.post("cargarTestEmpate.php", {area1: area_ind1,area2: area_ind2});

            // ------------------ Tomo el echo que vuelve por POST ------------------
            dataPost.done(
            function (data){
                // ------------------ Remuevo el contenedor viejo ------------------ 
                $("#contenedorPares").remove();
                // ------------------ Appendeo el bloque de preguntas ------------------ 
                $( data ).appendTo( $( ".main" ) );
                getOnScreen();
            });
        }
    
    }
    getOnScreen();
}

    function getOut2 (){ 
    var diada1 = "#diada" + id;
    var diada2 = "#diada" + par;

    var areaDiada = "#areaDiada" + par;

    areaDiada = $(areaDiada).text();

    sumaArea(areaDiada);

    $(diada1).remove();
    $(diada2).remove();

    id = id + 2;
    par = par + 2;

//Cuando ya clickie todas las diadas corroboro si estoy en empate

    if (par >= 14){

        var empate = hayEmpate();
        
        if (empate.length == 1){
            
            // ------------------ Hago la peticion al servidor ------------------
            var par_ = empate[0];
            var area_ind = par_[1];

            var dataPost = $.post("cargarResultado.php", {area: area_ind});
            // ------------------ Tomo el echo que vuelve por POST ------------------
            dataPost.done(
            function (data){
                // ------------------ Remuevo el contenedor viejo ------------------ 
                $("#contenedorPares").remove();
                // ------------------ Modifico el estilo ------------------ 
                if (screen.width < 1280 ) {
                            $("#estilo").attr("href", "cssTest/orientateResultadoStyle.css");
                        }
                            else if (screen.width >=1280 && screen.width <1920 ) {
                                $("#estilo").attr("href", "css1280/orientateResultadoStyle.css");
                            }
                            else if (screen.width >= 1920 ) {
                                $("#estilo").attr("href", "css1920/orientateResultadoStyle.css");
                            }
                $("body").css("background-image",'url("css1920/imagenes/'+area_ind+'.jpg")');
                // ------------------ Appendeo el bloque de preguntas ------------------ 
                $( data ).appendTo( $( ".main" ) );
                //Acá puedo agregar un efecto para la aparicion de un texto que indica que se termino el juego y que me toco;
            });
        
        }
        else{
            var par_1 = empate[0];
            var par_2 = empate[1];
            var area_ind1 = par_1[1];
            var area_ind2 = par_2[1];

            var dataPost = $.post("cargarTestEmpate.php", {area1: area_ind1,area2: area_ind2});

            // ------------------ Tomo el echo que vuelve por POST ------------------
            dataPost.done(
            function (data){
                // ------------------ Remuevo el contenedor viejo ------------------ 
                $("#contenedorPares").remove();
                // ------------------ Appendeo el bloque de preguntas ------------------ 
                $( data ).appendTo( $( ".main" ) );
                getOnScreen();
            });
        }
    
    }
    
    getOnScreen();
}

// ------------------ Callbacks index.php ------------------

function jugadorVaron(){

// ------------------ Hago la peticion al servidor ------------------
        var dataPost = $.post("cargarTest.php",{genero: "varon"});
// ------------------ Tomo el echo que vuelve por POST ------------------
        dataPost.done(
        	function (data){
        		// ------------------ Remuevo el contenedor viejo ------------------ 
        		$("#contenedorGeneros").remove();
				// ------------------ Modifico el estilo ------------------
              if (screen.width < 1280 ) {
                                        $("#estilo").attr("href", "cssTest/orientateVaronStyle.css");
                                        }
                                            else if (screen.width >=1280 && screen.width <1920 ) {
                                                $("#estilo").attr("href", "css1280/orientateVaronStyle.css");
                                            }
                                            else if (screen.width >= 1920 ) {
                                                $("#estilo").attr("href", "css1920/orientateVaronStyle.css");
                                            }
				// ------------------ Appendeo el bloque de preguntas ------------------ 
        		$( data ).appendTo( $( ".main" ) );
                // ------------------ Comienzo a mostrar las preguntas ------------------
                getOnScreen();
        	});
	}

function jugadorMujer(){
// ------------------ Hago la peticion al servidor ------------------
        var dataPost = $.post("cargarTest.php",{genero: "mujer"});
// ------------------ Tomo el echo que vuelve por POST ------------------
        dataPost.done(
            function (data){
                // ------------------ Remuevo el contenedor viejo ------------------ 
                $("#contenedorGeneros").remove();
                // ------------------ Modifico el estilo ------------------
                if (screen.width < 1280 ) {
                            $("#estilo").attr("href", "cssTest/orientateMujerStyle.css");
                            }
                                else if (screen.width >=1280 && screen.width <1920 ) {
                                    $("#estilo").attr("href", "css1280/orientateMujerStyle.css");
                                }
                                else if (screen.width >= 1920 ) {
                                    $("#estilo").attr("href", "css1920/orientateMujerStyle.css");
                                }
                // ------------------ Appendeo el bloque de preguntas ------------------ 
                $( data ).appendTo( $( ".main" ) );
                // ------------------ Comienzo a mostrar las preguntas ------------------
                getOnScreen();
            });
}

function cargarJuego(){
    var dataPost = $.post("cargarJuego.php");
    dataPost.done(
        function (data){
        if (screen.width < 1280 ) {
            $("#estilo").attr("href", "cssTest/generoStyle.css");
            }
                else if (screen.width >=1280 && screen.width <1920 ) {
                    $("#estilo").attr("href", "css1280/generoStyle.css");
                }
                else if (screen.width >= 1920 ) {
                    $("#estilo").attr("href", "css1920/generoStyle.css");
                }
            $( data ).appendTo( $( ".main" ) );

            $("#varon").click(jugadorVaron);
            $("#mujer").click(jugadorMujer);
            $("body").off();
        }
        );

}

// ------------------ Script de carga de funciones index------------------ 

function cargarScriptsIndex(){
        $("body").click(cargarJuego);

}
// ------------------ Triggers-ondocumentready ------------------ 

$(document).ready(cargarScriptsIndex);