<?php
include 'conexao.php'; // Inclui o arquivo de conexão

function limpar($id){

    include 'conexao.php';

    $sql_code = "DELETE FROM avaliacao WHERE id_prof = ?";
    $stmt = $mysqli->prepare($sql_code);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    
}

function limparTudo(){

    include 'conexao.php';

    $sql_code = "TRUNCATE TABLE avaliacao";
    $stmt = $mysqli->prepare($sql_code);
    $stmt->execute();
    $stmt->close();
    
}

if (isset($_REQUEST["limpar"])) {
    limpar($_REQUEST["limpar"]);
    header("Location: ../admin/admin.php");
    exit;

    
}

if (isset($_REQUEST["limparTudo"])) {
    limparTudo();
    header("Location: ../admin/admin.php");
    exit;

    
}

$itensPorPagina = 3; // Número de itens por página
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; // Página atual
$offset = ($paginaAtual - 1) * $itensPorPagina; // Calcular o offset

// Verifica se há busca
$busca = isset($_REQUEST["busca"]) ? $_REQUEST["busca"] : null;
$busca2 = isset($_REQUEST["busca2"]) ? $_REQUEST["busca2"] : null;

if ($busca2) {
    header("Location: ../admin/admin.php?busca=$busca2");
    exit;
}

// Consulta principal com prepared statements
if ($busca) {

    $sql_code = "
        SELECT professor.id AS id,
        professor.nome AS nome,

        ROUND((
            AVG(avaliacao.pontualidade) +
            AVG(avaliacao.apresentacao) +
            AVG(avaliacao.dominio_cadeira) +
            AVG(avaliacao.modo_avaliacao) +
            AVG(avaliacao.presenca) +
            AVG(avaliacao.organizacao) +
            AVG(avaliacao.explicacao_materia)
        ) / 7, 1) AS media_geral

        FROM professor JOIN avaliacao
        on professor.id=avaliacao.id_prof
        WHERE professor.nome LIKE CONCAT('%', ?, '%')
        GROUP BY professor.id, professor.nome
        ORDER BY professor.id, professor.nome
        LIMIT ? OFFSET ? 
    ";
    $stmt = $mysqli->prepare($sql_code);
    $stmt->bind_param("sii", $busca, $itensPorPagina, $offset);

    // Consulta para contar o total de resultados
    $totalSql = "
        SELECT COUNT(DISTINCT professor.id) AS total
        FROM professor JOIN avaliacao
        on professor.id=avaliacao.id_prof
        WHERE professor.nome LIKE CONCAT('%', ?, '%')
    ";
    $stmtTotal = $mysqli->prepare($totalSql);
    $stmtTotal->bind_param("s", $busca);
} else {
    $sql_code = "
        SELECT professor.id AS id,
        professor.nome AS nome,

        ROUND((
            AVG(avaliacao.pontualidade) +
            AVG(avaliacao.apresentacao) +
            AVG(avaliacao.dominio_cadeira) +
            AVG(avaliacao.modo_avaliacao) +
            AVG(avaliacao.presenca) +
            AVG(avaliacao.organizacao) +
            AVG(avaliacao.explicacao_materia)
        ) / 7, 1) AS media_geral

        FROM professor JOIN avaliacao
        on professor.id=avaliacao.id_prof
        GROUP BY professor.id, professor.nome
        ORDER BY professor.id, professor.nome
        LIMIT ? OFFSET ?
    ";
    $stmt = $mysqli->prepare($sql_code);
    $stmt->bind_param("ii", $itensPorPagina, $offset);

    $totalSql = "
        SELECT 
        COUNT(DISTINCT professor.id) AS total
        FROM professor JOIN avaliacao
        on professor.id=avaliacao.id_prof
    ";
    $stmtTotal = $mysqli->prepare($totalSql);
}

// Executa as consultas
$stmt->execute();
$result = $stmt->get_result();

$stmtTotal->execute();
$total = $stmtTotal->get_result();
$totalRow = $total->fetch_assoc();

// Cálculo do total de páginas
$totalProdutos = $totalRow["total"];
$totalPaginas = ceil($totalProdutos / $itensPorPagina);

// Fecha os statements
$stmt->close();
$stmtTotal->close();
?>
