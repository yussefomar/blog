<?php

//info de la base de datos
 define('NOMBRE_SERVIDOR','localhost');
 define('NOMBRE_USUARIO','root');
 define('PASSWORD','');
 define('NOMBRE_BD','blog');
  
 
 //rutas de la web
 define("SERVIDOR","http://localhost:8080/blog");
 define("RUTA_REGISTRO",SERVIDOR."/registro.php");
 define("RUTA_REGISTRO_CORRECTO",SERVIDOR."/registro-correcto.php");
 define("RUTA_LOGIN",SERVIDOR."/login.php");
 define("RUTA_GESTOR",SERVIDOR."/gestor");
 define("RUTA_LOGOUT",SERVIDOR."/logout");
 define("RUTA_ENTRADAS",SERVIDOR."/entrada.php");
 define("RUTA_FAVORITOS",SERVIDOR."/favoritos.php");
 define("RUTA_AUTORES",SERVIDOR."/autores.php");
 define("RUTA_GESTOR_ENTRADAS",RUTA_GESTOR."/entradas");
 define("RUTA_GESTOR_COMENTARIOS",RUTA_GESTOR."/comentarios");
 define("RUTA_GESTOR_FAVORITOS",RUTA_GESTOR."/favoritos");
 define("RUTA_NUEVA_ENTRADA",SERVIDOR."/nueva-entrada.php");
 define("RUTA_BORRAR_ENTRADA",SERVIDOR."/borrar-entrada.php");
 define("RUTA_EDITAR_ENTRADA",SERVIDOR."/editar-entrada.php");
 //recursoS
 
 define('RUTA_CSS',SERVIDOR."/css/");
 define('RUTA_JS',SERVIDOR."/js/");