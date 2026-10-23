<?php 
//termina a sessão do usuário aluno 

if (!isset($_SESSION)) {/* se não existir sessão inicia a sessão */
    session_start();
}


if (isset($_SESSION["matricula"])) {
    
    unset($_SESSION["matricula"]);/* destruir sessão matricula*/

    header("Location: ../index.php");
    exit; // Garante que nenhum código adicional seja executado após o redirecionamento
}

?>