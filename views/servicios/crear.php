<h1 class="nombre-pagina">Crear Servicios</h1>
<h3 class="descripcion-pagina">Llena todos los campos para añadir un nuevo servicio</h3>

<?php 
    // include_once __DIR__ . "/../templates/barra.php";
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . "/formulario.php"; ?>

    <input type="submit" name="" id="" class="boton" value="Guardar Servicio">
</form>