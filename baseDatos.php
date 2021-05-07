<?php


// Parámetros de configuración MySQL

$host = "localhost"; // IP DEL SERVIDOR
$usuario = "root"; // USUARIO QUE NOS DAN
$password = "";
$baseDatos = "cine";

$BD = new mysqli($host, $usuario, $password, $baseDatos);

// Esta función registra a un nuevo usuario
function registrarUsuario($usuario, $BD)
{
    // Interpretar un Check
    $noticias = 0;
    if ($usuario['noticias'] === 'on') {
        $noticias = 1;
    }

    $query = "INSERT INTO usuario VALUES (NULL,'{$usuario['correo']}', '{$usuario['password']}', '{$usuario['nombre']}', '{$usuario['apellidos']}', '{$usuario['ciudad']}', '{$usuario['estado']}', '{$usuario['cp']}', '{$noticias}');";    
    $BD->query($query);
    printf("Nuevo registro con el id %d.\n", $BD->insert_id);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function modificar($usuario,$BD){
    $noticias = 0;
    if ($usuario['noticias'] === 'on') {
        $noticias = 1;
    }
    $consulta = "UPDATE usuario SET nombre='{$usuario['nombre']}',correo='{$usuario['correo']}',apellidos='{$usuario['apellidos']}',ciudad='{$usuario['ciudad']}',estado='{$usuario['estado']}',cp='{$usuario['cp']}',password='{$usuario['password']}',noticias='{$noticias}' WHERE id = {$usuario['id']}";
    $BD->query($consulta);
    printf("usuario modificado");
    header('Location:index.php');

}

// Esta función obtiene a todos los elementos de una colección en una BD recibiendo como
// parámetro una tabla
function obtenerTodos($tabla, $BD)
{
    $consulta = "SELECT *FROM {$tabla}"; 
    $retorno = array();

    if ($resultado = $BD->query($consulta)) {
        
        while ($fila = $resultado->fetch_assoc()) {            
            array_push($retorno, $fila);
        }
    }

    return $retorno;
}


// Esta función encuentra a un usuario en específico
function obtenerUsuario($id, $BD)
{
    $consulta = "SELECT *FROM USUARIO WHERE id = {$id}"; 
    $retorno = array();

    if ($resultado = $BD->query($consulta)) {
        while ($fila = $resultado->fetch_assoc()) {            
            array_push($retorno, $fila);
        }
    }

    return $retorno[0];
}

// Esta función es utilizada mediante AJAX para verificar el email
function verificar($correo, $BD)
{
    $consulta = "SELECT *FROM USUARIO WHERE correo = '{$correo}'"; 
    $retorno = array();

    if ($resultado = $BD->query($consulta)) {
        while ($fila = $resultado->fetch_assoc()) {            
            array_push($retorno, $fila);
        }
    }

    if (count($retorno) != 0 ) {
        return $retorno[0];
    } else {
        return null;
    }
}


function eliminar($usuario,$BD){
    $consulta="DELETE FROM USUARIO WHERE id='{$usuario['id']}'";
    $BD->query($consulta);
    printf("Eliminando registro %d.\n", $BD->insert_id);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
