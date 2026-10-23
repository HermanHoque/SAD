<?php 
include("conexao.php");

if (isset($_REQUEST["matricula"])) { // Verifica se a matrícula foi enviada
    $matricula = $_REQUEST["matricula"];

    // Consulta usando prepared statements
    $sql_code = "
        SELECT
            aluno.nome AS aluno_nome,
            aluno.genero AS aluno_genero, 
            turma.nome AS turma_nome,
            turma.periodo AS turma_periodo,
            turma.ano AS turma_ano,
            curso.nome AS curso_nome,
            sala.nome AS sala_nome
        FROM turma 
        JOIN aluno ON turma.id = aluno.id_turma 
        JOIN curso ON curso.id = aluno.id_curso 
        JOIN sala ON sala.id = turma.id_sala
        WHERE aluno.id = ?
    ";

    $stmt = $mysqli->prepare($sql_code);
    $stmt->bind_param("i", $matricula); // Bind da variável (inteiro)
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o registro foi encontrado
    if ($result->num_rows === 1) {
        $aluno = $result->fetch_assoc();

        // Inicia a sessão se necessário
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Armazena os dados do aluno na sessão
        $_SESSION["matricula"] = $matricula;
        $_SESSION["nome"] = $aluno["aluno_nome"];
        $_SESSION["genero"] = $aluno["aluno_genero"];
        $_SESSION["curso"] = $aluno["curso_nome"];
        $_SESSION["ano"] = $aluno["turma_ano"];
        $_SESSION["turma"] = $aluno["turma_nome"];
        $_SESSION["turno"] = $aluno["turma_periodo"];
        $_SESSION["sala"] = $aluno["sala_nome"];

        // Redireciona para a página de avaliação
        header("Location: ./avaliar.php");
        exit;
    } else {
        echo "
               <script>
                    alert(\"Este número de matrícula não existe no sistema!\");
                </script>
            ";
        
    }

    // Fecha o statement
    $stmt->close();
}
?>
