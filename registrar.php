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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>


<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Cadastro</h1>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-5 px-lg-5">
           

<div class="row justify-content-center">
    <div class="p-5" style="width: 100%">


    <form id="sample_form"> 
    <h1 class="h3 mb-3 font-weight-normal">Informações Pessoais</h1>
    <label for="nome" class="mt-3"><span class="text-danger">*</span>Nome Completo</label>
    <input type="text" id="nome" name="nome" class="form-control form_data mt-1" placeholder="Ex: Fábio Alberto da Silva" required autofocus>
    <span id="nome_error" class="text-danger"></span> 
    <label for="cpf" class="mt-3"><span class="text-danger">*</span>CPF</label>
    <input type="text" id="cpf" name="cpf" class="form-control mt-1 form_data" placeholder="Ex: 00011122233" required>
    <p id="cpf_error" class="text-danger"></p> 
    <label for="telefone" class="mt-3"><span class="text-danger">*</span>Telefone</label>
    <input type="text" id="telefone" name="telefone" class="form-control mt-1 form_data" placeholder="Ex: 12 345678912" required>
    <p id="telefone_error" class="text-danger"></p> 
    <label for="email" class="mt-3"><span class="text-danger">*</span>Email</label>
    <input type="email" id="email" name="email" class="form-control mt-1 form_data" placeholder="Ex: example@example.com" required>
    <p id="email_error" class="text-danger"></p> 
    <label for="Senha" class="mt-3"><span class="text-danger">*</span>Senha</label>
    <input type="password" id="senha" name="senha" class="form-control mt- form_data" required>
    <p id="senha_error" class="text-danger"></p> 
    <label for="senha2" class="mt-3"><span class="text-danger">*</span>Repita sua senha</label>
    <input type="password" id="senha2" name="senha2" class="form-control mt-1 form_data" required>
    
    <h1 class="h3 mb-2 mt-5 font-weight-normal">Endereço</h1>
    <p>Preencha com atenção, este endereço será utilizado para entrega de seus produtos comprados.</p>

    <label for="uf" class="mt-3"><span class="text-danger">*</span>UF</label>
    <input type="text" id="uf" name="uf" class="form-control form_data mt-1" placeholder="Ex: SC" required>
    <p id="uf_error" class="text-danger"></p> 
    <label for="cep" class="mt-3"><span class="text-danger">*</span>CEP</label>
    <input type="text" id="cep" name="cep" class="form-control mt-1 form_data" placeholder="Ex: 88240 000" required>
    <p id="cep_error" class="text-danger"></p> 
    <label for="cidade" class="mt-3"><span class="text-danger">*</span>Cidade</label>
    <input type="text" id="cidade" name="cidade" class="form-control mt-1 form_data" placeholder="Ex: São João Batista" required>
    <p id="cidade_error" class="text-danger"></p> 
    <label for="bairro" class="mt-3"><span class="text-danger">*</span>Bairro</label>
    <input type="text" id="bairro" name="bairro" class="form-control mt-1 form_data" placeholder="Ex: Centro" required>
    <p id="bairro_error" class="text-danger"></p> 
    <label for="Rua" class="mt-3"><span class="text-danger">*</span>Rua</label>
    <input type="text" id="rua" name="rua" class="form-control mt-1 form_data" placeholder="Ex: Rua Águas Frias" required>
    <p id="rua_error" class="text-danger"></p> 
    <label for="Complemento" class="mt-3">Complemento</label>
    <input type="text" id="complemento" name="complemento" class="form-control mt-1 form_data" placeholder="Ex: Casa, Apartamento">

    <label for="numero" class="mt-3"><span class="text-danger">*</span>Número</label>
    <input type="text" id="numero" name="numero" class="form-control mt-1 form_data" placeholder="Ex: 77, S/" required>
    <p id="numero_error" class="text-danger"></p> 
        <input class="btn btn-lg btn-outline-dark mt-3 mb-3 btn-block" type="button" name="submit" id="submit" onclick="save_data(); return false;" value="Cadastrar">  
        <span id="messageSuccess" class="text-success"></span> 

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
<script>

    function save_data()
    {
        var form_element = document.getElementsByClassName('form_data');

        var form_data = new FormData();

        for(var count = 0; count < form_element.length; count++)
        {
            form_data.append(form_element[count].name, form_element[count].value);
        }

        document.getElementById('submit').disabled = true;

        var ajax_request = new XMLHttpRequest();

        ajax_request.open('POST', 'validacaoRegistrar.php');

        ajax_request.send(form_data);
		
	//	document.getElementById('sample_form').reset();

        ajax_request.onreadystatechange = function()
        {
            if(ajax_request.readyState === 4 && ajax_request.status === 200)
            {
                document.getElementById('submit').disabled = false;

                var response = JSON.parse(ajax_request.responseText);

                if(response.success !== '')
                {
                    document.getElementById('sample_form').reset();

                    document.getElementById('messageSuccess').innerHTML = response.success;
				

                  /*setTimeout(function(){

                        document.getElementById('message').innerHTML = 'Scanner de Código de Barra';
						document.getElementById('message2').innerHTML = '';

               }, 2000);*/

                    document.getElementById('nome_error').innerHTML = '';
					          document.getElementById('cpf_error').innerHTML = '';
                    document.getElementById('telefone_error').innerHTML = '';
                    document.getElementById('email_error').innerHTML = '';
                    document.getElementById('senha_error').innerHTML = '';
                    document.getElementById('uf_error').innerHTML = '';
                    document.getElementById('cep_error').innerHTML = '';
                    document.getElementById('cidade_error').innerHTML = '';
                    document.getElementById('bairro_error').innerHTML = '';
                    document.getElementById('rua_error').innerHTML = '';
                    document.getElementById('numero_error').innerHTML = '';

                }
                else
                {
                    //display validation error
				          	document.getElementById('nome_error').innerHTML = response.nome_error;
					          document.getElementById('cpf_error').innerHTML = response.cpf_error;
                    document.getElementById('telefone_error').innerHTML = response.telefone_error;
                    document.getElementById('email_error').innerHTML = response.email_error;
                    document.getElementById('senha_error').innerHTML = response.senha_error;
                    document.getElementById('uf_error').innerHTML = response.uf_error;
                    document.getElementById('cep_error').innerHTML = response.cep_error;
                    document.getElementById('cidade_error').innerHTML = response.cidade_error;
                    document.getElementById('bairro_error').innerHTML = response.bairro_error;
                    document.getElementById('rua_error').innerHTML = response.rua_error;
                    document.getElementById('numero_error').innerHTML = response.numero_error;

                }


            }
        }
    }


</script>
</body>
</html>


