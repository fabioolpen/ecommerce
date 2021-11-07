
<?php

include "conexao.php";

if($_POST["nome"])
{
	//sleep(3);


	$success = '';


    $nome = $_POST['nome'];
    $cpf = trim($_POST['cpf']);
    $telefone = trim($_POST['telefone']);
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    $uf = trim($_POST['uf']);
    $cep = trim($_POST['cep']);
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $complemento = $_POST['complemento'];
    $numero = $_POST['numero'];

	
	//$idLeitura = $_POST["idLeitura"];




	$nome_error = '';
    $cpf_error = '';
    $telefone_error = '';
    $email_error = '';
    $senha_error = '';
    $uf_error = '';
    $cep_error = '';
    $cidade_error = '';
    $bairro_error = '';
    $rua_error = '';
    $numero_error = '';




	if(empty(trim($nome)) || strlen($nome) < 5)
	{
		$nome_error = 'O nome deve conter no mínimo 5 caracteres!';
	}else{
		$barcode_error = '';
	}

    if(strlen($cpf) != 11)
	{
		$cpf_error = 'O CPF digitado é inválido!';
	}else{
		$cpf_error = '';
	}

    if(strlen($telefone) != 11)
	{
		$telefone_error = 'O telefone digitado é inválido! Você deve inserir o DDD e o número.';
	}else{
		$telefone_error = '';
	}

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$email_error = 'O email digitado é inválido!';
	}else{
		$email_error = '';
	}

   

    

    if($senha != $senha2)
	{
		$senha_error = 'As senhas inseridas devem ser iguais!';
	}

    if(strlen($senha) < 5)
	{
		$senha_error = 'Digite uma senha mais forte!';
	}

    if(empty($senha))
	{
		$senha_error = 'Digite uma senha!';
	}

    if(strlen($uf) != 2)
	{
		$uf_error = 'O UF digitado é inválido!';
	}else{
		$uf_error = '';
	}

    if(strlen($cep) != 8)
	{
		$cep_error = 'O CEP digitado é inválido!';
	}else{
		$cep_error = '';
	}

    if(empty($cidade))
	{
		$cidade_error = 'A cidade digitada é inválida!';
	}else{
		$cidade_error = '';
	}

    if(empty($bairro))
	{
		$bairro_error = 'O bairro digitado é inválido!';
	}else{
		$bairro_error = '';
	}

    if(empty($rua))
	{
		$rua_error = 'A rua digitada é inválida!';
	}else{
		$rua_error = '';
	}

    if(empty($numero))
	{
		$numero_error = 'O numero digitado é inválido!';
	}else{
		$rua_error = '';
	}
    

	if($nome_error == '' && $cpf_error == '' && $telefone_error == '' && $email_error == '' && $senha_error == '' && $uf_error == '' && $cep_error == '' && $cidade_error == '' && $bairro_error == '' && $rua_error == '' && $numero_error == '')
	{
		$success = '<div class="alert alert-success">Cadastrado com sucesso!</div>';

        $queryCadastro = "INSERT INTO clientes (NOME, CPF, TELEFONE, EMAIL, SENHA, UF, CEP, CIDADE, BAIRRO, COMPLEMENTO, RUA, END_NUMERO) VALUES ('$nome', '$cpf', '$telefone', '$email', '$senha', '$uf', '$cep', '$cidade', '$bairro', '$complemento', '$rua', '$numero')";

        $result = mysqli_query($conn, $queryCadastro);
	}

	$output = array(
		'success'		    =>	$success,
		'nome_error'	    =>	$nome_error,
        'cpf_error'	        =>	$cpf_error,
        'telefone_error'	=>	$telefone_error,
        'email_error'	    =>	$email_error,
        'senha_error'	    =>	$senha_error,
        'uf_error'      	=>	$uf_error,
        'cep_error'	        =>	$cep_error,
        'cidade_error'	    =>	$cidade_error,
        'bairro_error'	    =>	$bairro_error,
        'rua_error'	        =>  $rua_error,
        'numero_error'	    =>	$numero_error

	);

	echo json_encode($output);
	
}

?>
