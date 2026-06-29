<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aqui.Receitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-danger fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Aqui.Receitas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="receitas.php">Receitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastrar_receita.php">Cadastre sua receita</a>
                </li>
            </ul>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <span class="text-white me-3">Olá, <?= $_SESSION['usuario_nome'] ?>!</span>
                <?php if ($_SESSION['usuario_tipo'] == 'admin'): ?>
                    <a href="categorias.php" class="btn btn-outline-light btn-sm me-2">Categorias</a>
                <?php endif; ?>
                <a href="logout.php" class="btn btn-light btn-sm">Sair</a>
            <?php else: ?>
                <a href="cadastro.php" class="btn btn-outline-light btn-sm me-2">Cadastrar</a>
                <a href="login.php" class="btn btn-light btn-sm">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container" style="margin-top:100px; margin-bottom:100px;">

    <div class="alert alert-success" role="alert">
        O SITE COM MAIS DE 3.000 RECEITAS DIVERSAS!
    </div>

    <div class="border border-danger" style="margin-top:30px; margin-bottom:30px;">
        <h1><img src="img/Aqui.Receitaas.png" width="200" height="100"></h1>

        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">Jantar</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="receitas.php">Mostrar todas</a>
            </div>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">Sobremesas</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="receitas.php">Mostrar todas</a>
            </div>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">Caldos</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="receitas.php">Mostrar todas</a>
            </div>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">Outras</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="receitas.php">Mostrar todas</a>
            </div>
        </div>
    </div>

    <!-- Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <h1>Bolo de Chocolate</h1>
                <img src="img/boloChocolate.jpeg" alt="Bolo de Chocolate" class="d-block w-100" height="450" style="object-fit:cover;">
            </div>
            <div class="carousel-item">
                <h1>Salpicão</h1>
                <img src="img/salpicao.jpeg" alt="Salpicão" class="d-block w-100" height="450" style="object-fit:cover;">
            </div>
            <div class="carousel-item">
                <h1>Pizza caseira</h1>
                <img src="img/pizza.jpeg" alt="Pizza" class="d-block w-100" height="450" style="object-fit:cover;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <br>

    <div class="row mt-4">
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="img/camarao.jpeg" alt="Moqueca">
                <div class="card-body">
                    <h5 class="card-title">Moqueca</h5>
                    <p class="card-text">Aprenda a fazer a receita mais pesquisada da semana.</p>
                    <a href="receitas.php" class="btn btn-danger">Vamos lá!</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="img/natal.jpeg" alt="Ceia de Natal">
                <div class="card-body">
                    <h5 class="card-title">Ceia de Natal</h5>
                    <p class="card-text">Venha conferir as melhores receitas de natal.</p>
                    <a href="receitas.php" class="btn btn-danger">Vamos lá!</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="img/bolo2222.jpeg" alt="Bolo Aniversário">
                <div class="card-body">
                    <h5 class="card-title">Bolo para Aniversário</h5>
                    <p class="card-text">Que tal fazer um bolo tornando essa data mais especial?</p>
                    <a href="receitas.php" class="btn btn-danger">Vamos lá!</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="img/panqueca.jpeg" alt="Panqueca">
                <div class="card-body">
                    <h5 class="card-title">Panqueca</h5>
                    <p class="card-text">Uma receita simples e fácil que vai te surpreender!</p>
                    <a href="receitas.php" class="btn btn-danger">Vamos lá!</a>
                </div>
            </div>
        </div>
    </div>

</div>

<footer class="bg-danger text-white text-center p-3 fixed-bottom">
    Aqui.Receitas — Desenvolvido por <strong>Rafaela Kavinski</strong>
</footer>

</body>
</html>