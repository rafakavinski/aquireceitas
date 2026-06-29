<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include("includes/conexao.php");

$erro = "";

if (isset($_POST['entrar'])) {

    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos.";
    } else {

        $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $usuario = mysqli_fetch_assoc($resultado);

            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id']   = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_tipo'] = $usuario['tipo'];

                if ($usuario['tipo'] == 'admin') {
                    header("Location: categorias.php");
                } else {
                    header("Location: receitas.php");
                }
                exit;

            } else {
                $erro = "Senha incorreta.";
            }
        } else {
            $erro = "E-mail não encontrado.";
        }
    }
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Aqui.Receitas</title>
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
                <li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastrar</a></li>
                <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="receitas.php">Receitas</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">

                <div class="card-header bg-danger text-white">
                    <h4><i class="bi bi-box-arrow-in-right"></i> Login</h4>
                </div>

                <div class="card-body">

                    <?php if ($erro): ?>
                        <div class="alert alert-danger"><?= $erro ?></div>
                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" required>
                        </div>

                        <button type="submit" name="entrar" class="btn btn-danger w-100">
                            <i class="bi bi-box-arrow-in-right"></i> Entrar
                        </button>

                    </form>

                    <hr>
                    <p class="text-center">Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>

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