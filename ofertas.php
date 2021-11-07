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
                        <li><a class="dropdown-item" href="lista.php?categoria=esporte">Esporte</a></li>
                        <li><a class="dropdown-item" href="lista.php?categoria=tecnologia">Tecnologia</a></li>
                        <li><a class="dropdown-item" href="lista.php?categoria=eletrodoméstico">Eletrodomésticos</a></li>
                        <li><a class="dropdown-item" href="lista.php?categoria=móvel">Móveis</a></li>
                        <li><a class="dropdown-item" href="lista.php?categoria=moda">Moda</a></li>
                        <li><a class="dropdown-item" href="lista.php?categoria=acessório">Acessórios</a></li>
                        <li><a class="dropdown-item" href="lista.php?categoria=ferramenta">Ferramentas</a></li>
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
            <?php
            $querySelect = "SELECT * FROM produtos WHERE PROMOCAO = 1";
            $result = mysqli_query($conn, $querySelect);
            while($row = mysqli_fetch_assoc($result)) {
                $valorAntigo = $row['PRECO'];
                $valorNovo = $row['PRECO'] - $row['DESCONTO'];

                $aux = ($valorNovo - $valorAntigo) / $valorAntigo * 100;
                //$aux2 = $aux / 1000 * 100;
                $resultado = number_format(abs($aux)); ///* 100;
                echo "<div class='col mb-5'>
                <div class='card h-100'><div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>{$row['CATEGORIA']}</div><a href='produto.php?id={$row['ID']}&descricao={$row['DESCRICAO']}'><img class='card-img-top' src='{$row['IMG_PATH']}' alt='...'/></a><div class='card-body p-4'>
                        <div class='text-center'>
                        <div class='badge bg-danger text-black mb-2'><strong>PROMOÇÃO</strong></div>
                       
                            <!-- Product name-->
                            <a href='produto.php?id={$row['ID']}&descricao={$row['DESCRICAO']}' style='text-decoration:none'><h5 class='fw-bolder text-black'>{$row['DESCRICAO']}</h5></a>
                            <!-- Product reviews-->
                            <div class='d-flex justify-content-center small text-warning mb-2'>";

                            for($i = 1; $i <= $row['STAR_AVALIACAO']; $i++){

                          echo "<div class='bi-star-fill'></div>
                              
                            ";
                            }


                echo "</div><span class='text-muted text-decoration-line-through'>R$ $valorAntigo</span>
                            R$ $valorNovo
                        </div>
                        <div class='text-center'>
                         <div class='badge bg-danger text-white mt-2'><strong>$resultado% DE DESCONTO</strong></div>
                         </div>
                    </div>
                    <!-- Product actions-->
                    <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                       <div class='row col text-center'><a class='col btn btn-outline-dark mt-auto' href='#'>Comprar</a></div>  
                       <div class='row col text-center mt-1'><a class='col btn btn-outline-dark mt-auto' href='#'><i class='bi bi-cart-plus-fill'></i></a></div>
                </div>
                </div>
            </div>";
            }
            
            ?>

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

