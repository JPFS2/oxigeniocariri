<?php
session_start();

if(isset($_GET['sair'])) {
    unset($_SESSION['usuario']);
    unset($_GET['sair']);
    header('Location: login.php');
    exit();
}

if(!$_SESSION['usuario']) {
	header('Location: login.php');
	exit();
}else{

}
