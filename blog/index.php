<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';


include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';

//$componentes_url = parse_url($_SERVER['REQUEST_URI']);
//$ruta = $componentes_url['path'];
//$partes_ruta = explode('/', $ruta);
//$partes_ruta=array_filter($partes_ruta);
//$partes_ruta=array_slice($partes_ruta,0);



$componentes_url = parse_url($_SERVER['REQUEST_URI']);

$ruta = $componentes_url['path'];

$partes_ruta = explode('/', $ruta);
$partes_ruta = array_filter($partes_ruta);
$partes_ruta = array_slice($partes_ruta, 0);

$ruta_elegida = 'vistas/404.php';
            

if ($partes_ruta[0] == 'blog') {
    if (count($partes_ruta) == 1) {
        $ruta_elegida = 'vistas/home.php';
    } else if (count($partes_ruta) == 2) {
        switch ($partes_ruta[1]) {
            case 'login.php' :
                
                $ruta_elegida = 'vistas/login.php';
                break;
            case 'logout':
                

                $ruta_elegida = 'vistas/logout.php';
                break;
            case 'registro.php':
                $ruta_elegida = 'vistas/registro.php';
                break;
            case 'gestor':
                $ruta_elegida = 'vistas/gestor.php';
                $gestor_actual='';
                break;
            case 'relleno-dev.php':
                $ruta_elegida='scripts/script-relleno.php';
                break;
            case 'nueva-entrada.php':
                $ruta_elegida='vistas/nueva-entrada.php';
                break;
            case'borrar-entrada.php':
            
                $ruta_elegida='scripts/borrar-entrada.php';
                break;
            case'editar-entrada.php':
            
                $ruta_elegida='vistas/editar-entrada.php';
                break;
        }
    } else if (count($partes_ruta) == 3) {
        if ($partes_ruta[1] == 'registro-correcto.php') {
            $nombre = $partes_ruta[2];
            $ruta_elegida = 'vistas/registro-correcto.php';
        }
        if($partes_ruta[1]=='entrada.php'){
            $url=$partes_ruta[2];
            Conexion::abrir_conexion();
            $entrada=RepositorioEntrada::obtener_entrada_por_url(Conexion::obtener_conexion(),$url);
            if($entrada!=null){
                $autor=RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$entrada->obtener_autor_id());
                $comentarios=RepositorioComentario::obtener_comentarios(Conexion::obtener_conexion(),$entrada->obtener_autor_id());
                $entradas_al_azar=RepositorioEntrada::obtener_entradas_al_azar(Conexion::obtener_conexion(),3);
                $ruta_elegida='vistas/entrada.php';
            }
        }
            
        if ($partes_ruta[1]=='gestor'){
            switch($partes_ruta[2]){
                case 'entradas':
                    $gestor_actual='entradas';
                    $ruta_elegida='vistas/gestor.php';
                    break; 
                case 'comentarios':
                    $gestor_actual='comentarios';
                    $ruta_elegida='vistas/gestor.php';
                    break; 
                 case 'favoritos':
                    $gestor_actual='favoritos';
                    $ruta_elegida='vistas/gestor.php';
                    break; 
            }
        }
    }
}


include_once $ruta_elegida;