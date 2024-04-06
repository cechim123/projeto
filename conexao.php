<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'produtos'; // Nome do seu banco de dados
$username = 'root'; // Seu nome de usuário do banco de dados
$password = '1234'; // Sua senha do banco de dados
$port = '3307'; // Porta do MySQL

try {
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
