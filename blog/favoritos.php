<?php
include_once 'app/config.inc.php';

?>
<!DOCTYPE html>

<html lang="es">
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        if(!isset($titulo)||(empty($titulo))){
           $titulo ='youssef';
        }
        echo "<title>$titulo</title>";
        ?>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/cover.css" rel="stylesheet">
         <link href="css/bug.css" rel="stylesheet">
         <script src="js/emulation.js"></script>
    </head>
    <body>
        <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Favoritos</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="<?php echo SERVIDOR ?>">Inicio</a></li>
                   
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">dbz.</h1>
            <p class="lead"> </p>
            <p class="lead">
               
            </p>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Page template for <a href="http://getbootstrap.com">Page</a>, by <a href="https://twitter.com/mdo">@yussef</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
