<?php 
//termina a sessão do usuário admin-->

if (!isset($_SESSION)) {/* se não existir sessão inicia a sessão */
    session_start();
}


if (isset($_SESSION["senha"])) {
    
    unset($_SESSION["senha"]);/* destruir sessão senha*/

    header("Location: ../admin/index.php");
    exit; // Garante que nenhum código adicional seja executado após o redirecionamento
}

?>