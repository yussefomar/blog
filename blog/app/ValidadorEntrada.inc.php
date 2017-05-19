<?php

include_once 'RepositorioEntrada.inc.php';

class ValidadorEntrada {

    private $aviso_inicio;
    private $aviso_cierre;
    
    private $titulo;
    private $url;
    private $texto;
    
    private $error_titulo;
    private $error_url;
    private $error_texto;
    
    public function __construct($titulo,$url,$texto,$conexion){
        $this->aviso_inicio="<br><div class='alert alert-danger' role='alert' >";
        $this->aviso_cierre="</div>";
        
        $this->titulo="";
        $this->url="";
        $this->texto="";
        
        $this->error_titulo= $this->validador_titulo($conexion,$titulo);
        $this->error_url= $this->validador_url($conexion,$url);
        $this->error_texto= $this->validador_texto($conexion,$texto);
    }
    
    
    public function variable_iniciada($variable){
        if (isset($variable)&&!empty($variable)){
            return true;
        }else{
            return false;
        }
    }
    
    public function validador_titulo($conexion,$titulo){
        if(!$this->variable_iniciada($titulo)){
            return "debes escribir un titulo";
        }else{
            $this->titulo=$titulo;
        }
        if(strlen($titulo)>255){
            return "El titulo no puede ocupar mas de 255 caracterres";
        }
        if(RepositorioEntrada:: titulo_existe($conexion,$titulo)){
            return "ya existe una entrada con ese titulo, por favor escoge uno diferente";
        }
    }
    public function validador_url($conexion,$url){
        if(!$this->variable_iniciada($url)){
            return"debes insertar una URL";
            
        }else{
            $this->url=$url;
        }
        $url_tratada=str_replace(' ','',$url);
        
        if(strlen($url)!=strlen($url_tratada)){
            return "la URL no puede contener espacios vacios";
        }
        if(RepositorioEntrada::url_existe($conexion,$url)){
            return "ya existe otro articulo con la misma URL, elige una diferente";
        }
    }
    
    public function validador_texto($conexion,$texto){
        if(!$this->variable_iniciada($texto)){
            return "El contenido no puede estar vacio";
        }else{
            $this->texto=$texto;
        }
    }
    public function obtener_titulo(){
        return $this->titulo;
    }
    public function obtener_url(){
        return $this->url;
    }
    public function obtener_texto(){
        return $this->texto;
        
        
    }
    public function mostrar_titulo(){
        if($this->titulo!=""){
            echo 'value="'. $this->titulo.'"';
        }
        
    }
    public function mostrar_url(){
        if($this->url!=""){
            echo 'value="'. $this->url.'"';
        }
        
    }
    public function mostrar_texto() {
		if ($this -> texto != "" && strlen(trim($this -> texto)) > 0) {
			echo $this -> texto;
		}
	}
  public function mostrar_error_titulo() {
		if ($this -> error_titulo != "") {
			echo $this -> aviso_inicio . $this -> error_titulo . $this -> aviso_cierre;
		}
	}
	
	public function mostrar_error_url() {
		if ($this -> error_url != "") {
			echo $this -> aviso_inicio . $this -> error_url . $this -> aviso_cierre;
		}
	}
	
	public function mostrar_error_texto() {
		if ($this -> error_texto != "") {
			echo $this -> aviso_inicio . $this -> error_texto . $this -> aviso_cierre;
		}
	}
	
	public function entrada_valida() {
		if ($this -> error_titulo == "" && $this -> error_url == "" && $this -> error_texto == "") {
			return true;
		} else {
			return false;
		}
	}
}
