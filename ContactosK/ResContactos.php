<?php
//---------------------------------------------------------------------
// Servicio web para respaldar los contactos de un usuario
// Alejnadro Guzmán Zazueta
// Proyecto AppContactos para Android con Kotlin
// Agosto 2018
//---------------------------------------------------------------------
	include_once('database_utilerias.php');
    header('Content-type: application/json; charset=utf-8');
	$method=$_SERVER['REQUEST_METHOD'];
	$response = array();
	$obj = json_decode( file_get_contents('php://input') );   
    $objArr = (array)$obj;
	if (empty($objArr))
    {
		    	$response["success"] = 422;  //No encontro información 
            	$response["message"] = "Error: checar json de entrada";
            	header($_SERVER['SERVER_PROTOCOL']." 422  Error: faltan parametros de entrada json ");		
    }
    else
    {
    			$contacto = array();
	      		$corr= $objArr['Correo'];
	      		$cont= $objArr['contrasena'];
	      		$contacto= $objArr['contacto'];
	      		$res = obj2array($contacto);
	      		//var_dump($res);
				$result = buscaRegistro($corr, $cont);
				if ($result == 1) // Tiene permiso de respaldar sus contactos
				{
					   foreach ($res as $value)
					   {
					   	   $idcont = $value['idContacto'];
					   	   $nom = $value['NomContacto'];
					   	   $dom = $value['DomContacto'];
					   	   $cp =  $value['Cp'];
					   	   $cor = $value['CorContacto'];
					   	   $tcasa = $value['TelCasa'];
					   	   $tcelular = $value['TelCelular'];
					   	   $rf = $value['recFecha'];
					   	   $edo = $value['Estado'];
					   	   $feca  = $value['FechaAlta'];
					   	   
					   	   $result = RespaldaContacto($corr,$idcont,$nom,$dom,$cp,$cor,$tcasa,$tcelular,$rf,$edo,$feca);   

					   	   if ($result == 1)
					   	   {
					   	   		$response["success"] = 200; 
								$response["message"] = "Se Respaldaron Correctamente";
					   	   }
					   	   else
					   	   {
					   	   		$response["success"] = 500;  
								$response["message"] = "Error: al Registrar la App:";
					   	   }
					   }
				}
				else 
				{
				   	$response["success"] = 422;  //No encontro información 
            		$response["message"] = "Error: Correo no registrado";
				}
	}
	echo json_encode($response);
?>