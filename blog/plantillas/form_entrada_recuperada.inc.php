<div class="form-group">
    <label for="titulo"> Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ponle un titulo a esta entrada" value="<?php echo $entrada_recuperada->obtener_titulo(); ?>">
</div>
<div class="form-group">
    <label for="url"> URL</label>
    <input type="text" class="form-control" id="url" name="url" placeholder="direccion unica para la entrada" value="<?php echo $entrada_recuperada->obtener_url(); ?>">
</div>

<div class="form-group">
    <label for="titulo"> Contenido</label>
    <textarea class="form-control" rows="5" name="texto" placeholder="Escribe aqui un articulo"><?php echo $entrada_recuperada->obtener_texto(); ?></textarea>

</div>
<div class="checkbox" >
    <label ><input type="checkbox" value="publica" name="publicar" value="si"<?php if( $entrada_recuperada->esta_activa())echo'checked'; ?>>Marca este recuadro si quieres que la entrada se publique de inmediato </label>
</div>
<br>
<br>
<button type="submit" class="btn btn-primary" name="guardar">Guardar entrada</button>

