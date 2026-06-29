<?php
session_start();
include("includes/conexao.php");

// Verifica se foi passado um ID
if (!isset($_GET['id'])) {
    header("Location: receitas.php");
    exit;
}

$id = $_GET['id'];

// Busca a receita com o nome da categoria
$sql = "SELECT receitas.*, categorias.nome AS categoria 
        FROM receitas 
        LEFT JOIN categorias ON receitas.id_categoria = categorias.id
        WHERE receitas.id = '$id'";

$resultado = mysqli_query($conexao, $sql);
$receita = mysqli_fetch_assoc($resultado);

// Se não encontrou, volta para a lista
if (!$receita) {
    header("Location: receitas.php");
    exit;
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $receita['titulo'] ?> - Aqui.Receitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand" href="index.php">Aqui.Receitas</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="receitas.php">Receitas</a></li>

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="cadastrar_receita.php">Cadastrar Receita</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Sair (<?= $_SESSION['usuario_nome'] ?>)</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastrar</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 mb-5">

    <!-- Botão voltar -->
    <a href="receitas.php" class="btn btn-outline-danger mb-4">
        <i class="bi bi-arrow-left"></i> Voltar para Receitas
    </a>

    <div class="card shadow">

        <!-- Foto -->
        <?php if (!empty($receita['foto'])): ?>
            <img src="img/<?= $receita['foto'] ?>" class="card-img-top" style="max-height:400px; object-fit:cover;">
        <?php endif; ?>

        <div class="card-body p-4">

            <!-- Título e badges -->
            <h2 class="card-title"><?= $receita['titulo'] ?></h2>
            <div class="mb-3">
                <span class="badge bg-danger fs-6"><?= $receita['categoria'] ?></span>
                <span class="badge bg-secondary fs-6"><?= $receita['dificuldade'] ?></span>
                <span class="badge bg-success fs-6">
                    <i class="bi bi-cash"></i> <?= $receita['preco'] ?>
                </span>
            </div>

            <hr>

            <!-- Ingredientes -->
            <h4><i class="bi bi-list-check"></i> Ingredientes</h4>
            <p style="white-space: pre-line;"><?= $receita['ingredientes'] ?></p>

            <hr>

            <!-- Modo de preparo -->
            <h4><i class="bi bi-journals"></i> Modo de Preparo</h4>
            <p style="white-space: pre-line;"><?= $receita['modo_preparo'] ?></p>

            <hr>

            <!-- Botões admin -->
            <?php if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] == 'admin'): ?>
                <div class="d-flex gap-2 mt-3">
                    <a href="editar_receita.php?id=<?= $receita['id'] ?>" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <a href="receitas.php?deletar=<?= $receita['id'] ?>"
                       class="btn btn-dark"
                       onclick="return confirm('Tem certeza que deseja deletar esta receita?')">
                        <i class="bi bi-trash"></i> Deletar
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<footer class="bg-danger text-white text-center p-3 mt-5">
    Aqui.Receitas — Desenvolvido por <strong>rafaela.tadsifpr@gmail.com</strong>
</footer>

</body>
</html>