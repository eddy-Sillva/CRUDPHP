<?php
require_once("baseDatos.php");

// ROUTING
switch ($_POST["accion"]) {
    case 'verificar':        
        $usuarioVerificado = verificar($_POST['correo'], $BD);
        
        if ($usuarioVerificado != NULL) {
            echo json_encode(array('success' => 1));            
        }else{
            echo json_encode(array('success' => 0));            
        }
        break;

    case 'registrar':
        registrarUsuario($_POST, $BD);       
        break;

    case 'eliminar':
            eliminar($_POST, $BD);       
         break;
    case 'modificar':
        modificar($_POST, $BD);
        break;
    
    default:
        return '<h1>NO SE ELIGIÓ NINGUNA ACCIÓN</h1>';
        break;
}
?>