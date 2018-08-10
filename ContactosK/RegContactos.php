<?php
//---------------------------------------------------------------------
// Servicio web para registrar un nuevo usuario o recuperar los 
// contactos de uno ya registrado
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
            	$response["message"] = "Error: checar json entrada";
            	//header($_SERVER['SERVER_PROTOCOL']." 422  Error: faltan parametros de entrada json ");		
    }
    else
    {
	      		$corr=  $objArr['Correo'];
	      		$nom= $objArr['NomRegistro'];
	      		$cont= $objArr['contrasena'];
				$result = agregarRegistro($corr, $nom, $cont);
				if ($result == 1)
				{
						$response["success"] = 201; 
						$response["message"] = "Se inserto correctamente";
				}
				else 
				{
				   if ($result == 52) // Regresar los contactos
					{
						$res = buscaContactos($corr);
						 if ($res->num_rows == 0)
						 {
						 	$response["success"] = 202; 
							$response["message"] = "Correo ya existe, sin contactos";
						 }
						 else
						 {
						 	$response["success"] = 200; 
							$response["message"] = "Correo con contactos";
							$response["contacto"] = array();
							$contacto = array();
							while ($tupla = $res->fetch_assoc())
		                        {
		                          	$contacto["Correo"] = $tupla["Correo"];
		        	       			$contacto["idContacto"] = $tupla["idContacto"];
				        	        $contacto["NomContacto"] = $tupla["NomContacto"];
				    		        $contacto["DomContacto"] = $tupla["DomContacto"];
				    		        $contacto["Cp"] = $tupla["Cp"];
				    		        $contacto["CorContacto"] = $tupla["CorContacto"];
				    		        $contacto["TelCasa"] = $tupla["TelCasa"];
				    		        $contacto["TelCelular"] = $tupla["TelCelular"];
				    		        $contacto["recFecha"] = $tupla["recFecha"];
				    		        $contacto["Estado"] = $tupla["Estado"];
				    		        $contacto["FechaAlta"] = $tupla["FechaAlta"];
				                    array_push($response["contacto"], $contacto);
		                        }
						 }
					}
					else
					{
						$response["success"] = 500;  
						$response["message"] = "Error en contraseña, da clic en Recuperar Contraseña para que la evien a tu correo";
						//header($_SERVER['SERVER_PROTOCOL']." 500  Error en contraseña: interno del servidor ");		
					}
				}	
	}
	echo json_encode($response);
?>