<?php
include("conexao.php");

if (isset($_REQUEST["id_aluno"])) {
    // Recupera os dados enviados
    $id_prof = $_REQUEST["prof"] ?? 0;
    $id_disci = $_REQUEST["disci"] ?? 0;
    $id_aluno = $_REQUEST["id_aluno"];

    // Valores de avaliação
    $pontualidade = $_REQUEST["pontualidade"];
    $apresentacao = $_REQUEST["apresentacao"];
    $presenca = $_REQUEST["presenca"];
    $organizacao = $_REQUEST["organizacao"];
    $dominio_cadeira = $_REQUEST["dominio_cadeira"];
    $explicacao_materia = $_REQUEST["explicacao_materia"];
    $modo_avaliacao = $_REQUEST["modo_avaliacao"];

    // Verifica se o professor já foi avaliado pelo aluno
    $sql_check_avaliacao = "
        SELECT 1 
        FROM avaliacao 
        WHERE ID_PROF = ? AND id_disciplina = ? AND id_aluno = ?
    ";
    $stmt_check_avaliacao = $mysqli->prepare($sql_check_avaliacao);
    $stmt_check_avaliacao->bind_param("iii", $id_prof, $id_disci, $id_aluno);
    $stmt_check_avaliacao->execute();
    $avaliacao_exists = $stmt_check_avaliacao->get_result()->num_rows > 0;
    $stmt_check_avaliacao->close();

    // Verifica se o professor pertence à disciplina
    $sql_check_prof_disciplina = "
        SELECT 1
        FROM prof_disciplina
        WHERE id_prof = ? AND id_disciplina = ?
    ";
    $stmt_check_prof_disciplina = $mysqli->prepare($sql_check_prof_disciplina);
    $stmt_check_prof_disciplina->bind_param("ii", $id_prof, $id_disci);
    $stmt_check_prof_disciplina->execute();
    $prof_disciplina_exists = $stmt_check_prof_disciplina->get_result()->num_rows > 0;
    $stmt_check_prof_disciplina->close();

    // Validações
    if (!$prof_disciplina_exists) {

        /* mensagem de erro de seleção */
        echo "
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH\" crossorigin=\"anonymous\">
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz\" crossorigin=\"anonymous\"></script>
        <div class=\"container\" style=\"padding-top: 50px;\">
            <div class=\"alert alert-danger shadow p-3 mb-5 rounded\" role=\"alert\">
                <h4 class=\"alert-heading\"> Erro de Seleção!</h4>
                <p>O professor não pertence a Disciplina selecionada.</p> 
                <p>Por favor, refaça a sua escolha!</p>
                <hr>
                <p class=\"mb-0\"><a href=\"../avaliar.php\">OK</a></p>
                </div>
        </div>";
        
    } elseif ($avaliacao_exists) {
        /* mensagem caso já exista a avaliação */
        echo "
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH\" crossorigin=\"anonymous\">
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz\" crossorigin=\"anonymous\"></script>
        <div class=\"container\" style=\"padding-top: 50px;\">
            <div class=\"alert alert-danger shadow p-3 mb-5 rounded\" role=\"alert\">
                <h4 class=\"alert-heading\"> Avaliação já feita!</h4>
                <p>Você já avaliou este professor nesta disciplina.</p> 
                <hr>
                <p class=\"mb-0\"><a href=\"../avaliar.php\">OK</a></p>
                </div>
        </div>";
    } else {
        // Insere a avaliação no banco de dados
        $sql_insert = "
            INSERT INTO avaliacao (
                pontualidade, apresentacao, presenca, organizacao, 
                dominio_cadeira, explicacao_materia, modo_avaliacao, 
                id_prof, id_disciplina, id_aluno
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";
        $stmt_insert = $mysqli->prepare($sql_insert);
        $stmt_insert->bind_param(
            "iiiiiiiiii", 
            $pontualidade, $apresentacao, $presenca, $organizacao, 
            $dominio_cadeira, $explicacao_materia, $modo_avaliacao, 
            $id_prof, $id_disci, $id_aluno
        );

        if ($stmt_insert->execute()) {

            /* mensagem caso tenha sucesso */
            echo "
            <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH\" crossorigin=\"anonymous\">
            <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz\" crossorigin=\"anonymous\"></script>
            <div class=\"container\" style=\"padding-top: 50px;\">
                <div class=\"alert alert-success shadow p-3 mb-5 rounded\" role=\"alert\">
                    <h4 class=\"alert-heading\"> Sucesso!</h4>
                    <p>Avaliação enviada com sucesso.</p> 
                    <hr>
                    <p class=\"mb-0\"><a href=\"../avaliar.php\">OK</a></p>
                    </div>
            </div>";
        } else {
            echo "Erro: " . $mysqli->error;
        }
        $stmt_insert->close();
    }
}
?>
