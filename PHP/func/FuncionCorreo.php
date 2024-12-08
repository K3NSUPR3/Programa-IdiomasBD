<?php

function generaTokenPass ($user_id)
{
global $mysqli;

$token = generateToken () ;

$stmt = $mysqli->prepare ("UPDATE registroidiomas SET token_password =? ,
$password_request=1 WHERE ID = ?");
$stmt->bind_param('ss', $token, $user_id);
$stmt->execute () ;
$stmt->close ();

return $token;

}


function getValor ($campo, $campoWhere, $valor)
{
    global $mysqli;

    $stmt = $mysqli->prepare ("SELECT $campo FROM registroidiomas WHERE $campoWhere =
    ? LIMIT 1");
    $stmt->bind_param('s', $valor);
    $stmt->execute ();
    $stmt->store_result ();
    $num = $stmt->num_rows;
    
    if ($num > 0){
    $stmt->bind_result($_campo);
    $stmt->fetch();
    $stmt->close();
    return $_campo;
    }
    
    else{
        $stmt->close(); // Cerrar la declaración incluso si no hay resultados 
        return null;
    }
}
?>