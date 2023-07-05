<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{

    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $incio = true;


        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $incio
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/propiedades');
        //Buscar la propiedad por su id.
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $router->render('/paginas/entrada');
    }

    public static function contacto(Router $router)
    {

        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // debuguear($_POST);
            $respuestas = $_POST['contacto'];
            //Envio de mails.
            //Crear una instancia de PHPMailer instalada por composer.json
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '171b1a89c8a7cc';
            $mail->Password = 'bbcd6801d54938';

            //Configrar el contenido del mail.
            $mail->setFrom('admin@bienesraices.com'); //Esto es quien envia el email.
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); //A que email va a mandarse ese corre.
            $mail->Subject = 'Tienes un nuevo mensaje.'; //Mensaje que va llevar (ASUNTO);

            //Habilitar HTML.
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido.
            $contenido = '<html> <p> ';
            $contenido .= 'Tienes un nuevo mensaje';
            $contenido .= '<p> Nombre: ' . $respuestas['nombre'] . ' </p>';
            //Enviar de forma condicional el email o el telefono:
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= 'Eligio ser contactado por telefono:';
                $contenido .= '<p> Telefono: ' . $respuestas['telefono'] . ' </p>';
                $contenido .= '<p> Fecha de contacto: ' . $respuestas['fecha'] . ' </p>';
                $contenido .= '<p> Hora: ' . $respuestas['hora'] . ' </p>';

            } else {
                $contenido .= 'Eligio ser contactado por email:';
                $contenido .= '<p> Email: ' . $respuestas['email'] . ' </p>';

            }


            $contenido .= '<p> Mensaje: ' . $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p> Vende o comra: ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p> Precio o Presupuesto: $' . $respuestas['precio'] . ' </p>';
            $contenido .= '<p> Prefiere ser contactado por: ' . $respuestas['contacto'] . ' </p>';
            $contenido .= '</p> </html>';




            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin html';

            //Enviar mail.
            if ($mail->send()) { //Este metodo retorna true si se envio o false si no se envio.
                $mensaje= "Mensaje enviado correctamente";
            } else {
                $mensaje= "Mensaje no se pudo enviar...";
            }
        }


        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
