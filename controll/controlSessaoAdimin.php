<?php 
//controlo de sessões (verifica se a sessão foi iniciada)
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION["senha"])) { /* Se a sessão for sem a matrícula */
        die("
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH\" crossorigin=\"anonymous\">
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz\" crossorigin=\"anonymous\"></script>
        <div class=\"container\" style=\"padding-top: 50px;\">
            <div class=\"alert alert-danger shadow p-3 mb-5 rounded\" role=\"alert\">
                <h4 class=\"alert-heading\"> Sessão inválida!</h4>
                <p>Você não pode acessar esta pagina.</p> 
                <hr>
                <p class=\"mb-0\"><a href=\"../admin/index.php\">Entrar</a></p>
                </div>
        </div>");
    }

?>

