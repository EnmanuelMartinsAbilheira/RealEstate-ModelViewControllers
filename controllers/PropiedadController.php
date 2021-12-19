<?php 

namespace Controllers;
use MVC\Router; 
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();

        $vendedores = Vendedor::all();
            
        //muestra mensaje condicional 
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router){

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        //arreglo con mensaje de errores
        $errores = Propiedad::getErrores();

        //ejecutar el codigo despues de que el usuario envie el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //crea una nueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);

        //generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        // setear la imagen
        //Realiza un resize a la imagen con intervetion
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        // Validar
        $errores = $propiedad->validar();

        if(empty($errores)){

            // crear la capeta para subir imagenes
            if(!is_dir(CARPETA_IMAGEN)){
                mkdir(CARPETA_IMAGEN);
            }

            //guarda la imagen en el servidor
            //$image->save(CARPETA_IMAGEN . $nombreImagen);

            //guardar en la base de datos
            $propiedad->guardar();
            
        }
    
}

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);

    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        //metodo post para actualizar
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //asignar los atributos
            $args = $_POST['propiedad'];
            
            $propiedad->sincronizar($args);
    
            $errores = $propiedad->validar();
    
            //validacion de subida de  archivos
            //generar un nombre unico
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
    
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
    
    
            //revisar que el arreglo de errores este vacio
            if(empty($errores)){
    
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    // Almacenar la imagen
                    $image->save(CARPETA_IMAGEN . $nombreImagen);
                }
    
                $propiedad->guardar();
            }    
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST['tipo'];
                
                if(validarTipoContenido($tipo)){
                    //comprara lo que vamos a eliminar 
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();

                } 
            }
        }
    }

}
