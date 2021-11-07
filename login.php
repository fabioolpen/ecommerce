<?php
include "conexao.php";
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
           

<div class="row justify-content-center">
    <div class="p-5" style="width: 450px">


<form action="validacao.php" method="post" class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal text-center">Entrar</h1>
    <input type="email" id="inputEmail" name="email" class="form-control mb-3" placeholder="Email" required autofocus>

    <input type="password" name="senha" id="inputPassword" class="form-control mb-1" placeholder="Senha" required>
    <?php
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(strpos($fullUrl, "login=invalido") == true){
        echo "<p class='text-danger'>Email ou senha inválidos!</p>";
    }

    ?>
    <a href="registrar.php" class="text-dark" style="text-decoration: none">Criar uma conta</a><br>   
   <div class="text-center">
        <button class="btn btn-lg btn-outline-dark btn-block mt-3 " name="save" type="submit">Login</button>
</div>
    </form>
    </div>
</div>
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