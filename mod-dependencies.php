<!-- ESTE ARCHIVO ES UN MÓDULO, EL PREFIJO 'mod' INDICA MÓDULO. -->

<!--
  Estas son las dependencias que utiliza nuestro software. En orden estas son:
    - Bootstrap
    - Fonts (tipografía)
    - JQuery
-->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400&display=swap" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<!--
  Este tag de estilo nos define el fondo de la página web y la tipografía que utilizará todo el texto escrito en nuestra página.
-->
<style>
  body {
    background-image: url('img/hotel_bg.jpg');
    background-repeat: no-repeat;
    background-size: cover;

    font-family: 'Raleway', sans-serif;
  }

  .container-fluid {
    margin-bottom: 15px;
  }
</style>

<!--
  Este tag de estilo nos define una 'scrollbar' estilizada, para que esta no sea igual a la que viene por defecto.
  Este estilo no es soportado en todos los exploradores web.
-->
<style type="text/css">
::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}
::-webkit-scrollbar-button {
  width: 0px;
  height: 0px;
}
::-webkit-scrollbar-thumb {
  background: #e1e1e1;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-thumb:hover {
  background: #ffffff;
}
::-webkit-scrollbar-thumb:active {
  background: #000000;
}
::-webkit-scrollbar-track {
  background: #666666;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-track:hover {
  background: #666666;
}
::-webkit-scrollbar-track:active {
  background: #333333;
}
::-webkit-scrollbar-corner {
  background: transparent;
}
</style>

<!--
  Este script tag aplica el 'tooltip' de Bootstrap en todos los elementos que tengan el atributo.
  El 'tooltip' es el cuadrito negro que aparece an algunos elementos de la página cuando uno pasa el mouse por encima de ellos.
-->
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>