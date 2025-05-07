<?php
include "modelos/registro.modelo.php";
class ControladorRegistro{

    static public function ctrRegistro(){

        if(isset($_POST["registroCorreo"])){

            $tabla = "personas";

            $datos = array(
                "nombre" => $_POST["registroNombre"],
                "telefono" => $_POST["registroTelefono"],
                "correo" => $_POST["registroCorreo"],
                "clave" => $_POST["registroClave"]            

            );

            $respuesta = ModeloRegistro::mdlRegistro($tabla, $datos);

            return $respuesta;

        }

    }



    static public function ctrIngresar() {

        if(isset($_POST ["ingresoCorreo"])) {

            $tabla = "personas";
            $item = "pers_correo";
            $valor = $_POST["ingresoCorreo"];

            $respuesta = ModeloRegistro::mdlSeleccionarRegistro($tabla,$item, $valor);

            if($respuesta["pers_correo"] == $_POST["ingresoCorreo"] && $respuesta["pers_clave"] == $_POST["ingresoClave"]){ 

                
                session_start();


                $_SESSION["validarIngreso"] = "ok";

                echo '<script>

                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }

                    window.location = "index.php?modulo=contenido";

                </script>';

            } else {

                echo '<script>

                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }

                </script>';

                echo '<div class="alert alert-success">la contraseña no es valida</div>';
            }






        }

    }


    static public function ctrSeleccionarRegistro(){

        $tabla = "personas";

        $respuesta = ModeloRegistro::mdlSeleccionarRegistro($tabla, null,null);

        return $respuesta;
    }

    public static function ctrActualizar() {
        if (isset($_POST['actualizarNombre'], $_POST['actualizarTelefono'], $_POST['actualizarCorreo'], $_POST['actualizarClave'])) {

            $tabla = "personas";

            $datos = array(
                "id" => $_GET["id"], 
                "nombre" => $_POST["actualizarNombre"],
                "telefono" => $_POST["actualizarTelefono"],
                "correo" => $_POST["actualizarCorreo"],
                "clave" => password_hash($_POST["actualizarClave"], PASSWORD_DEFAULT)
            );

            $respuesta = ModeloRegistro::mdlActualizarRegistro($tabla, $datos);

            return $respuesta;
        }

        return null;
    }

   
}