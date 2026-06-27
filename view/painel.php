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
                <div class="home-content">
                    <h1 class="home-title">Bem vindo ao  <span class="highlight">SISTESKS</span></h1>
                    <p class="home-subtitle">Seu sistema de controle de damandas</p>                
                </div>
                <div>
                    <div class="curso-item">
                        <div class="curso-header" <?= (!$demandas) ? 'style="justify-content: center !important;"' : '';?>>
                            <h3>
                                <?= ($demandas) ? 'Ultimas Demandas' : 'Você está sem demandas';?>
                            </h3>
                        </div>
                        <?php if($demandas): ?>
                            <table class="demandas ">
                                <thead>
                                    <tr>                                    
                                        <th class="dm">Demanda</th>
                                        <th class="st">Status</th>                                    
                                        <th class="em">Empresa</th>                                    
                                        <th class="ac">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                    <?php foreach(array_slice($demandas, 0, 4) as $demanda): ?>
                                        <tr>
                                            <td class="dm"><?= $demanda['NOME_CHAMADO']?></td>
                                            <td class="st"><?= $demanda['STATUS']?></td>
                                            <td class="em"><?= $demanda['NOME_FANTASIA']?></td>
                                            <td class="ac">
                                                <button class="btn btn-sm btn-primary">Visualizar</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>

                    <div class="home-buttons" style="margin-top: 10px; flex-direction: row-reverse;">
                        <a id="btnTabelaDemandas" class="btn btn-secondary">Tabela de damandas</a>
                        <a id="btnCriarDemandas" class="btn btn-secondary">Cirar demanda</a>
                    </div>
                </div>
                
            </div>
        </section>

        <section id="criarDemandas" class="educacao">
            <div class="container">
                <h2 class="section-title">Crie a Demanda</h2>
                <div class="educacao-grid">
                    <div class="form-item">
                        <form id="formCreateTask">
                            <div class="input-box">
                                <label for="EMPRESA">Empresa no qual solicitou o chamado</label>
                                <select name="EMPRESA" id="EMPRESA" required>
                                    <?php foreach($empresas as $empresa): ?>
                                        <option value="<?= $empresa['ID'] ?>">
                                            <?= htmlspecialchars($empresa['NOME_FANTASIA']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="toggle-link" style="margin: 0px; !important">Sua empresa está <a href="<?= url('/cadastro-empresa')?>">cadastrada</a>?</p>
                            </div>
                            <div class="input-box">
                                <label for="USUARIO_RESPO">Responsavel pelo chamado</label>
                                <select name="USUARIO_RESPO" id="USUARIO_RESPO" required>
                                    <?php foreach($usuarios as $usuario): ?>
                                        <option value="<?= $usuario['ID'] ?>">
                                            <?= htmlspecialchars($usuario['NOME']) . ' | ' . htmlspecialchars($usuario['NOME_FANTASIA'])?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-box">
                                <label for="NOME_CHAMADO">Nome do chamado</label>
                                <input id="NOME_CHAMADO" name="NOME_CHAMADO" type="text" required>
                            </div>
                            <div class="input-box">
                                <label for="TITULO">Titulo do chamdo</label>
                                <input id="TITULO" name="TITULO" type="text" required>
                            </div>
                            <div class="input-box">
                                <label for="DESCRICAO">Descrição do chamado</label>
                                <textarea name="DESCRICAO" id=" " rows="5" cols="33" required></textarea>
                            </div>
                            <button style="border: 0px;" type="submit" class="curso-badge">Criar Chamado</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="tabelaDemandas" class="educacao">
            <div class="container">
                <h2 class="section-title">Tabela de Demandas</h2>
                <div class="educacao-grid">
                    <div class="table-container">
                        <?php if($demandas): ?>
                            <table class="demandas">
                                <thead>
                                    <tr>                                    
                                        <th class="dm">Demanda</th>
                                        <th class="em">Empresa</th>
                                        <th class="st">Status</th>
                                        <th class="dt">Data de Criação</th>
                                        <th class="ac">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                    <?php foreach($demandas as $demanda): ?>
                                        <tr style="border-bottom: 1px solid;">
                                            <td class="dm"><?= $demanda['NOME_CHAMADO']?></td>                                            
                                            <td class="em"><?= $demanda['NOME_FANTASIA']?></td>
                                            <td class="st"><?= $demanda['STATUS']?></td>
                                            <td class="dt"><?= $demanda['DATA_CRIACAO']?></td>
                                            <td class="ac">
                                                <button class="btn btn-sm btn-primary">Visualizar</button>
                                                <button class="btn btn-sm btn-primary">Deletar</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                $('#logoutAction').on('click', function() {
                    window.location.href = '<?= url('/logout-action')?>';
                });
                
                $('#criarDemandas').hide();             
                $('#btnCriarDemandas').on('click', function() {
                    $('#criarDemandas').show();
                    $('#tabelaDemandas').hide();
                    $('#btnCriarDemandas').attr('href', '#criarDemandas');
                });

                $('#tabelaDemandas').hide();             
                $('#btnTabelaDemandas').on('click', function() {
                    $('#tabelaDemandas').show();
                    $('#criarDemandas').hide();
                    $('#btnTabelaDemandas').attr('href', '#tabelaDemandas');
                });
            });

            jQuery(document).ready(function($) {
                $('#formCreateTask').on('submit', function(e) {
                    e.preventDefault();

                    let dadosFormulario = $(this).serialize();
                    $.ajax({
                        url: '<?= url('/criar-task-action') ?>',
                        type: 'POST',
                        data: dadosFormulario,
                        dataType: 'json',
                        success: function(resposta) {                            
                            if (resposta.status === 'sucesso') {
                                alert('Chamado Criado');
                                window.location.href = '<?= url('/painel') ?>';
                            } else {
                                alert('Erro: ' + resposta.mensagem);
                                window.location.href = '<?= url('/painel') ?>';
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Erro de comunicação com o servidor.');
                            console.log('Status do Erro:', xhr.status);
                            console.log('Texto do Status:', status);
                            console.log('Erro Lançado:', error);
                            console.log('Resposta do Servidor:', xhr.responseText);
                        }
                    });
                });
            });
        </script>
    </body>
</html>