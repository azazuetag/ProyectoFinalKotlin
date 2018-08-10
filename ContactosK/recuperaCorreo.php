<?php
//---------------------------------------------------------------------
// Servicio web para recuperar contraseña
// Alejnadro Guzmán Zazueta
// Proyecto AppContactos para Android con Kotlin
// Agosto 2018
//---------------------------------------------------------------------
    include_once('database_utilerias.php');
    header('Content-type: application/json; charset=utf-8');
	$method=$_SERVER['REQUEST_METHOD'];
	$response = array();
    $pwd = "";
	$obj = json_decode( file_get_contents('php://input') );   
    $objArr = (array)$obj;
	if (empty($objArr))
    {
		    	$response["success"] = 422;  //No encontro información 
            	$response["message"] = "Error: checar json entrada";
    }
    else
    {
	    $corr=  $objArr['Correo'];
        $nom= $objArr['NomRegistro'];
	    $cont= $objArr['contrasena'];
        $result = recuperaCorreo($corr);
        $ban = false;
		while ($tupla = $result->fetch_assoc())
        {
            $ban = true;
            $pwd = $tupla["contrasena"];
        }
     //--------------------------------------------
        if ($ban)
        {
            $destinatario = $corr; 
            $asunto = "Recuperación de contraseña"; 
            $cuerpo = ' 
            <html> 
            <head> 
               <title>Recupera Contraseña</title> 
            </head> 
            <body> 
            <h1>Buenos días!</h1> 
            <p> 
            <b>Bienvenidos a la recuperación de contraseña del sistema de Contactos. La contraseña es:'. $pwd . '
            </p> 
            </body> 
            </html> 
            '; 

            //para el envío en formato HTML 
            $headers = "MIME-Version: 1.0\r\n"; 
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

            //dirección del remitente 
            $headers .= "From: Administrador <a.zazuetag@gmail.com>\r\n"; 

            //dirección de respuesta, si queremos que sea distinta que la del remitente 
            $headers .= "Reply-To: a.zazuetag@gmail.com\r\n"; 

            //ruta del mensaje desde origen a destino 
            $headers .= "Return-path: a.zazuetag@gmail.com\r\n"; 

            //direcciones que recibián copia 
            //$headers .= "Cc: a.zazuetag@gmail.com\r\n"; 

            //direcciones que recibirán copia oculta 
            //$headers .= "Bcc: a.zazuetag@gmail.com\r\n"; 

            mail($destinatario,$asunto,$cuerpo,$headers);
     //---------------------------------------------
            $response["success"] = 205; 
            $response["message"] = "Contraseña de Correo Recuperada";
        }
        else
        {
            $response["success"] = 505;  
            $response["message"] = "Error Correo no encontrado";
        }
    }   
	echo json_encode($response);
?>