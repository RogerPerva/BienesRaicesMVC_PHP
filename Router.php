<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];
    //Trayendo datos por metodo get
    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    //trayendo datos por metodo post
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start(); //abrimos la sesion para poder autenticar
        $auth = $_SESSION['login'] ?? null;



        //Arreglo de rutas protegidas:
        $rutas_protegidas = [
            '/admin', '/propiedades/actualizar', '/propiedades/crear', '/propiedades/eliminar',
            '/vendedores/actualizar', '/vendedores/crear', '/vendedores/eliminar'
        ];

$urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
      //  $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las rutas: buscamos la ruta en la que estamos en el arreglo de rutas protegidas.
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }
        if ($fn) {
            //La URL existe y hay una funcion asociada.
            call_user_func($fn, $this); //funcion que llama otra funcion cuando no se sabe el nombre de otra funcion

        } else {
            echo "Error 404: Pagina no encontrada";
        }
    }
    //Muestra una vista
    public function render($view, $datos = [])
    {

        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); //almacenamiento en memoria durante un momento
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //limpia el buffer y la variable toma el valor que tenia el buffer

        include __DIR__ . "/views/layout.php";
    }
}
