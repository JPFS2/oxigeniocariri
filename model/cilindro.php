<?php

include('conexao.php');

$numero = filter_input(INPUT_POST, 'numerocilindro');
$fab = filter_input(INPUT_POST, 'fabricacao');
$venc = filter_input(INPUT_POST, 'vencimento');
$obs = filter_input(INPUT_POST, 'obs');

if (isset($_FILES['arquivo']['tmp_name'])){
    $endereco = '../files/' . $numero . '.' . substr($_FILES['arquivo']['name'], -3);
    move_uploaded_file($_FILES['arquivo']['tmp_name'],$endereco);
}

$_FILES['arquivo']['tmp_name'] = null;

$query = "INSERT INTO cilindro(codigo, fabricacao, validade, observacao, endereco) VALUES ('{$numero}','{$fab}','{$venc}','{$obs}','{$endereco}')";

if(mysqli_query($conexao, $query)){
    $_SESSION['aviso'] = "Cadastrado com sucesso";
    header("Location: ../painel.php");

}else{
    $_SESSION['aviso'] = "Erro".$query;
}



echo $_FILES['arquivo']['name'];