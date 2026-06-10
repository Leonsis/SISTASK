<?php
$host = 'localhost'; // ou o IP do seu servidor
$dbname = 'SisTasks';
$username = 'root';
$password = 'root';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    
    // Configura o PDO para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "Conexão realizada com sucesso!";
    
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}