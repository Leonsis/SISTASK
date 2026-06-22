<?php
require_once __DIR__ . '/../Core/Controller.php';

class TasksController extends Controller {

    private $pdo;

    public function __construct() {
        // global $pdo;
        require_once __DIR__ . '/../conexao/Conexao.php';
        $this->pdo = $pdo;
    }

    public function viewPainel()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
            header('Location: ' . url('/'));
            exit;
        }

        $empresas = [];

        $sql = "SELECT ID, NOME_FANTASIA FROM EMPRESA";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        $this->view('painel', [
            'empresas' => $empresas
        ]);
    }

    public function criarTaskAction() 
    {
        $pDados = isset($_POST) ? $_POST : [];

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        try {
            
            $sql = "SELECT * FROM TASKS WHERE NOME_CHAMADO = :NOME_CHAMADO AND EMPRESA_ID = :EMPRESA_ID";
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->execute([
                ':NOME_CHAMADO' => $pDados['NOME_CHAMADO'],
                ':EMPRESA_ID'   => $pDados['EMPRESA']
            ]);

            $task = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($task) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Trefa á foi criada']);
                exit;
            }
            
            $sql2 = "INSERT INTO TASKS (USER_ID, EMPRESA_ID, NOME_CHAMADO, TITULO, DESCRICAO) 
                    VALUES (:USER_ID, :EMPRESA_ID, :NOME_CHAMADO, :TITULO, :DESCRICAO)";
            $stmt = $this->pdo->prepare($sql2);
            $dados = [
                'USER_ID'           => $_SESSION['usuario_id'],
                ':EMPRESA_ID'       => $pDados['EMPRESA'],
                ':NOME_CHAMADO'     => $pDados['NOME_CHAMADO'],
                ':TITULO'           => $pDados['TITULO'],                
                ':DESCRICAO'        => $pDados['DESCRICAO'],
            ];

            if ($stmt->execute($dados)) {
                echo json_encode(['status' => 'sucesso', 'mensagem' => 'Dados salvos com sucesso!']);
            } else {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao salvar os dados.']);
            }
        } 
        catch (PDOException $e) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar os dados: ' . $e->getMessage()]);
        }
    }

}