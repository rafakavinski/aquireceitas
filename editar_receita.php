<?php
session_start();
include("includes/conexao.php");

// Só admin pode editar
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$erro = "";
$sucesso = "";

// Busca a receita atual
$sql = "SELECT * FROM receitas WHERE id = '$id'";
$resultado = mysqli_query($conexao, $sql);
$receita = mysqli_fetch_assoc($resultado);

if (!$receita) {
    header("Location: receitas.php");
    exit;
}

// Busca categorias
$categorias = mysqli_query($conexao, "SELECT * FROM categorias");

if (isset($_POST['salvar'])) {

    $titulo       = trim($_POST['titulo']);
    $ingredientes = trim($_POST['ingredientes']);
    $modo_preparo = trim($_POST['modo_preparo']);
    $dificuldade  = $_POST['dificuldade'];
    $preco        = $_POST['preco'];
    $id_categoria = $_POST['id_categoria'];
    $foto         = $receita['foto']; // mantém foto antiga por padrão

    // Validação server-side
    if (empty($titulo) || empty($ingredientes) || empty($modo_preparo)) {
        $erro = "Preencha todos os campos obrigatórios.";
    } else {

        // Nova foto enviada?
        if (!empty($_FILES['foto']['name'])) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nome_foto = uniqid() . "." . $extensao;
            move_uploaded_file($_FILES['foto']['tmp_name'], "img/" . $nome_foto);
            $foto = $nome_foto;
        }

        $sql = "UPDATE receitas SET 
                    titulo = '$titulo',
                    ingredientes = '$ingredientes',
                    modo_preparo = '$modo_preparo',
                    dificuldade = '$dificuldade',
                    preco = '$preco',
                    foto = '$foto',
                    id_categoria = '$id_categoria'
                WHERE id = '$id'";

        if (mysqli_query($conexao, $sql)) {
            $sucesso = "Receita atualizada com sucesso!";
            // Recarrega os dados atualizados
            $receita = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM receitas WHERE id = '$id'"));
        } else {
            $erro = "Erro ao atualizar: " . mysqli_error($conexao);
        }
    }
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Receita - Aqui.Receitas</title>
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
                <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">

                <div class="card-header bg-danger text-white">
                    <h4><i class="bi bi-pencil-square"></i> Editar Receita</h4>
                </div>

                <div class="card-body">

                    <?php if ($erro): ?>
                        <div class="alert alert-danger"><?= $erro ?></div>
                    <?php endif; ?>

                    <?php if ($sucesso): ?>
                        <div class="alert alert-success"><?= $sucesso ?></div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Título da Receita *</label>
                            <input type="text" class="form-control" name="titulo"
                                   value="<?= $receita['titulo'] ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dificuldade</label>
                                <select class="form-select" name="dificuldade">
                                    <?php foreach (['Fácil', 'Médio', 'Difícil'] as $d): ?>
                                        <option value="<?= $d ?>" <?= $receita['dificuldade'] == $d ? 'selected' : '' ?>>
                                            <?= $d ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Categoria</label>
                                <select class="form-select" name="id_categoria">
                                    <?php while ($cat = mysqli_fetch_assoc($categorias)): ?>
                                        <option value="<?= $cat['id'] ?>"
                                            <?= $receita['id_categoria'] == $cat['id'] ? 'selected' : '' ?>>
                                            <?= $cat['nome'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Preço Estimado</label>
                            <select class="form-select" name="preco">
                                <?php
                                $precos = ['R$10-R$20', 'R$20-R$30', 'R$30-R$40', 'R$40-R$50', '+R$50'];
                                foreach ($precos as $p):
                                ?>
                                    <option value="<?= $p ?>" <?= $receita['preco'] == $p ? 'selected' : '' ?>>
                                        <?= $p ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ingredientes *</label>
                            <textarea class="form-control" name="ingredientes" rows="4" required><?= $receita['ingredientes'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Modo de Preparo *</label>
                            <textarea class="form-control" name="modo_preparo" rows="5" required><?= $receita['modo_preparo'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto atual</label><br>
                            <?php if (!empty($receita['foto'])): ?>
                                <img src="img/<?= $receita['foto'] ?>" height="100" class="mb-2 rounded"><br>
                            <?php else: ?>
                                <span class="text-muted">Sem foto cadastrada</span><br>
                            <?php endif; ?>
                            <label class="form-label mt-2">Trocar foto (opcional)</label>
                            <input type="file" class="form-control" name="foto" accept="image/*">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" name="salvar" class="btn btn-danger flex-fill">
                                <i class="bi bi-check-circle"></i> Salvar Alterações
                            </button>
                            <a href="receitas.php" class="btn btn-secondary flex-fill">
                                <i class="bi bi-x-circle"></i> Cancelar
                            </a>
                        </div>

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