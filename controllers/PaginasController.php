<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index( Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros( Router $router) {
        $router->render('paginas/nosotros');
    }
    public static function propiedades( Router $router) {

        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades',[
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad( Router $router) {
        $id =validarORedireccionar('/propiedades');

        //buscar la propiedad por su id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router) {
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router) {
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router) {

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuesta = $_POST['contacto'];

            //crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '152bea06fa2dd9';
            $mail->Password = 'cfaf67c4362438';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //habilita HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuesta['nombre'] . '</p>';
            
            //enviar de forma condicional algunos campos de email o telefono
            if($respuesta['contacto'] === 'telefono'){

                $contenido .= '<p>Eligio ser contactado por Telefono:</p>';
                $contenido .= '<p>Telefono: ' . $respuesta['telefono'] . '</p>';
                $contenido .= '<p>Fecha Contacto: ' . $respuesta['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuesta['hora'] . '</p>';
            }else{
                //es email, entonces agregamos el campo de email
                $contenido .= '<p>Eligio ser contactado por email:</p>';
                $contenido .= '<p>Email: ' . $respuesta['email'] . '</p>';
            
            }

            $contenido .= '<p>Mensaje: ' . $respuesta['mensaje'] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuesta['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuesta['precio'] . '</p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuesta['contacto'] . '</p>';
            
            $contenido .= '</html>';


            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            //enviar el email
            if($mail->send()){
                $mensaje = "Mensaje Enviado Correctamente";
            }else{
                $mensaje = "El mensaje no pudo ser enviado";
            }

        }

        $router->render('paginas/contacto',[
            'mensaje' => $mensaje
        ]);
        
    }
}