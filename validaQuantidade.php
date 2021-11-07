
<?php

include "conexao.php";

if($_POST["quantity[]"])
{
   $success = "SUCESSO!";




    $output = array(
        'success'		    =>	$success,

    );

    echo json_encode($output);

}

?>
