<?php
include "conexao.php";

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();







// Verifica se não há a variável da sessão que identifica o usuário
if (isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
   /* session_destroy();
   
    // Redireciona o visitante de volta pro login
    header("Location: login.php"); exit;*/
    $name = explode(" ", $_SESSION['UsuarioNome']);
}else{
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['cart'])) {
    // Destrói a sessão por segurança
    /* session_destroy();

     // Redireciona o visitante de volta pro login
     header("Location: login.php"); exit;*/
    $cartsize = count($_SESSION['cart']);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Fábio Alberto da Silva" />
    <title>e-Commerce</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
<!-- Navigation-->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">e-Commerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorias</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Esporte</a></li>
                        <li><a class="dropdown-item" href="#!">Informática</a></li>
                        <li><a class="dropdown-item" href="#!">Eletrodomésticos</a></li>
                        <li><a class="dropdown-item" href="#!">Móveis</a></li>
                        <li><a class="dropdown-item" href="#!">Moda</a></li>
                        <li><a class="dropdown-item" href="#!">Acessórios</a></li>
                        <li><a class="dropdown-item" href="#!">Ferramentas</a></li>
                        <!--  <li><hr class="dropdown-divider" /></li>
                          <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                          <li><a class="dropdown-item" href="#!">New Arrivals</a></li> !-->
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link active" href="#!">Ofertas</a></li>

            </ul>
            <form action="search.php" method="post" class="d-flex me-5">
                <input class="form-control me-2" name="search" id="search" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
            </form>

            <form action="cliente.php" method="post" class="d-flex me-2">
                <button class="btn btn-outline-dark" type="submit"><i class="bi bi-person-fill"> <?php if (isset($_SESSION['UsuarioID']))  echo $name[0]  ?></i></button>
            </form>

            <form class="d-flex">
                <a href="carrinho.php" class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>

                    <span class="badge bg-dark text-white ms-1 rounded-pill"><?php if (isset($_SESSION['cart'])){  echo $cartsize;}else{ echo 0;}  ?></span>
                </a>
            </form>
        </div>
    </div>
</nav>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">


        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; e-Commerce 2021</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>

