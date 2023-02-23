<?php

session_start();
include('conexao.php');

$id = filter_input(INPUT_GET,"id");
$query1 = "DELETE FROM cilindro WHERE codigo = {$id}";
$query2 = "SELECT * FROM cilindro WHERE codigo = {$id}";

$caminho = mysqli_query($conexao, $query2);
$cam = mysqli_fetch_all($caminho);

if(mysqli_query($conexao, $query1)){
    unlink('..'.$cam[0][4]);
    $_SESSION['aviso'] = "Excluido com sucesso ";
    header("Location: ../painel.php");

}else{
    echo $query;
}
