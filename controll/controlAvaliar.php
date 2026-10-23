<?php
include("conexao.php");

$turma = $_SESSION["turma"];
$aluno = $_SESSION["matricula"];

// Consulta para pegar os professores
$sql_code_professores = "
    SELECT DISTINCT
        professor.id AS id,
        professor.nome AS nome
    FROM 
        professor
    JOIN prof_disciplina ON professor.id = prof_disciplina.id_prof
    JOIN disciplina ON disciplina.id = prof_disciplina.id_disciplina
    JOIN turma_disc ON turma_disc.id_disc = disciplina.id
    JOIN turma ON turma_disc.id_turma = turma.id
    WHERE turma.nome = ?
";

$stmt1 = $mysqli->prepare($sql_code_professores);
$stmt1->bind_param("s", $turma);
$stmt1->execute();
$sql_consulta = $stmt1->get_result();

// Consulta para pegar as disciplinas
$sql_code_disciplinas = "
    SELECT DISTINCT
        disciplina.id,  
        disciplina.nome
    FROM 
        professor
    JOIN prof_disciplina ON professor.id = prof_disciplina.id_prof
    JOIN disciplina ON disciplina.id = prof_disciplina.id_disciplina
    JOIN turma_disc ON turma_disc.id_disc = disciplina.id
    JOIN turma ON turma_disc.id_turma = turma.id
    WHERE turma.nome = ?
";

$stmt2 = $mysqli->prepare($sql_code_disciplinas);
$stmt2->bind_param("s", $turma);
$stmt2->execute();
$sql_consulta2 = $stmt2->get_result();

// Consulta para pegar os professores avaliados
$sql_code_avaliacoes = "
    SELECT
        professor.nome AS prof,
        GROUP_CONCAT(disciplina.nome SEPARATOR ', ') AS disci
    FROM avaliacao
    JOIN professor ON professor.id = avaliacao.id_prof
    JOIN disciplina ON disciplina.id = avaliacao.id_disciplina
    WHERE avaliacao.id_aluno = ?
    GROUP BY professor.nome
";

$stmt3 = $mysqli->prepare($sql_code_avaliacoes);
$stmt3->bind_param("s", $aluno);
$stmt3->execute();
$sql_consulta3 = $stmt3->get_result();

// Fechando os statements
$stmt1->close();
$stmt2->close();
$stmt3->close();
?>
