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

$ID = $_GET['id'];

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body onload="mostraTamanhoCamiseta()">
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

            <form class="d-flex me-2">
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
<?php
$querySelect = "SELECT * FROM produtos where ID = $ID";

$result = mysqli_query($conn, $querySelect);
$row = mysqli_fetch_assoc($result);
$precoAntigo = $row['PRECO'] + 30;
$nome = $row['DESCRICAO'];
$categoria = $row['CATEGORIA'];
$produtoID = $row['ID'];

$produto = explode(" ", $nome);
 ?>
 <form id="formProduto" action="carrinho.php" method="post">
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><div class="fotorama">
                   <?php echo "<img src='{$row['IMG_PATH700']}'>
                    <img src='{$row['IMG_PATH700']}'>
                    <img src='{$row['IMG_PATH700']}'>"; ?>
                </div></div>
            <div class="col-md-6">
                <input type="text" id="nomeProduto" name="nomeProduto" style="display: none" value="<?php echo $produto[0] ?>">
                <?php echo "<h1 class='display-5 fw-bolder'>{$row['DESCRICAO']}</h1>"; ?>
                <div class="small mb-1">COD: <?php echo $ID ?></div>
                <div class="fs-5 mb-3">
                    <span class="text-muted text-decoration-line-through">R$ <?php echo $precoAntigo ?></span>
                    <span>R$ <?php echo $row['PRECO'] ?></span>
                </div>
                <div class="fs-5 mb-2" id="tamanhoCamiseta" style="display: none">
                    <input type="number" class="form-control" style="display: none" value="<?php echo $ID ?>" name="idProduto">
                    <input type="radio" class="btn-check" name="tamanho" id="PP" autocomplete="off">
                    <label class="btn btn-outline-dark" for="PP">PP</label>
                    <input type="radio" class="btn-check" name="tamanho" id="P" autocomplete="off">
                    <label class="btn btn-outline-dark" for="P">P</label>
                    <input type="radio" class="btn-check" name="tamanho" id="M" autocomplete="off">
                    <label class="btn btn-outline-dark" for="M">M</label>
                    <input type="radio" class="btn-check" name="tamanho" id="G" autocomplete="off">
                    <label class="btn btn-outline-dark" for="G">G</label>
                    <input type="radio" class="btn-check" name="tamanho" id="GG" autocomplete="off">
                    <label class="btn btn-outline-dark" for="GG">GG</label>
                </div>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                <div class="d-flex">
                   <?php echo "<a href='carrinho.php?id=$ID' class='btn btn-outline-dark flex-shrink-0'>
                        <i class='bi-cart-fill me-1'></i>
                        Comprar
                    </a>"; ?>
                </div>
            </div>
        </div>
    </div>
</section>
</form>


<section class="py-3 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Descrição</h2>
<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sit amet lacinia nisi. Nulla vel ultrices sapien, et pulvinar nulla. Donec pretium, libero eget vehicula suscipit, nibh libero fringilla sem, nec vehicula arcu nisl id velit. Praesent ac ultrices ante, ac hendrerit metus. Phasellus efficitur mollis nulla id venenatis. Morbi porttitor tellus non magna cursus, eu sagittis mi dictum. Cras eu ipsum consectetur, imperdiet sem eget, elementum erat. Aliquam faucibus, purus interdum gravida sollicitudin, orci ex dictum sapien, vel condimentum felis augue ut ipsum. Duis non metus ut nisi dictum egestas at tempus justo. Cras porta dui sem, at dictum urna eleifend vel. Morbi commodo dolor magna, auctor ultrices quam bibendum ac. Suspendisse neque eros, gravida quis aliquet a, congue id felis. Maecenas fringilla diam in est maximus, a fermentum est sollicitudin. Nullam malesuada leo sed erat mattis pellentesque. Duis ultrices nisi lorem, eu dictum dui finibus nec.</p>
    </div>
</section>

<section class="py-3 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Especificações Técnicas</h2>
        <p class="mb-0"><strong>Praesent ultrices:</strong></p>
        <p class="mt-0">Lorem ipsum dolor sit amet, consectetur adipiscing.</p>

        <p class="mb-0"><strong>Sed volutpat:</strong></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>

        <p class="mb-0"><strong>Proin fringilla:</strong></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>

        <p class="mb-0"><strong>Integer sollicitudin:</strong></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>

        <p class="mb-0"><strong>Proin porttitor:</strong></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>

        <p class="mb-0"><strong>Morbi commodo:</strong></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>

        <p class="mb-0"><strong>Vestibulum in:</strong></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
    </div>
</section>
<!-- Related items section-->
<section class="py-3 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Produtos Relacionados</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php
            $querySelect = "SELECT * FROM produtos WHERE CATEGORIA = '$categoria' AND ID <> $produtoID ORDER BY RAND() LIMIT 5";
            $result = mysqli_query($conn, $querySelect);
            while($row = mysqli_fetch_assoc($result)) {
                $valorAntigo = $row['PRECO'] + 30;
                echo "<div class='col mb-5'>
                <div class='card h-100'><div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>{$row['CATEGORIA']}</div><a href='produto.php?id={$row['ID']}&descricao={$row['DESCRICAO']}'><img class='card-img-top' src='{$row['IMG_PATH']}' alt='...'/></a><div class='card-body p-4'>
                        <div class='text-center'>
                            <!-- Product name-->
                            <a href='produto.php?id={$row['ID']}&descricao={$row['DESCRICAO']}' style='text-decoration:none'><h5 class='fw-bolder text-black'>{$row['DESCRICAO']}</h5></a>
                            <!-- Product reviews-->
                            <div class='d-flex justify-content-center small text-warning mb-2'>";

                            for($i = 1; $i <= $row['STAR_AVALIACAO']; $i++){

                          echo "<div class='bi-star-fill'></div>
                              
                            ";
                            }


                echo "</div><span class='text-muted text-decoration-line-through'>R$ $valorAntigo</span>
                            R$ {$row['PRECO']}
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                       <div class='row col text-center'><a class='col btn btn-outline-dark mt-auto me-2' href='#'>Comprar</a>   <a class='col btn btn-outline-dark mt-auto' href='#'><i class='bi bi-cart-plus-fill'></i></a></div>
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

<script>
    function mostraTamanhoCamiseta(){
        if(document.getElementById('nomeProduto').value == 'CAMISETA'){
            document.getElementById('tamanhoCamiseta').style.display = 'block';
        }else{
            var element = document.getElementById('tamanhoCamiseta');
            element.remove(); //
        }
    }
</script>
</body>
</html>

