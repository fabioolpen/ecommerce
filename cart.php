<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<?php
session_start ();
require 'conexao.php';
require 'item.php';
if (isset ( $_GET ['id'] ) && !isset($_POST['update'])) {

    $result = mysqli_query ( $conn, 'select * from produtos where id=' . $_GET ['id'] );
    $product = mysqli_fetch_object ( $result );
    $item = new Item ();
    $item->id = $product->ID;
    $item->name = $product->DESCRICAO;
    $item->price = $product->PRECO;
    $item->quantity = 1;
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
        $cart [$index]->quantity ++;
        $_SESSION ['cart'] = $cart;
    }
}

// Delete product in cart
if (isset ( $_GET ['index'] ) && !isset($_POST['update'])) {
    $cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
    unset ( $cart [$_GET ['index']] );
    $cart = array_values ( $cart );
    $_SESSION ['cart'] = $cart;
}

// Update quantity in cart
if(isset($_POST['update'])) {
    $arrQuantity = $_POST['quantity'];

    // Check validate quantity
    $valid = 1;
    for($i=0; $i<count($arrQuantity); $i++)
        if(!is_numeric($arrQuantity[$i]) || $arrQuantity[$i] < 1){
            $valid = 0;
            break;
        }
    if($valid==1){
        $cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
        for($i = 0; $i < count ( $cart ); $i ++) {
            $cart[$i]->quantity = $arrQuantity[$i];
        }
        $_SESSION ['cart'] = $cart;
    }
    else
        $error = 'Quantity is InValid';
}

?>
<?php echo isset($error) ? $error : ''; ?>
<form method="post">
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>Option</th>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity  <input type="submit" name="update" onclick="save_data(); return false;">
            </th>
            <th>Sub Total</th>
        </tr>
        <?php
        $cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
        $s = 0;
        $index = 0;
        for($i = 0; $i < count ( $cart ); $i ++) {
            $s += $cart [$i]->price * $cart [$i]->quantity;
            ?>
            <tr>
                <td><a href="cart.php?index=<?php echo $index; ?>"
                       onclick="return confirm('Are you sure?')">Delete</a></td>
                <td><?php echo $cart[$i]->id; ?></td>
                <td><?php echo $cart[$i]->name; ?></td>
                <td><?php echo $cart[$i]->price; ?></td>
                <td><input type="text" class="form_data" value="<?php echo $cart[$i]->quantity; ?>"
                           style="width: 50px;" name="quantity[]"></td>
                <td><?php echo $cart[$i]->price * $cart[$i]->quantity; ?></td>
            </tr>
            <?php
            $index ++;
        }
        ?>
        <tr>
            <td colspan="5" align="right">Sum</td>
            <td align="left"><?php echo $s; ?></td>
        </tr>
    </table>
</form>
<br>
<a href="index.php">Continue Shopping</a>

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

        ajax_request.open('POST', 'validaQuantidade.php');

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


                    document.getElementById('messageSuccess').innerHTML = response.quantity;


                    /*setTimeout(function(){

                          document.getElementById('message').innerHTML = 'Scanner de Código de Barra';
                          document.getElementById('message2').innerHTML = '';

                 }, 2000);*/



                }



            }
        }
    }


</script>