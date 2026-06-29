<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include("includes/conexao.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$erro = "";
$sucesso = "";

$categorias = mysqli_query($conexao, "SELECT * FROM categorias");

if (isset($_POST['cadastrar'])) {

    $titulo       = trim($_POST['titulo']);
    $ingredientes = trim($_POST['ingredientes']);
    $modo_preparo = trim($_POST['modo_preparo']);
    $dificuldade  = $_POST['dificuldade'];
    $preco        = $_POST['preco'];
    $id_categoria = $_POST['id_categoria'];
    $id_usuario   = $_SESSION['usuario_id'];
    $foto         = "";

    if (empty($titulo) || empty($ingredientes) || empty($modo_preparo)) {
        $erro = "Preencha todos os campos obrigatórios.";
    } else {

        if (!empty($_FILES['foto']['name'])) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nome_foto = uniqid() . "." . $extensao;
            move_uploaded_file($_FILES['foto']['tmp_name'], "img/" . $nome_foto);
            $foto = $nome_foto;
        }

        $sql = "INSERT INTO receitas (titulo, ingredientes, modo_preparo, dificuldade, preco, foto, id_usuario, id_categoria)
                VALUES ('$titulo', '$ingredientes', '$modo_preparo', '$dificuldade', '$preco', '$foto', '$id_usuario', '$id_categoria')";

        if (mysqli_query($conexao, $sql)) {
            $sucesso = "Receita cadastrada com sucesso!";
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
    <title>Cadastrar Receita - Aqui.Receitas</title>
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
                <li class="nav-item"><a class="nav-link active" href="cadastrar_receita.php">Cadastrar Receita</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Sair (<?= $_SESSION['usuario_nome'] ?>)</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">

                <div class="card-header bg-danger text-white">
                    <h4><i class="bi bi-journal-plus"></i> Cadastrar Receita</h4>
                </div>

                <div class="card-body">

                    <?php if ($erro): ?>
                        <div class="alert alert-danger"><?= $erro ?></div>
                    <?php endif; ?>

                    <?php if ($sucesso): ?>
                        <div class="alert alert-success"><?= $sucesso ?> <a href="receitas.php">Ver receitas</a></div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Título da Receita *</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dificuldade</label>
                                <select class="form-select" name="dificuldade">
                                    <option value="Fácil">Fácil</option>
                                    <option value="Médio">Médio</option>
                                    <option value="Difícil">Difícil</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Categoria</label>
                                <select class="form-select" name="id_categoria">
                                    <?php while ($cat = mysqli_fetch_assoc($categorias)): ?>
                                        <option value="<?= $cat['id'] ?>"><?= $cat['nome'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Preço Estimado</label>
                            <select class="form-select" name="preco">
                                <option value="R$10-R$20">R$ 10 a R$ 20</option>
                                <option value="R$20-R$30">R$ 20 a R$ 30</option>
                                <option value="R$30-R$40">R$ 30 a R$ 40</option>
                                <option value="R$40-R$50">R$ 40 a R$ 50</option>
                                <option value="+R$50">Acima de R$ 50</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ingredientes *</label>
                            <textarea class="form-control" name="ingredientes" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Modo de Preparo *</label>
                            <textarea class="form-control" name="modo_preparo" rows="5" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto da Receita</label>
                            <input type="file" class="form-control" name="foto" accept="image/*">
                        </div>

                        <button type="submit" name="cadastrar" class="btn btn-danger w-100">
                            <i class="bi bi-check-circle"></i> Publicar Receita
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-danger text-white text-center p-3 mt-5">
    Aqui.Receitas — Desenvolvido por <strong>rafaela.tadsifpr@gmail.com</strong>
</footer>

</body>
</html>



