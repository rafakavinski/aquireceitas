<?php
session_start();
include("includes/conexao.php");

// Só admin pode acessar
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Deletar
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    mysqli_query($conexao, "DELETE FROM categorias WHERE id = '$id'");
    header("Location: categorias.php");
    exit;
}

$categorias = mysqli_query($conexao, "SELECT * FROM categorias ORDER BY nome");
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categorias - Aqui.Receitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand" href="index.php">Aqui.Receitas</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="receitas.php">Receitas</a></li>
                <li class="nav-item"><a class="nav-link active" href="categorias.php">Categorias</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-tags"></i> Categorias</h2>
        <a href="cadastrar_categoria.php" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Nova Categoria
        </a>
    </div>

    <?php if (mysqli_num_rows($categorias) == 0): ?>
        <div class="alert alert-warning">Nenhuma categoria cadastrada ainda.</div>
    <?php else: ?>

    <table class="table table-bordered table-hover">
        <thead class="table-danger">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($cat = mysqli_fetch_assoc($categorias)): ?>
            <tr>
                <td><?= $cat['id'] ?></td>
                <td><?= $cat['nome'] ?></td>
                <td>
                    <a href="editar_categoria.php?id=<?= $cat['id'] ?>" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <a href="categorias.php?deletar=<?= $cat['id'] ?>"
                       class="btn btn-dark btn-sm"
                       onclick="return confirm('Deletar esta categoria?')">
                        <i class="bi bi-trash"></i> Deletar
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php endif; ?>
</div>

<footer class="bg-danger text-white text-center p-3 mt-5">
    Aqui.Receitas — Desenvolvido por <strong>rafaela.tadsifpr@gmail.com</strong>
</footer>

</body>
</html>