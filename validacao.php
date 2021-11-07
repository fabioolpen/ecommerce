<?php
include "conexao.php";

$email = ($_POST['email']);
$senha = ($_POST['senha']);
/*
if (!empty($_POST) AND (empty($_POST['email']) OR empty($_POST['senha']))) {
 //   header("Location: login.php");
    exit;
}
*/
$querylogin = "SELECT ID, NOME, EMAIL FROM clientes WHERE (EMAIL = '".$email ."') AND (SENHA = '". $senha ."')";

$result = mysqli_query($conn, $querylogin);

if(mysqli_num_rows($result) !== 1){
    // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
    header("Location: ./login.php?login=invalido");
    exit();



} else {
    // Salva os dados encontados na variável $resultado
    $resultado = mysqli_fetch_assoc($result);

    // Se a sessão não existir, inicia uma
    if (!isset($_SESSION)) session_start();

    // Salva os dados encontrados na sessão
    $_SESSION['UsuarioID'] = $resultado['ID'];
    $_SESSION['UsuarioNome'] = $resultado['NOME'];
    $_SESSION['UsuarioEmail'] = $resultado['EMAIL'];

    // Redireciona o visitante
    header("location: ./carrinho.php");

}
?>