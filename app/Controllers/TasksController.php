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
            
            $sql = "SELECT * FROM TASKS WHERE NOME_CHAMADO = :NOME_CHAMADO AND EMPRESA_SOLICI_ID = :EMPRESA_SOLICI_ID";
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->execute([
                ':NOME_CHAMADO'        => $pDados['NOME_CHAMADO'],
                ':EMPRESA_SOLICI_ID'   => $pDados['EMPRESA']
            ]);

            $task = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($task) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Trefa já foi criada']);
                exit;
            }

            $sql = "INSERT INTO TASKS (EMPRESA_SOLICI_ID, USER_SOLICI_ID, USER_RESPO_ID, NOME_CHAMADO, TITULO, DESCRICAO) 
                    VALUES (:EMPRESA_SOLICI_ID, :USER_SOLICI_ID, :USER_RESPO_ID, :NOME_CHAMADO, :TITULO, :DESCRICAO)";
            $stmt = $this->pdo->prepare($sql);
            $resultado = $stmt->execute([
                ':EMPRESA_SOLICI_ID'    => $pDados['EMPRESA'],
                ':USER_SOLICI_ID'       => (int) $_SESSION['usuario_id'],
                ':USER_RESPO_ID'        => $pDados['USUARIO_RESPO'], 
                ':NOME_CHAMADO'         => $pDados['NOME_CHAMADO'],
                ':TITULO'               => $pDados['TITULO'],
                ':DESCRICAO'            => $pDados['DESCRICAO'],
            ]);

            if ($resultado) {
                echo json_encode(['status' => 'sucesso', 'mensagem' => 'Dados salvos com sucesso!']);
            } else {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao salvar os dados.']);
            }
        } 
        catch (PDOException $e) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar os dados: ' . $e->getMessage()]);
        }
    }

    public function deletarTaskAction() {
        $pDados = isset($_POST) ? $_POST : [];
        
        try {
            $sql = "DELETE FROM TASKS WHERE ID = :ID";
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->execute([
                ':ID' => (int) $pDados['ID']
            ]);
            
            header('Location: ' . url('/painel'));
        } 
        catch (PDOException $e) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao deletar: ' . $e->getMessage()]);
        }
    }
}