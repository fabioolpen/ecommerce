<?php
if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php"); exit;
}

if (isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    /* session_destroy();

     // Redireciona o visitante de volta pro login
     header("Location: login.php"); exit;*/
    $name = explode(" ", $_SESSION['UsuarioNome']);

}
include "conexao.php";
include "item.php";

//$id = $_GET['id'];
//$_SESSION['cart']=array();
if (isset ( $_GET ['id'] ) && !isset($_POST['update'])) {
    $result = mysqli_query($conn, 'select * from produtos where id=' . $_GET ['id']);
    $product = mysqli_fetch_object($result);
    $item = new Item ();
    $item->id = $product->ID;
    $item->descricao = $product->DESCRICAO;
    $item->preco = $product->PRECO;
    $item->path = $product->IMG_PATH;
    $item->quantidade = 1;
//$b=array("id"=> $ResultId,"descricao"=> "$ResultDescricao", "path"=>"$ResultPath", "preco"=> $ResultPreco, "quantidade"=> 1,);
//array_push($_SESSION['cart'],$b); // Items added to cart
    // Check product is existing in cart
$index = - 1;
if (isset ( $_SESSION ['cart'] )) {
    $cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
    for($i = 0; $i < count ( $cart ); $i ++)
        if ($cart [$i]->id == $_GET ['id']) {
            $index = $i;
            break;
        }
}
if ($index == - 1)
    $_SESSION ['cart'] [] = $item;
else {
    $cart [$index]->quantidade ++;
    $_SESSION ['cart'] = $cart;
}
}

if (isset ( $_GET ['index'] ) && !isset($_POST['update'])) {
    $cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
    unset ( $cart [$_GET ['index']] );
    $cart = array_values ( $cart );
    $_SESSION ['cart'] = $cart;
}
$cartsize = 0;


if (isset($_SESSION['cart'])) {
    // Destrói a sessão por segurança
    /* session_destroy();

     // Redireciona o visitante de volta pro login
     header("Location: login.php"); exit;*/
    $cartsize = count($_SESSION['cart']);

}


/*if (isset($_SESSION['cart'])) {
    // Destrói a sessão por segurança
    /* session_destroy();

     // Redireciona o visitante de volta pro login
     header("Location: login.php"); exit;*/
  /*  array_push($_SESSION['cart'],$b); // Items added to cart

    $cart = $_SESSION['cart'];

}*/


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

    <style>
        /*
       body {
    background: #ddd;
    min-height: 100vh;
    vertical-align: middle;
    display: flex;
    font-family: sans-serif;
    font-size: 0.8rem;
    font-weight: bold
}*/

.title {
    margin-bottom: 5vh
}

.card {
    margin: auto;

    width: 90%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent
}

@media(max-width:767px) {
    .card {
        margin: 3vh auto
    }
}

.cart {
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem
}

@media(max-width:767px) {
    .cart {
        padding: 4vh;
        border-bottom-left-radius: unset;
        border-top-right-radius: 1rem
    }
}

.summary {
    background-color: #ddd;
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color: rgb(65, 65, 65)
}

@media(max-width:767px) {
    .summary {
        border-top-right-radius: unset;
        border-bottom-left-radius: 1rem
    }
}

.summary .col-2 {
    padding: 0
}

.summary .col-10 {
    padding: 0
}

.row {
    margin: 0
}

.title b {
    font-size: 1.5rem
}

.main {
    margin: 0;
    padding: 2vh 0;
    width: 100%
}

.col-2,
.col {
    padding: 0 1vh
}

a {
    padding: 0 1vh
}

.close {
    margin-left: auto;
    font-size: 0.7rem
}

img {
    width: 3.5rem
}

.back-to-shop {
    margin-top: 4.5rem
}

h5 {
    margin-top: 4vh
}

hr {
    margin-top: 1.25rem
}
/*

form {
    padding: 2vh 0
}
*/
select {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
}
/*
input {

}
*/
input:focus::-webkit-input-placeholder {
    color: transparent
}

.btnFecharCompra {
    background-color: #000;
    border-color: #000;
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 0
}

.btn:focus {
    box-shadow: none;
    outline: none;
    box-shadow: none;
    /*color: white;*/
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none
}

.btn:hover {
    color: white
}

a {
    color: black
}

a:hover {
    color: black;
    text-decoration: none
}

#code {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center
}
        </style>
</head>
<body>
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
                <li class="nav-item"><a class="nav-link active" href="ofertas.php">Ofertas</a></li>

            </ul>
            <form action="search.php" method="post" class="d-flex me-5">
                <input class="form-control me-2" name="search" id="search" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
            </form>

            <form action="cliente.php" method="post" class="d-flex me-2">
                <button class="btn btn-outline-dark" type="submit"><i class="bi bi-person-fill"> <?php if (isset($_SESSION['UsuarioID']))  echo $name[0]  ?></i></button>
            </form>

            <form class="d-flex">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>

                    <span class="badge bg-dark text-white ms-1 rounded-pill"><?php if (isset($_SESSION['cart'])){  echo $cartsize;}else{ echo 0;}  ?></span>
                </button>
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

<div class="card mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>CARRINHO DE COMPRAS</b></h4>
                    </div>
                </div>
            </div>


<div class="click-cart">


<?php
/*
foreach ($cart as $produto) {*/

if (isset($_SESSION['cart'])) {

$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
$s = 0;
$index = 0;
for($i = 0; $i < count ( $cart ); $i ++) {
    $s += $cart [$i]->preco * $cart [$i]->quantidade;
?>
    <div class="cart-row row border-top border-bottom">
        <div class="row main align-items-center">
            <div class="col-2"><img class="img-fluid" src="<?php echo $cart[$i]->path; ?>"></div>
                   <div class='col'>
                <div class="row text-muted"><?php echo $cart[$i]->descricao; ?></div>
                <div class="row">CAMISETA HANDBONE</div>
            </div>
            <div class="col d-flex"><button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                    <i class="bi bi-dash-lg"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="<?php echo $cart[$i]->quantidade; ?>" type="number"
                       class="form-control form-control-sm quantity-input" style="width: 60px" />

                <button id="btnPlus" class="btn btn-link px-2"
                        onclick="incrementa()">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
          <div class="col shop-price">R$ <?php echo $cart[$i]->preco; ?></div>
            <div class="col-2">
            <a href="carrinho.php?index=<?php echo $index; ?>" class="text-muted delete-cart"><i class="bi bi-x-lg"></i></a>
            </div>
            </div>
    </div>

    <?php
    $index ++;
    }
}
if ($cartsize < 1){
echo "<div class='text-center text-muted'>Seu carrinho está vazio.</div>";

}

    ?>

</div>

            <div class="back-to-shop"><a href="index.php">&leftarrow;</a><span class="text-muted">Voltar a Loja</span></div>
        </div>
        <div class="col-md-4 summary">
            <div>
                <h5><b>FINALIZAR COMPRA</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">SUBTOTAL:</div>
                <div class="col text-right cart-total-price"></div>
                <input type="number" id="subtotal" class="cart-total-input">
            </div>
            <form class="mt-3 mb-0">
            <p>CUSPOM DE DESCONTO</p> <input id="code" placeholder="Enter your code">
            </form>


            <p>ENDEREÇO</p>
            <?php
            $endQuery = "SELECT endereco.ID, endereco.ID_CLIENTE, endereco.NOME_CLIENTE, endereco.UF, endereco.CEP, endereco.CIDADE, endereco.BAIRRO, endereco.RUA, endereco.COMPLEMENTO, endereco.END_NUMERO from endereco, clientes WHERE endereco.ID_CLIENTE = clientes.ID AND ID_CLIENTE = {$_SESSION['UsuarioID']}";
            $resultEnd = mysqli_query($conn, $endQuery);

            while ($rowEnd = mysqli_fetch_assoc($resultEnd)) {

              echo "<div class='card py-3 px-2 align-items-start mb-3'>
            <div class='form-check'>

                <input class='form-check-input' onclick='calculo();' onchange='cartTotal()' type='radio' name='radioCEP' value='{$rowEnd['CEP']}' id='radioCEP'>
                <label class='form-check-label' for='flexRadioDefault1'>
                    {$rowEnd['RUA']} - {$rowEnd['END_NUMERO']} - {$rowEnd['COMPLEMENTO']} - {$rowEnd['BAIRRO']} - {$rowEnd['CIDADE']} - {$rowEnd['CEP']} - {$rowEnd['UF']}
                </label>
         
           
             </div>
             
            </div>";
            }
            ?>

                <div class="mb-3 cart-frete-row" id='retorno'></div>



            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">PREÇO TOTAL</div>
                <div id="carTotal" class="col text-right cart-total-x"></div>
            </div> <button class="btnFecharCompra">FECHAR COMPRA</button>
        </div>
    </div>
</div>

<footer class="py-5 bg-dark mt-5">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; e-Commerce 2021</p></div>
</footer>

<script>
    function incrementa(){
        document.getElementById('form1').value = document.getElementById('form1').value++;
        document.getElementById('form1').focus();

    }



    updateCartTotal();
    updateCartResult();
    let removeCartItemButtons = document.querySelectorAll('.delete-cart');
    for (let i = 0; i < removeCartItemButtons.length; i++) {

        let button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
        updateCartTotal();
        updateCartResult();
    }

    let quantityInputs = document.querySelectorAll('.quantity-input');
    for (let i = 0; i < quantityInputs.length; i++) {

        let input = quantityInputs[i]
        input.addEventListener('change', quantityChanged);
    }

    function removeCartItem(event) {
        let buttonCliked = event.target;
        buttonCliked.parentElement.parentElement.remove()
        updateCartTotal()
        updateCartResult()
    }

    function quantityChanged() {

        let input = event.target;
        if (isNaN(input.value) || input.value <= 0) {
            input.value = 1;
        }
        updateCartTotal();
        updateCartResult()
    }

    function updateCartTotal() {
        let cartItemContainer = document.querySelector('.click-cart');
        let cartRows = cartItemContainer.querySelectorAll('.cart-row');

        let total = 0
        for (let i = 0; i < cartRows.length; i++) {
            let cartRow = cartRows[i]
            let priceElement = cartRow.querySelector('.shop-price');
            let quantityElement = cartRow.querySelector('.quantity-input');

            let price = parseFloat(priceElement.innerText.replace('R$ ', ''))
            let quantity = quantityElement.value
            total = total + (price * quantity)
        }
        total = Math.round(total * 100) / 100;


        document.querySelector('.cart-total-price').innerText = 'R$ ' + total;
        document.querySelector('.cart-total-input').value = total;

    /*  let subtotalElement = cartRow.querySelector('.cart-total-price');
        let subtotal = parseFloat(subtotalElement.value);

        let freteElement = cartRows2.querySelector('.cart-frete');
        let frete = freteElement.value;
        let totalcart = subtotal + frete;

        document.querySelector('.cart-total-x').innerText = totalcart;*/

    }

    function updateCartResult() {
        let subtotal = parseFloat(document.getElementById('subtotal').value);
       var frete = <?php echo $_POST['valorFrete'] ?>>;
        let total = Math.round(subtotal + frete);


        document.getElementById('carTotal').innerText = 'R$ ' + total;


        /*  let subtotalElement = cartRow.querySelector('.cart-total-price');
            let subtotal = parseFloat(subtotalElement.value);

            let freteElement = cartRows2.querySelector('.cart-frete');
            let frete = freteElement.value;
            let totalcart = subtotal + frete;

            document.querySelector('.cart-total-x').innerText = totalcart;*/

    }


</script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>

    function calculo(){
        var cep = document.querySelector('input[name="radioCEP"]:checked').value;
        $.post('calcula.php',{cep:cep},function(data){
            $("#retorno").html(data);
        });
    }
</script>

</script>
</body>
</html>