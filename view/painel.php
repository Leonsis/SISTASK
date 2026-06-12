
<!DOCTYPE html>
<html lang="en" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SISTASKS - Painel</title>
        <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"> -->
        <!-- <link rel="stylesheet" href="../public/main.css"> -->    
        <link rel="stylesheet" href="../public/bootstrap-5.3.8/css/bootstrap.min.css">
        <script src="../public/bootstrap-5.3.8/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="../public/mainPainel.css">
        <link rel="stylesheet" href="../public/style.css">    

        <script src="https://cloudflare.com"></script>
        <script src="../public/jQuery.js"></script>
        <script src="../public/jquery.mask.min.js"></script>
        <script src="../public/main.js"></script>
    </head>
    <body class="painel">

        <main class="container pt-4">

            <nav class="nav-face navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">SISTASK</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Painel</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Empresas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Chamados</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                            </li> -->
                        </ul>
                        <!-- <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> -->
                    </div>
                </div>
            </nav>

            <div class='mt-5'>
                <table class="table tasks">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>John</td>
                            <td>Doe</td>
                            <td>@social</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        
    </body>
</html>