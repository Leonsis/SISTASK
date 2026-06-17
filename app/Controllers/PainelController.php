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
        $empresas = [];

        $sql = "SELECT ID, NOME_FANTASIA FROM EMPRESA";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        $this->view('painel', [
            'empresas' => $empresas
        ]);
    }

}