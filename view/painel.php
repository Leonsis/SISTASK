<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
    <?php include 'inc/head.php'; ?>
    <style>
        <?php if(count($demandas) > 1): ?>
            table tbody tr{
                box-shadow: 0px 1px #f5b645;
            }
        <?php endif; ?>
    </style>   
    <body id="painel">
        
        <?php include 'inc/nav.php'; ?>
        
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
                            <table>
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
                                        <tr <?= (count($demandas) > 1) ? 'style="box-shadow: inset 0 -1px 0 #f5b64569;"' : '' ?>>
                                            <td class="dm"><?= $demanda['NOME_CHAMADO']?></td>
                                            <td class="st"><?= $demanda['STATUS']?></td>
                                            <td class="em"><?= $demanda['NOME_FANTASIA']?></td>
                                            <td class="ac">                                                
                                                <form method="GET" action="<?= url('/task') ?>" style="display:inline;">
                                                    <input type="hidden" name="ID" value="<?= $demanda['ID'] ?>">
                                                    <button class="btn btn-sm btn-primary">Visualizar</button>
                                                </form>
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
                                <label for="DESCRICAO">Escreva os detalhes do chamado</label>
                                <div class="editor" style="height:200px;"></div>
                                <input type="hidden" name="DESCRICAO" id="DESCRICAOCreateTask">
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
                                        <tr <?= (count($demandas) > 1) ? 'style="box-shadow: inset 0 -1px 0 #f5b64569;"' : '' ?>>
                                            <td class="dm"><?= $demanda['NOME_CHAMADO']?></td>                                            
                                            <td class="em"><?= $demanda['NOME_FANTASIA']?></td>
                                            <td class="st"><?= $demanda['STATUS']?></td>
                                            <td class="dt"><?= $demanda['DATA_CRIACAO']?></td>
                                            <td class="ac">
                                                 <!-- Visualizar -->
                                                <form method="GET" action="<?= url('/task') ?>" style="display:inline;">
                                                    <input type="hidden" name="ID" value="<?= $demanda['ID'] ?>">
                                                    <button class="btn btn-sm btn-primary">Visualizar</button>
                                                </form>

                                                <!-- Deletar -->
                                                <form method="POST" action="<?= url('/deletar-task-action')?>" style="display:inline;">
                                                    <input type="hidden" name="ID" value="<?= $demanda['ID'] ?>">
                                                    <button class="btn btn-sm btn-primary" onclick="return confirm('Deseja realmente deletar?')">
                                                        Deletar
                                                    </button>
                                                </form>
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

            const quill = new Quill('.editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['link'],
                        ['clean']
                    ]
                }
            });
            const form = document.getElementById('formCreateTask');

            form.addEventListener('submit', function () {
                document.getElementById('DESCRICAOCreateTask').value = quill.root.innerHTML;
            });

            $(document).ready(function() {                                
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