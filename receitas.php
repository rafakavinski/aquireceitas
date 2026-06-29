<?php
session_start();
include("includes/conexao.php");

// Deletar receita (só admin)
if (isset($_GET['deletar']) && isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] == 'admin') {
    $id = $_GET['deletar'];
    mysqli_query($conexao, "DELETE FROM receitas WHERE id = '$id'");
    header("Location: receitas.php");
    exit;
}

// Busca receitas junto com o nome da categoria
$sql = "SELECT receitas.*, categorias.nome AS categoria 
        FROM receitas 
        LEFT JOIN categorias ON receitas.id_categoria = categorias.id
        ORDER BY receitas.id DESC";

$resultado = mysqli_query($conexao, $sql);
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receitas - Aqui.Receitas</title>
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
                <li class="nav-item"><a class="nav-link active" href="receitas.php">Receitas</a></li>

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

<div class="container mt-5">

    <h2 class="mb-4"><i class="bi bi-journal-richtext"></i> Receitas</h2>

    <?php if (mysqli_num_rows($resultado) == 0): ?>
        <div class="alert alert-warning">Nenhuma receita cadastrada ainda.</div>
    <?php else: ?>

    <div class="row">
        <?php while ($receita = mysqli_fetch_assoc($resultado)): ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">

                <?php if (!empty($receita['foto'])): ?>
                    <img src="img/<?= $receita['foto'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                <?php else: ?>
                    <div class="bg-secondary text-white text-center p-5">Sem foto</div>
                <?php endif; ?>

                <div class="card-body">
                    <h5 class="card-title"><?= $receita['titulo'] ?></h5>
                    <p class="card-text">
                        <span class="badge bg-danger"><?= $receita['categoria'] ?></span>
                        <span class="badge bg-secondary"><?= $receita['dificuldade'] ?></span>
                    </p>
                    <p class="card-text"><small class="text-muted">Preço estimado: <?= $receita['preco'] ?></small></p>
                </div>

                <div class="card-footer d-flex gap-2">
                    <a href="receita.php?id=<?= $receita['id'] ?>" class="btn btn-danger btn-sm flex-fill">
                        <i class="bi bi-eye"></i> Ver
                    </a>

                    <?php if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] == 'admin'): ?>
                        <a href="editar_receita.php?id=<?= $receita['id'] ?>" class="btn btn-warning btn-sm flex-fill">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <a href="receitas.php?deletar=<?= $receita['id'] ?>"
                           class="btn btn-dark btn-sm flex-fill"
                           onclick="return confirm('Tem certeza que deseja deletar?')">
                            <i class="bi bi-trash"></i> Deletar
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <?php endif; ?>
</div>

<footer class="bg-danger text-white text-center p-3 mt-5">
    Aqui.Receitas — Desenvolvido por <strong>rafaela.tadsifpr@gmail.com</strong>
</footer>

</body>
</html>