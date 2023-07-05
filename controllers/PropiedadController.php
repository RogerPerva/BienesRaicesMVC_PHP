<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;
use Model\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{

    public static function index(Router $router)
    {

        $propiedades = Propiedad::all();

        $vendedores = Vendedor::all();
        
        //Mostrar los resultados 
        $resultado = $_GET['mensaje'] ?? null; //traemos de la url lo que tenga mensaje, lo que hace el doble signo de interrogacion es que si no esta adopta el null


        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //Arreglo con mensajes de errores.---------------------------------------
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            //--------------------------**Subida de archivos**---------------------
            //Crear nombre unico de imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //--Setear la imagen.
            //Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();

            //Revisar que el arreglo de errores este vacio.
            if (empty($errores)) {
                //Crear carpeta.
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                //Guarda la imagen en el servidor:
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                //Guarda la imagen en la base de datos.
                $resultado = $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        //Ejecutar el codigo despues de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los atributos.
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args); //sincronizamos los datos para actualizarlos
            //Validacion
            $errores = $propiedad->validar();
            //--------------------------**Subida de archivos**---------------------------------------------
            //Crear nombre unico de imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //--------------Setear la imagen.------------
            //Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            $propiedad->guardar();
            //Revisar que el arreglo de errores este vacio.
            if (empty($errores)) {

                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    //Alamacenar imagen en disco duro
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        } //llave del request method

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar(Router $router)
    {

        //VALIDAMOS CON REQUEST_METHOD, para que no nos aparezca como undefined. El post no existe hasta que se mande el request_method
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Validar ID.
            $id = $_POST['id'];

            $id = filter_var($id, FILTER_VALIDATE_INT); //validamos que sea un numero

            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad
        ]);
    }
}
