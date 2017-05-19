<?php
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
include_once 'plantillas/panel_control_declaracion.inc.php';
    

switch($gestor_actual){
    case'':
        $cantidad_entradas_activas=RepositorioEntrada::contar_entradas_activas_usuarios(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
         $cantidad_entradas_inactivas=RepositorioEntrada::contar_entradas_inactivas_usuarios(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
         $cantidad_comentarios=RepositorioComentario::contar_comentarios_usuario(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
        include_once 'plantillas/gestor_generico.inc.php';
        break;
     case'entradas':
         $array_entradas=RepositorioEntrada::obtener_entradas_usuario_fecha_descendente(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
         
        include_once 'plantillas/gestor_entradas.inc.php';
        break;
    case'comentarios':
        include_once 'plantillas/gestor_comentarios.inc.php';
        break;
    case'favoritos':
    
        include_once 'plantillas/gestor_favoritos.inc.php';
        break;
}

include_once 'plantillas/panel_control_cierre.inc.php';
