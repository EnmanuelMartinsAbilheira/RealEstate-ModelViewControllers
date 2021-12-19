<?php  

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;

$router = new Router();

//zona privada
$router->GET('/admin', [PropiedadController::class, 'index']);
$router->GET('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->POST('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->GET('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->POST('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->POST('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->GET('/vendedores/crear', [VendedorController::class, 'crear']);
$router->POST('/vendedores/crear', [VendedorController::class, 'crear']);
$router->GET('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->POST('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->POST('/vendedores/eliminar', [VendedorController::class, 'eliminar']);


//zona publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

//login y autenticacion
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->comprobarRutas();