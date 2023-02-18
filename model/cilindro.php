<?php
session_start();
include('conexao.php');

if(empty($_POST['numerocilindro']) || empty($_POST['endereco'])) {
	header('Location: ../login.php');
	exit();
}

$numerocilindro = mysqli_real_escape_string($conexao, $_POST['numerocilindro']);
$fabricacao = mysqli_real_escape_string($conexao, $_POST['fabricacao']);
$vencimento = mysqli_real_escape_string($conexao, $_POST['vencimento']);
$obs = mysqli_real_escape_string($conexao, $_POST['obs']);
$endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);

$query = "select usuario from usuario where usuario = '{$usuario}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

if($row == 1) {
	$_SESSION['mensagem'] = "Cadastrado com sucesso";
	header('Location: ../painel.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
    header('Location: ../painel.php');
	exit();
}