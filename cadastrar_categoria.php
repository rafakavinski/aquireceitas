<?php
session_start();
include("includes/conexao.php");

// Só admin pode acessar
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'admin') {
    header("Location: login.php");
    exit;
}

$erro = "";
$sucesso = "";

if (isset($_POST['cadastrar'])) {
    $nome = trim($_POST['nome']);

    if (empty($nome)) {
        $erro = "O nome da categoria é obrigatório.";
    } else {
        $sql = "INSERT INTO categorias (nome) VALUES ('$nome')";
        if (mysqli_query($conexao, $sql)) {
            $sucesso = "Categoria cadastrada com sucesso!";
        } else {
            $erro = "Erro ao cadastrar: " . mysqli_error($conexao);
        }
    }
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar Categoria - Aqui.Receitas</title>
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">

                <div class="card-header bg-danger text-white">
                    <h4><i class="bi bi-tag"></i> Cadastrar Categoria</h4>
                </div>

                <div class="card-body">

                    <?php if ($erro): ?>
                        <div class="alert alert-danger"><?= $erro ?></div>
                    <?php endif; ?>

                    <?php if ($sucesso): ?>
                        <div class="alert alert-success"><?= $sucesso ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nome da Categoria *</label>
                            <input type="text" class="form-control" name="nome" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" name="cadastrar" class="btn btn-danger flex-fill">
                                <i class="bi bi-check-circle"></i> Cadastrar
                            </button>