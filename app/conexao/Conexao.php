<?php
$host = '192.168.0.199'; // ou o IP do seu servidor/computador
$port = '3306';
$dbname = 'SisTasks';
$username = 'caio';
$password = '22060122';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    
    // Configura o PDO para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "Conexão realizada com sucesso!";
    
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}