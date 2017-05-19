<?php

include_once 'app/config.inc.php';

include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.class.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';
 
Conexion::abrir_conexion();

for($usuarios=0;$usuarios<100;$usuarios++){
    $nombre=sa(10);
    $email=sa(5).'@'.sa(3);
    $password=password_hash('123456',PASSWORD_DEFAULT);
    $usuario=new Usuario('',$nombre,$email,$password,'','');
    RepositorioUsuario::insertar_usuario(Conexion::obtener_conexion(),$usuario);
}

for($entradas=0;$entradas<100;$entradas++){
    $titulo=sa(10);
    $texto=lorem();
    $autor=rand(1,100);//tenemos 100 usuarios creados ver function usuarios
    $url=$titulo;
    $entrada=new Entrada('',$autor,$url,$titulo,$texto,'','');
    RepositorioEntrada::insertar_entrada(Conexion::obtener_conexion(),$entrada);
}
for($comentarios=0;$comentarios<100;$comentarios++){
    $titulo=sa(10);
    $texto=lorem();
    $autor=rand(1,100);//tenemos 100 usuarios creados ver function usuarios
    $entrada=rand(1,100);
    $comentario=new Comentario('',$autor,$entrada,$titulo,$texto,'');
    RepositorioComentario::insertar_comentario(Conexion::obtener_conexion(),$comentario);
}

function sa($longitud){
    $caracteres='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres=strlen($caracteres);
    $string_aleatorio='';
    for($i=0;$i<$longitud;$i++){
     $string_aleatorio.=$caracteres[rand(0,$numero_caracteres-1)];   
    }
    return $string_aleatorio;
}
 function   lorem(){
    $loremn = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tristique luctus sem, nec auctor lectus gravida gravida. Morbi ac ligula ornare, accumsan metus ac, tristique leo. Nulla lobortis urna vel varius rutrum. Nunc sed lectus id felis viverra lobortis vitae congue leo. Integer eu sollicitudin massa. Donec sit amet pellentesque libero. Pellentesque vulputate eget nisl in accumsan.

Phasellus mollis, massa nec sollicitudin lacinia, justo mi eleifend erat, et luctus mi est sed arcu. Curabitur sagittis lectus sed justo dictum, eget hendrerit risus rhoncus. Aliquam consequat elit venenatis, rutrum elit a, suscipit elit. Integer porta est nunc, et sagittis tortor bibendum et. Sed luctus, ipsum in euismod ultrices, tortor quam consectetur turpis, a pharetra libero lectus ut urna. Donec porta ullamcorper nunc quis consectetur. Duis pellentesque diam et ultricies sodales. Quisque commodo tincidunt turpis, vel porta arcu rhoncus sit amet. Phasellus et tristique dui. Mauris dictum ac nulla ut suscipit. Curabitur mollis magna elementum, consequat risus nec, mollis odio. Nam hendrerit ipsum in quam lobortis consectetur. Quisque et metus nec magna cursus luctus. Donec quis tincidunt dui.

Nam vehicula purus sit amet arcu vehicula eleifend. Praesent varius ligula quis lorem sagittis auctor. Nunc dolor nisl, cursus quis scelerisque nec, lacinia id lacus. Suspendisse pellentesque ligula sed condimentum aliquam. Fusce in sapien lorem. Nam sed sem nunc. Quisque eu mauris lacus. Praesent ut gravida tellus. Cras velit justo, suscipit eget tempus non, elementum a diam. Etiam venenatis at arcu ac imperdiet.

Nam gravida tellus in elementum suscipit. Vestibulum sollicitudin magna quis quam finibus, at auctor dui tempus. Mauris eget enim justo. Donec quis aliquet enim. Mauris ornare mi nec maximus scelerisque. Quisque faucibus accumsan porttitor. Praesent tincidunt justo eget tellus cursus, quis volutpat erat molestie. Aenean hendrerit imperdiet neque, imperdiet blandit massa tincidunt in. Suspendisse posuere justo non erat interdum, et commodo purus laoreet. Etiam a egestas turpis, non faucibus odio. Fusce quis blandit enim. Integer leo mi, pharetra sit amet pretium at, auctor sit amet mi. Nullam sodales nulla purus, non bibendum lorem egestas sed.

In sit amet sodales erat. Morbi ultricies diam efficitur nulla congue, sed gravida nibh ultrices. Suspendisse non faucibus augue. Etiam bibendum diam a lectus efficitur, pulvinar ultrices risus vulputate. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam justo erat, dignissim et scelerisque efficitur, scelerisque id eros. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin blandit blandit dictum. Nulla vitae neque lectus. Quisque vel purus nunc. Aenean et purus metus. Cras vel est dui. Praesent vehicula porttitor velit laoreet egestas. Curabitur ultrices nisi dictum leo tincidunt, eget pharetra sem laoreet.';
            return $loremn;
}