<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$dompdf = new Dompdf($options);

// Captura os dados do formulário
$nome = $_POST['nome'];
$genero = $_POST['genero'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$disciplinas = $_POST['disciplinas'];
$medias = $_POST['medias'];
$avaliacoes = $_POST['avaliacoes'];

$pontosCompletos = [
  "pt" => "Pontualidade",
  "ap" => "Apresentação",
  "pr" => "Presença",
  "org" => "Organização",
  "dc" => "Domínio da cadeira",
  "exm" => "Explicação da Matéria",
  "mda" => "Modo de Avaliação"
];

// Converte logo para base64
$logoPath = '../img/SAD3.png';
$logoBase64 = base64_encode(file_get_contents($logoPath));
$data = date("d/m/Y");

// Estilos CSS
$style = "
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      color: #333;
      padding: 30px;
    }
    header {
      border-bottom: 2px solid #0d6efd;
      padding-bottom: 10px;
      margin-bottom: 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    header .logo {
      text-align: center;
      flex: 1;
    }
    header .data {
      text-align: left;
      font-size: 12pt;
      flex: 1;
    }
    header img {
      height: 60px;
    }
    h1 {
      font-size: 22pt;
      color: #0d6efd;
      margin: 0;
    }
    h2 {
      font-size: 16pt;
      color: #0d6efd;
      margin-bottom: 10px;
      margin-top: 30px;
    }
    h4 {
      color: #0d6efd;
      margin-bottom: 5px;
    }
    ul {
      margin: 10px 0 0 20px;
    }
    li {
      margin-bottom: 5px;
    }
    footer {
      text-align: center;
      margin-top: 50px;
      font-size: 10pt;
      color: #999;
    }
    .page-break {
      page-break-before: always;
    }
    .card {
      border: 1px solid #cde0ff;
      border-left: 8px solid #0d6efd;
      border-radius: 8px;
      background-color: #f3f8ff;
      padding: 15px;
      margin-bottom: 25px;
    }
    .section-title {
      font-size: 15pt;
      color: #0d6efd;
      margin-bottom: 5px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 5px;
    }
  </style>
";

// HTML DO PDF
$html = "
<!DOCTYPE html>
<html lang='pt'>
<head>
  <meta charset='UTF-8'>
  {$style}
</head>
<body>

<header>
  <div class='data'><strong>Data:</strong> {$data}</div>
  <div class='logo'>
    <img src='data:image/png;base64,{$logoBase64}' alt='Logo do Sistema'><br>
    <h1>Relatório de Avaliação</h1>
  </div>
</header>

<h2>Informações do Professor</h2>
<div class='card'>
  <p><strong>Nome:</strong> {$nome}</p>
  <p><strong>Gênero:</strong> {$genero}</p>
  <p><strong>Telefone:</strong> {$telefone}</p>
  <p><strong>Email:</strong> {$email}</p>
  <p><strong>Disciplinas:</strong></p>
  <ul>";
foreach ($disciplinas as $disc) {
  $html .= "<li>{$disc}</li>";
}
$html .= "</ul>
</div>";

$html .= "<h2>Média Final de Cada Ponto Avaliado</h2>
<div class='card'>
  <ul>";
foreach ($medias as $ponto => $valor) {
  $pontoCompleto = $pontosCompletos[$ponto] ?? $ponto;
  $html .= "<li><strong>{$pontoCompleto}:</strong> {$valor}</li>";
}
$html .= "</ul>
</div>";

$html .= "<div class='page-break'></div>
<h2>Resumo das Avaliações por Disciplina</h2>";

foreach ($avaliacoes as $disciplina => $dados) {
  $html .= "<div class='card'>
    <h4>{$disciplina}</h4>
    <ul>";
  foreach ($dados as $item => $valor) {
    $pontoCompleto = $pontosCompletos[$item] ?? $item;
    $html .= "<li>{$pontoCompleto}: <strong>{$valor}</strong></li>";
  }
  $html .= "</ul>
  </div>";
}

$html .= "
<footer>
  Gerado automaticamente por SAD - Sistema de Avaliação de Docentes
</footer>

</body>
</html>
";

// Geração do PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("avaliacao_{$nome}.pdf", ["Attachment" => false]);
?>
