<?php 
include("conexao.php");

if (isset($_REQUEST["senha"])) {

    $senha = $mysqli->real_escape_string($_REQUEST["senha"]);


    $sql_code = "SELECT * FROM admin WHERE pass=?;";
    $stmt_admin = $mysqli->prepare($sql_code);
    $stmt_admin->bind_param("i", $senha);
    $stmt_admin->execute();
    $result = $stmt_admin->get_result();
    $stmt_admin->close();

    if ($result->num_rows === 1) {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION["senha"] = $senha;
        header("Location: ../admin/admin.php");
        exit;
    }else {
        echo "
               <script>
                    alert(\"Esta Senha não existe!\");
                </script>
            ";
        
    }

}

?>