<?php

include_once 'app/config.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Conexion.inc.php';

class RepositorioEntrada {

    public static function insertar_entrada($conexion, $entrada) {
        $entrada_insertada = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO entradas(autor_id,url, titulo, texto, fecha, activa) VALUES(:autor_id,:url,:titulo,:texto, NOW(), :activa)";

                $activa=0;
                if($entrada->esta_activa()){
                    $activa=1;
                }
                
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':autor_id', $entrada->obtener_autor_id(), PDO::PARAM_STR);
                $sentencia->bindParam(':url', $entrada->obtener_url(), PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $entrada->obtener_titulo(), PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $entrada->obtener_texto(), PDO::PARAM_STR);
                $sentencia->bindParam(':activa', $activa, PDO::PARAM_STR);

                $entrada_insertada = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $entrada_insertada;
    }

    public static function obtener_todas_por_fecha_descendiente($conexion) {
        $entradas = [];
        if (isset($conexion)) {

            try {
                $sql = 'SELECT * FROM entradas ORDER BY fecha DESC LIMIT 5'; //la primer entrada que recuperaremos es la ultima CON LIMITE 5 DE ENTRADAS OSEA NO SE VEN TODAS
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new Entrada($fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']);
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function obtener_entrada_por_url($conexion, $url) {
        $entrada = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE url LIKE :url";
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $entrada = new Entrada($resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa']);
                }
            } catch (PDOexeption $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entrada;
    }

    public static function obtener_entradas_al_azar($conexion, $limite) {
        $entradas = [];

        if (isset($conexion)) {
            try {
                $sql = "SELECT*FROM entradas ORDER BY RAND() LIMIT $limite";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new Entrada($fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']);
                    }
                }
            } catch (PDOexeption $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function contar_entradas_activas_usuarios($conexion, $id_usuario) {
        $total_entradas = '0';
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id=:autor_id AND activa= 1";
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $total_entradas == $resultado['total_entradas'];
                }
            } catch (PDOexeption $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $total_entradas;
    }

    public static function contar_entradas_inactivas_usuarios($conexion, $id_usuario) {
        $total_entradas = '0';
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id=:autor_id AND activa=0";
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $total_entradas = $resultado['total_entradas'];
                }
            } catch (PDOexeption $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $total_entradas;
    }

    public static function obtener_entradas_usuario_fecha_descendente($conexion, $id_usuario) {
        $entradas_obtenidas = [];

        if (isset($conexion)) {
            try {
                $sql = "SELECT a.id, a.autor_id, a.url, a.titulo, a.texto, a.fecha, a.activa, COUNT(b.id) AS 'cantidad_comentarios' ";
                $sql .= "FROM entradas a ";
                $sql .= "LEFT JOIN comentarios b ON a.id = b.entrada_id ";
                $sql .= "WHERE a.autor_id = :autor_id ";
                $sql .= "GROUP BY a.id ";
                $sql .= "ORDER BY a.fecha DESC";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas_obtenidas[] = array(
                            new Entrada(
                                    $fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']
                            ),
                            $fila['cantidad_comentarios']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $entradas_obtenidas;
    }

    public static function titulo_existe($conexion, $titulo) {
        $titulo_existe=true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT* FROM entradas WHERE titulo=:titulo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                
                if (count($resultado)){
                    $titulo_existe=true;
                }else{
                    $titulo_existe=false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $titulo_existe;
    }
    
    public static function url_existe($conexion,$url){
        $url_existe=true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT* FROM entradas WHERE url=:url";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                
                if (count($resultado)){
                    $url_existe=true;
                }else{
                    $url_existe=false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $url_existe;
    }
    
    public static function eliminar_comentarios_y_entrada($conexion,$entrada_id){
         if (isset($conexion)) {
            try {
                $conexion->beginTransaction();
                $sql1="DELETE FROM comentarios WHERE entrada_id=:entrada_id";
                $sentencia = $conexion->prepare($sql1);
                $sentencia->bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia->execute();
                
                $sql2="DELETE FROM entradas WHERE id=:entrada_id";
                $sentencia = $conexion->prepare($sql2);
                $sentencia->bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia->execute();
                
                $conexion->commit();
            
                
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
                $conexion->rollBack();
            }
    }
    }
      public static function obtener_entrada_por_id($conexion, $id) {
        $entrada = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE id=:id";
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $entrada = new Entrada($resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa']);
                }
            } catch (PDOexeption $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entrada;
    }

}
