<?php
//---------------------------------------------------------------------
// Utilerias de Bases de Dato
// Alejnadro Guzmán Zazueta
// Proyecto AppContactos para Android con Kotlin
// Agosto 2018
//---------------------------------------------------------------------
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'kontactos');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$Cn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$result = '';
mysqli_set_charset($Cn,"utf8");
if( $Cn->connect_errno )
{
	echo 'Error en la conexión';
	exit;
}



//------------- Contactos-----------------------
function buscaContactos($corr)
{
    global $Cn;
    $sql = "SELECT Correo, idContacto,NomContacto,DomContacto,Cp,CorContacto,TelCasa, TelCelular, recFecha, Estado, FechaAlta From Contacto where correo='{$corr}' order by idContacto";
    return $Cn->query($sql);
}

function recuperaCorreo($corr)
{
    global $Cn;
    $sql = "SELECT correo,contrasena From registro where correo='{$corr}'";
    return $Cn->query($sql);
}


function buscaRegistro($corr,$pwd)
{
	global $Cn;
	$sql = "SELECT * From registro where Correo = '{$corr}' and contrasena = '{$pwd}'";
	$res = $Cn->query($sql);
    if ($tupla = $res->fetch_assoc())
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

function agregarRegistro($corr, $nom, $pw)
{
    global $Cn;
    if (buscaRegistro($corr,$pw) == 0)
    {
        $sql = "Insert into registro (Correo,NomRegistro,contrasena,FechaAlta) values ('{$corr}','{$nom}','{$pw}', Now())";
        return $Cn->query($sql);
    }
    else
    {
        $sql = "SELECT contrasena From registro where Correo = '{$corr}'";
	    $res = $Cn->query($sql);
        if ($tupla = $res->fetch_assoc())
        {
            if ($pw == $tupla["contrasena"])
            {
                return 52;
            }
            else
            {
                return 54;
            }
        }
    }
}

function RespaldaContacto($cor,$idcon,$no,$do,$cp,$co,$tcas,$tcelula,$rf,$ed,$fec)
{
    global $Cn;
    $sql = "Insert into Contacto (Correo, idContacto, NomContacto, DomContacto, Cp, CorContacto, TelCasa, TelCelular, recFecha, Estado, FechaAlta) values ('{$cor}','{$idcon}','{$no}','{$do}','{$cp}','{$co}','{$tcas}','{$tcelula}','{$rf}','G','{$fec}')";
    if ($Cn->query($sql))
        return 1;
    else
    {
        if ($ed == 'B')
        {
            $sql = "Update Contacto set Estado='B' where Correo='{$cor}' and idContacto='{$idcon}'";
        }
        else
        {
            if ($ed == 'C')
            {
                $sql = "Update Contacto Set NomContacto='{$no}', DomContacto='{$do}', Cp='{Cp}', CorContacto='{$co}', Telcasa='{$tcas}', TelCelular='{$tcelula}', recFecha='{$rf}', Estado ='G', FechaAlta='{$fec}' where Correo='{$cor}' and idContacto='{$idcon}'";
            }
            else
                return 1;
        }
        
        return $Cn->query($sql);
    }
}



function obj2array($obj) {
  $out = array();
  foreach ($obj as $key => $val) {
    switch(true) {
        case is_object($val):
         $out[$key] = obj2array($val);
         break;
      case is_array($val):
         $out[$key] = obj2array($val);
         break;
      default:
        $out[$key] = $val;
    }
  }
  return $out;
} 
