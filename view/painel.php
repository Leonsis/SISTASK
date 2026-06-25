<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SISTASKS Login</title>
        <link rel="stylesheet" href="/SisTasks/public/styles.css">
        <script src="/SisTasks/public/jQuery.js"></script>
        <script src="/SisTasks/public/jquery.mask.min.js"></script>
        <script src="/SisTasks/public/script.js"></script>
    </head>
    <body>
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
                    <h1 class="home-title">Bem vindo ao  <span class="highlight">SISTESk</span></h1>
                    <p class="home-subtitle">Seu sistema de controle de damandas</p>                
                </div>
                <div>
                    <div class="curso-item">
                        <div class="curso-header">
                            <h3>Ultimas Demandas</h3>
                        </div>
                        <table class="demandas ">
                            <thead>
                                <tr>                                    
                                    <th class="dm">Demanda</th>
                                    <th class="em">Empresa</th>                                    
                                    <th class="ac">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach($demandas as $demanda): ?>
                                        <td class="dm"><?= $demanda['NOME_CHAMADO']?></td>
                                        <td class="em"><?= $demanda['NOME_FANTASIA']?></td>
                                        <td class="ac">
                                            <button class="btn btn-sm btn-primary">Visualizar</button>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="home-buttons" style="margin-top: 10px; flex-direction: row-reverse;">
                        <a href="#projetos" class="btn btn-secondary">Tabela de damandas</a>
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
        <script>
            $(document).ready(function() {
                $('#logoutAction').on('click', function() {
                    window.location.href = '<?= url('/logout-action')?>';
                });
                
                $('#criarDemandas').hide();             
                $('#btnCriarDemandas').on('click', function() {
                    $('#criarDemandas').show();
                    $('#btnCriarDemandas').attr('href', '#criarDemandas');
                });
            });

            jQuery(document).ready(function($) {
                $('#formCreateTask').on('submit', function(e) {
                    e.preventDefault();

                    let dadosFormulario = $(this).serialize();
                    //console.log(dadosFormulario);
                    //debugger;
                    $.ajax({
                        url: '<?= url('/criar-task-action') ?>',
                        type: 'POST',
                        data: dadosFormulario,
                        dataType: 'json',
                        success: function(resposta) {
                            if (resposta.status === 'sucesso') {
                                //window.location.href = '<?= url('/painel') ?>';
                            } else {
                                alert('Erro: ' + resposta.mensagem);
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