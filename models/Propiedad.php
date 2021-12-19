<?php

namespace Model;

class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedorid'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorid;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorid = $args['vendedorid'] ?? '';
    }

    public function validar(){

        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }
        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        }
        if(strlen (!$this->descripcion) > 30 ){
            self::$errores[] = "La Descripcion es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "El numero de habitaciones es obligatorias";
        }
        if(!$this->wc){
            self::$errores[] = "El numero de baños es obligatorias";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "El numero de estacionamieto es obligatorias";
        }
        if(!$this->vendedorid){
            self::$errores[] = "Elige un vendedor";
        }
        if(!$this->imagen) {
            self::$errores[] = 'La imagen es Obligatoria';
        }
    }

}