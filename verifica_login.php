<?php
session_start();
if(!$_SESSION['usuario']) {
	header('Location: model/login.php');
	exit();
}