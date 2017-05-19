<?php
 
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/EscritorEntradas.inc.php';
$titulo='Page Official';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

        
        <div class="container">
            <div class="jumbotron">
                <h1> force please,not destroy the effort past</h1
                <p>
                    Pagina principal
                </p>   

                <!--   <div class="row">
                       <div class="col-md-4">
                         <h1> esto es una columan mediana 4</h1>  
                       </div> 
                       <div class="col-md-8">
                            <h1> esto es una columan mediana 8</h1>
                       </div>  
                   </div> 
                 <div class="row">
                     <div class="col-md-4">
                         <h1> esto es una columan mediana 4</h1>  
                         </div> 
                         <div class="col-md-4">
                            <h1> esto es una columan mediana 8</h1>
                          </div>  
                          <div class="col-md-4">
                            <h1> esto es una columan mediana 8</h1>
                          </div>
                 </div> -->

            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-default">
                                    <div class="panel panel-heading">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span> busqueda
                                    </div>  
                                    <div class="panel panel-body">
                                        <div class="form-group">
                                            <input type="search" class="form-control" placeholder="esribi rapido ja">

                                            <button   class="form-control"  >  buscar</button  >    

                                        </div>  
                                    </div>  
                                </div>  
                            </div>  
                        </div> 
                        <div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-default">
                                    <div class="panel panel-heading">
                                        <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>filtro
                                    </div>  
                                    <div class="panel panel-body">

                                    </div>  
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="panel panel-default">
                                        <div class="panel panel-heading">
                                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>archivo
                                        </div>  
                                        <div class="panel panel-body">

                                        </div>  
                                    </div>  
                                </div>
                            </div>     
                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php
                        EscritorEntradas::escribir_entradas();
                        ?>
                    </div>
                </div>      
            </div>   
<?php        
include_once 'plantillas/documento-cierre.inc.php'; 
        ?>
