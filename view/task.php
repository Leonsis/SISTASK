<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SISTASKS Login</title>
        <link rel="stylesheet" href="/SisTasks/public/styles.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <script src="/SisTasks/public/jQuery.js"></script>
        <script src="/SisTasks/public/jquery.mask.min.js"></script>
        <script src="/SisTasks/public/script.js"></script>
    </head>
    <body id="painel">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <h2>SISTASKS</h2>
                </div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <button id="logoutAction" class="btn btn-sm btn-primary">Sair</button>
                    </li>                    
                </ul>
            </div>
        </nav>

        <section id="home" class="home">
            <div class="home-container">
                
                <div>
                    <h3>
                        Chamdo: <?= $task[0]['NOME_CHAMADO']; ?>
                    </h3>
                    <div class="curso-item" style="width: 900px; margin-top: 15px;">
                        <div class="curso-header">
                            <h3>
                                <?= $task[0]['TITULO']; ?>
                            </h3>
                        </div>
                        <div>
                            <h3>Descrição</h3>
                            <p>
                                <?= $task[0]['DESCRICAO']; ?>
                            </p>
                        </div>
                    </div>
                    
                </div>

                <div class="home-content">
                    <div>
                        status: 
                        <select name="EMPRESA" id="EMPRESA" required>
                            <?php
                                $status = [
                                    0 => 'Cancelado',
                                    1 => 'Não iniciado',
                                    2 => 'Iniciado',
                                    3 => 'Finalizado'
                                ];
                            ?>

                            <?php foreach ($status as $id => $nome): ?>
                                <option <?php ($task[0]['ID'] == $id) ? 'select' : ''?> value="<?= $id ?>">
                                    <?= $nome ?>
                                </option>
                            <?php endforeach; ?>    
                        </select>
                        <?= $task[0]['STATUS']; ?>
                    </div>
                    <div>
                        Criado em: <?= $task[0]['DATA_CRIACAO']; ?>
                    </div>
                    <div>
                        Empressa solicitante: <?= $task[0]['EMPRESA']; ?>
                    </div>
                    <div>
                        Solicitante: <?= $task[0]['USUARIO_SOLICITANTE']; ?>
                    </div>
                    <div>
                        Responsavel: <?= $task[0]['USUARIO_RESPONSAVEL']; ?>
                    </div>
                    <div>
                        Tempo gasto: 
                    </div>
                </div>
            </div>
        </section>

    </body>
</html>