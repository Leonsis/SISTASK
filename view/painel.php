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
                    <li class="nav-item"><button class="btn btn-sm btn-primary">Sair</button></li>                    
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
                            <h3>Demandas</h3>
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
                                    <td class="dm">PF-52445</td>
                                    <td class="em">WTR SISTEMAS</td>
                                    <td class="ac">
                                        <button class="btn btn-sm btn-primary">Visualizar</button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="dm">PF-52445</td>
                                    <td class="em">CNA</td>
                                    <td class="ac">
                                        <button class="btn btn-sm btn-primary">Visualizar</button>    
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="home-buttons" style="margin-top: 10px; flex-direction: row-reverse;">
                        <a href="#projetos" class="btn btn-secondary">Tabela de damandas</a>
                        <a href="#projetos" class="btn btn-secondary">Cirar demanda</a>
                    </div>
                </div>
                
            </div>
        </section>
    </body>
</html>