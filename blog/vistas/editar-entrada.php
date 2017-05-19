<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/ValidadorEntrada.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

$titulo="Editar entrada";
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Editar</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-nueva-entrada" method="post" action="<?php RUTA_EDITAR_ENTRADA ; ?>  ">
              <?php 
               if(isset($_POST['editar_entrada'])){
                   $id_entrada=$_POST['id_editar'];
                   Conexion::abrir_conexion();
                   
                   $entrada_recuperada=RepositorioEntrada::obtener_entrada_por_id(Conexion::obtener_conexion(),$id_entrada);
                   
                   include_once 'plantillas/form_entrada_recuperada.inc.php';
                   
                   Conexion::cerrar_conexion();
               }
              
               ?>

                
            </form>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
