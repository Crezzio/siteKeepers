$(function () {
    // PARA MOSTRAR LA CONTRASEÑA
    $("#btnContrasena").click(function() {
        var atributo = $("#pswUsuario").attr("type");
        if (atributo == "password") {
            $("#pswUsuario").attr("type", "text");
        } else {
            $("#pswUsuario").attr("type", "password");
        }
    });
});

// PARA COMPROBAR QUE SE HA PASADO UNA IMAGEN POR EL CAMPO FILE
function comprobarTipoArchivo(idImagen) {
    var imagen = document.getElementById(idImagen);
    if (imagen.value != "") {
        function validacionFallida(msg) {
            alert(msg);
            return false;
        }

        if (!esImagen(imagen.value)) {
            return validacionFallida("El tipo de archivo es erróneo.\nInserte una imagen, por favor.");
        }
        // SI ESTÁ CORRECTO
        formularioImagen.submit()
    }
}
function obtenerExtension(nombreArchivo) {
    return nombreArchivo.split('.').pop();
}
function esImagen(nombreArchivo) {
    var ext = obtenerExtension(nombreArchivo);
    switch (ext.toLowerCase()) {
        case 'jpg':
        case 'gif':
        case 'jpeg':
        case 'png':
            return true;
    }
    return false;
}
// PARA COMPROBAR SI SE DEBE MOSTRAR EL CAMPO DE CORREO O NO
function comprobarCorreo(ev) {
    var correo = ev.target.value;
    if (correo == "si") {
        mostrarCorreo();
    } else {
        ocultarCorreo();
    }
}
function mostrarCorreo() {
    document.getElementById("contenedorEmail").style.display = "block";
}
function ocultarCorreo() {
    document.getElementById("contenedorEmail").style.display = "none";
}
// CONFIRMACIÓN A LA HORA DE BORRAR DEPORTE
function confirmar() {
    resultado = confirm("¿Está seguro de que quiere realizar esta acción?");
    if (resultado) formulariodeporte.submit();
    else return false;
}
// PARA CAMBIAR LA IMAGEN
function imagenPreview(ev) {
    comprobarImagen(ev);
    cambiarImagen(ev);
}
function comprobarImagen(ev) {
    var valorInput = ev.target.value;
    if (valorInput != null) {
        document.getElementById("preview").style.display = "block";
    } else {
        document.getElementById("preview").style.display = "none";
    }
}
function cambiarImagen(ev) {
    var input = ev.target;
    var fReader = new FileReader();
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function(event){
        var img = document.getElementById("imagenMostrada");
        img.src = event.target.result;
    }
}
// PARA EL NAVEGADOR LATERAL (SIDENAV)
function comprobarNav() {
    var ancho = document.getElementById("mySidenav").style.width;
    var numeroAncho = ancho.substring(0,ancho.length-2);
    //alert(numeroAncho);
    if (numeroAncho > 0) {
        closeNav();
    } else {
        openNav();
    }
}
function openNav() {
    var enlacesSidenav = document.getElementsByClassName("enlacesSidenav");
    for (var i=0; i<enlacesSidenav.length; i++) {
        enlacesSidenav.item(i).style.opacity = "1";
    }
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("abrirCerrarNav").innerHTML = "&#9776; cerrar";
}
function closeNav() {
    var enlacesSidenav = document.getElementsByClassName("enlacesSidenav");
    for (var i=0; i<enlacesSidenav.length; i++) {
        enlacesSidenav.item(i).style.opacity = "0";
    }
    document.getElementById("mySidenav").style.width = "0px";
    document.getElementById("abrirCerrarNav").innerHTML = "&#9776; abrir";
}
// PARA MOSTRAR LA IMAGEN
function mostrarFotoEnInicio(ev,urlFoto) {
    if (urlFoto !== undefined) {
        document.getElementById("previewInicio").style.marginTop = "5%";
        document.getElementById("recuadro").style.display = "block";
        document.getElementById("recuadro").style.backgroundImage = 'url('+urlFoto+')';
        document.getElementById("recuadro").style.backgroundSize = "cover";
        document.getElementById("recuadro").style.backgroundPosition = "center";
        document.getElementById("previewInicio").innerHTML = "Preview de la imagen de "+ev.target.textContent;
    } else {
        document.getElementById("previewInicio").style.marginTop = "50%";
        document.getElementById("recuadro").style.display = "none";
        document.getElementById("recuadro").style.backgroundImage = '';
        document.getElementById("previewInicio").innerHTML = ev.target.textContent+" no tiene foto aún";
    }
}
// ONMOUSEOUT - NO SE USA POR AHORA
function borrarFotoEnInicio() {
    document.getElementById("recuadro").style.backgroundImage = '';
    document.getElementById("previewInicio").innerHTML = "Pasa el ratón por encima de un deporte con foto";
}
// BORRAR LA PREVIEW
function borrarPreview() {
    document.getElementById("imagen").value = null;
    document.getElementById("preview").style.display = "none";
    document.getElementById("imagenMostrada").src = "";
}
// PARA COMPROBOBAR EL NÚMERO DE CARACTERES
function comprobarCaracteres(nCaracteres, id) {
    var valorCampo = document.getElementById(id).value;
    if (valorCampo.length < nCaracteres) {
        alert("Introduzca un nombre con 3 caracteres o más, por favor.");
        return false;
    }
    return true;
}
// PARA FIJAR EL NAVEGADOR
// SE FIJA LA BARRA DE NAVEGACIÓN AL HACER SCROLL
window.onscroll = function() {
    //fijarNavegador();
    mostrarBotonTop();
};

/*var nav = document.getElementById("navegadorInicio");
var sticky = nav.offsetTop;

// SE AÑADE LA CLASE STICKY (PEGADO) CUANDO SE SUPERA EL OFFSET
function fijarNavegador() {
    logoNav = document.getElementById("logoNav");

    if (window.pageYOffset >= sticky) {
        nav.classList.add("sticky");
        logoNav.style.visibility = 'visible';

    } else {
        nav.classList.remove("sticky");
        logoNav.style.visibility = 'hidden';
    }
}*/
function mostrarBotonTop() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("btnVolverArriba").style.display = "block";
    } else {
        document.getElementById("btnVolverArriba").style.display = "none";
    }
}
function volverArriba() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
// PARA CAMBIAR LA IMAGEN
function imagenPreview(ev) {

    cambiarImagen(ev);
}
function comprobarImagen(ev) {
    var valorInput = ev.target.value;
    if (valorInput != null) {
        document.getElementById("preview").style.display = "block";
    } else {
        document.getElementById("preview").style.display = "none";
    }
}
function cambiarImagen(ev) {
    var input = ev.target;
    var fReader = new FileReader();
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function(event){
        var img = document.getElementById("imagenMostrada");
        img.src = event.target.result;
    }
}