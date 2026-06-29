<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aqui.Receitas</title>
    
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CDN (Content Delivery Network para ícones do Bootstrap) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

 

  
  <!-- Barra de Navegação -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-danger fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="inicial.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="conectar.html">Conectar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tabela.html">Avaliações de receitas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="CadastrodeReceita.html">Cadastre sua receita</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="text" placeholder="Pesquisar">
          <button class="btn btn-primary" type="button">Pesquisar</button>
        </form>
        &nbsp
        <a href="conectar.html">
        <button class="btn btn-primary" type="button"  title="Login"><i class="bi bi-person-circle" style="width:100px;"></i></button></a>
    </div>
  </nav>


  <!-- Container que abrigará o conteúdo da página -->
  <div class="container" style="margin-top:100px; margin-bottom:100px;">

    <div class="alert alert-success" role="alert">
      O SITE COM MAIS DE 3.000 RECEITAS DIVERSAS!
    </div>


      <!-- Container que abrigará o menu superior (Com dropdowns)-->
      <div class="border border-danger" style="margin-top:30px; margin-bottom:30px;">
        <h1> <img src="img/Aqui.Receitaas.png" width="200" height="100"></img></h1>
        
        
        <!-- Example single danger button -->
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Jantar
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Feijoada</a>
              <a class="dropdown-item" href="#">Strogonoff</a>
              <a class="dropdown-item" href="#">Macarrão</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Mostrar mais...</a>

            </div>
          </div>
          
          <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sobremesas
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="Receita.html">Bolo de chocolate</a>
              <a class="dropdown-item" href="#">Pudim Clássico</a>
              <a class="dropdown-item" href="#">Somethin</a>
              <div class="dropdown-divider"></div>
              <a class ="dropdown-item" href="#">Mostrar mais</a>
            </div>
          </div>

          <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Caldos
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Sopa de mandioca</a>
              <a class="dropdown-item" href="#">Galinhada</a>
              <a class="dropdown-item" href="#">Ensopado de feijão</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Mostrar mais...</a>
            </div>
          </div>

          <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Outras
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Pratos principais</a>
            <a class="dropdown-item" href="#">Entradas</a>
            <a class="dropdown-item" href="#">Pratos para datas especiais</a>
            <div class="dropdown-divider"></div>
          </div>

        </div>
      </div>
    

          
      <!-- Carousel -->
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

          <!-- Indicators/dots -->
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
          </div>

          <!-- The slideshow/carousel -->
          <div class="carousel-inner">
            <div class="carousel-item active"><h1>Bolo de Chocolate</h1>
              <a href="Receita.html">
              <img src="img/boloChocolate.jpeg"  alt="Bolo de Chocolate" width="1000" height="450" title="Bolo de Chocolate" class="d-block w-100"></a>
            </div>
            <div class="carousel-item"><h1>Salpicao</h1>
              <img src="img/salpicao.jpeg" alt="Descrição da imagem" width="1000" height="450"alt="Coxinha" title="Coxinha" class="d-block w-100">
            </div>
            <div class="carousel-item"><h1>Pizza caseira</h1>
              <img src="img/pizza.jpeg" alt="Pizza"  width="1000" height="450" title="Pizza" class="d-block w-100">
            </div>
          </div>

          <!-- Left and right controls/icons -->
          <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>

        <!-- Fim da div do carrossel -->
        <br>
       

        <!-- Grid para exibir receitas -->
        <div class="row">
          <div class="col-3">
            <div class="card">
              <img class="card-img-top" src="img/camarao.jpeg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Moqueca</h5>
                <p class="card-text">Aprenda a fazer a receita mais pesquisada da semana.</p>
                <a href="#" class="btn btn-primary">Vamos lá!</a>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="card">
              <img class="card-img-top" src="img/natal.jpeg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Ceia de Natal</h5>
                <p class="card-text">Venha conferir as melhores receitas de natal.</p>
                <a href="#" class="btn btn-primary">Vamos lá!</a>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="card">
              <img class="card-img-top" src="img/bolo2222.jpeg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Bolo para Aniversário</h5>
                <p class="card-text">Que tal fazer um bolo tornando essa data mais especial?</p>
                <a href="#" class="btn btn-primary">Vamos lá!</a>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="card">
              <img class="card-img-top" src="img/panqueca.jpeg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Panqueca</h5>
                <p class="card-text">Um receita simples e fácil que vai te surpreender!</p>
                <a href="#" class="btn btn-primary">Vamos lá!</a>
              </div>
            </div>
          </div>
        </div>
  
  </div>  
   

<div class="mt-5 bg-danger text-white text-center fixed-bottom">
  <p>
      Interfaces para um sistema de Receita<br>
      Desenvolvido por
      <b><a href="mailto:paulo.silva@ifpr.edu.br?subject=Tecnologias Web">rafaela.tadsifpr@gmail.com</a></b> 
  </p>
</div>
</body>
</html>
