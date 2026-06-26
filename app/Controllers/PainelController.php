<?php
require_once __DIR__ . '/../Core/Controller.php';

class PainelController extends Controller {

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

        $demandas = [];
        $sql = "SELECT 
                    T.ID,
                    T.NOME_CHAMADO,
                    E.NOME_FANTASIA,
                    CASE T.STATUS
                        WHEN 0 THEN 'Cancelado'
                        WHEN 1 THEN 'Não iniciado'
                        WHEN 2 THEN 'iniciado'
                        ELSE 'Finalizado'
                    END AS STATUS
                FROM 
                    TASKS T, 
                    EMPRESA E
                WHERE 
                    T.EMPRESA_SOLICI_ID = E.ID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $demandas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $usuarios = [];
        $sql = "SELECT 
                    U.ID, 
                    U.NOME,
                    E.NOME_FANTASIA 
                FROM 
                    USERS U,
                    EMPRESA E
                WHERE U.EMPRESA_ID = E.ID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view('painel', [
            'empresas' => $empresas,
            'demandas' => $demandas,
            'usuarios' => $usuarios
        ]);
    }

    public function logoutAction()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header('Location: ' . url('/'));
        exit;
    }

}