<?php
include("conexao.php");

if (isset($_REQUEST["id"])) {
    // Sanitiza o ID do professor recebido
    $id_prof = $mysqli->real_escape_string($_REQUEST["id"]);

    // Consulta para obter os dados do professor
    $sql_prof = "SELECT * FROM professor WHERE id = ?";
    $stmt_prof = $mysqli->prepare($sql_prof);
    $stmt_prof->bind_param("i", $id_prof);
    $stmt_prof->execute();
    $result_prof = $stmt_prof->get_result();
    $info_prof = $result_prof->fetch_assoc();
    $stmt_prof->close();

    // Consulta para obter as disciplinas associadas ao professor
    $sql_disc = "
        SELECT disciplina.* 
        FROM disciplina 
        JOIN prof_disciplina ON disciplina.id = prof_disciplina.id_disciplina 
        WHERE prof_disciplina.id_prof = ?
    ";
    $stmt_disc = $mysqli->prepare($sql_disc);
    $stmt_disc->bind_param("i", $id_prof);
    $stmt_disc->execute();
    $info_prof_disci = $stmt_disc->get_result();
    $stmt_disc->close();

    // Consulta para obter as médias finais de cada ponto do professor
    $sql_medias = "
        SELECT 
            ROUND(AVG(pontualidade), 1) AS pt,
            ROUND(AVG(apresentacao), 1) AS ap,
            ROUND(AVG(dominio_cadeira), 1) AS dc,
            ROUND(AVG(modo_avaliacao), 1) AS mda,
            ROUND(AVG(presenca), 1) AS pr,
            ROUND(AVG(organizacao), 1) AS org,
            ROUND(AVG(explicacao_materia), 1) AS exm
        FROM avaliacao
        WHERE id_prof = ?
    ";
    $stmt_medias = $mysqli->prepare($sql_medias);
    $stmt_medias->bind_param("i", $id_prof);
    $stmt_medias->execute();
    $result_medias = $stmt_medias->get_result();
    $medias = $result_medias->fetch_assoc();
    $stmt_medias->close();

    /* média de disciplina */
    $sql_medias2 = "
            SELECT 
            disciplina.nome AS nome,
                ROUND(AVG(pontualidade), 1) AS pt,
                ROUND(AVG(apresentacao), 1) AS ap,
                ROUND(AVG(dominio_cadeira), 1) AS dc,
                ROUND(AVG(modo_avaliacao), 1) AS mda,
                ROUND(AVG(presenca), 1) AS pr,
                ROUND(AVG(organizacao), 1) AS org,
                ROUND(AVG(explicacao_materia), 1) AS exm
            FROM disciplina JOIN avaliacao
            ON disciplina.id=avaliacao.id_disciplina
            WHERE `avaliacao`.id_prof = ?
            GROUP BY disciplina.nome";
    
    $stmt_medias2 = $mysqli->prepare($sql_medias2);
    $stmt_medias2->bind_param("i", $id_prof);
    $stmt_medias2->execute();
    $result_medias2 = $stmt_medias2->get_result();
    $stmt_medias2->close();
}
?>
