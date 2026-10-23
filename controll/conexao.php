<?php 
// Conexão com a base de dados

$hostname = "127.0.0.1"; # o link onde esta a base de dados
$baseDados = "escolah"; # O nome da base de dados
$usuario = "root"; # O nome do usuário
$senha = ""; # A senha da base de dados

$mysqli = new mysqli($hostname, $usuario, $senha, $baseDados);
if ($mysqli->connect_errno) {
    echo "Falha ao conectar a base de dados!: (".$mysqli->connect_errno.")".$mysqli->connect_error;
}

?>