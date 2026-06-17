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
        
        $this->view('painel', [
            'empresas' => $empresas
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